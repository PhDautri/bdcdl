<?php

namespace App\Controller;

use Core\Controller\Controller;


class RoomsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Room');		

	}


	// function voir toutes les piéces (id place) //

	public function ViewRoom() {

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$rooms = $this->Room->viewroom($_POST['id']);

			$output = array("data" => $rooms);

			header('Content-Type: aplication/json');

			echo json_encode($output);			
		}
	}

	// function qui recherche la piéce  par rapport au lieux //
	
	public function selectRoom(){

		if (!empty($_POST['id_place']) ? $_POST['id_place'] : NULL) {

			$room = $this->Room->findroom($_POST['id_place']);

			header('Content-Type: aplication/json');

		    echo json_encode($room);		    
			
		}

	}

	// function qui recherche si la piéce existe pour le lieux dans la base //
	
	public function checkedRoom() {

		if (!empty($_POST['id_place']) ? $_POST['id_place'] : NULL) {

			$room = $this->Room->checkedroom($_POST['id_place'], $_POST['room']);

			header('Content-Type: aplication/json');

		    echo json_encode($room);		    
			
		}
	}

	// function qui recherche si le lieu a des piéces lier //
	
	public function checkedRoomBind() {

		if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

			$room = $this->Room->findroom($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($room);		    
			
		}
	}

	// function qui ajoute une piéce au lieux //

	public function addRoom(){			

		if(!empty($_POST)) {
			// ajoute la piéce //
			
			$this->Room->create([

				'lieux_id' => $_POST['id_place'],

				'piece' => $_POST['room']
			]); 
			
		}
		
	}

	// function qui edit la piéce //
	
	public function editRoom(){

		if(!empty($_POST)) {

			$this->Room->update($_POST['id'],[

				'piece' => $_POST['room']

			]);
		}
	}

	// function qui déplace la piéce vers un autre lieux //
	
	public function displaceroom(){

		if(!empty($_POST)) {

			$this->Room->update($_POST['id'],[

				'lieux_id' => $_POST['idpdr']

			]);
		}
	}

	// function qui efface une piéce //
	
	public function deleteRoom() {

		$this->Room->delete($_POST['id']);

	}



}