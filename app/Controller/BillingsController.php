<?php

namespace App\Controller;

use Core\Controller\Controller;

class BillingsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Billing'); // facturation //

		$this->loadModel('Cabinet'); // cabinet doctors //

		$this->loadModel('IntervCab'); // intervention cabinet //

		$this->loadModel('Line'); // Lignes //

	}

	/////////////////////FACTURATION ////////////////////////////	

	// function qui affiche les factures des cabinets des médecins // 
	public function billings() {

		$this->render('billings.billings');
	}

	// function qui remonte les données pour la table facture cab //
	
	public function allbillings() {

		$result = $this->Billing->allBillings();

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui edit la facture / id_fact //
	
	public function editbilling() {

		if (!empty($_POST)) {

			$this->Billing->update($_POST['id_fact'],[

				'date_fact' => $_POST['dateF']
			]);			

		}

	}

	// function qui affiche toutes les Factures des cabinets des médecins en pdf //
	
	public function viewallfactpdf() {

		$fact = $this->Billing->allBillings();		

		$this->render('billings.viewAllFactpdf', compact('fact'));
	}	

	// function qui creer la facture / id interv //
	
	public function generatebilling() {		

		$result = $this->IntervCab->findIntervdoc($_POST['id']);
		
		$mTHT = $result[0]->mTHT;
		$tva = round($mTHT * 0.2, 2);
		$mttc = round($mTHT + $tva, 2);
		
		if (!empty($_POST)) {

			$this->Billing->create([

				'cab_id' => $result[0]->cab_id,

				'interv_cab' => $result[0]->id_interv,

				'date_fact' => date('Y-m-d'),

				'num_fact' => $result[0]->num_interv,

				'montantTTC' => $mttc,

				'etat' => "A Facturer"
			]);			

		}

	}	

	// function qui supprime l'intervention //
	
	public function deletebilling() {

		if (!empty($_POST)) {   		

			$this->Billing->delete($_POST['id']);
		}

	}

	// function qui modifie l'état de la facture Cab //
	
	public function etatfacture() {

		if (!empty($_POST)) {

			if ($_POST['textslc'] == "Facturer") {
				
				$this->Billing->update($_POST['id'],[

					'etat' => $_POST['textslc']
				]);

			} 		

		}
	}

	///////////////////INTERV CABINET MEDICAUX ///////////////////
	
	// function qui affiche la table des interventions des cabinets des médecins // 
	public function intervsdoctors() {

		$this->render('billings.intervsdoctors');
	}

	// function qui remonte les données pour la table interv doctors //
	
	public function affTableinterv() {

		$interv = $this->Billing->allintervdoctor();

		$output = array("data" => $interv);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui affiche toutes les interventions des cabinets des médecins en pdf //
	
	public function viewallinterv() {

		$interv = $this->IntervCab->allintervcab();		

		$this->render('billings.viewAllIntervpdf', compact('interv'));
	}		

	// function qui affiche les bon d'interventions des cabinets des médecins en pdf //
	 
	public function viewinterv() {

		$interv = $this->IntervCab->findIntervdoc($_GET['id']);

		$line = $this->Line->findLinesPdf($_GET['id']);		

		$this->render('billings.viewintervpdf', compact('interv', 'line'));
	}

	// function qui affiche les factures des cabinets des médecins en pdf //
	 
	public function viewfact() {

		$fact = $this->Billing->findfactdoc($_GET['id']);

		$line = $this->Line->findLinesPdf($fact[0]->interv_cab);		

		$this->render('billings.viewfactpdf', compact('fact', 'line'));
	}		

	// function qui remonte le dernier numéro ST ou SI //
	
	public function findnuminterv() {

		$result = $this->Billing->findNumInterv($_POST['deb']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// function qui recherche si le bon d'intervention à etait validé //
	
	public function findvalidinterv() {

		$result = $this->IntervCab->findValidInterv($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui verifie si le cabinet a des interventions //
	
	public function checkedintervcab() {

		if (!empty($_POST)) {
			
			$result = $this->Cabinet->CheckedIntervCab($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);
		}

	}

	// function qui ajoute une interv //
	
	public function addinterv() {

		if (!empty($_POST)) {

			$cabid = substr($_POST['nomcab'], -1);

			$this->IntervCab->create([

				'cab_id' => $cabid,

				'date' => date('Y-m-d'),

				'num_interv' => $_POST['numinterv'],

				'designation' => $_POST['design'],

				'etat' => "Attente Lignes",

				'validate' => "0",

				'validate_cab' => "0",

				'travaux' => "0",
			]);			

		}

	}

	// function qui edit l'interv / id_interv //
	
	public function editinterv() {

		if (!empty($_POST)) {

			$this->IntervCab->update($_POST['id_interv'],[

				'cab_id' => $_POST['nomcab'],

				'date' => $_POST['dateI'],

				'num_interv' => $_POST['numinterv'],				

				'designation' => $_POST['design']
			]);			

		}

	}

	// function qui supprime l'intervention / id interv //
	
	public function deleteintervcab() {

		if (!empty($_POST)) {   		

			$this->Line->deleteTLines($_POST['id']); // suppréssion de toutes les lignes de l'interv cab 
			$this->IntervCab->delete($_POST['id']); // suppréssion de l'interv cab
		}

	}

	// function qui modifie l'état de l'interv Cab //
	
	public function etatintervcab() {

		if (!empty($_POST)) {

			if ($_POST['valslc'] == 1) { // Validation Bon Intervention //

				$result = $this->Line->countmhtInterv($_POST['id']);

				$mTHT = number_format($result[0]->mtht, 2,'.', ' ');
				
				$this->IntervCab->update($_POST['id'],[

					'totalHT' => $mTHT,

					'etat' => 'Validation',

					'validate' => "1"
				]);				

			} else if ($_POST['valslc'] == 2) { // Attente Validation Cabinet //
				
				$this->IntervCab->update($_POST['id'],[

					'etat' => 'Attente Validation Cab'
				]);

			} else if ($_POST['valslc'] == 3) { // Validation Cabinet //
				
				$this->IntervCab->update($_POST['id'],[

					'etat' => 'Validation Cabinet',

					'validate_cab' => "1"
				]);

			} else if ($_POST['valslc'] == 4) { // Refus Cabinet //

				$this->IntervCab->update($_POST['id'],[ 

					'etat' => 'Refus Cabinet'
				]);				

			} else if ($_POST['valslc'] == 5) { // Travaux Réaliser //
				
				$this->IntervCab->update($_POST['id'],[

					'etat' => 'Travaux Réaliser',

					'travaux' => "1"
				]);						

			} 					

		}
	}

	////////////////////LINES////////////////////

	// function qui remonte les données lines / id = interv cab //
	
	public function findlines() {

		$result = $this->Line->findLines($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// function add line //
	
	public function addline() {

		if (!empty($_POST)) {

			$idInterv = $_POST['ID_interv'];

			$line = $this->Line->countLines($idInterv);

			if($line[0]->Qtl == 0) {

				$this->IntervCab->update($idInterv, [					

					'etat' => "Attente Validation"

				]);
			}			

			$mTHT = round($_POST['prix_ht'] * $_POST['quantite'], 2);			

			$this->Line->create([

				'intervs_id' => $idInterv,

				'designation' => $_POST['designation'],

				'quantite' => $_POST['quantite'],

				'ligne_ht' => $_POST['prix_ht'],

				'montantTHT' => $mTHT
			]);

		}
	}

	// function edit line //
	
	public function editline() {

		if (!empty($_POST)) {

			$mTHT = round($_POST['prix_ht'] * $_POST['quantite'], 2);

			$this->Line->update($_POST['id_line'],[				

				'designation' => $_POST['designation'],

				'quantite' => $_POST['quantite'],

				'ligne_ht' => $_POST['prix_ht'],

				'montantTHT' => $mTHT
			]);			

		}

	}

	// function qui supprime la ligne selectionner //
	
	public function deleteLine() {

		if (!empty($_POST)) {   		

			$this->Line->delete($_POST['id']); // supprime la ligne //

			// recalcule le montant ht des ligne & update intervCab //

			$result = $this->Line->countmhtInterv($_POST['id_interv']);

			$mTHT = number_format($result[0]->mtht, 2,'.', ' ');

			$this->IntervCab->update($_POST['id_interv'], [

				'totalHT' => $mTHT

			]);
		}

	} 	

	////////////////////CABINET MEDICAUX /////////////////////////
	
	// function qui affiche la page liste des cabinets médecins //
	
	public function listpratice() {

		$this->render('billings.cabdoctors');
	}	

	// function qui remonte les données pour la table liste cabinets médicaux //
	
	public function listcabdoctors() {

		$result = $this->Cabinet->all();

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function add cabinet //
	
	public function addcab(){

		if (!empty($_POST)) {

			$this->Cabinet->create([

				'nom_cab' => $_POST['nomcab'],

				'telephone' => $_POST['phone'],

				'email' => $_POST['email']
			]);			

		}
	} 

	// function edition cabinet //
	 
	public function editcab(){

		if (!empty($_POST)) {

			$this->Cabinet->update($_POST['id_cab'], [

				'nom_cab' => $_POST['nomcab'],

				'telephone' => $_POST['phone'],

				'email' => $_POST['email']
			]);			

		}
	}

	// function delete cabinet //
	
	public function deletecab(){

		if (!empty($_POST)) {   		

			$this->Cabinet->delete($_POST['id']);
		}
	}

	// function data cabinet //
	
	public function affdatacabinet() {

		$result = $this->Cabinet->datacabinet($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// function qui affiche la liste des cabinets en pdf //
	
	public function viewallcabpdf() {

		$this->render('billings.viewAllCabPdf');
	}

	
}