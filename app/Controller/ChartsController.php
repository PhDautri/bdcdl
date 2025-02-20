<?php

namespace App\Controller;

use Core\Controller\Controller;

class ChartsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Chart');

	}

	// remonte les données pour affichage chart clim //
	
	public function affchart() {

		$output = $this->Chart->chartPanne();

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// remonte les données pour affichage chart volets //

	public function affchartvolet() {

		$output = $this->Chart->chartPannevolet();

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// extrait les années des pannes créer //
	
	public function extractyear() {

		$output = $this->Chart->extractYear();

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// verifie les années dans chart_panne //
	
	public function checkedyear() {

		$output = $this->Chart->checkedYear($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// extrait le nbr de pannes par année  //
	
	public function extractnbrpanne() {

		$output = $this->Chart->extractNbrPanne($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// remonte les montant total intervs & repairs //
	
	public function countpricetotalrepair() {

		$output = $this->Chart->countPriceTotalRepair($_POST['annee']);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// remonte les montant total intervs & repairs des volets/**********AC***********/
	
	public function countPTRV() {

		$output = $this->Chart->countptrv($_POST['annee']);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// ajoute les années dans la base chart_panne & prix_total //
	
	public function addyearchart() {

		//var_dump($_POST);die();

		if (!empty($_POST)) {   		

			$this->Chart->create([

				"year" => $_POST['id'],
				"nbrs_panne" => $_POST['nbr'],
				"prix_total_rep" => $_POST['pt'],
				"nbr_pvolet" => $_POST['nbrpv'],
				"prixT_rep_volet" => $_POST['ptv']

			]);	
		}		
	}

	// mise a jour de prix total réparation dans chart_panne //
	
	public function updatechartpanne() {

		if (!empty($_POST)) { 

			$id = $this->Chart->checkedYear($_POST['annee']);

			$this->Chart->update($id[0]->id, [
				
				"prix_total_rep" => $_POST['pt']

			]);	
		}		

	}

	// mise a jour de prix total panne volet réparation dans chart_panne /*********AC***********/
	
	public function updateCPV() {

		if (!empty($_POST)) { 

			$id = $this->Chart->checkedYear($_POST['annee']);

			$this->Chart->update($id[0]->id, [
				
				"prixT_rep_volet" => $_POST['pt']

			]);	
		}		

	}
}
