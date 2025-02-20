<?php

namespace App\Controller;

use Core\Controller\Controller;


class LevelsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Level');		

	}


	// function voir toutes les niveaux //

	public function ViewLevel() {

		$levels = $this->Level->viewLevel();

		$output = array("data" => $levels);

		header('Content-Type: aplication/json');

		echo json_encode($output);			
		
	}

	// function qui remonte tout les niveau //
	
	public function selectLevel() {

		$level = $this->Level->all();

		header('Content-Type: aplication/json');

		echo json_encode($level);

	}

	// function qui remonte le niveau qui correspond au materiel primaire //

	public function selectLevelMateLier() {

		$level = $this->Level->slclevelmatelier($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($level);
	}

	// function qui receherche si le niveau existe dans la base //
	
	public function checkedLevel() {

		if (!empty($_POST['levels']) ? $_POST['levels'] : NULL) {

			$level = $this->Level->checkedlevel($_POST['levels']);

			header('Content-Type: aplication/json');

		    echo json_encode($level);		    
			
		}
	}

	// function qui ajoute un model //
	
	public function addLevel() {

		if(!empty($_POST)) {
			// ajoute le niveau //
			
			$this->Level->create([

				'niveau' => $_POST['level']
			]); 
			
		}
	}

	// function qui edit le niveau //
	
	public function editLevel(){

		if(!empty($_POST)) {

			$this->Level->update($_POST['levelId'],[

				'niveau' => $_POST['level']

			]);
		}
	}

}