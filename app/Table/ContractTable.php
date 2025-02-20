<?php

namespace App\Table;

use Core\Table\Table;


class ContractTable extends Table {

	protected $table = 'contrats';

	// function qui remonte tous les contrats des entreprises //
	 
	public function AllContract() {

		return $this->query('SELECT c.id, c.num_contrat, DATE_FORMAT(c.date_contrat, \'%d-%m-%Y\') AS date_deb, 
							c.durer, contr.id AS id_contri, contr.nom, c.reconduction, c.montant, c.lien_contrat  
							FROM contrats c 
							LEFT JOIN intervenants contr ON contr.id = c.contribu_id
							');
	}


	// function qui verifie si le numéro de contrat existe déja //

	public function CheckedContrat($id) {

		return $this->query('SELECT c.num_contrat FROM contrats c WHERE c.num_contrat = ?', [$id], true);
	}


	// function qui remonte le matériel qui a un contrat / id = id contrat //

	public function FindMatesContract($id) {

		return $this->query('SELECT m.id, m.num_inventaire, pro.produit, ma.marque, m.marques_id, mo.model, t.type, m.num_serie, m.lieux_install, n.niveau, m.niveau_id, 
							p.piece, m.statut,
							(SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE m.id = mtfr.materiel_id) AS mfr, 
							(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE m.id = mtfi.materiel_id) AS mfi, 
							(SELECT COUNT(pa.id) FROM pannes pa WHERE m.id = pa.materiel_id) AS nbrtotalpanne

							FROM (((((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN pieces p ON m.pieces_id = p.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							LEFT JOIN types t ON m.types_id = t.id) 

							WHERE m.statut != "Rebus" AND m.contrat_id = ?', [$id]);
	}



}



							

							

							
