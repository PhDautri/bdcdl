<?php

namespace App\Table;

use Core\Table\Table;


class ControlTable extends Table {

	protected $table = 'controls';


	// retourne tout les controles //
	public function All() {

		return $this->query('SELECT c.id, c.type, c.category_id, cat.categorie, c.prestation, c.frequency, c.controleur, c.nom, 
							DATE_FORMAT(c.planification, \'%d-%m-%Y\') AS planif, c.verification,
							DATE_FORMAT(c.last_control, \'%d-%m-%Y\') AS last_control, 
							DATE_FORMAT(c.deadline, \'%d-%m-%Y\') AS deadline, c.lien_control 

							FROM controls c 

							LEFT JOIN categories cat ON cat.id = c.category_id

							ORDER BY c.id');
	}

	// retourne les données par leurs id controls //
	public function dataCtrl($id) {

		return $this->query('SELECT * FROM controls c WHERE c.id = ?', [$id]);
	}

	// retourne la valeur de statut //	

	public function FindControl() {

		return $this->query('SELECT c.statut FROM controls c WHERE c.type = "'.$_POST['typecont'].'" AND c.category_id = "'.$_POST['categorie'].'" AND c.prestation = "'.$_POST['prestation'].'"');
	}
	

}