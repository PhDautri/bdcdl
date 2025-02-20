<?php

namespace App\Controller;

use Core\Controller\Controller;


class PlacesController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Place');
		$this->loadModel('Room');		

	}

	// function voir toutes les lieux (id niveau) //

	public function ViewPlace() {

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$places = $this->Place->viewplace($_POST['id']);

			$output = array("data" => $places);

			header('Content-Type: aplication/json');

			echo json_encode($output);			
		}
	}

	// function qui recherche le lieux par rapport au niveau //
	
	public function selectPlace(){

		if (!empty($_POST['id_level']) ? $_POST['id_level'] : NULL) {

			$place = $this->Place->findplace($_POST['id_level']);

			header('Content-Type: aplication/json');

		    echo json_encode($place);		    
			
		}

	}

	// function qui recherche le lieux par rapport au niveau pour materiel lier//
	
	public function selectPlaceMateLier(){

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$place = $this->Place->findplacematlier($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($place);		    
			
		}

	}

	// function qui recherche si le lieu existe dans la base //
	
	public function checkedPlace() {

		if (!empty($_POST['place']) ? $_POST['place'] : NULL) {

			$place = $this->Place->checkedplace($_POST['place'], $_POST['id_level']);

			header('Content-Type: aplication/json');

		    echo json_encode($place);		    
			
		}
	}		

	// function qui ajoute un lieux au niveau //

	public function addPlace(){

		if(!empty($_POST)) {
			// ajoute le lieu //
			
			$this->Place->create([

				'niveau_id' => $_POST['id_level'],

				'lieux' => $_POST['place']
			]); 
			
		}
		
	}

	// function qui edit le lieu //
	
	public function editPlace(){

		if(!empty($_POST)) {

			$this->Place->update($_POST['id'],[

				'lieux' => $_POST['place']

			]);
		}
	}

	// function qui affiche la page voir niveau lieux //
	
	public function LevelPlace(){

		$page = 'LevelPlace';

		$this->render('materials.levelplace', compact('page'));	

	}

	// function qui déplace le lieux dans piéce pour un lieux donner //
	
	public function displaceplace(){

		if(!empty($_POST)) {

			//var_dump($_POST);die();

			if ($_POST['action'] == 1) { 
				
				// création d'une nouvelle ligne dans piéce pour mettre le lieux deplacer//
			
				$this->Room->create([

					'lieux_id' => $_POST['idl'],
					'piece' => $_POST['name']
				]);					

				// suppression de la ligne lieux //
				$this->Place->delete($_POST['id']);

			} else {

				$this->Place->update($_POST['id'],[

					'niveau_id' => $_POST['idl']
				]);

			}
			
		}
	}

}