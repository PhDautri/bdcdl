<?php

namespace App\Table;

use Core\Table\Table;


class CallTable extends Table {

	protected $table = 'appel';

	// function qui remonte l'id de l'appel de la panne et le contact_id / id_panne //
    
    public function findCallPanne($id) {

    	return $this->query('SELECT a.id, a.contact_id FROM appel a WHERE a.pannes_id = ?', [$id]);

    }
    

}