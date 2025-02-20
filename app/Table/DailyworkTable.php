<?php

namespace App\Table;

use Core\Table\Table;


class DailyworkTable extends Table {

	protected $table = 'travaux';


	// function qui remonte tous les travaux journalier //
	
	public function alldailyworks(){

		return $this->query('SELECT t.id, t.user, DATE_FORMAT(t.date_travaux, \'%d-%m-%Y\') AS datedailyfr, 
							t.categorie_id, c.categorie, t.designation, t.commentaire, t.statut

							FROM travaux t

							INNER JOIN categories c ON  c.id = t.categorie_id

							ORDER BY t.id
						');
	
	}	

	// function qui recherche les données travaux en function du travail journalier //
	
	public function FindDataDaily($id){

		return $this->query('SELECT t.date_travaux, t.categorie_id, t.designation, t.commentaire
							FROM travaux t 
							WHERE t.id = ?', [$id]);
	}	


}