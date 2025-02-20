<?php

namespace App\Table;

use Core\Table\Table;


class ArmoireTable extends Table {

	protected $table = 'armoires';	


	// remonte true ou false si l'armoire existe ou non //
	
	public function checkedarm($id) {

		return $this->query('SELECT arm.id, n.niveau, arm.type, arm.nom_arm, arm.lieux
							 FROM armoires arm 
							 LEFT JOIN niveau n ON n.id = arm.niveau_id
							 WHERE arm.nom_arm = ?', [$id]);
	}	

	// remonte les armoires //
	
	public function viewarm() {

		return $this->query('SELECT arm.id, arm.niveau_id, arm.nom_arm, arm.type, arm.lieux, n.niveau 
							FROM armoires arm 
							LEFT JOIN niveau n ON n.id = arm.niveau_id ORDER BY arm.id');
	}

	// function qui remonte les données sur l'armoire selectionner //
	
	public function findarm($id) {

		return $this->query('SELECT * FROM armoires arm LEFT JOIN niveau n ON n.id = arm.niveau_id WHERE arm.id = ?', [$id]);
	}

	// function qui retourne les données pour le select //
	
	public function selectarm($type) {

		return $this->query('SELECT arm.id, arm.nom_arm, n.niveau 
							FROM armoires arm 
							LEFT JOIN niveau n ON n.id = arm.niveau_id
							WHERE arm.type = "'.$_POST['type'].'"
							ORDER BY arm.niveau_id ASC');
	}

}