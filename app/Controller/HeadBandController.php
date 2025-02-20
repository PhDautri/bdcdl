<?php

namespace App\Controller;

use Core\Controller\Controller;

class HeadBandController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('HeadBand');

	}

	// function qui affiche un bandeau //
	
	public function bandeau() {

		$this->render('headbands.bandeau');
	}

	// function qui verifie si le bandeau existe en base //

	public function findband() {

		$result = $this->HeadBand->findHeadBand($_POST['Band']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
		
	}

	// function qui retourne la liste des bandeaux pour le select //
	
	public function selectheadband() {

		$result = $this->HeadBand->selectHeadBand();

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// function add headband //

	public function addband() {

		$this->HeadBand->create([

			'nom_bandeau' => $_POST['headband']

		]);
	}

	// function edit headband //
	
	public function editband() {

		$this->HeadBand->update($_POST['id_band'],[

			'nom_bandeau' => $_POST['headband']
		]); 
	}


}