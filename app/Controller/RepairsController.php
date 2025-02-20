<?php

namespace App\Controller;

use Core\Controller\Controller;

class RepairsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Repair');

	}

	// function qui calcul le montant total des réparations par id matériel //
	
	public function countRepairsT() {

		$result = $this->Repair->countrepairst($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// function qui calcul le montant de la réparations  pour la panne selectionner //id panne //
	
	public function countRepairs() {

		$result = $this->Repair->countrepairs($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	
}