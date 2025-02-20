<?php

namespace App\Controller;

use Core\Controller\Controller;

class PannesController extends AppController {

	public function __construct(){

		parent::__construct();

		$this->loadModel('Panne');

		$this->loadModel('Event');

		$this->loadModel('Material');

		$this->loadModel('Chart');

		$this->loadModel('Quotation');

	}

	// function qui affiche toutes les pannes //
	
	public function pannes(){	

		$this->render('pannes.pannes');

	}

	// function qui remonte toutes les pannes //
	
	public function pannesAll(){

		$panne = $this->Panne->allpanne();		
		
		$output = array("data" => $panne);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui affiche les pannes par matériel // id matériel//
	
	public function affPanne(){

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {
			
			$this->Panne->affpanne($_POST['id'], $_POST['index']);
		   
		}
	}

	// function qui affiche les pannes en attente de rép //
	
	public function pannesAttenteRep(){	

		$this->render('pannes.pannesattrep');

	}

	// function qui affiche les pannes en attente de réparation //
	
	public function attenterep() {		

	    $panne = $this->Panne->affpannesAttenteRep();		
	
		$output = array("data" => $panne);

		header('Content-Type: aplication/json');

		echo json_encode($output);	

	}

	// function qui affiche les pannes de volets en attente de rép //
	
	public function pannesAttenteRepVolets(){	

		$this->render('pannes.pannesattrepvolet');

	}

	// function qui affiche les pannes en attente de réparation //
	
	public function attenterepvolet() {		

	    $panne = $this->Panne->affpannesAttenteRepvolet();		
	
		$output = array("data" => $panne);

		header('Content-Type: aplication/json');

		echo json_encode($output);	

	}

	// verifie si une panne et active pour le matériel / id materiel //
	
	public function checkedPanne(){

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {			

			$panne = $this->Panne->checkedpanne($_POST['id']);			

			header('Content-Type: aplication/json');

		    echo json_encode($panne);
			
		}
	}

	// function qui ajoute une panne au matériel //
		
	public function addPanne(){

		//var_dump($_POST);die();
		
		if (!empty($_POST)) {    		

			$this->Panne->create([

				'user' => $_SESSION['name'],
				'materiel_id' => $_POST['MateId'],
				'date_panne' => $_POST['DatePanne'],
				'heure_panne' => $_POST['HeurePanne'],
				'designation' => $_POST['Designation'],
				'etat_devis' => 0,
				'etat_panne' => 'Attente Intervention Interne'
			]);

			$this->Material->update($_POST['MateId'],[

				'statut' => "En Panne"

			]);

			$tabdate = date_parse($_POST['DatePanne']);
			$year = $tabdate['year']; //récupére l'année de la date //		

			$result = $this->Chart->checkedYear($year); // vérifie si l'année existe en base //
			$mate = $this->Material->checkedmate($_POST['MateId']); // vérifie si le matériel est un volet ou non //

			if ($result) { // si année existe ont met a jour //

				$id = $result[0]->id;
				$nbrsp = $result[0]->nbrs_panne + 1;
				$nbrpv = $result[0]->nbr_pvolet + 1;

				if ($mate) {
					// année existe en base
					$this->Chart->update($id,[

						'nbrs_panne' => $nbrsp,
						'nbr_pvolet' => $nbrpv 

					]);

				} else {

					// année existe en base
					$this->Chart->update($id,[

						'nbrs_panne' => $nbrsp 

					]);
				}				

			} else { // année n'existe pas ont crée année 

				if($mate) {

					$this->Chart->create([

						'year' => $year,
						'nbrs_panne' => 1,
						'nbr_pvolet' => 1

					]);

				} else {

					$this->Chart->create([

						'year' => $year,
						'nbrs_panne' => 1

					]);
				}			
				 
			}			
	 	    	
		}  

	}

	// function qui edit la panne //
	
	public function editPanne(){

		if (!empty($_POST)) {

			$datepannefr = implode('/', array_reverse(explode('/', $_POST['DatePanne'])));			
			$heurepannefr = implode('/', array_reverse(explode('/', $_POST['HeurePanne'])));			
				
			$this->Panne->update($_POST['Idpanne'],[

				'date_panne' => $datepannefr,
				'heure_panne' => $heurepannefr,
				'designation' => $_POST['Designation']
			]);
					
		}
		
	}	

	// function qui affiche toute les pannes par matériel / id mate//
	
	public function panneMate(){	

		$this->render('pannes.pannesmate');
	}	

	// function remonte toutes les pannes par matériél //
	
	public function findPanneMate(){

		$panne = $this->Panne->findpannemate($_POST['id']);

		$output = array("data" => $panne);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// verifie si une panne et active pour le matériel //
	
	public function findDataPanne(){

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$panne = $this->Panne->finddatapanne($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($panne);
			
		}
	}
	
	// trouve les données sur le matériel et la panne selectionner / id panne//
	
	public function findDataPanneMate(){

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$panne = $this->Panne->finddatapannemate($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($panne);
			
		}
	}		

	// verifie l'état de la panne pour commentaire /****AV**********/
	
	public function findEtatPanne(){

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$panne = $this->Panne->findetatpanne($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($panne);
			
		}
	}

	// function qui remonte le nombre de pannes du matériel //
		
	public function NbrPannesMate() {

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$nbr = $this->Panne->countnbrpannesmate($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($nbr);
		}
	}

	// function qui change la panne de matériel //
	
	public function ChangeMate() {
		
		if (!empty($_POST)) {

			if ($_POST["index"] == "P") {

				// remplacer le matériel lier par le mat primaire //    		

				$this->Panne->update($_POST['idpanne'],[

					"materiel_id" => $_POST['idmatep']

				]);

				// mise a jour des statut matPrimaire//

				$this->Material->update($_POST['idmatep'],[

					'statut' => "En Panne"

				]);

				// mise a jour des statut matLier//

				$this->Material->update($_POST['idmatel'],[

					'statut' => "Actif"

				]);

			} else {

				// remplacer le matériel primaire par le matlier selectionner //    		

				$this->Panne->update($_POST['IDP'],[

					"materiel_id" => $_POST['IDMateL']

				]);

				// mise a jour des statut matPrimaire//

				$this->Material->update($_POST['IDMateP'],[

					'statut' => "Actif"

				]);

				// mise a jour des statut matLier//

				$this->Material->update($_POST['IDMateL'],[

					'statut' => "En Panne"

				]);

				// récupére un ou plusieurs devis en attente //
				 
				$quota = $this->Quotation->checkeddenyquota($_POST['IDP']); 		

				foreach ($quota as $key => $value) {
					
					// update de devis //
					$this->Quotation->update($value->id,[

						'date_refus_quota' => date('Y-m-d'),
						'etat_devis' => 'Devis Refusé'
					]);	
				}

			}				

		}
		
	}	

	//////////////////////////////////////// PDF ////////////////////////////////////
	
	// function qui affiche le matériels selectionner en pdf//
	
	public function viewPannePdf(){					

		$this->render('pannes.detailpannepdf');

	}

	// function qui affiche les panne des volets en PDF //
	
	public function viewPanneVoletsPdf(){

		$this->render('pannes.pannesvoletspdf'); 
	}

}