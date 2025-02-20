<?php

namespace App\Table;

use Core\Table\Table;


class HeadBandTable extends Table {

	protected $table = 'bandeau';


	// function qui retourne la liste des bandeaux pour le select //
	
	public function selectHeadBand() {

		return $this->query('SELECT b.id, b.nom_bandeau FROM bandeau b ORDER BY b.nom_bandeau ASC');
	}

	// function qui verifie si le bandeau existe en base //

	public function findHeadBand($band) {

		return $this->query('SELECT b.id FROM bandeau b WHERE b.nom_bandeau =?', [$band]);
	} 


}
