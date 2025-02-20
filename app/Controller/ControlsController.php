<?php

namespace App\Controller;

use Core\Controller\Controller;

class ControlsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Control'); // control réglementaire //

	}

	// function qui affiche la page des contrôles reglementaire // 
	public function controls() {

		$this->render('controls.controls');
	}

	// function qui affiche la table Controls all //
	
	public function controlsAll(){

		$controls = $this->Control->All();		
		
		$output = array("data" => $controls);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui ajoute un control reglementaire //
	
	public function Add() {		

		if (!empty($_POST)) {

			if ($_POST['lastcont'] != "") {
				
				switch ($_POST['freq']) {				
					
					case 'Mensuel':
					// calcul date pour mensuel //
					$olddate = date_create($_POST['lastcont']);
					$dateout = date_add($olddate, date_interval_create_from_date_string("1 month"));
					break;

					case "Trimestriel":
					// calcul date pour trois mois //
					$olddate = date_create($_POST['lastcont']);
					$dateout = date_add($olddate, date_interval_create_from_date_string("3 month"));
					break;

					case 'Semestriel':
					// calcul date pour semestriel //
					$olddate = date_create($_POST['lastcont']);
					$dateout = date_add($olddate, date_interval_create_from_date_string("6 month"));
					break;
					
					case 'Annuel':
					// calcul date pour une année //
					$olddate = date_create($_POST['lastcont']);
					$dateout = date_add($olddate, date_interval_create_from_date_string("1 year"));
					break;

					case 'Triennal':
					// calcul date pour 3 ans //
					$olddate = date_create($_POST['lastcont']);
					$dateout = date_add($olddate, date_interval_create_from_date_string("3 year"));
					break;

					case 'Quinquennal':
					// calcul date pour 5 ans //
					$olddate = date_create($_POST['lastcont']);
					$dateout = date_add($olddate, date_interval_create_from_date_string("5 year"));
					break;

					case 'Décennal':
					// calcul date pour 10 ans //
					$olddate = date_create($_POST['lastcont']);
					$dateout = date_add($olddate, date_interval_create_from_date_string("10 year"));
					break;

				}

				$verif = "Valider";
				$lastcont = $_POST['lastcont'];
				$deadline = date_format($dateout,"Y-m-d");

			} else {

				$verif = "";
				$lastcont = "00-00-0000";
				$deadline = "00-00-0000";

			}						
			
			$this->Control->create([

				'type' => $_POST['typecont'],
				'category_id' => $_POST['categorie'],
				'prestation' => $_POST['prestation'],
				'controleur' => $_POST['controleur'],
				'frequency' => $_POST['freq'],
				'nom' => $_POST['nom'],
				'verification' => $verif,
				'last_control' => $lastcont,
				'deadline' => $deadline,
				'statut' => 'En Attente' 					

		    ]);			
			
		}	
	}

	// function qui edit le control reglementaire //
	
	public function Edit() {

		if (!empty($_POST)) {

			switch ($_POST['freq']) {				
				
				case 'Mensuel':
				// calcul date pour mensuel //
				$olddate = date_create($_POST['lastcont']);
				$dateout = date_add($olddate, date_interval_create_from_date_string("1 month"));
				break;

				case "Trimestriel":
				// calcul date pour trois mois //
				$olddate = date_create($_POST['lastcont']);
				$dateout = date_add($olddate, date_interval_create_from_date_string("3 month"));
				break;

				case 'Semestriel':
				// calcul date pour semestriel //
				$olddate = date_create($_POST['lastcont']);
				$dateout = date_add($olddate, date_interval_create_from_date_string("6 month"));
				break;
				
				case 'Annuel':
				// calcul date pour une année //
				$olddate = date_create($_POST['lastcont']);
				$dateout = date_add($olddate, date_interval_create_from_date_string("1 year"));
				break;

				case 'Triennal':
				// calcul date pour 3 ans //
				$olddate = date_create($_POST['lastcont']);
				$dateout = date_add($olddate, date_interval_create_from_date_string("3 year"));
				break;

				case 'Quinquennal':
				// calcul date pour 5 ans //
				$olddate = date_create($_POST['lastcont']);
				$dateout = date_add($olddate, date_interval_create_from_date_string("5 year"));
				break;

				case 'Décennal':
				// calcul date pour 10 ans //
				$olddate = date_create($_POST['lastcont']);
				$dateout = date_add($olddate, date_interval_create_from_date_string("10 year"));
				break;

			}

			$deadline = date_format($dateout,"Y-m-d");
			
			$this->Control->update($_POST['id'],[
							
				'prestation' => $_POST['prestation'],
				'controleur' => $_POST['controleur'],
				'frequency' => $_POST['freq'],
				'nom' => $_POST['nom'],
				'last_control' => $_POST['lastcont'],
				'deadline' => $deadline							

			]);
		}
	}

	// function qui verifie si un control existe et en cours //
	
	public function findcontrol(){

		$controls = $this->Control->FindControl($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($controls);
	}

	// function qui retourne les données pour edition //
	
	public function datactrl(){

		$controls = $this->Control->dataCtrl($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($controls);
	}

	// function qui modifie le champ planification //
	
	public function planif() {

		if (!empty($_POST)) {			
				
			$this->Control->update($_POST['ControlID'],[
						
				'planification' => $_POST['dateP'],
				'verification' => "En Attente",
				'deadline' => $_POST['dateP']				

			]);						

		}

	}

	// function qui modifie le champ vérification //
	
	public function verif() {		

		if (!empty($_POST)) {

			$cont = $this->Control->dataCtrl($_POST['ControlID']);

			if ($cont[0]->last_control === "0000-00-00") {
				$lc = $cont[0]->planification;
			} else {
				$lc = $_POST['dateV'];
			}

			switch ($cont[0]->frequency) {	// calcul date echéance //			
					
				case 'Mensuel':
				// calcul date pour mensuel //
				$olddate = date_create($lc);
				$dateout = date_add($olddate, date_interval_create_from_date_string("1 month"));
				break;

				case "Trimestriel":
				// calcul date pour trois mois //
				$olddate = date_create($lc);
				$dateout = date_add($olddate, date_interval_create_from_date_string("3 month"));
				break;

				case 'Semestriel':
				// calcul date pour semestriel //
				$olddate = date_create($lc);
				$dateout = date_add($olddate, date_interval_create_from_date_string("6 month"));
				break;
				
				case 'Annuel':
				// calcul date pour une année //
				$olddate = date_create($lc);
				$dateout = date_add($olddate, date_interval_create_from_date_string("1 year"));
				break;

				case 'Triennal':
				// calcul date pour 3 ans //
				$olddate = date_create($lc);
				$dateout = date_add($olddate, date_interval_create_from_date_string("3 year"));
				break;

				case 'Quinquennal':
				// calcul date pour 5 ans //
				$olddate = date_create($lc);
				$dateout = date_add($olddate, date_interval_create_from_date_string("5 year"));
				break;

				case 'Décennal':
				// calcul date pour 10 ans //
				$olddate = date_create($lc);
				$dateout = date_add($olddate, date_interval_create_from_date_string("10 year"));
				break;

			}

			$deadline = date_format($dateout,"Y-m-d");		

			$this->Control->update($_POST['ControlID'],[							
				
				'verification' => "Valider",
				'nom' => $_POST['nom'],
				'statut' => 'Terminé'			

			]);

			// création d'un autre contrôle avec les même paramétres //
			
			$this->Control->create([

				'type' => $cont[0]->type,
				'category_id' => $cont[0]->category_id,
				'prestation' => $cont[0]->prestation,
				'controleur' => $cont[0]->controleur,
				'frequency' => $cont[0]->frequency,
				'nom' => "",
				'verification' => "",
				'last_control' => $_POST['dateV'],
				'deadline' => $deadline,
				'statut' => 'En Attente' 					

		   ]);

		}

	}	

	///////////////////////////////  PDF //////////////////////////////////////
	
	// function qui affiche tout les contrôles en pdf //
	
	public function ViewControlPdf(){					

		$this->render('controls.viewpdf');

	}
	

}