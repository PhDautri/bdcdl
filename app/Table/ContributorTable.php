<?php

namespace App\Table;

use Core\Table\Table;


class ContributorTable extends Table {

	protected $table = 'intervenants';

	// function qui remonte les intervenants externe //
	
	public function allContributExt() {

		return $this->query('SELECT * FROM intervenants contr WHERE contr.depend = "EXT" ORDER BY contr.id');
	}

	// function qui remonte les intervenants interne //
	
	public function allContributInte() {

		return $this->query('SELECT * FROM intervenants contr WHERE contr.depend = "INT" ORDER BY contr.id');
	}

	// function qui remonte les données sur les intervenants Interne ou Externe //
	
	public function selectcontri($dep) {

		if ($dep == 'INT') { // intervenant interne //

			return $this->query('SELECT * FROM intervenants contr WHERE contr.depend = "INT" ORDER BY contr.id');
			
		} else { // intervenants externe //

			return $this->query('SELECT * FROM intervenants contr WHERE contr.depend = "EXT" ORDER BY contr.id');
		}
	}

	// function qui remonte les données sur le l'intervenant pour edition en function de l'id //
	
	public function findContributor($id) {

		return $this->query('SELECT * FROM intervenants contr WHERE contr.id = ?', [$id], true);
	}

	// function qui remonte l'id contact appeler pour le devis / id panne /***********AR***************/
	
	public function findCCquota($id) {

		return $this->query('SELECT de.contribut_id, de.contact_id 

							FROM devis de
							
							WHERE de.pannes_id = ?',[$id]

							);
	}

	// function qui remonte l'id contribut & contact pour le devis réactualiser / id panne //
	
	public function findCCquotaReactu($id) {

		return $this->query('SELECT de.contribut_id, de.contact_id 

							FROM devis de
							
							WHERE de.reactua_devis = 1 AND de.pannes_id = ?',[$id]

							);
	}	
	
	// function qui verifie si l'intervenant existe en base //
	
	public function CheckedContributors($Nom) {

		return $this->query('SELECT contr.nom FROM intervenants contr WHERE contr.nom = ?', [$Nom], true);
	}

	// function verifie si l'intervenant a déja etait appeler pour cette panne //
	
	public function CheckedAppelContribut($id) {

		return $this->query('SELECT ap.contribut_id FROM appel ap WHERE ap.pannes_id = ?', [$id]);
	}

	// function qui verifie si le numero existe déja //

	public function CheckedNumphone($phone) {

		return $this->query('SELECT contr.num_phone FROM intervenants contr WHERE contr.num_phone = ?',[$phone], true);
	}

	// function qui verifie si l'intervenant à des contact  //
	
	public function CheckedContact($id) {

		return $this->query('SELECT cont.id, cont.c_nom, cont.c_prenom, cont.c_fonction, cont.c_portable, cont.c_email, contr.nom 
							 FROM intervenants contr
							 LEFT JOIN contacts cont ON contr.id = cont.contribut_id
							 WHERE contr.id = ?', [$id]);
	}

	// function qui remonte les emails des contacts / id contributor//
	
	public function emailcontact($id) {

		return $this->query("SELECT contr.nom, cont.id, CONCAT(cont.c_nom, ' - ', cont.c_prenom) AS nom_contact, cont.c_email 
							FROM contacts cont
							LEFT JOIN intervenants contr ON contr.id = cont.contribut_id 
							WHERE cont.c_fonction != 'Technicien' AND cont.contribut_id = ".$_POST['id']."

			              ");
	} 	

}