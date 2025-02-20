<?php

namespace App\Table;

use Core\Table\Table;


class QuotationTable extends Table {

	protected $table = 'devis';

	// function qui remonte tous les devis //
	public function allquota() {

		return $this->query('SELECT de.id, DATE_FORMAT(de.date_request_quota, \'%d-%m-%Y\') AS daterequestfr, 
							DATE_FORMAT(de.date_quota, \'%d-%m-%Y\') AS datequotafr, 
							DATE_FORMAT(de.date_vali_quota, \'%d-%m-%Y\') AS datevaliquotafr, 
							DATE_FORMAT(de.date_refus_quota, \'%d-%m-%Y\') AS daterefusquotafr, de.num_devis, de.lien_devis, de.montantDE, de.etat_devis, i.nom, de.pannes_id, pa.materiel_id
							FROM ((devis de
							LEFT JOIN intervenants i ON i.id = de.contribut_id)
							LEFT JOIN pannes pa ON pa.id = de.pannes_id) 
							ORDER BY de.id'
							);		
		
	}

	// function qui remonte le devis par panne/ id panne //
	
	public function affquota($id) {

		return $this->query('SELECT de.id, DATE_FORMAT(de.date_quota, \'%d-%m-%Y\') AS datequotafr, 
							DATE_FORMAT(de.date_vali_quota, \'%d-%m-%Y\') AS datevaliquotafr, 
							DATE_FORMAT(de.date_refus_quota, \'%d-%m-%Y\') AS daterefusquotafr, de.num_devis, de.lien_devis, de.montantDE, de.etat_devis, i.id AS idcontribut, i.nom, 
							(SELECT pa.etat_devis FROM pannes pa WHERE pa.id = de.pannes_id) AS etatquota, de.pannes_id 
							FROM devis de
							LEFT JOIN intervenants i ON i.id = de.contribut_id 
							WHERE de.pannes_id = ?', [$id]
							);		
	}

	// function qui remonte les devis en attente //
	public function PendingQuote() {

		return $this->query('SELECT de.id, DATE_FORMAT(de.date_request_quota, \'%d-%m-%Y\') AS daterequestfr, 
							DATE_FORMAT(de.date_quota, \'%d-%m-%Y\') AS datequotafr, 
							DATE_FORMAT(de.date_vali_quota, \'%d-%m-%Y\') AS datevaliquotafr, 
							DATE_FORMAT(de.date_refus_quota, \'%d-%m-%Y\') AS daterefusquotafr, de.num_devis, de.lien_devis, de.montantDE, de.etat_devis, i.nom, de.pannes_id, pa.materiel_id
							FROM ((devis de							
							LEFT JOIN intervenants i ON i.id = de.contribut_id)
							LEFT JOIN pannes pa ON pa.id = de.pannes_id)
							WHERE de.etat_devis = "Attente Devis" || de.etat_devis = "Devis En Attente"
							ORDER BY de.id'
							);

	}

	// function  qui remonte le total devis id matériel //
	public function countquotat($id) {

		return $this->query('SELECT SUM(d.montantDE) AS mtd 

							 FROM pannes p

							 LEFT JOIN devis d ON p.id = d.pannes_id
							 
							 WHERE d.date_vali_quota IS NOT NULL AND p.materiel_id = ?', [$id]);
	}

	// function qui remonte le montant total des devis /**********AC************/
	public function countmtquota() {

		return $this->query('SELECT SUM(d.montantDE) AS montantDE FROM devis d');
	}
	
	// function  qui remonte le montant devis id panne //
	public function countquota($id) {

		return $this->query('SELECT SUM(d.montantDE) AS md

							FROM pannes p 

							LEFT JOIN devis d ON p.id = d.pannes_id

							WHERE d.date_vali_quota IS NOT NULL AND d.date_refus_quota IS NULL AND p.id = ?', [$id]);
	}

	// remonte le nombre de devis par pannes // id panne //
	
	public function countnbrquota($id) {

		return $this->query('SELECT COUNT(de.id) AS nbrquota FROM devis de WHERE de.pannes_id = ?', [$id] );
	}

	// remonte le nombre de devis refuser par pannes // id panne //
	
	public function nbrdenyquota($id) {

		return $this->query('SELECT COUNT(de.id) AS nbrquota FROM devis de WHERE de.date_refus_quota IS NOT NULL AND de.pannes_id = ?', [$id],true );
	}	

	// verifie si tous le devis sont en devis Refusé lors du passage en Réparation pas envisagé / id panne //	

	public function checkeddenyquota($id) {

		return $this->query('SELECT de.id FROM devis de WHERE de.etat_devis = "Devis En Attente" AND de.pannes_id = ?',[$id]);

	}

	// function qui remonte le nbrs de devis en attente //
	
	public function CountNda() {

		return $this->query('SELECT COUNT(de.id) AS id FROM devis de WHERE de.etat_devis = "Devis En Attente" || de.etat_devis = "Attente Devis" || de.etat_devis = "Devis En Attente de Réactualisation"'); 
	} 

	// remonte le données de la panne devis validé contribut & contact //
	
	public function finddataquotavalidate($id) {

		return $this->query('SELECT de.id, de.contribut_id, de.contact_id FROM devis de WHERE de.date_vali_quota IS NOT NULL AND de.pannes_id = ?', [$id]);
	}

	// remonte le données du devis  //
	
	public function finddataquota($id) {

		return $this->query('SELECT de.pannes_id, de.contribut_id, de.num_devis FROM devis de WHERE de.id = ?', [$id]);
	}
	
}