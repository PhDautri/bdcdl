<?php

namespace App\Table;

use Core\Table\Table;


class ChartTable extends Table {

	protected $table = 'chart_panne';

	// function qui remonte les données de la table chart_panne (panne et prix total) //

	public function chartPanne() {

		return $this->query('SELECT cp.year, cp.nbrs_panne, cp.prix_total_rep FROM chart_panne cp ORDER BY cp.year');
	}

	// function qui remonte les données pour chart_panne volet //

	public function chartPannevolet() {

		return $this->query('SELECT cp.year, cp.nbr_pvolet, cp.prixT_rep_volet FROM chart_panne cp ORDER BY cp.year');
	}

	// function qui remonte les années des pannes //
	
	public function extractYear() {

		return $this->query('SELECT DISTINCT YEAR(pa.date_panne) AS annee FROM pannes pa ORDER BY YEAR(pa.date_panne)');
	}

    // function qui verifie les années en base $id = annee //
	
	public function checkedYear($id) {

		return $this->query('SELECT cp.id, cp.year, cp.nbrs_panne, cp.prix_total_rep, cp.nbr_pvolet FROM chart_panne cp WHERE cp.year = ?', [$id]);
	}

	// function qui remonte le nombre de panne par année et somme et mfi & mfr- propriétaire clinique / id = année //
	
	public function extractNbrPanne($id) {

		return $this->query('SELECT 
							(SELECT SUM(fr.montantFR) FROM factures_repar fr WHERE fr.prop = 0 AND fr.annee_factrepair = "'.$_POST['id'].'") AS mfr, 
							(SELECT SUM(fi.montantFI) FROM factures_interv fi WHERE fi.prop = 0 AND fi.annee_factinterv = "'.$_POST['id'].'") AS mfi,			
							(SELECT COUNT(pa.id) AS nbrpV FROM ((pannes pa
								LEFT JOIN materiels ma ON pa.materiel_id = ma.id)
								LEFT JOIN produits p ON ma.produits_id = p.id) 
								WHERE YEAR(pa.date_panne) = "'.$_POST['id'].'" AND p.mat_category = "SN") AS nbrpV,
							(SELECT SUM(fr.montantFR) FROM ((factures_repar fr
							    LEFT JOIN materiels ma ON fr.materiel_id = ma.id)
							    LEFT JOIN produits p ON ma.produits_id = p.id)  
							    WHERE fr.prop = 0 AND p.mat_category = "SN" AND fr.annee_factrepair = "'.$_POST['id'].'") AS mfrv, 
							(SELECT SUM(fi.montantFI) FROM ((factures_interv fi
							    LEFT JOIN materiels ma ON fi.materiel_id = ma.id)
							    LEFT JOIN produits p ON ma.produits_id = p.id)  
							    WHERE fi.prop = 0 AND p.mat_category = "SN" AND fi.annee_factinterv = "'.$_POST['id'].'") AS mfiv,
							COUNT(pa.id) AS nbrpanne FROM pannes pa WHERE YEAR(pa.date_panne) = ?', [$id]);
	}

	// function qui remonte les montants totaux par année des intervs & reparations propriétaire clinique / id= annee //
	
	public function countPriceTotalRepair($id) {

		return $this->query('SELECT SUM(fr.montantFR) AS mt FROM factures_repar fr WHERE fr.prop = 0 AND fr.annee_factrepair = "'.$_POST['annee'].'" 

							UNION

							SELECT SUM(fi.montantFI) FROM factures_interv fi WHERE fi.prop = 0 AND fi.annee_factinterv = "'.$_POST['annee'].'" ');
	}

	// function qui remonte les montants totaux par année des intervs & reparations propriétaire clinique des volets / id= annee /************AC***********/
	
	public function countptrv($id) {

		return $this->query('SELECT SUM(fr.montantFR) AS mt 
							 FROM factures_repar fr
							 LEFT JOIN materiels m ON m.id = fr.materiel_id 
							 WHERE fr.prop = 0 AND fr.annee_factrepair = "'.$_POST['annee'].'" AND m.num_inventaire LIKE "Volet%"

							 UNION

							 SELECT SUM(fi.montantFI) 
							 FROM factures_interv fi
							 LEFT JOIN materiels m ON m.id = fi.materiel_id 
							 WHERE fi.prop = 0 AND fi.annee_factinterv = "'.$_POST['annee'].'" AND m.num_inventaire LIKE "Volet%" ');
	}	 

}