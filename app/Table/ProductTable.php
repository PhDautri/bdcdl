<?php

namespace App\Table;

use Core\Table\Table;


class ProductTable extends Table{

	protected $table = 'produits';

	// function qui remonte les données pour views product //

	public function allproduct(){

		return $this->query('SELECT p.id, p.produit,p.mat_primary, p.mat_category, f.famille 
							FROM produits p
							LEFT JOIN familles f ON f.id = p.famille_id
							');
	}

	
	// function qui remonte les données pour le select product //
	
	public function selectproduct() {

		if ($_POST['fam'] == "0") {
			return $this->query('SELECT * FROM produits p WHERE p.mat_primary = '.$_POST['btn'].' ORDER BY p.produit ASC');
		} else {
			return $this->query('SELECT * FROM produits p WHERE p.famille_id = '.$_POST['fam'].' AND p.mat_primary = '.$_POST['btn'].' ORDER BY p.produit ASC');
		}

		
	}

	// function qui remonte les données pour le select catégorie /A verifier pas utiliser /
	
	public function selectcateproduct() {

		return $this->query('SELECT * FROM produits ');
	}

	// function qui verifie si le produit existe //

	public function findproduct($product) {

		return $this->query('SELECT p.produit,p.mat_category FROM produits p WHERE p.produit = ?' ,[$product], true);
	}

	// function qui remonte si le produit et lier a un ou plusieurs matériels //
	
	public function finddelproduct($id) {

		return $this->query('SELECT COUNT(m.id) AS Qtm FROM materiels m WHERE m.produits_id = ?', [$id]);
	}

	

}	
