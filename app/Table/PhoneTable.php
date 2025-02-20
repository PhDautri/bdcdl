<?php

namespace App\Table;

use Core\Table\Table;


class PhoneTable extends Table {

	protected $table = 'telephones';

	// function qui affiche tous les liens //
	
	public function allLink() {

		return $this->query('SELECT tel.id, tel.num_tel, tel.num_sda, s.nom_service, tel.type, tel.nom_tel, tel.zone, tel.link,
							 tel.empl_ipbx, b.nom_bandeau, tel.port_rg, tel.nom_arm, tel.port_arm, tel.niveau_arm, tel.num_pbureau, tel.lieux_bureau 
							 FROM ((telephones tel 
							 LEFT JOIN bandeau b ON tel.band_id = b.id)
							 LEFT JOIN services s ON tel.service_id = s.id)
							 WHERE tel.type != "DECT" AND tel.link = 1 ORDER BY tel.id');
	} 

	// function qui retourne l'annuaire avec lien selectionner //
	
	public function selectLink($id) {

		return $this->query('SELECT tel.id, tel.num_tel, tel.num_sda, s.nom_service, tel.type, tel.nom_tel, tel.zone, tel.link,
							 tel.empl_ipbx, b.nom_bandeau, tel.port_rg, tel.nom_arm, tel.port_arm, tel.niveau_arm, tel.num_pbureau, tel.lieux_bureau
							 FROM ((telephones tel 
							 LEFT JOIN bandeau b ON tel.band_id = b.id)
							 LEFT JOIN services s ON tel.service_id = s.id) 
							 WHERE tel.id = ?',[$id]);
	}

	// function qui retourne les données lien par sont id //
	
	public function dataLinks($id) {

		return $this->query('SELECT tel.id, tel.num_tel, tel.num_sda, tel.type, tel.nom_tel, tel.zone, tel.link, tel.empl_ipbx, tel.band_id, 
							 b.nom_bandeau, tel.port_rg, tel.nom_arm, tel.port_arm, tel.niveau_arm, tel.num_pbureau, tel.lieux_bureau 
							 FROM telephones tel 
							 LEFT JOIN bandeau b ON tel.band_id = b.id
							 WHERE tel.id =?', [$id]);
	}

	// function qui verifie si le champ existe en base //
	
	public function CheckedFields($field, $fieldB) {

		$varia = 'tel.';

		$var = "$varia$fieldB";

		return $this->query('SELECT tel.id FROM telephones tel WHERE '.$var.' = ?',[$field]);
	}

	// function qui remonte les données lier au port du bandeau /*********A REVOIR***********/
	
	public function CheckedPorts($band,$field,$fieldA,$fieldB) {

		$varia = 'tel.';

		$val1 = "$varia$fieldA"; // tel.nom_band //

		$val2 = "$varia$fieldB"; // tel.port_rg //

		return $this->query('SELECT tel.id FROM telephones tel WHERE tel.band_id = "'.$band.'" AND tel.port_rg = "'.$field.'" ');
		
	}	

	// function qui remonte les données pour la table datatable annuaire //
	
	public function PhonesBook() {

		return $this->query('SELECT tel.id, tel.num_tel, tel.num_sda, tel.type, s.nom_service, tel.nom_tel, tel.link, tel.zone

							 FROM telephones tel 

							 LEFT JOIN services s ON tel.service_id = s.id

							 ORDER BY tel.id

							');

	}

	// function qui retourne les données du téléphone pour annuaire / id phone//
	
	public function findDataPhoneBook($id) {

		return $this->query('SELECT tel.id, tel.num_tel, tel.num_sda, tel.type, tel.nom_tel, tel.zone, s.id AS id_serv, s.nom_service

							 FROM telephones tel 

							 LEFT JOIN services s ON tel.service_id = s.id

							 WHERE tel.id =?', [$id]);

	}

	



}