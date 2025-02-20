<?php

namespace App\Table;

use Core\Table\Table;


class HomeTable extends Table {


	// function qui verifie si du matériel a un statut en panne //
	public function checkedNotif() {

		return $this->query('SELECT COUNT(pa.id) AS nbrpanne FROM pannes pa WHERE pa.etat_panne  != "Terminé"');
		
	}	
	
	

}