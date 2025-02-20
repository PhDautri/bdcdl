<?php

namespace App\Table;

use Core\Table\Table;


class KnowledgeTable extends Table {

	protected $table = 'Knowledges';


	// function qui remonte les données pour la table knowledges //
	
	public function FindKnowledge($id) {

		return $this->query('SELECT k.id, k.sujet, k.probleme, k.category_id, cat.categorie
							FROM knowledges k
							LEFT JOIN categories cat ON k.category_id = cat.id 
							WHERE k.category_id = ?', [$id]);

	}


	// function qui remonte les resolutions pour les afficher //
	
	public function FindResolution($id) {

		return $this->query('SELECT k.resolution FROM knowledges k WHERE k.id = ?', [$id]);

	}
    

}