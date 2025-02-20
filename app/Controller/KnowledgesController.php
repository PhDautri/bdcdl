<?php

namespace App\Controller;

use Core\Controller\Controller;

class KnowledgesController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Knowledge');

		$this->loadModel('Categorie');

	}

	// function qui affiche la page base de connaissance //

	public function knowledge() {

		$this->render('knowledges.knowledge');
	}

	// add suject & probleme //
	
	public function addsuject() {

		if (!empty($_POST)) {  		

			$this->Knowledge->create([
				'category_id' => $_POST['id_category'],
				'sujet' => $_POST['suject'],
				'probleme' => $_POST['probleme'],
				'resolution' => $_POST['resolution']

			]);
		}

	}

	// edit suject & probleme //
	
	public function editsuject() {

		if (!empty($_POST)) {  		

			$this->Knowledge->update($_POST['id_suject'],[

				'sujet' => $_POST['suject'],
				'probleme' => $_POST['probleme']

			]);
		}
	}

	// edit resolution //
	
	public function editresolution() {

		if (!empty($_POST)) {  		

			$this->Knowledge->update($_POST['id_suject'],[

				'resolution' => $_POST['resolution']

			]);
		}
	}

	// function qui efface le sujet  //
	
	public function deletesuject() {

		if (!empty($_POST)) {   		

			$this->Knowledge->delete($_POST['id']);
		}
	}

	// function qui remonte toute les catégories pour le panel //
		
	public function knowledgePanelCategories() {

		$categories = $this->Categorie->panelcategorie();

		header('Content-Type: aplication/json');

		echo json_encode($categories);
	}

	// function qui verifie si la catégorie existe déja //
	
	public function knowledgecheckedCategories() {

		$categories = $this->Categorie->checkedcategories($_POST['cat']);

		header('Content-Type: aplication/json');

		echo json_encode($categories);

	}

	// function qui remonte les données pour la table knowledge / id catégorie //
	
	public function findknowledge() {

		$result = $this->Knowledge->FindKnowledge($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui remonte les données pour afficher la résolution du probléme / id knowledge //
	
	public function findresolution() {

		$result = $this->Knowledge->FindResolution($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}



}