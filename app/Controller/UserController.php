<?php

namespace App\Controller;

use \Core\Auth\DbAuth;

use \App;


class UserController extends AppController{	

	public function __construct(){

		parent::__construct();

		$this->loadModel('User');

	}

	// Login //
	
	public function Login(){

		$auth = new DbAuth(App::getInstance()->getDb());					
		$basesql = $auth->namebase(); 
		$namebase = $basesql[0]->namebase;

		if(!empty($_POST)){

			// permet de faire une demande d'acces //

			if (isset($_POST['request'])) {

				if ($_POST['request'] === 'request') {
					$nom = $_POST["nom"];
					$prenom = $_POST["prenom"];
					$email = $_POST["email"];

					include_once('../app/Views/users/requestaccess.php');
					sendmail($nom,$prenom,$email);
				}				

			} else if (isset($_POST['forgotPass'])) {
				
				if ($_POST['forgotPass'] === 'forgotPass') {
					$email = $_POST["Email"];
					include_once('../app/Views/users/requestaccess.php');
					forgotpassword($email);
						
				}				

			} else {				

				if(!empty($_POST['username'] && !empty($_POST['password']))) {					

					if ($namebase == "bdcdl") { // base production
						
						$connect = $auth->login($_POST['username'], $_POST['password']);

						if ($connect === false) {

							session_abort();
							
							?>							
								<h3 class="alert alert-danger text-center">Identifiant ou Mot de passe Incorrect !!</h3>

							<?php

						} else if ($connect === "Inconnu") {

							session_abort();

							?>						
								<h3 class="alert alert-danger text-center">Ce compte n'existe pas. Veuillez contacter votre administrateur !!</h3>			

							<?php

						} else if ($connect === "Inactif") {

							session_abort();
							
							?>							
								<h3 class="alert alert-danger text-center">Ce compte et desactivé. Veuillez contacter votre administrateur !!</h3>

							<?php

						} else if ($_SESSION["etat"] === 'Actif' AND $connect == true) {

							$result = $this->User->nbrconnect($_SESSION['auth']);

							$nbrconnect = $result[0]->nbr_connec +1;								

							$this->User->update($_SESSION['auth'], [

								'nbr_connec' => $nbrconnect,
								'date_connect' => date("Y-m-d H:i:s")

							]);
							
							if ($_SESSION['niveau'] === '2') {

								header('Location: index.php?p=home.compta');

							} else { 								

								header('Location: index.php?p=home');
							}					

						} 

					} else if($namebase != "bdcdl" AND $_POST['username'] == "admin"){ // base test / site en maintenance  //

						$connect = $auth->login($_POST['username'], $_POST['password']);

						if ($connect === false) {

							session_abort();
							
							?>							
								<h3 class="alert alert-danger text-center">Identifiant ou Mot de passe Incorrect !!</h3>

							<?php

						} else if ($connect == true) {							

							header('Location: index.php?p=home');									

						} 
						
					} 				
					
				} else {

					// aucun champ rempli //

					session_abort();

					?>						
						<h3 class="alert alert-danger text-center">Vous devez renseigner tous les champs !!</h3>			

					<?php

				}
				
			}			
			
		}

		$this->render('users.login', compact('namebase'));
	}
	
	// coupe la session //
	
	public function destroy(){

		$_SESSION = session_destroy();

		header('Location: index.php?p=login');
	}

	// change le mot de passe utilisateur //

	public function changemp(){

		if (!empty($_POST)) {

			$mp = password_hash($_POST['mp'], PASSWORD_DEFAULT);

			$this->User->update($_POST['id'], [				

				'password' => $mp
    		
			]);
	 	    	
		}

	}

	// ouvre la page add user //
	
	public function AddUser(){

		$this->render('users.adduser');

	}

	// enregistre le nouveau utilisateur //
	
	public function Add_User(){		

		if (!empty($_POST)) {

			$resultuser = $this->User->checkuser($_POST['nom'],$_POST['prenom']);

			if (!$resultuser) {				
				
				$password = password_hash($_POST['pass'], PASSWORD_DEFAULT); // crypte le mot de passe //

				$nom = $_POST['nom'];

				$prenom = $_POST['prenom'];

				$minipren = strtolower($prenom[0]); // mise en minuscule de la premiére lettre du prenom récupérer //

				$mininom = strtolower($nom); // mise en minuscule du nom //

				$array = array($minipren,$mininom); // crée un tableau

				$login = implode(".", $array); // reforme le login

				if ($_POST['type'] === "1") {
					
					$type = "administrateur";
					$niveau = "10";

				} else {

					$type = "utilisateur";

					if (isset($_POST['NT'])) {
						$niveau = '7';
					} 

					if (isset($_POST['NC'])) {
						$niveau = '2';
					}

					if (isset($_POST['ND'])) {
						$niveau = '9';
					}

				}

				$this->User->create([

					'username' => $login,
					'last_name' => $_POST['nom'],
					'first_name' => $_POST['prenom'],
					'type' => $type,
					'password' => $password,
					'u_email' => $_POST['email'],
					'u_annu' => $_POST['annu'],
					'u_phone' => $_POST['phone'],
					'u_etat' => 'Actif',
					'niveau' => $niveau				
	    		
				]);

				$v = true;

				echo json_encode($v);				

			} else {

				// l'utilisateur existe				
				$v = false;
				echo json_encode($v); 
			}			
	 	    	
		}  
	}

	// function qui affiche tous les utilisateurs //
	
	public function viewallusers(){

		$this->render('users.users');

	}

	// remonte les données sur les utilisateur //
	 
	public function UsersAll(){

		$user = $this->User->allusers();		
		
		$output = array("data" => $user);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// edition utilisateur BD //
	
	public function EditUser(){		

		if (!empty($_POST)) {

			if ($_POST['type'] === "administrateur") {					
				
				$niveau = "10";

			} else {

				$type = "utilisateur";

				if (isset($_POST['NT'])) {
					$niveau = '7';
				} 

				if (isset($_POST['NC'])) {
					$niveau = '2';
				}

				if (isset($_POST['ND'])) {
					$niveau = '9';
				}

			}

			$this->User->update($_POST['IdUser'], [

				'username' => $_POST['login'],
				'last_name' => $_POST['nom'],
				'first_name' => $_POST['prenom'],
				'type' => $_POST['type'],
				'u_email' => $_POST['email'],
				'u_annu' => $_POST['annu'],
				'u_phone' => $_POST['phone'],
				'niveau' => $niveau
			]);			

		}

	}

	// function qui verifie si l'utilisateur et actif et pas compte admin //
	
	public function checkedUser(){

		if (!empty($_POST)) {
			
			$result = $this->User->CheckedUser($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);
		}
	}

	// change etat utilisateur //
	
	public function ChangeEtatUser(){

		if (!empty($_POST)) {

			$result = $this->User->update($_POST['id'], [

				'u_etat' => $_POST['etat']
			]);			

		}

	}	

	// function delete //
	
	public function deleteUser(){

		$result = $this->User->delete($_POST['id']);
	}
}