<?php

namespace App\Controller;

use Core\Controller\Controller;

class DailyworksController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Dailywork');

		$this->loadModel('Dailyevent');

		$this->loadModel('Categorie');

	}

	// function qui ouvre la page travaux journalier //

	public function dailyworks(){

		$this->render('dailyworks.dailyworks');

	}	

	// function qui remonte tous les travaux journalier realiser //
	
	public function dailyworksAll(){

		$dailyworks = $this->Dailywork->alldailyworks();		
		
		$output = array("data" => $dailyworks);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}	

	// function qui remonte toute les catégories pour le select //
		
	public function selectCategories() {

		$categories = $this->Categorie->allcat();

		header('Content-Type: aplication/json');

		echo json_encode($categories);
	}

	// function qui ajoute un travail journalier //
	
	public function AddDailyworks() {

		if (!empty($_POST)) {			

			// ajoute le travail //
			$result = $this->Dailywork->create([

			'user' => $_SESSION['name'],

			'date_travaux' => $_POST['datedaily'],

			'categorie_id' => $_POST['categorie'],

			'designation' => $_POST['design'],

			'commentaire' => $_POST['comment'],

			'statut' => 'Actif'			

		   ]);			
			
		}	
	}

	// function qui edit le travail journalier //
	
	public function EditDailyworks() {

		if (!empty($_POST)) {
			
			$result = $this->Dailywork->update($_POST['id'],[

			'date_travaux' => $_POST['datedaily'],

			'categorie_id' => $_POST['categorie'],

			'designation' => $_POST['design'],

			'commentaire' => $_POST['comment']

			]);
		}
	}

	// function qui ajoute une catégorie //
	
	public function AddCategorie() {

		if (!empty($_POST)) {

			$this->Categorie->create([

			'categorie' => $_POST['cat']

			]);

		}
	}

	// function qui recherche les données travaux journalier id travaux//
	
	public function findDataDaily() {

		$result = $this->Dailywork->FindDataDaily($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui supprime le travail journalier /**********DELETE DAILY WORK***********/
	
	public function DeleteDailyworks() {

		$this->Dailywork->delete($_POST['id']);
	}

	// function qui affiche le pdf //
	
	public function viewPdf() {

		$this->render('dailyworks.dailyworksAllPdf'); 
	}

	///////////////// DAILY EVENTS ///////////////////////////////////////	
	
	// function qui ouvre la page travaux journalier //

	public function dailyEvents(){

		$this->render('dailyworks.dailyevents');

	}

	// function qui remonte tous les événements journalier //
	
	public function dailyAll(){

		$dailyevents = $this->Dailyevent->allevents();		
		
		$output = array("data" => $dailyevents);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui ajoute un événement journalier //
	
	public function Addevent() {

		if (!empty($_POST)) {			

			// ajoute l'événement  //
			$this->Dailyevent->create([

			'user' => $_SESSION['name'],

			'date' => $_POST['datedailyE'],

			'designation' => $_POST['designE'],

			'commentaire' => $_POST['commentE']		

		   ]);			
			
		}	
	}

	// function qui edit le événement journalier //
	
	public function Editevent() {

		if (!empty($_POST)) {
			
			$this->Dailyevent->update($_POST['id'],[

			'date' => $_POST['datedailyE'],

			'designation' => $_POST['designE'],

			'commentaire' => $_POST['commentE']

			]);
		}
	}

	// function qui supprime l'événemet journalier /**********DELETE***********/
	
	public function DeleteEvent() {

		$this->Dailyevent->delete($_POST['id']);
	}

	// function qui affiche le pdf //
	
	public function viewEventsPdf() {

		$result = $this->Dailyevent->all();

		$this->render('dailyworks.dailyeventsAllPdf', compact('result')); 
	}


}