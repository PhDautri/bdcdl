<?php

namespace App\Controller;

use Core\Controller\Controller;

class ParamsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Param');

	}

	// function qui ouvre la page paramétrage email test //
	
	public function emailparams() {		

		$this->render('emails.params');

	}

	// function qui remonte les données paramétrage email //

	public function dataparams() {

		$result = $this->Param->dataparamsemail();

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	/////////////////////// Paramétrage serveur email /////////////////////

	// function add params email //
	public function validparams() {

		//var_dump($_POST);die();

		if ($_POST['TLS'] == 1 || $_POST['STARTTLS'] == 1) {
			$smtpauth = 'true';
		} else {
			$smtpauth = 'false';
		}

		if ($_POST['op'] == 'add') { // aucune données (create)
			
			$this->Param->create([

				'host' => $_POST['host'],
				'smtp_auth' => $smtpauth,
				'TLS' => $_POST['TLS'],
				'STARTTLS' => $_POST['STARTTLS'],
				'user_name' => $_POST['username'],
				'password' => $_POST['password'],
				'port' => $_POST['port'],
				'setfrom_addres' => $_POST['EMAIL_FROM'],
				'setfrom_name' => $_POST['NAME_FROM']

			]);

		} else { // données existe (update)

			$this->Param->update($_POST['id'],[

				'host' => $_POST['host'],
				'smtp_auth' => $smtpauth,
				'TLS' => $_POST['TLS'],
				'STARTTLS' => $_POST['STARTTLS'],
				'user_name' => $_POST['username'],
				'password' => $_POST['password'],
				'port' => $_POST['port'],
				'setfrom_addres' => $_POST['EMAIL_FROM'],
				'setfrom_name' => $_POST['NAME_FROM']

			]);

		}
		
	}

}