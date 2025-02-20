<?php

namespace App\Table;

use Core\Table\Table;


class FactureInteTable extends Table {

	
	protected $table = 'factures_interv';

    // function qui verifie si des documents existe pour l'intervention (id interv) //
	
	public function chekeddocinterv($id, $tab) {

        if ($tab == 'PANN') {		

	        return $this->query('SELECT inte.id, inte.sous_garanti, inte.num_bi, inte.type_interv, inte.etat_interv, pa.id AS pannes_id, 
								YEAR(pa.date_panne) AS annee, pa.etat_panne, fi.id AS idfacinte, fi.num_fac_interv, fi.lien_fac_interv

	                            FROM ((interventions inte

	                            LEFT JOIN factures_interv fi ON inte.id = fi.intervs_id)

	                            INNER JOIN pannes pa ON inte.pannes_id = pa.id)

	                            WHERE inte.id = ?', [$id]
	                        );
	    } else { // sans panne //

	    	return $this->query('SELECT inte.id, YEAR(inte.date_interv) AS annee, inte.sous_garanti, inte.num_bi, inte.type_interv, 
								inte.etat_interv, fi.id AS idfacinte, fi.num_fac_interv, fi.lien_fac_interv

	    						FROM interventions inte

	    						LEFT JOIN factures_interv fi ON inte.id = fi.intervs_id

	    						WHERE inte.id = ?', [$id]
	                        );		
	    }
    } 

}