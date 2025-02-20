<?php

namespace App\Table;

use Core\Table\Table;


class RepairTable extends Table {

	protected $table = 'reparations';


	// function qui remonte le montant de réparation pour la panne selectionner // id panne //
	
	public function countrepairs($id) {

		return $this->query('SELECT SUM(fr.montantFR) AS mr FROM factures_repar fr WHERE fr.pannes_id = ?',[$id]);

	}

	// function qui remonte le montant total des réparations par id matériel //
	
	public function countrepairst($id) {

		return $this->query(' SELECT SUM(fr.montantFR) AS mfr, SUM(fi.montantFI) AS mfi 

								FROM ((materiels m 

								LEFT JOIN factures_repar fr ON m.id = fr.materiel_id)

								LEFT JOIN factures_interv fi ON m.id = fi.materiel_id)

								WHERE m.id = ?', [$id]  
							);

	} 

}