<?php

namespace App\Table;

use Core\Table\Table;


class DocumentTable extends Table {

	protected $table = 'documents';

	// function qui affiche tout les documents /*********AC**********/
	
	public function documentsall() {

		return $this->query('SELECT * FROM documents d WHERE d.num_cert_etanch IS NOT NULL ');
	}


	// function qui verifie si une facture existe pour le matériel (id mate) //
	
	public function chekeddocfactachat($id) {

		return $this->query('SELECT m.montantAchat, m.num_factAchat FROM materiels m WHERE m.id = ?', [$id] );
	}

	// function qui verifie si un certif existe pour la panne (id panne) //
	
	public function chekeddocce($id) {

		return $this->query('SELECT d.id, d.b_cce, d.num_cert_etanch, p.etat_panne	 

				             FROM documents d

				             INNER JOIN pannes p ON p.id = d.pannes_id

				             WHERE d.pannes_id = ?', [$id]
						);
	}	   

	// function qui calcule le montant total des réparations propiétaire clinique //
	
	public function Countmtr(){

		return $this->query('SELECT SUM(mt) AS montantT 
							FROM (SELECT mtfr.montantFR AS mt FROM factures_repar mtfr WHERE mtfr.prop = 0 UNION ALL SELECT mtfi.montantFI AS mt FROM factures_interv mtfi WHERE mtfi.prop = 0) 
							AS mtr');

	}

	// function qui retourne les données document caractéristique matériel /id = id mate //
	
	public function DocCm($id) {

		return $this->query('SELECT d.id, d.doc_mat FROM documents d WHERE d.materiel_id = ?', [$id]);
	}
	

}