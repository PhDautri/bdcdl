<?php

namespace App\Table;

use Core\Table\Table;


class LotTable extends Table {

	protected $table = 'lot';

	
    // function qui remonte tout les lot pour le select //
    
    public function selectLot() {

        return $this->query('SELECT * FROM lot l ORDER BY l.id');

    }

    // function qui remonte les lot déja enregistrer pour le select lot //
    
    public function findLot($id) {

        return $this->query('SELECT rce.id, rce.lotID FROM relever_compteurseau rce
        					
        					WHERE YEAR(rce.date) = ?', [$id]
        					);

    }

    // function qui remonte true si le lot existe et false si le lot n'existe pas //
    
    public function CheckedLot($id) {

    	return $this->query('SELECT l.num_lot FROM lot l WHERE l.num_lot = ?', [$id], true);


    }

}