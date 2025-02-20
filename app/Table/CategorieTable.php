<?php

namespace App\Table;

use Core\Table\Table;


class CategorieTable extends Table {

	protected $table = 'categories';

	// remonte les catégories et le nbr de sujet par catégorie //
	
	public function panelcategorie() {

		return $this->query('SELECT cat.id, cat.categorie, (SELECT COUNT(k.id) FROM knowledges k WHERE k.category_id = cat.id ) AS nbr 

			FROM categories cat ORDER BY cat.id');
	}


	// remonte true ou false si la catégorie existe ou non //
	
	public function checkedcategories($id) {

		return $this->query('SELECT * FROM categories cat WHERE cat.categorie = ?', [$id]);
	}

	// function qui retourne la liste de la catégorie / $p = page //
	
	public function allcat(){

		return $this->query('SELECT c.id, c.categorie FROM categories c ORDER BY c.id');
	} 

}