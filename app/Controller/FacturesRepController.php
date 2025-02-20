<?php

namespace App\Controller;

use Core\Controller\Controller;

class FacturesRepController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('FactureRep');


	}

	// verifie la facture existe pour la panne (id panne)//

	public function checkedDocFactRep(){

		$result = $this->FactureRep->chekeddocfactrep($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}


}