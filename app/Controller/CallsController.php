<?php

namespace App\Controller;

use Core\Controller\Controller;

class CallsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Call'); // 

	}

	// function qui remonte l'id de l'appel et contact_id de la table Appel //
	
	public function findcallpanne() {

		if (!empty($_POST['id'])) {
			
			$result = $this->Call->findCallPanne($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);
		}
	}

}