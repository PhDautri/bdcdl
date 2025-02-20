<?php

namespace App\Controller;

use Core\Controller\Controller;

class QuotationsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Quotation');
		$this->loadModel('Panne');
		$this->loadModel('Event');

	}

	// function qui affiche tout les devis //
	
	public function quotation(){	

		$this->render('quotations.quotation');

	}

	// function qui remonte toutes les devis //
	
	public function quotationAll(){

		$quota = $this->Quotation->allquota();		
		
		$output = array("data" => $quota);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui affiche les devis en attente //
	
	public function affpendingquote(){	

		$this->render('quotations.pendingquote');

	}

	// function qui remonte les devis en attente //
	
	public function pendingquote(){

		$quota = $this->Quotation->PendingQuote();		
		
		$output = array("data" => $quota);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui remonte le(s) devis pour la panne //
	
	public function affQuota() {

		$result =  $this->Quotation->affquota($_POST['id']);

		$output = array("data" => $result);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// function qui modifie l'état du devis et etat panne/ id = id quota - idpanne - valslc - contribut - numquota //
	
	public function etatQuota() {				

		if (!empty($_POST)) {			

			if ($_POST['datev'] == "") {
				$datev = NULL;					
			} else {
				$datev = $_POST['datev'];
			}

			if ($_POST['dater'] == "") {
				$dater = NULL;
			} else {
				$dater = $_POST['dater'];
			}

			if ($_POST['ID_CONTRIB']) {

				$idcontrib = $_POST['ID_CONTRIB'];
			} else {
				$idcontrib = NULL;
			}

			if ($_POST['valslc'] == "1") { // devis reçu //

				$event = 'Réception Devis';
				$desig = 'Devis Reçu - Intervenant:' . $_POST['contribut'];				
	
				$this->Quotation->update($_POST['IDQuota'],[

					'date_quota' => $_POST['datequota'],
					'date_vali_quota' => $datev,
					'date_refus_quota' => $dater,
					'num_devis' => $_POST['numQuota'],
					'montantDE' => $_POST['mQuota'],
					'etat_devis' => 'Devis En Attente'

				]);

				// mise a jour de la panne //
				$this->Panne->update($_POST['IDP_ED_Quota'],[
					'etat_panne' => "Devis Reçu",
					'etat_devis' => 2					

				]);

			} else if ($_POST['valslc'] == "2") { // devis accepté //

				$date = strftime('%d-%m-%Y',strtotime($_POST['datev'])); // met la date de validation version française //			
				$event = 'Accéptation Devis';
				$desig = 'Accéptation Devis ' . $_POST['contribut'] . ' - Numéro:'. $_POST['numquota'] . ' - validé le ' . $date;

				$this->Quotation->update($_POST['IDQuota'],[ 
					'date_vali_quota' => $datev,
					'date_refus_quota' => $dater,
					'etat_devis' => 'Devis Accepté'				
				]);

				// mise a jour de la panne //
				$this->Panne->update($_POST['IDP_ED_Quota'],[
					'etat_panne' => 'Attente Réparation',
					'etat_devis' => 3
				]);				

			} else if ($_POST['valslc'] == "3") { // devis refusé //

				// faire verification devis validé sur panne en cours et nbr de quota en "Devis en Attente" dans table devis//
				$result = $this->Panne->getpanne($_POST['IDP_ED_Quota']); // id panne //

				if ($result[0]->etat_devis != '3') { // un devis n'est pas validé //

					if ($result[0]->nbrquotatt == '1') {
						// un seul devis en attente existe //
						$etat_panne = "Attente Décision";
						$etat_devis = 5;

					} else if ($result[0]->nbrquotatt > '1') {
						// plusieurs devis en attente existe //
						$etat_panne = "Devis Reçu";
						$etat_devis = 2;
					}

					$this->Panne->update($_POST['IDP_ED_Quota'],[						
			            'etat_devis' => $etat_devis,
			            'etat_panne' => $etat_panne
			        ]);

				} else { // un devis et validé //

					// mise a jour panne //					
					$this->Panne->update($_POST['IDP_ED_Quota'],[
			            'etat_devis' => 3
			        ]);
				}				

				$date = strftime('%d-%m-%Y',strtotime($_POST['dater']));
				$event = 'Devis Refusé';
				$desig = 'Refus Devis ' . $_POST['contribut'] . ' - Numéro:'. $_POST['numquota'] . ' - refusé le ' . $date;

				// mise a jour devis //
				$this->Quotation->update($_POST['IDQuota'],[
					'date_vali_quota' => $datev,
					'date_refus_quota' => $dater,
					'etat_devis' => 'Devis Refusé'				
				]);
				
			} else if ($_POST['valslc'] == "4") { // devis réactualisé reçu //

				$event = 'Réception Devis Réactualisé';
				$desig = 'Devis Réactualisé Reçu - Intervenant:' . $_POST['contribut'];

				$this->Quotation->update($_POST['IDQuota'],[
					'date_quota' => $_POST['datequota'],
					'date_refus_quota' => null,
					'num_devis' => $_POST['numQuota'],
					'montantDE' => $_POST['mQuota'],
					'etat_devis' => 'Devis En Attente'
				]);

				// mise a jour de la panne //
				$this->Panne->update($_POST['IDP_ED_Quota'],[
					'etat_panne' => "Devis Reçu",
					'etat_devis' => 2					

				]);
			}			

			// ecriture de l'événement //
			$this->Event->create([
				'user' => $_SESSION['name'],
				'pannes_id' => $_POST['IDP_ED_Quota'],
				'contribut_id' => $idcontrib,
				'date_event' => date('Y-m-d'),
				'heure_event' => date('H:i'),
				'event' => $event,
				'designation' => $desig
			]);			
			
		}
	}	

	// edition du devis //
	
	public function editQuota(){

		// modifie l'evenement //

		if ($_POST['inp']) { // si inp existe //
							
			$result = $this->Event->findeventdesig($_POST['IDP_ED_Quota'], $_POST['inp'], $_POST['ID_CONTRIB']);

			$desig = $result[0]->designation;
			$explo = explode('-', $desig); // explode la chaine de caractére //

			if ($_POST['datev']) {
				$date = $_POST['datev'];
				$text = 'validé le ';
			} else if ($_POST['dater']) {
				$date = $_POST['dater'];
				$text = 'refusé le ';
			}

			$datefr = strftime('%d-%m-%Y',strtotime($date));
			$reform = $explo[0] .'-'. $explo[1] .'- '. $text . $datefr;

			$this->Event->update($result[0]->id,[

				'designation' => $reform

			]);
			
		}

		if (!empty($_POST)) {			

			if ($_POST['datev'] == "") {
				$datev = NULL;					
			} else {
				$datev = $_POST['datev'];
			}

			if ($_POST['dater'] == "") {
				$dater = NULL;
			} else {
				$dater = $_POST['dater'];
			}

			$this->Quotation->update($_POST['IDQuota'],[

				'date_request_quota' => $_POST['daterequest'],
				'date_quota' => $_POST['datequota'],
				'date_vali_quota' => $datev,
				'date_refus_quota' => $dater,
				'num_devis' => $_POST['numQuota'],
				'montantDE' => $_POST['montantQuota']			
			]);
			
		}
	}

	// function qui remonte le nombre de devis par panne  //
		
	public function Nbrquota() {

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$nbr = $this->Quotation->countnbrquota($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($nbr);
		}
	}

	// function qui remonte le nombre de devis refusé pour la même panne //
	
	public function nbrDenyQuota() {

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$nbr = $this->Quotation->nbrdenyquota($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($nbr);
		}
	}	

	// function qui calcul le montant devis total par id matériel //
	
	public function countQuotaT() {

		$result = $this->Quotation->countquotat($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// function qui calcul le montant devis par id panne //
	
	public function countQuota() {

		$result = $this->Quotation->countquota($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}	

	// remonte les données lier a la panne et devis validé (contribut & contact) / id panne /
	
	public function findDataQuotaValidate() {

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$panne = $this->Quotation->finddataquotavalidate($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($panne);
			
		}

	}

	// remonte les données lier au devis / id quota //
	
	public function findDataQuota() {

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$panne = $this->Quotation->finddataquota($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($panne);
			
		}

	}
	
}