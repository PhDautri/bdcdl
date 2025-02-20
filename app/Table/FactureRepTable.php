<?php

namespace App\Table;

use Core\Table\Table;


class FactureRepTable extends Table {

	
	protected $table = 'factures_repar';


    // function qui verifie si une facture existe pour la panne (id panne) //
	
	public function chekeddocfactrep($id) {

		return $this->query('SELECT DISTINCT inte.sous_garanti, p.etat_panne, 
							YEAR(p.date_panne) AS annee, fr.id AS idfacrep, 
							fr.lien_fac_rep, fr.num_fac_rep	 

				             FROM ((pannes p				             

				             LEFT JOIN interventions inte ON p.id = inte.pannes_id)

							 LEFT JOIN factures_repar fr ON p.id = fr.pannes_id)

				             WHERE p.id = ?', [$id]

				            );
	}

	

}