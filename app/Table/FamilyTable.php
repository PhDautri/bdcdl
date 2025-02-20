<?php

namespace App\Table;

use Core\Table\Table;


class FamilyTable extends Table {

	protected $table = 'familles';


	// function qui remonte les données pour le select famille //
	
	public function selectfamily() {

		return $this->query('SELECT DISTINCT f.id, f.famille FROM familles f ORDER BY f.famille ASC');
	}

	// function qui verifie si la famille existe dans la table //

	public function findfamily($family) {

		return $this->query('SELECT f.id FROM familles f WHERE f.famille = ?' ,[$family], true);
	}

}