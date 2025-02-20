<?php

namespace App\Controller;

use Core\Controller\Controller;


class ArmoiresController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Armoire');		

	}

	// function qui affiche la page armoires //
	
	public function armoire() {

		$this->render('materials.armoire');
	}

	// function qui affiche la table armoire //
	
	public function ViewArmoire() {

		$arm = $this->Armoire->viewarm();

		$output = array("data" => $arm);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// function qui recherche l'armoire pour edit //
	
	public function findArmoire() {

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$arm = $this->Armoire->findarm($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($arm);		    
			
		}
	}

	// function qui remonte toute les armoires pour le select //
	
	public function selectArm() {					

		$arm = $this->Armoire->selectarm($_POST['type']);

		header('Content-Type: aplication/json');

		echo json_encode($arm);
	
	}

	// function qui verifie si l'armoire existe dans la base //
	
	public function checkedArm() {

		if (!empty($_POST['arm'])) {
			
			$arm = $this->Armoire->checkedarm($_POST['arm']);

			header('Content-Type: aplication/json');

		    echo json_encode($arm);
		}
		
	}

	// function qui ajoute une armoire //
	
	public function addArm() {

		if(!empty($_POST)) {

			if (empty ($_POST['type'])) {
				$type = "ELEC";
			} else {
				$type = $_POST['type'];
			}
			
			$this->Armoire->create([

				'nom_arm' => $_POST['n_arm'],

				'niveau_id' => $_POST['Levels'],

				'type' => $type,

				'lieux' => $_POST['lieux']
			]); 
			
		}
	}

	// function qui edit l'armoire //
	
	public function editArm(){

		if(!empty($_POST)) {

			$this->Armoire->update($_POST['id'],[

				'nom_arm' => $_POST['arm'],

				'niveau_id' => $_POST['Levels'],

				'type' => $_POST['type'],

				'lieux' => $_POST['lieux']

			]);
		}
	}		
}