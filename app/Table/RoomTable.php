<?php

namespace App\Table;

use Core\Table\Table;


class RoomTable extends Table{
	
	protected $table = 'pieces';

	// fonction qui recherche la pièce par rapport au lieux pour le select / id = id_place//

	public function findroom($id) {

		return $this->query('SELECT p.id, p.piece FROM pieces p WHERE p.lieux_id = ?' ,[$id]);

	}

	// function qui verifie si la pièce existe pour le lieux //

	public function checkedroom($id_place, $room) {

		return $this->query('SELECT p.id FROM pieces p WHERE p.lieux_id = "'. $_POST['id_place'] .'" AND p.piece = "'. $_POST['room'].'"');

	}
		
	// function qui affiche tous les pièces du lieux selectionner (id du lieux)//
	 
	public function viewroom($id) {

		return $this->query('SELECT p.id, p.piece FROM pieces p INNER JOIN lieux l ON l.id = p.lieux_id WHERE l.id = "'. $_POST['id'] .'" ORDER BY l.id ASC '); 
		
	}
}