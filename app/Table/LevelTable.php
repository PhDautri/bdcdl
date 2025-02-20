<?php

namespace App\Table;

use Core\Table\Table;


class LevelTable extends Table{

	protected $table = 'niveau';


	// fonction qui remonte les niveaux //	

	public function viewLevel() {

		return $this->query('SELECT n.id, n.niveau FROM niveau n ORDER BY n.niveau ');
	}

	// function qui verifie si le niveau existe //

	public function checkedlevel($level) {

		return $this->query('SELECT n.id, n.niveau FROM niveau n WHERE n.niveau = ?' ,[$level], true);
	}

	// function qui remonte le niveau du materiel lier en fonction du materiel primaire / id mate P//

	public function slclevelmatelier($id) {

		return $this->query('SELECT n.id, n.niveau FROM niveau n LEFT JOIN materiels m ON m.niveau_id = n.id WHERE m.id = ?',[$id]);
	}

}