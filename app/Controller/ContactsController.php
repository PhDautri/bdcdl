<?php

namespace App\Controller;

use Core\Controller\Controller;

class ContactsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Contact');


	}

// CONTACTS //
	
	// function qui remonte tous les contacts //
	
	public function contacts(){

		$this->render('contributors.contacts');
				
	}

	// function qui affiche la table Contacts all /:
	
	public function contactsAll(){

		$contact = $this->Contact->allContact();		
		
		$output = array("data" => $contact);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui ajoute un intervenant //
		
	public function addContacts(){

		if (!empty($_POST)) {   		

			$this->Contact->create([

				'contribut_id' => $_POST['idContrib'],				

				'c_nom' => $_POST['NomCont'],

				'c_prenom' => $_POST['PrenomCont'],

				'c_fonction' => $_POST['Fonction'],

				'c_portable' => $_POST['PhoneCell'],

				'c_email' => $_POST['EmailCont']
    		
			]);
	 	    	
		}  

	}

	// function edition contact//
	 
	public function editContacts(){

		if (!empty($_POST)) {

			$result = $this->Contact->update($_POST['IDContact'], [

				'c_nom' => $_POST['EdNomCont'],

				'c_prenom' => $_POST['EdPrenomCont'],

				'c_fonction' => $_POST['EdFonction'],

				'c_portable' => $_POST['EdPhoneCell'],

				'c_email' => $_POST['EdEmailCont']
			]);			

		}
	}

	///////////////////////////CHECKED//////////////////

	// function qui verifie si le contact a deja etait appeler pour cette panne / id panne / id contribut //
	
	public function checkedAppelContact(){

		$result = $this->Contact->CheckedAppelContact($_POST['idp'], $_POST['idc']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	/////////////////////////////////FIND ///////////////////////

	// function qui remonte la liste des contacts lier aux intervenants pour select //
	
	public function selectContact(){

		$result = $this->Contact->findContact($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// function qui remonte la liste des tecchniciens lier aux intervenants pour select //
	
	public function selectTech(){

		$result = $this->Contact->findTech($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}	

	// function qui remonte les données intervenant & contact appeler // id contact /*****************************/

	public function findDataContact() {

		$result = $this->Contact->finddataContact($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function delete //
	
	public function deleteContact(){

		$result = $this->Contact->delete($_POST['id']);
	} 

////////////////////////////// UTILISATEUR //////////////////////////////////////////////
	
	public function contactsUtil(){

		$this->render('contributors.contactsUtil', compact(''));

	}
}