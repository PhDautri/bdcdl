<?php

namespace App\Table;

use Core\Table\Table;


class UserTable extends Table {

	protected $table = 'users';

	// function qui remonte tous les utilisateurs //
	
	public function allusers() {

		return $this->query('SELECT u.id, u.username, u.last_name, u.first_name, u.type, u.u_email,
								u.u_phone, u.u_annu, u.u_etat, u.niveau, u.nbr_connec, 
								DATE_FORMAT(u.date_connect, \'%d-%m-%Y - %H:%i:%s\') AS dateconnectfr
								FROM users u
								ORDER BY u.id

							');
	} 

	// function qui verifie si l'utilisateur existe déja //
	 
	public function checkuser($nom, $prenom) {

		return $this->query("SELECT u.id FROM users u WHERE u.last_name = '$nom' AND u.first_name = '$prenom' ");
	}

	// function qui verifie si l'utilisateur et actif et non compte admin //
	
	public function CheckedUser($id) {

		return $this->query('SELECT u.id FROM users u WHERE u.u_etat = "Inactif" AND u.username != "admin" AND u.id = ?', [$id], true);
	}

	// function qui remonte le dernier compteur connection utilisateur //
	
	public function nbrconnect($id) {

		return $this->query('SELECT u.nbr_connec FROM users u WHERE u.id = ?', [$id] );
	}

}