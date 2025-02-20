<?php

namespace App\Table;

use Core\Table\Table;


class ModelTable extends Table{

	protected $table = 'models';


	// function qui recherche les models par rapport a leur marque (id marque & id produit)//

		public function findModels($idm,$idp) {

			return $this->query("SELECT mo.id, mo.marques_id, mo.model 

								 FROM models mo

								 LEFT JOIN produits p ON mo.produits_id = p.id

								 WHERE mo.marques_id = " .$_POST['idm']. " AND mo.produits_id = " .$_POST['idp']. "

								");
		}

	// function qui verifie si les models existe en base par sont model //

		public function checkedmodel($model) {

			return $this->query('SELECT mo.marques_id, mo.model FROM models mo WHERE mo.model = ?' ,[$model], true );

		}

	// function qui verifie si une image existe pour le model du matériel selectionner (id mate) //
	
		public function checkedimgmodel($id) {

			return $this->query('SELECT mo.img, m.models_id, mo.model 
								FROM models mo
								LEFT JOIN materiels m ON m.models_id = mo.id 
								WHERE m.id = ?' ,[$id], true
								);
		}	
	 
	// function qui affiche un tableau tous les model par rapport & a la marque (affichage) //	

		public function viewModels($id, $idp) {
			
			// recherche par id_marque //
			return $this->query('SELECT mo.id, mo.model, mo.img 
									FROM models mo 
									WHERE mo.marques_id = "'. $_POST['id'] .'" AND mo.produits_id = "'. $_POST['idp'] .'" 

									ORDER BY mo.model ASC

									');				
		}

	// function qui remonte si le model et lier a un ou plusieurs matériels //
	
		public function finddelmodel($id) {

			return $this->query('SELECT COUNT(m.id) AS Qtm FROM materiels m WHERE m.models_id = ?', [$id]);
		}
	
}