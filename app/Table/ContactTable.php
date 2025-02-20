<?php

namespace App\Table;

use Core\Table\Table;


class ContactTable extends Table {

	protected $table = 'contacts';


	// function qui remonte tous les contacts des entreprises //
	 
	public function allContact() {

		return $this->query('SELECT cont.id, CONCAT(contr.nom) AS societe, cont.c_nom, cont.c_prenom, cont.c_fonction, cont.c_portable, cont.c_email FROM contacts cont LEFT JOIN intervenants contr ON contr.id = cont.contribut_id');
	}

	// function verifie si le contact a déja etait appeler pour cette panne //
	
	public function CheckedAppelContact($idp, $idc) {

		return $this->query('SELECT ap.contact_id FROM appel ap WHERE ap.pannes_id = "'.$_POST['idp'].'" AND ap.contribut_id = "'.$_POST['idc'].'"');
	}

	// function qui remonte les contacts de l'intervenant //
	
	public function findContact($id) {

		return $this->query('SELECT cont.id, CONCAT(contr.nom) AS societe, cont.c_nom, cont.c_prenom, cont.c_fonction, cont.c_portable, cont.c_email, CONCAT(cont.c_nom, " - ", cont.c_prenom) AS nom 
							FROM contacts cont 
							LEFT JOIN intervenants contr ON contr.id = cont.contribut_id
							WHERE cont.c_fonction != "Technicien" AND cont.contribut_id = ?', [$id]
							);
	}

	// function qui remonte les technicien de l'intervenant //
	
	public function findTech($id) {

		return $this->query('SELECT cont.id, CONCAT(contr.nom) AS societe, cont.c_nom, cont.c_prenom, cont.c_fonction, cont.c_portable, cont.c_email, CONCAT(cont.c_nom, " - ", cont.c_portable) AS nom 
							FROM contacts cont 
							LEFT JOIN intervenants contr ON contr.id = cont.contribut_id
							WHERE cont.c_fonction = "Technicien" AND cont.contribut_id = ?', [$id]
							);
	}
	
	// function qui remonte les données sur l'intervenant & contact appeler //

	public function finddataContact($id) {

		return $this->query('SELECT contr.id, contr.nom, CONCAT(cont.c_nom," - ", cont.c_prenom) AS contact, cont.c_portable 
							 FROM contacts cont  
							 LEFT JOIN intervenants contr ON contr.id = cont.contribut_id							 
							 WHERE cont.id = ?', [$id]); 
	}
	
}