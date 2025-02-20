<?php

namespace App\Table;

use Core\Table\Table;


class CabinetTable extends Table {

	protected $table = 'cabinets_doctors';


	// function qui remonte les données du cabinet / id cabinet //
	
	public function datacabinet($id) {

		return $this->query('SELECT * FROM cabinets_doctors c WHERE c.id = ?', [$id]);
	}

	// verifie si le cabinet a des interventions //
	
	public function CheckedIntervCab($id) {

		return $this->query('SELECT c.id FROM cabinets_doctors c LEFT JOIN interv_doctors id ON id.cab_id = c.id WHERE c.id = ?' ,[$id]);

	}

}