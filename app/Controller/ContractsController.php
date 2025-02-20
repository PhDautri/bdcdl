<?php

namespace App\Controller;

use Core\Controller\Controller;

class ContractsController extends AppController{

	public function __construct(){

		parent::__construct();
		
		$this->loadModel('Contract'); // contrats //

	}

	///////////////////// CONTRACT /////////////////////////////
	
	// function qui affiche la page contrat // 
	public function contracts() {

		$this->render('contracts.contracts');
	}

	// function qui affiche la table Contracts all //
	
	public function contractsAll(){

		$contract = $this->Contract->AllContract();		
		
		$output = array("data" => $contract);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui ajoute un contrat //
	
	public function Add() {

		//var_dump($_POST);die();

		if (!empty($_POST)) {			
			
			$this->Contract->create([

				'num_contrat' => $_POST['NumContract'],					
				'contribu_id' => $_POST['ContributIC'],					
				'date_contrat' => $_POST['datedeb'],					
				'durer' => $_POST['durer'],
				'montant' => $_POST['montant'],
				'reconduction' => $_POST['recond']					

		   ]);			
			
		}	
	}

	// function qui edit le contrat //
	
	public function Edit() {

		if (!empty($_POST)) {			
			
			$this->Contract->update($_POST['ContractID'],[

				'num_contrat' => $_POST['NumContract'],					
				'contribu_id' => $_POST['ContributIC'],					
				'date_contrat' => $_POST['datedeb'],					
				'durer' => $_POST['durer'],
				'montant' => $_POST['montant'],
				'reconduction' => $_POST['recond']										

			]);
		}
	}

	// function qui remonte les contrats pour le select //
	
	public function selectcontrat() {

		$contract = $this->Contract->all();	

		header('Content-Type: aplication/json');

		echo json_encode($contract);

	}

	// function qui vérifie si le contrat n'existe pas déja en base //
	
	public function checkedcontrat() {

		$result = $this->Contract->CheckedContrat($_POST['numc']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui cherche le matériel qui a un contrat //
	
	public function findmatescontract() {

		$result = $this->Contract->FindMatesContract($_POST['id']);

		$output = array("data" => $result);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	///////////////////////////////  PDF //////////////////////////////////////
	
	// function qui affiche tout les contrat en pdf //
	
	public function ViewPdf(){					

		$this->render('contracts.viewpdf');

	}

}