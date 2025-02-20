<?php

namespace App\Table;

use Core\Table\Table;


class TypeTable extends Table{

	protected $table = 'types';

	// function qui recherche le type par rapport au model pour add matériel (id du model) //

		public function findTypes($id) {

			return $this->query('SELECT t.id, t.type

								FROM types t

								LEFT JOIN models m ON t.id = m.types_id

								WHERE m.id = ?' ,[$id]
							); 
		}

	// function qui recherche le type par rapport a la marque pour add type (id de la marque)//

		public function findSelectTypes($id) {

			return $this->query('SELECT DISTINCT t.id, t.type

								FROM types t

								INNER JOIN models m ON t.id = m.types_id

								WHERE m.marques_id = ?' ,[$id]
							); 
		}

	// function qui affiche tous les types ( id du model )//
	 
		public function viewType($id) {

				return $this->query('SELECT t.id, t.type FROM types t

								 	INNER JOIN models m ON t.id = m.types_id

								 	WHERE  m.id = "'. $_POST['id'] .'"

								 	ORDER BY t.id ASC '); 
			
		}

	// fonction qui verifie si le type existe en base //

		public function checkedtype($type) {

			return $this->query('SELECT t.id, t.type FROM types t WHERE t.type = ?' ,[$type], true);
		}
		
	// function qui recherche l'id du type //
	
		public function findIdType() {

			return $this->query('SELECT MAX(t.id) AS id FROM types t');
		}

	// function qui remonte si le type et lier a un ou plusieurs matériels //
	
		public function finddeltype($id) {

			return $this->query('SELECT COUNT(m.id) AS Qtm FROM materiels m WHERE m.types_id = ?', [$id]);
		}
}