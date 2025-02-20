<?php

namespace App\Controller;

use Core\Controller\Controller;


class EventsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Event');

		$this->loadModel('Panne');

		$this->loadModel('Document');

		$this->loadModel('Quotation');

		$this->loadModel('Material');

		$this->loadModel('Dailywork');

		$this->loadModel('Interv');

		$this->loadModel('Call');

	}

	// affiche la page événements matériel selectionner // a suprimé //
	
	public function eventsMate(){

		$mate = $this->Material->finddatamate($_GET['idMate']);

		$this->render('events.eventsPanneMate', compact('mate'));
	}

	// affiche la table événement panne//
	
	public function affEvent(){

		if (!empty($_POST['id'])) {
			
			$result = $this->Event->affevent($_POST['id']);

			$output = array("data" => $result);

			header('Content-Type: aplication/json');

		    echo json_encode($output);
		   
		}
	}

	// ajoute un évenement a la panne //
	
	public function addEvent(){	

		//var_dump($_POST);die();			

		if (!empty($_POST)) {

			if (isset($_POST['Commentaire'])) {

				$comment = $_POST['Commentaire'];
				$dateEvent = $_POST['DateEvent'];
				$heureEvent = $_POST['HeureEvent'];				

				if (isset($_POST['Contact'])) {

					$contact = $_POST['Contact'];
				}			

			} 	

			if ($_POST['Etat'] === '1') { // Intervention interne / TEST //

				if ($_POST['BTNRadio'] == '1') { // panne Cloturé réparer en interne / OK //

					$event = 'Panne Cloturé';
					$etat_panne = 'Terminé';

				} elseif ($_POST['BTNRadio'] == '2') { // appel Intervenant / OK //
			 	
				 	$event = 'Intervention Interne';
				 	$etat_panne = 'Attente Appel Intervenant';

				} elseif ($_POST['BTNRadio'] == '3') { // demande devis par email //
					
					$event = 'Intervention Interne';
					$etat_panne = 'Attente Envoi email';
				} 

			} elseif ($_POST['Etat'] === '2') { // appel intervenant / TEST //

				if($_POST['StatutAppel'] == '1') {	// OK //				
					$etat_panne = 'Attente Intervention';
					$statut_appel = 1;
				} elseif($_POST['StatutAppel'] == '2'){					
					$etat_panne = 'Attente Appel Technicien';
					$statut_appel = 2;
				} elseif($_POST['StatutAppel'] == '3'){					
					$etat_panne = 'Attente Rappel Intervenant';
					$statut_appel = 3;
				}

				$event = 'Appel Intervenant';		    

				if (empty($comment)) { // si le champ et vide //
					$comment = 'Personne contacté : ' . $_POST['ContriContact'];
				} else {
					$comment = $_POST['Commentaire'] . ' / Personne contacté : ' . $_POST['ContriContact'];
				}

				$this->Call->create([
					'pannes_id' => $_POST['IdPanne'],					
					'contribut_id' => $_POST['Contributor'],
					'contact_id' => $contact,
					'statut_appel' => $statut_appel,
					'type_appel' => 'Téléphone'
				]);																	
			
			} elseif ($_POST['Etat'] === '3') { // si il faut rappeler l'intervenant // update appel / TEST OK //

			    $event = 'Rappel Intervenant';
				$etat_panne = 'Attente Intervention';

				// modifie le statut de l'appel la table appel //
				
				$this->Call->update($_POST['IdAppel'],[

					'statut_appel' => $_POST['StatutAppel']

				]);					

			} elseif ($_POST['Etat'] === '3.1') { // si l'intervenant à rappeler // update appel / TEST OK //

			    $event = 'Rappel de l\'intervenant';
				$etat_panne = 'Attente Intervention';

				// modifie le statut de l'appel la table appel //
				
				$this->Call->update($_POST['IdAppel'],[

					'statut_appel' => '1'

				]);				

			} elseif ($_POST['Etat'] === '3.2') { // J'appel le technicien / update appel //

			    $event = 'Appel Technicien';

			    if ($_POST['StatutAppel'] == 5) { // laisse message répondeur
			    	
			    	$etat_panne = 'Attente Rappel Technicien';

			    } else {// Technicien contacter / statut appel == 4 //
			    	
			    	if ($_POST['StatutPanne'] == 1) { // statut panne 1
			    		$etat_panne = 'Attente Rappel Technicien';
			    	} else { // statut panne 2
			    		$etat_panne = 'Attente Intervention';
			    	}
			    }			    

				if (empty($comment)) { // si le champ et vide //
					$comment = 'Technicien contacté : ' . $_POST['ContriContact'];
				} else {
					$comment = $_POST['Commentaire'] . ' / Technicien contacté : ' . $_POST['ContriContact'];
				}				    			

				// modifie le statut de l'appel // table appel //
				
				$this->Call->update($_POST['IdAppel'],[

					'tech_id' => $_POST['Tech'],
					'statut_appel' => $_POST['StatutAppel']

				]);				

			} elseif ($_POST['Etat'] === '3.3') { // rappel du technicien et action en fonction du select statut panne / update appel //

			    $event = 'Rappel du Technicien';

			    if ($_POST['StatutPanne'] == 1) {
			    	$etat_panne = 'Attente Rappel Technicien';
			    	$status_appel = 4;
			    } else {
			    	$etat_panne = 'Attente Intervention';
			    	$status_appel = 1;
			    }				

				// modifie le statut de l'appel // table appel //
				
				$this->Call->update($_POST['IdAppel'],[

					'statut_appel' => $status_appel

				]);

			} elseif ($_POST['Etat'] === '3.4') { // je rappel le technicien / update appel //

				if($_POST['StatutAppel'] == '4') {
					$event = 'Rappel Technicien';
					$etat_panne = 'Attente Intervention';
					$status_appel = 4;
				} elseif($_POST['StatutAppel'] == '5'){
					$event = 'Rappel Technicien';
					$etat_panne = 'Attente Rappel Technicien';
					$status_appel = 5;
				}

				// modifie le statut de l'appel // table appel //
				
				$this->Call->update($_POST['IdAppel'],[

					'tech_id' => $_POST['Tech'],
					'statut_appel' => $status_appel

				]);	

			} elseif ($_POST['Etat'] === '3.5') { //  attente rappel technicien / update appel / TEST OK //
				
				$event = 'Rappel Intervenant';
				$etat_panne = 'Attente Rappel Technicien';								

				// modifie le statut de l'appel //
				
				$this->Call->update($_POST['IdAppel'],[

					'statut_appel' => $_POST['StatutAppel']

				]);	

			} elseif ($_POST['Etat'] === '3.6') { //  attente rappel Intervenant / update appel / TEST //
				
				$event = 'Rappel Intervenant';
				$etat_panne = 'Attente Rappel Intervenant';								

				// modifie le statut de l'appel //
				
				$this->Call->update($_POST['IdAppel'],[

					'statut_appel' => $_POST['StatutAppel']

				]);	

			} elseif ($_POST['Etat'] === '3.7') { //  autre contact appeler du même intervenant / update appel //

				if($_POST['StatutRappel'] == '1') {
					$event = 'Rappel Intervenant';
					$etat_panne = 'Attente Intervention';
					$statut_appel = 1;
				} elseif($_POST['StatutRappel'] == '2'){
					$event = 'Rappel Intervenant';
					$etat_panne = 'Attente Rappel Technicien';
					$statut_appel = 2;
				} elseif($_POST['StatutRappel'] == '3'){
					$event = 'Rappel Intervenant';
					$etat_panne = 'Attente Rappel Intervenant';
					$statut_appel = 3;
				}	    

				if (empty($comment)) { // si le champ et vide //
					$comment = 'Personne contacté : ' . $_POST['ContriContact'];
				} else {
					$comment = $_POST['Commentaire'] . ' / Personne contacté : ' . $_POST['ContriContact'];
				}

				$this->Call->create([
					'pannes_id' => $_POST['IdPanne'],					
					'contribut_id' => $_POST['IdContribut'],
					'contact_id' => $_POST['Contact'],
					'statut_appel' => $statut_appel,
					'type_appel' => 'Téléphone'
				]);

			} elseif ($_POST['Etat'] === '3.8') { // le technicien doit m'appeler  //

				$event = 'Rappel Intervenant';
				$etat_panne = 'Attente Appel Technicien';

			} elseif ($_POST['Etat'] === '3.9') { // le technicien à appeler //

				$event = 'Appel du Technicien';
				$etat_panne = 'Attente Intervention';
				
				$this->Call->update($_POST['IdAppel'],[

					'tech_id' => $_POST['Tech'],
					'statut_appel' => 2

				]);

			} elseif ($_POST['Etat'] === '3.10') { // l'intervenant appel //

				$event = 'Appel de l\'intervenant';
				$etat_panne = 'Attente Réparation';				

			} elseif ($_POST['Etat'] === '4') { // intervention en cours // create Interv / update appel declencheur id interv //
				
				$event = 'Intervention Diagnostique';
				$etat_panne = 'Attente diagnostique';				

				// création de l'interv auto //
				
				$this->Interv->create([

					'pannes_id' => $_POST['IdPanne'],
					'contribut_id' => $_POST['IdContribut'],					
					'date_interv' => $_POST['DateEvent'],
					'heure_interv' => $_POST['HeureEvent'],
					'type_interv' => 'Diagnostique',
					'category_int' => 'P',
					'depend' => 'EXT',
					'user' => $_SESSION['name'],
					'etat_interv' => 'En Cours'

				]);

				$result = $this->Interv->LastId();

				$this->Call->update($_POST['IdAppel'],[

					'intervs_id' => $result[0]->id

				]);														

			} elseif ($_POST['Etat'] === '5') { // diagnostique / update interv / create quotation //

				if ($_POST['BTNRadio'] == '1') { // intervention sous garantie / a revoir

					$event = 'Diagnostique';
					$etat_panne = 'Attente Réparation';
					
					// mise a jour de l'intervention //
					$this->Interv->update($_POST['IdInterv'],[
						'sous_garanti' => 1,
						'etat_interv' => 'Terminé'
					]);

					$comment .= "/ Intervention sous garantie";					

				} elseif ($_POST['BTNRadio'] == '2') { // diagnostique avec devis / create quotation / update interv //					
					
					$event = 'Diagnostique';
					$etat_panne = 'Attente Devis';
					$etat_devis = 1;

					$this->Quotation->create([ // création devis //

						'pannes_id' => $_POST['IdPanne'],
						'intervs_id' => $_POST['IdInterv'],
						'contribut_id' => $_POST['IdContribut'],
						'contact_id' => $_POST['IdContact'],
						'date_request_quota' => date('Y-m-d'),
						'etat_devis' => 'Attente Devis',
						'reactua_devis' => 0
					]);					

					// ferme l'intervention //
					$this->Interv->update($_POST['IdInterv'],[

						'etat_interv' => 'Terminé'
					]);

				} elseif ($_POST['BTNRadio'] == '3') { // diagnostique avec réparation / update interv //					
					
					$event = 'Diagnostique';
					$etat_panne = 'Réparation en cours';

					// modifie le type de l'intervention //
					$this->Interv->update($_POST['IdInterv'],[

						'type_interv' => 'Diagnostique & Réparation'
					]);

					$quota = $this->Quotation->checkeddenyquota($_POST['IdPanne']); // récupére un ou plusieurs devis en attente		

					foreach ($quota as $key => $value) {
						
						// update de devis //
						$this->Quotation->update($value->id,[

							'date_refus_quota' => date('Y-m-d'),
							'etat_devis' => 'Devis Refusé'
						]);	
					}									

				} elseif ($_POST['BTNRadio'] == '4') { // diagnostique / update interv cloturé  //
					
					$event = 'Diagnostique/Panne Cloturé';
					$etat_panne = 'Terminé';

					// ferme l'intervention //
					$this->Interv->update($_POST['IdInterv'],[

						'etat_interv' => 'Terminé'
					]);

				} elseif ($_POST['BTNRadio'] == '5') { // diagnostique pas réparable  / update interv //
					
					$event = 'Diagnostique/Pas Réparable';
					$etat_panne = 'Non Réparable';

					// ferme l'intervention //
					$this->Interv->update($_POST['IdInterv'],[

						'etat_interv' => 'Terminé'
					]);
					
				}				

			} elseif ($_POST['Etat'] === '8') { // réparation // create interv / update interv//
				
				$event =  'Intervention Réparation';
				$etat_panne = 'Réparation en cours';				

				// création de l'interv /*************AR************/
				
				$this->Interv->create([

					'pannes_id' => $_POST['IdPanne'],
					'contribut_id' => $_POST['IdContribut'],
					'date_interv' => $_POST['DateEvent'],
					'heure_interv' => $_POST['HeureEvent'],
					'type_interv' => 'Réparation',
					'category_int' => 'P',
					'depend' => 'EXT',
					'user' => $_SESSION['name'],
					'etat_interv' => 'En Cours'

				]);							

				// modifie le statut de l'appel a zero //
				
				$this->Call->update($_POST['IdAppel'],[

					'statut_appel' => '0'

				]);				

			} elseif ($_POST['Etat'] === '8.1') { // rappel / update appel //
				
				$event = 'Rappel Intervenant';
				$etat_panne = 'Attente Réparation';

				// modifie le statut de l'appel la table appel //
				
				$this->Call->update($_POST['IdAppel'],[

					'statut_appel' => $_POST['StatutAppel']

				]);

			} elseif ($_POST['Etat'] === '9') { // réparation non terminé // create quotation / update interv //

				$event =  'Réparation en attente';

				if ($_POST['BTNRadio'] == '0') { // attente diag constructeur //

					$etat_panne = 'Réparation non terminé';

					// ferme l'intervention //
					$this->Interv->update($_POST['IdInterv'],[

						'type_interv' => 'Réparation non terminé',
						'etat_interv' => 'Terminé'
					]);	
					
				} elseif ($_POST['BTNRadio'] == '1') { // attente autre devis ou devis coché //				
					
					$etat_panne = 'Attente Devis';
					$etat_devis = 1;

					// création d'un autre devis //
					$this->Quotation->create([ // création devis //

						'pannes_id' => $_POST['IdPanne'],
						'intervs_id' => $_POST['IdInterv'],
						'contribut_id' => $_POST['IdContribut'],
						'contact_id' => $_POST['IdContact'],
						'date_request_quota' => date('Y-m-d'),
						'etat_devis' => 'Attente Devis'
						
					]);

					// ferme l'intervention //
					$this->Interv->update($_POST['IdInterv'],[

						'type_interv' => 'Réparation non terminé',
						'etat_interv' => 'Terminé'
					]);		

				} elseif ($_POST['BTNRadio'] == '2') { // attente piéces / update interv //

					$etat_panne = 'Attente Réparation';

					// ferme l'intervention //
					$this->Interv->update($_POST['IdInterv'],[

						'type_interv' => 'Réparation non terminé',
						'etat_interv' => 'Terminé'
					]);	

				} else {

					$etat_panne = 'Réparation non terminé'; // panne non résolu 
				}

			} elseif ($_POST['Etat'] === '9.1') { // Attente devis aprés consultation hotline /Create quotation //

					$event = "Demande Devis";
					$etat_panne = 'Attente Devis';
					$etat_devis = 1;

					// création d'un autre devis //
					$this->Quotation->create([ // création devis //

						'pannes_id' => $_POST['IdPanne'],
						'intervs_id' => NULL,
						'contribut_id' => $_POST['IdContribut'],
						'contact_id' => $_POST['IdContact'],
						'date_request_quota' => date('Y-m-d'),
						'etat_devis' => 'Attente Devis'
						
					]);

			} elseif ($_POST['Etat'] === '10') { // réparation terminé // create doc / update interv / update appel//
				
				$event =  'Fin de Réparation';
				$etat_panne = 'Terminé';
				
				// btn radio b_cce //

				if ($_POST['BTNRadio'] == 1) {

					// création document //
					$this->Document->create([

						'pannes_id' => $_POST['IdPanne'],						
						'b_cce' => 1					

					]);

				} 

				if ($_POST['TypeAppel'] == 'e-mails') { // a revoir ********************************* //
					
					$this->Quotation->update($_POST['IdQuota'],[ // update de devis //

						'intervs_id' => $_POST['IdInterv']

					]);	

				}									

				// ferme l'intervention //
				$this->Interv->update($_POST['IdInterv'],[

					'etat_interv' => 'Terminé'
				]);	

			} elseif ($_POST['Etat'] === '11') { // rappel intervenant aprés réparation non terminé //
				
				$event = 'Rappel';
				$etat_panne = 'Réparation non terminé';

			} elseif ($_POST['Etat'] === '12') { // réparation pas envisager / devis refusé dans quotation // 

				$event = 'Décision Direction';
				$etat_panne = 'Réparation pas Envisager';
				$etat_devis = 4;

				// récupéré les infos sur les devis en cour pour cette panne et passer devis en 'Devis Refusé' + date refus //
				$quota = $this->Quotation->checkeddenyquota($_POST['IdPanne']);

				// boucle for pour update devis //
				
				for ($i=0; $i < count($quota) ; $i++) { 
					
					$val = $quota[$i]->id;

					$this->Quotation->update($val,[

						'date_refus_quota' => date("Y-m-d"),
						'etat_devis' => 'Devis Refusé'
					]);
				}

			} elseif ($_POST['Etat'] === '13') { // mise au rebus matériel 
				
				$event = 'Matériel Au Rebus';
				$etat_panne = 'Non Réparé';

			} elseif ($_POST['Etat'] === '14') { // mail envoyé pour devis volet // create quotation//

				$dateEvent = date('Y-m-d');
				$heureEvent = date("H:i");
				$event = "Envoi Email";
				$comment = "Demande Devis envoyer à " . $_POST['mail'];
				$etat_panne = "Attente Devis";
				$appel = "e-mails";
				$statut_appel = 6;
				$idcontribut = $_POST['Contributors'];
				$Idcontact = $_POST['IdContact'];

				$index = $_POST['index']; // index Multi ou Seul //
				$tabP = $_POST['tabidpanne']; // tableau des pannes //

				if ($index == 'Multi') {

					$tidp = explode(',',$tabP);
					$key = sizeof($tidp);

					for ($i=0; $i < $key ; $i++) { 
						
						$idpanne = $tidp[$i];

						// création Multi devis //
						$this->Quotation->create([ 
							
							'pannes_id' => $idpanne,
							'contribut_id' => $idcontribut,
							'contact_id' => $Idcontact,
							'date_request_quota' => date('Y-m-d'),
							'etat_devis' => "Attente Devis"
						]);
						// création de l'appel //
						$this->Call->create([
							'pannes_id' => $idpanne,					
							'contribut_id' => $idcontribut,
							'contact_id' => $Idcontact,
							'statut_appel' => $statut_appel,
							'type_appel' => $appel
						]);

						// création de l'événement //
						$this->Event->create([
							'user' => $_SESSION['name'],
							'pannes_id' => $idpanne,
							'date_event' => $dateEvent,
							'heure_event'=> $heureEvent,
							'event' => $event,
							'designation' => $comment
						]);

						$this->Panne->update($idpanne,[
							'etat_panne' => $etat_panne
						]);		
					}

				} else {

					// création devis /****************a revoir ***********************/
					$this->Quotation->create([ 
						
						'pannes_id' => $_POST['IdPanne'],
						'contribut_id' => $idcontribut,
						'contact_id' => $Idcontact,
						'date_request_quota' => date('Y-m-d'),
						'etat_devis' => "Attente Devis"
					]);

					// création de l' appel //
					$this->Call->create([
						'pannes_id' => $_POST['IdPanne'],					
						'contribut_id' => $idcontribut,
						'contact_id' => $Idcontact,
						'statut_appel' => $statut_appel,
						'type_appel' => $appel
					]);

					// création de l'événement //
					$this->Event->create([
						'user' => $_SESSION['name'],
						'pannes_id' => $_POST['IdPanne'],
						'date_event' => $dateEvent,
						'heure_event'=> $heureEvent,
						'event' => $event,
						'designation' => $comment
					]);

					$this->Panne->update($_POST['IdPanne'],[
						'etat_panne' => $etat_panne
					]);		

				}			

			} elseif ($_POST['Etat'] === '15') { // demande de devis comparatif //

				$event = 'Demande Devis Comparatif';
				$etat_panne = 'Attente Appel Intervenant';
				$etat_devis = 1;

			} elseif ($_POST['Etat'] === '15.1') { // demande de devis comparatif par email //

				$event = 'Demande Devis Comparatif';
				$etat_panne = 'Attente Envoi email';
				$etat_devis = 1;					

			} elseif ($_POST['Etat'] === '16') { // demande de reactualisation devis //

				$event = 'Demande Réactualisation Devis';
				$etat_panne = 'Attente Réactualisation Devis';
				$etat_devis = 6;

				// mise a jour devis a réactualisé //
				$this->Quotation->update($_POST['IdQuota'],[

					'etat_devis' => 'Devis En Attente de Réactualisation',
					'reactua_devis' => 1
					
				]);

				//  mise a jour de panne / a voir //

			} elseif ($_POST['Etat'] === '16.1') { // attente réactualisation devis sélectionner //

				if($_POST['StatutAppel'] == '1') {
					$event = 'Appel Intervenant';
					$etat_panne = 'Attente Devis Réactualisé';
					$statut_appel = 1; // intervenant contacté //
				} elseif($_POST['StatutAppel'] == '3'){
					$event = 'Appel Intervenant';
					$etat_panne = 'Attente Rappel Intervenant';
					$statut_appel = 3; // laisser message sur répondeur //
				}			    

				if (empty($comment)) { // si le champ et vide //
					$comment = 'Personne contacté : ' . $_POST['ContriContact'];
				} else {
					$comment = $_POST['Commentaire'] . ' / Personne contacté : ' . $_POST['ContriContact'];
				}

				$this->Call->create([
					'pannes_id' => $_POST['IdPanne'],					
					'contribut_id' => $_POST['IdContribut'],
					'contact_id' => $contact,
					'statut_appel' => $statut_appel,
					'type_appel' => 'Téléphone'
				]);													
			}

			//var_dump($_POST);
			//die();			
			// FIN DU IF //	
			
			if ($_POST['Etat'] === '14') { // //
				// on ne fait rien //
			} else {

				//  mise a jour de panne //
				if (isset($etat_devis) === false) {

					$this->Panne->update($_POST['IdPanne'],[
						'etat_panne' => $etat_panne
					]);

				} else {				

					$this->Panne->update($_POST['IdPanne'],[
						'etat_devis' => $etat_devis,
						'etat_panne' => $etat_panne
					]);

				}			

				// création de l'événement //
				$this->Event->create([
					'user' => $_SESSION['name'],
					'pannes_id' => $_POST['IdPanne'],
					'date_event' => $dateEvent,
					'heure_event'=> $heureEvent,
					'event' => $event,
					'designation' => $comment
				]);		
			}				
			
			if ($etat_panne === "Terminé") { // update matériel //

				// mise a jour de matériel si $etat_panne = Terminé //
				$this->Material->update($_POST['IdMate'],[
					'statut' => "Actif"
				]);

			} else if($etat_panne === "Non Réparé") { // update matériel //

				// mise a jour de matériel si $etat_panne = Non réparé //
				$this->Material->update($_POST['IdMate'],[
					'statut' => "HS"
				]);
			} 						
	 	    	
		}  
	}

	// edition de l'évenement panne //
	 
	public function editEvent(){

		if (!empty($_POST)) {
			
			$this->Event->update($_POST['IdEvent'],[

				'date_event' => $_POST['dateevent'],
				'heure_event' => $_POST['heureevent'],
				'designation' => $_POST['commentaire']
			]);
		}

	}

	// function qui verifie si des évenements existe pour la panne //
	
	public function checkedEvent(){

		if (!empty($_POST['id'])) {
			
			$result = $this->Event->CheckedEvent($_POST['id'], $_POST['page']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);
		}
	}

	// function qui crer un pdf pour envoye par mail (pour les volets)//
	
	public function attachementpdf() {

		$tabM = $_POST['tabM'];
		$val = explode(",", $tabM);
		$key = $_POST['key'];

		$this->render('events.attachementpdf', compact('val', 'key'));		
		
	}

	// SANS PANNE /////////////////////////////////////////////////////////////

	// affiche la table événement intervention sans panne //
	
	public function affEventSP(){

		if (!empty($_POST['id'])) {
			
			$result = $this->Event->affeventSP($_POST['id']);

			$output = array("data" => $result);

			header('Content-Type: aplication/json');

		    echo json_encode($output);
		   
		}

	}	

	//  ajoute ou edit un événement a l'intervention sans panne //
	
	public function AE_EventSP(){

		//var_dump($_POST);die();

		if ($_POST['index'] == "Add") {
			
			// création de l'événement //
			$this->Event->create([
				'user' => $_SESSION['name'],
				'interv_id' => $_POST['IdInterv'],
				'date_event' => $_POST['DateEvSP'],
				'heure_event'=> $_POST['HeureEvSP'],
				'event' => $_POST['EventSP'],
				'designation' => $_POST['CommentSP']
			]);

		} else {

			// edition de l'événement //
			$this->Event->update($_POST['IdEvents'],[
				'date_event' => $_POST['DateEvSP'],
				'heure_event' => $_POST['HeureEvSP'],
				'event' => $_POST['EventSP'],
				'designation' => $_POST['CommentSP']
			]);
			

		}		

	}	

	// WORKS ///////////////////////////////////////////////////////////
	
	// affiche la table événement work //
	
	public function affEventWork(){

		if (!empty($_POST['id'])) {			
			
			$result = $this->Event->affeventwork($_POST['id'], $_POST['statut']);
		   
		}

	}

	// ajoute un événement au travail //
	
	public function addEventWork(){		

		if (!empty($_POST)) {

			// création de l'événement //
			$this->Event->create([
				'user' => $_SESSION['name'],
				'travaux_id' => $_POST['IdWork'],
				'date_event' => $_POST['DateEvent'],
				'heure_event'=> $_POST['HeureEvent'],
				'event' => $_POST['Event'],
				'designation' => $_POST['Commentaire']
			]);

			// mise a jour de la table travaux //
			
			$this->Dailywork->update($_POST['IdWork'],[
				
				'statut' => $_POST['Statut']

			]);

		}

	}

	// edition de l'évenement travail //
	 
	public function editEventWork(){

		if (!empty($_POST)) {
			
			$this->Event->update($_POST['IdEvent'],[

				'date_event' => $_POST['DateEvent'],
				'heure_event' => $_POST['HeureEvent'],
				'event' => $_POST['Event'],
				'designation' => $_POST['Commentaire']
			]);
		}

	}	
	

}