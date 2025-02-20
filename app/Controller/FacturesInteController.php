<?php

namespace App\Controller;

use Core\Controller\Controller;

class FacturesInteController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('FactureInte');


	}

	// verifie si un devis existe pour l'intervention (id interv)//

	public function checkedDocinterv(){

		$result = $this->FactureInte->chekeddocinterv($_POST['id'], $_POST['tab']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}



}