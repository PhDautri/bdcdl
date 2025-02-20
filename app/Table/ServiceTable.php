<?php

namespace App\Table;

use Core\Table\Table;


class ServiceTable extends Table {

	protected $table = 'services';


	// function qui remonte les données pour le select //
	
	public function selectservice() {

		return $this->query('SELECT * FROM services s ORDER BY s.id');
	}

	// function qui verifie si le service existe déja dans la base //
	
	public function checkedservice($service) {		

		return $this->query('SELECT s.id FROM services s WHERE  s.nom_service = ?',[$service]);
	}
    

}