<?php

namespace App\Controller;

use Core\Controller\Controller;

class PhoneController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Phone');

	}

	////////////////////////////ANNUAIRE//PHONE BOOK/////////////////////////////

	// function qui affiche la page annuaire //

	public function pagephonesbook() {

		$this->render('phones.phonesbook');
	}	

	// function qui récupére les données pour le tableau annuaire//
	public function phonesbook() {

		$phone = $this->Phone->PhonesBook();

		$output = array("data" => $phone);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui ajoute une entrée dans l'annuaire //
	
	public function addphonebook() {

		if (!empty($_POST)) {

			$this->Phone->create([

				'num_tel' => $_POST['num'],

				'num_sda' => $_POST['numSda'],

				'service_id' => $_POST['serv'],

				'type' => $_POST['typephone'],				

				'nom_tel' => $_POST['nomU'],				

				'zone' => $_POST['zone']

			]);
		}
	}

	// edition annuaire //
	
	public function editphonebook() {

		if (!empty($_POST)) {

			$this->Phone->update($_POST['id_book'], [

				'num_tel' => $_POST['num'],

				'num_sda' => $_POST['numSda'],

				'service_id' => $_POST['serv'],

				'type' => $_POST['typephone'],				

				'nom_tel' => $_POST['nomU'],				

				'zone' => $_POST['zone']
			]);			

		}
	}

	// function recherche données annuaire //
		
	public function finddataphonebook() {

		$phone = $this->Phone->findDataPhoneBook($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($phone);
	}

	// function qui efface l'annuaire et sont lien //
	
	public function deletephonebook() {

		if (!empty($_POST)) {   		

			$this->Phone->delete($_POST['id']);
		}
	}

	// affiche le fichier pdf de tout l'annuaire //

	public function viewallphonesbookpdf() {

		$this->render('phones.phonebookpdf');
		
	}

	//////////////////////LINK/////////////////////////////////

	// function qui affiche la page liaisons ipbx prise pour admin //
	public function links() {

		$this->render('phones.links');
	}	

	// function qui affiche le lien selectionner //
	
	public function linkselect() {

		$this->render('phones.linkselect');
	}

	// function qui récupére les données pour le tableau liaisons //
	public function alllink() {

		$phone = $this->Phone->allLink();

		$output = array("data" => $phone);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui récupére les données pour le tableau liaisons selectionner en fonction de l'id annuaire //
	public function selectlink() {

		$link = $this->Phone->selectLink($_POST['id']);

		$output = array("data" => $link);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// add liens //

	public function addlink() {

		if (!empty($_POST)) {  

		//var_dump($_POST);die(); 		

			$this->Phone->update($_POST['id_link'],[

				'link' => 1,

				'empl_ipbx' => $_POST['Empla'],

				'band_id' => $_POST['Slcheadband'],

				'port_rg' => $_POST['Port_rg'],

				'nom_arm' => $_POST['Armoir'],

				'Port_arm' => $_POST['Port_arm'],

				'niveau_arm' => $_POST['Niv'],

				'num_pbureau' => $_POST['NumP'],

				'lieux_bureau' => $_POST['Lieux']
    		
			]);
	 	    	
		}  
	}

    // edition laison ipbx prise //
	
	public function editlink() {

		if (!empty($_POST)) {

			if ($_POST['Bandeau'] == "RG") {

				$this->Phone->update($_POST['id_link'], [

					'num_tel' => $_POST['Num'],				

					'nom_tel' => $_POST['NomU'],

					'empl_ipbx' => $_POST['Empla'],

					'port_rg' => $_POST['Port_rg'],

					'band_id' => $_POST['id_band'],

					'num_pbureau' => $_POST['NumP'],

					'lieux_bureau' => $_POST['Lieux']
				]);

			} else {

				$this->Phone->update($_POST['id_link'], [

					'num_tel' => $_POST['Num'],				

					'nom_tel' => $_POST['NomU'],

					'empl_ipbx' => $_POST['Empla'],

					'port_rg' => $_POST['Port_rg'],

					'band_id' => $_POST['id_band'],

					'nom_arm' => $_POST['Armoir'],

					'Port_arm' => $_POST['Port_arm'],

					'niveau_arm' => $_POST['Niv'],

					'num_pbureau' => $_POST['NumP'],

					'lieux_bureau' => $_POST['Lieux']
				]);	
			}					

		}
	}

	// retourne les données sur le lien selectionner //
	
	public function datalinks() {

		if (!empty($_POST)) {
			
			$result = $this->Phone->dataLinks($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);
		}

	}

	// delete lien //
	
	public function deletelink() {

		if (!empty($_POST)) {   		

			$this->Phone->update($_POST['id'],[

				'link' => 0,

				'empl_ipbx' => NULL,

				'nom_band' => NULL,

				'port_rg' => NULL,

				'nom_arm' => NULL,

				'Port_arm' => NULL,

				'niveau_arm' => NULL,

				'num_pbureau' => NULL,

				'lieux_bureau' => NULL
    		
			]);
	 	    	
		}  

	}

	// verifie si les champs existe dans la base //
	
	public function checkedfields() {

		if (!empty($_POST)) {
			
			$result = $this->Phone->CheckedFields($_POST['field'],$_POST['fieldB']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);
		}
	}

	// remonte les données lier au port du bandeau //
	
	public function checkedports() {

		if (!empty($_POST)) {
			
			$result = $this->Phone->CheckedPorts($_POST['band'],$_POST['field'],$_POST['fieldA'],$_POST['fieldB']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);
		}

	}

	// affiche le fichier pdf de tous les liens //

	public function viewalllinkipbxpdf() {

		$this->render('phones.linkipbxpdf');
		
	}

	// affiche le fichier pdf du liens delectionner //

	public function viewselectlinkipbxpdf() {

		$this->render('phones.selectlinkipbxpdf');
		
	}	

	
	

	
}