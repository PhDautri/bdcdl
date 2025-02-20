<?php

namespace App\Controller;

use Core\Controller\Controller;

class ServiceController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Service');

	}

	// function qui affiche la page service //

	public function annuservice() {

		$this->render('phones.services');
	}

	// function qui affiche tout les services //
	
	public function allservices() {

		$result = $this->Service->all();

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// add service //
		
	public function addService() {

		if (!empty($_POST)) {  		

			$result = $this->Service->create([

				'nom_service' => $_POST['service']

			]);
		}

	}

	// edit service //
	
	public function editService() {

		if (!empty($_POST)) {  		

			$result = $this->Service->update($_POST['id_service'],[

				'nom_service' => $_POST['service']

			]);
		}
	}

	// function qui remonte toute les services pour le select //
		
	public function selectService() {

		$serv = $this->Service->selectservice();

		header('Content-Type: aplication/json');

		echo json_encode($serv);

	}

	// function qui verifie si le service existe deja //
	
	public function checkedService() {

		$result = $this->Service->checkedservice($_POST['service']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}	



}