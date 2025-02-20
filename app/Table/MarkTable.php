<?php

namespace App\Table;

use Core\Table\Table;


class MarkTable extends Table{

	protected $table = 'marques';

	

	// function qui verifie si les marques existe //

	public function checkedmark($mark) {

		return $this->query('SELECT m.marque FROM marques m WHERE m.marque = ?' ,[$mark], true);
	}	

	// fonction qui remonte les marques lier aux produits //	

	public function viewMark($id) {

		return $this->query('SELECT DISTINCT m.id, m.marque 

							FROM ((marques m

							LEFT JOIN models mo ON m.id = mo.marques_id)

							LEFT JOIN produits p ON p.id = mo.produits_id)

							WHERE mo.produits_id = ?',[$id]

							);
	}

	// function qui remonte si la marque et lier a un ou plusieurs matériels //
	
	public function finddelmark($id) {

		return $this->query('SELECT COUNT(m.id) AS Qtm FROM materiels m WHERE m.marques_id = ?', [$id]);
	}
} 