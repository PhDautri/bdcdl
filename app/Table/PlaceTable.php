<?php

namespace App\Table;

use Core\Table\Table;


class PlaceTable extends Table{

	protected $table = 'lieux';

	// fonction qui recherche le lieu par rapport au niveau //

	public function findplace($id_level) {

		return $this->query('SELECT l.id, l.lieux FROM lieux l WHERE l.niveau_id = ?' ,[$id_level]);

	}

	// function qui recherche le lieu par rapport du matériel primaire/ id mate //

	public function findplacematlier($id) {

		return $this->query('SELECT l.id, l.lieux FROM lieux l LEFT JOIN materiels m ON m.lieux_id = l.id WHERE m.id = ?', [$id]);
	}

	// function qui verifie si le lieu existe dans le niveau //

	public function checkedplace($place, $idlevel) {

		return $this->query('SELECT l.id, l.lieux FROM lieux l WHERE l.niveau_id = "'. $_POST['id_level'] .'" AND l.lieux = ?' ,[$place], true);

	}	

	// function qui affiche tous les lieux du niveau selectionner ( id du niveau )//
	 
	public function viewplace($id) {

		return $this->query('SELECT l.id, l.lieux FROM lieux l INNER JOIN niveau n ON n.id = l.niveau_id WHERE n.id = "'. $_POST['id'] .'" ORDER BY l.id ASC '); 
		
	}
}