<?php

namespace App\Table;

use Core\Table\Table;


class IntervCabTable extends Table {

	protected $table = 'interv_doctors';


    // function qui remonte l'intervention et le client par sont id interv //
    
    public function findIntervdoc($id) {

        return $this->query('SELECT c.id AS cab_id, c.nom_cab, c.telephone, intd.id AS id_interv, DATE_FORMAT(intd.date, \'%d-%m-%Y\') AS datefr, 
                            intd.num_interv, intd.designation, SUM(li.montantTHT) AS mTHT 
        					FROM ((interv_doctors intd
        					LEFT JOIN cabinets_doctors c ON intd.cab_id = c.id)
                            LEFT JOIN ligne_intervs li ON li.intervs_id = intd.id) 
        					WHERE intd.id =?', [$id]);
    }

    // function qui remonte si le bon d'interv a était validé / id intervcab //
    
    public function findValidInterv($id) {

        return $this->query('SELECT intd.id FROM interv_doctors intd WHERE intd.validate = 1 AND intd.id = ?', [$id]);

    }   

    // function qui remonte l'ensemble des interventions des cabinet //
    
    public function allintervcab() {

        return $this->query('SELECT intd.id, DATE_FORMAT(intd.date, \'%d-%m-%Y\') AS datefr, intd.num_interv, intd.designation, c.nom_cab
                            FROM interv_doctors intd
                            LEFT JOIN cabinets_doctors c ON intd.cab_id = c.id
                            ORDER BY intd.id
                            
        ');
    }

    // function qui compte le nbr d'interv cabinet //
    
    public function CountIntervCab() {

        return $this->query('SELECT COUNT(intd.id) AS ni FROM interv_doctors intd ORDER BY intd.id');
    }


    // function qui compte le nbr d'interv pas facturer  //
    
    public function CountIntervNoFact() {

        return $this->query('SELECT COUNT(intd.id) AS ninf FROM interv_doctors intd WHERE intd.totalHT IS NULL');
    }

}