<?php

namespace App\Controller;

use Core\Controller\Controller;

class ContributorsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Contributor');

		$this->loadModel('Panne');

		$this->loadModel('Contact');

	}
	
// CONTRIBUTORS //

	// function qui affiche tous les intervenants externe //
	
	public function contributors(){	

		$this->render('contributors.contributors');

	}

	// function qui remonte tous les intervenants externe //
	
	public function contributorsAllExt(){

		$contri = $this->Contributor->allContributExt();		
		
		$output = array("data" => $contri);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui remonte l'intervenant en fonction de la panne //
	
	public function viewsContribPanne(){

		$result = $this->Panne->viewscontribpanne($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}	

	// function qui ajoute un intervenant //
		
	public function addContributors(){

		if (!empty($_POST)) { 

			if ($_POST['depend'] == "EXT") {
				
				$this->Contributor->create([

					'nom' => $_POST['Nom'],

					'adresse' => $_POST['Adresse'],

					'code_postal' => $_POST['CodePostal'],

					'ville' => $_POST['Ville'],

					'num_phone' => $_POST['Phone'],

					'site_web' => $_POST['Siteweb'],

					'depend' => $_POST['depend']	
	    		
				]);

			} else {

				$this->Contributor->create([

					'nom' => $_POST['Nom'],				

					'num_phone' => $_POST['Phone'],

					'depend' => $_POST['depend']	
	    		
				]);

			}			
	 	    	
		}  

	}

	// function edition intervenant //
	 
	public function editContributors(){

		if (!empty($_POST)) {

			if ($_POST['depend'] == "EXT") {

				$this->Contributor->update($_POST['ContriID'], [

					'nom' => $_POST['Nom'],

					'adresse' => $_POST['Adresse'],

					'code_postal' => $_POST['CodePostal'],

					'ville' => $_POST['Ville'],

					'num_phone' => $_POST['Phone'],

					'site_web' => $_POST['Siteweb'],

					'depend' => $_POST['depend']
				]);

			} else {

				$this->Contributor->update($_POST['ContriID'], [

					'nom' => $_POST['Nom'],

					'num_phone' => $_POST['Phone'],

					'depend' => $_POST['depend']
				]);	

			}					

		}
	}

	/////////////////////////////////FIND//////////////////////////////////////////

	// function qui récupére les données sur l'intervenant en function de sont id //
	
	public function findContributors(){

		$contri = $this->Contributor->findContributor($_POST['id']);		
		
		$output = array("data" => $contri);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// function qui récupére l'intervenant et le contact en function du devis réaliser / id panne //
	
	public function findCCQuota() {

		$result = $this->Contributor->findCCquota($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}	

	// function qui récupére l'intervenant et le contact en function du devis réactualisé / id panne //
	
	public function findCCQuotaReactu() {

		$result = $this->Contributor->findCCquotaReactu($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}		

	/////////////////////////////CHECKED////////////////////////////

	// function qui verifie si l'intervenant existe //
	
	public function checkedContributors(){

		$result = $this->Contributor->CheckedContributors($_POST['Nom']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui verifie si le téléphone existe //
	
	public function checkedNumphone(){

		if (!empty($_POST['numtel'])) {
			
			$result = $this->Contributor->CheckedNumphone($_POST['numtel']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);
		}
	}

	// function qui verifie si l'intervenant a deja etait appeler pour cette panne //
	
	public function checkedAppelContribut(){

		$result = $this->Contributor->CheckedAppelContribut($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// function qui verifie si l'intervenant a des interventions enregistrer (id pannes) //
	
	public function checkedIntervContribut(){

		if (!empty($_POST)) {
			
			$result = $this->Panne->CheckedIntervContribut($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);
		}
	}	
	 
	// function qui verifie si l'intervenant a des contacts actif //
	
	public function checkedContact(){

		if (!empty($_POST)) {
			
			$result = $this->Contributor->CheckedContact($_POST['id']);

			$output = array("data" => $result);

			header('Content-Type: aplication/json');

		    echo json_encode($output);
		}
	}

	///////////////////////////////SELECT///////////////////////////

	// function qui remonte la liste des intervenants pour select INT ou EXT //
	
	public function selectContri(){

		$result = $this->Contributor->selectcontri($_POST['index']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}

	// function qui remonte la liste des emails des intervenants pour select /id contribut //
	
	public function selectEmailContact(){

		$result = $this->Contributor->emailcontact($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}	

	// function delete //
	
	public function deleteContributor(){

		$result = $this->Contributor->delete($_POST['id']);
	}
	
	////////////////////////////// CONTRIBUTORS INTERNE /////////////////////////////////
	
	// function qui affiche tous les intervenants interne//
	
	public function contributorsInte(){	

		$this->render('contributors.contributorsinte');

	}

	// function qui remonte tous les intervenants //
	
	public function contributorsAllInte(){

		$contri = $this->Contributor->allContributInte();		
		
		$output = array("data" => $contri);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	///////////////////////////////  PDF //////////////////////////////////////
	
	// function qui affiche tous les intervenants en pdf//
	
	public function viewContriPdf(){					

		$this->render('contributors.contriextpdf');

	}

	// function qui affiche tous les intervenants Interne en pdf//
	
	public function viewContriIntPdf(){					

		$this->render('contributors.contriintpdf');

	}



}