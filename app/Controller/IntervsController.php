<?php

namespace App\Controller;

use Core\Controller\Controller;

class IntervsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Interv');
		$this->loadModel('Material');

	}

	////////////////// INTERV AVEC PANNE //////////////////////

		// affiche la page interventions all //
		
		public function intervs(){

			$this->render('intervs.intervs');
		}	

		// function qui remonte toutes les interventions //
		
		public function intervsall(){

			$interv = $this->Interv->allinterv();		
			
			$output = array("data" => $interv);

			header('Content-Type: aplication/json');

			echo json_encode($output);
		}	

		// function qui affiche les pannes en attente de rép //
		
		public function intervsencours(){	

			$this->render('intervs.intervsencours');

		}

		// function qui affiche les pannes en attente de réparation //
		
		public function affintervsencours() {		

		    $interv = $this->Interv->affIntervsEnCours();		
		
			$output = array("data" => $interv);

			header('Content-Type: aplication/json');

			echo json_encode($output);	

		}

		// affiche la table interventions //
		
		public function affIntervPanne(){

			if (!empty($_POST['id'])) {			
				
				$this->Interv->affintervpanne($_POST['id'], $_POST['index'], $_POST['type']);
			   
			}
		}		

		// verifie si une intervention et active pour le matériel //
		
		public function checkedInterv(){

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {			

				$result = $this->Interv->checkedinterv($_POST['id']);			

				header('Content-Type: aplication/json');

			    echo json_encode($result);
				
			}
		}

		// function qui remonte le nombre d'intervention  //
			
		public function Nbrinterv() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

				$nbr = $this->Interv->countnbrinterv($_POST['id']);

				header('Content-Type: aplication/json');

			    echo json_encode($nbr);
			}
		}	

		// function qui remonte l'intervenant en fonction de l'intervention //
		
		public function viewsContribinterv(){

			$result = $this->Interv->viewscontribinterv($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($result);

		}

		// function qui modifie l'état de l'intervention sans panne //
		
		public function stateinterv(){
			
			if (!empty($_POST)) {
				
				$this->Interv->update($_POST['idinterv'],[

					'etat_interv' => $_POST['etat']			
				]);

				$this->Material->update($_POST['idmate'],[

					'statut' => 'Actif'

				]);
				
			}

		}

		// function qui ferme l'intervention interne en cours et en créer une externe //
		
		public function CloseInterv(){
			
			$this->Interv->update($_POST['id'],[

				'etat_interv' => 'Terminé'
			]);		
			
		}

		// function qui calcul le montant interventions total par id mate //
		
		public function countIntervsT() {

			$result = $this->Interv->countintervst($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($result);

		}

		// function qui calcul le montant interventions de la panne selectionner// id panne //
		
		public function countIntervs() {

			$result = $this->Interv->countintervs($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($result);

		}		

	///////////////// INTERV SANS PANNE //////////////////////////////////////
	
		// affiche la page interventions all sans panne //
		
		public function intervssanspanne(){

			$this->render('intervs.intervssanspanne');
		}

		// function qui remonte toutes les interventions sans panne //
	
		public function intervsallSansPanne(){

			$interv = $this->Interv->allintervsanspanne();		
			
			$output = array("data" => $interv);

			header('Content-Type: aplication/json');

			echo json_encode($output);
		}

		// affiche la table interventions sur le materiel sans panne //
		
		public function affIntervsp(){

			if (!empty($_POST['id'])) {			
				
				$this->Interv->affintervsp($_POST['id'], $_POST['index']);
			   
			}
		}	
		
		// function qui ajoute une intervention sans panne au matériel //
			
		public function addInterv(){

			//var_dump($_POST);die();		

			if (!empty($_POST)) {    		

				$this->Interv->create([				

					'materiel_id' => $_POST['MateId_Interv'],

					'contribut_id' => $_POST['ContributIC'],

					'date_interv' => $_POST['DateInterv'],

					'heure_interv' => $_POST['HeureInterv'],

					'type_interv' => $_POST['typeinterv'],

					'category_int' => $_POST['cateInt'],

					'depend' => $_POST['dependI'],

					'design_interv' => $_POST['DesignInterv'],

					'user' => $_SESSION['name'],

					'etat_interv' => 'En Cours'
				]);

				$this->Material->update($_POST['MateId_Interv'],[

					'statut' => 'Intervention En Cours'

				]);			
		 	    	
			}  

		}	

		// edition de l'intervention panne & sans panne //
		
		public function editInterv(){

			if (!empty($_POST)) {
				
				$this->Interv->update($_POST['IDInterv'],[

					'date_interv' => $_POST['dateinterv'],
					'heure_interv' => $_POST['heureinterv'],
					'design_interv' => $_POST['designInterv']						
				]);
				
			}
		}

		// function qui remonte le nombre d'intervention  sans panne//
			
		public function Nbrintervsanspanne() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

				$nbr = $this->Interv->countnbrintervsanspanne($_POST['id']);

				header('Content-Type: aplication/json');

			    echo json_encode($nbr);
			}
		}
		
		// function qui calcul le montant interventions de l'interv selectionner// id interv //
		
		public function countIntervsSansPanne() {

			$result = $this->Interv->countintervsanspanne($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($result);

		}

	/////////////////// INTERV CONTRAT DE MAINTENANCE ///////////////////////////////////////

		// affiche la page interventions all contrat Maintenance //
		
		public function intervscm(){

			$this->render('intervs.intervscm');
		}

		// function qui remonte toutes les interventions contrat de maintenance //
	
		public function intervsallcm(){

			$result = $this->Interv->allintervscm();		
			
			$output = array("data" => $result);

			header('Content-Type: aplication/json');

			echo json_encode($output);
		}
	 
		// function qui remonte les données intervs lier au contrat de maintenance du matériel //
		
		public function Affintervscm() {

			if (!empty($_POST['id'])) {			
				
				$result = $this->Interv->affintervcm($_POST['id']);

				header('Content-Type: aplication/json');

			    echo json_encode($result);
			   
			}

		}
	
		// function qui remonte le nombre d'intervention lier aux contrat de maintenance //
			
		public function NbrintervCM() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

				$nbr = $this->Interv->countnbrintervMC($_POST['id']);

				header('Content-Type: aplication/json');

			    echo json_encode($nbr);
			}
		}

		// function qui calcul le montant interventions total contrat de maintenance par id mate //
		
		public function countIntervcm() {

			$result = $this->Interv->countintervCM($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($result);

		}		

	//////////////////////// Function commune ///////////////////////////////////////////
	
		// verifie si une intervention SP ou CM et en cours pour le matériel //
		
		public function checkedStatutInterv(){

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {			

				$result = $this->Interv->checkedstatutinterv($_POST['id']);			

				header('Content-Type: aplication/json');

			    echo json_encode($result);
				
			}
		}
}