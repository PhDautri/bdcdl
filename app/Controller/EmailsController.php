<?php

namespace App\Controller;

use Core\Controller\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// path du dossier PHPMailer % fichier d'envoi du mail
require '../core/PHPMailer/src/Exception.php';
require '../core/PHPMailer/src/PHPMailer.php';
require '../core/PHPMailer/src/SMTP.php';


class EmailsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Email');
		$this->loadModel('Param');

	}

	// function qui affiche tout les mail envoyer //
	
	public function email() {

		$this->render('emails.sendmail');

	}

	// function qui remonte les données pour table email all //
	
	public function emailAll() {

		$output = $this->Email->emailall();

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui remonte les données pour afficher le mail selectionner / id mail //
	
	public function viewemail() {

		$result = $this->Email->viewselectemail($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	///////////////////////////////  PHPMAILER //////////////////////////////////////

	// function qui envoi un mail pour demande devis volets seul ou multiple //
	
	public function sendemail(){			

		$contribut = $_POST['Contributors'];
		$destinataire = $_POST['to'];
		$subject = $_POST['subject'];
		$contenu = $_POST['mess'];
		$expl = explode("\n",$contenu);

		if ($_POST['type'] == 'Seul') {
			
			$contenu = '

				<html>  
					<body>
						<p><i>'.$expl[0].'</i></p> 
						<p><i>'.$expl[2].'</i></p>
						<p>'.$expl[4].'</p>
						<p>'.$expl[5].'</p>
						<p>'.$expl[6].'</p>
						<p>'.$expl[7].'</p>
						<p><strong>'.$expl[8].'</strong></p>
						<p>'.$expl[9].'</p><br>
						<p><i>'.$expl[11].'</i></p>
						<img src="cid:gcsM">		   
						<p><i>'.$expl[13].'</i></p>   
						<p><i>'.$expl[14].'</i></p>   
						<p><i>'.$expl[15].'</i></p>
						<p><i>'.$expl[16].'</i></p>   
						<p><i>'.$expl[17].'</i></p>   
					</body>
				</html>
			';
		} else {

			$contenu = '

				<html>  
					<body>
						<p><i>'.$expl[0].'</i></p> 
						<p><i>'.$expl[2].'</i></p>
						<p><i>'.$expl[4].'</i></p>
						<img src="cid:gcsM">		   
						<p><i>'.$expl[6].'</i></p>   
						<p><i>'.$expl[7].'</i></p>   
						<p><i>'.$expl[8].'</i></p>
						<b><i>'.$expl[9].'</i></b>   
					</body>
				</html>
			';
		}		

		$cc = $_POST['cc'];
		$bcc = $_POST['bcc'];		

		if ($_SESSION['name'] == "Dautricourt-Philippe" || $_SESSION['name'] == "admin") { // a continuer //
			//$address1 = 'm.clave@cliniquedeslandes.com';
			$address1 = 'servicetechnique@cliniquedeslandes.com';
			//$address2 = 'direction@cliniquedeslandes.com';
		} else if ($_SESSION['name'] == "Clavé-Mélanie") {
			$address1 = 'servicetechnique@cliniquedeslandes.com';
			//$address2 = 'direction@cliniquedeslandes.com';
		}
		
		// on crée une nouvelle instance de la classe
		$mail = new PHPMailer();
		// puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
		try {
			/* DONNEES SERVEUR */
			#####################
			$mail->setLanguage('fr', '../core/PHPMailer/language/');   // pour avoir les messages d'erreur en FR
			$mail->SMTPDebug = 0; // en production (0 sinon "2")
			$mail->isSMTP();  // envoi avec le SMTP du serveur
			$mail->Host = 'smtp.office365.com'; // serveur SMTP
			$mail->SMTPAuth = true;   // le serveur SMTP nécessite une authentification ("false" sinon)
			$mail->Username = 'servicetechnique@cliniquedeslandes.com';     // login SMTP
			$mail->Password = 'kQyKLqCP';                            // Mot de passe SMTP
			$mail->CharSet = 'UTF-8';
			$mail->Encoding = 'base64';                                  //Format d'encodage à utiliser pour les caractères
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // encodage des données TLS (ou juste 'tls') > "Aucun chiffrement des données"; sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
			$mail->Port = 587;   // port TCP (ou 25, ou 465...)

			/* DONNEES DESTINATAIRES */
			##########################
			$mail->setFrom($address1, 'GCS-DU-MARSAN BDCDL');  //adresse de l'expéditeur (pas d'accents)
			$mail->addAddress($destinataire); // Adresse du destinataire (le nom est facultatif)
			// $mail->addReplyTo('moi@mon_domaine.fr', 'son nom');     // réponse à un autre que l'expéditeur (le nom est facultatif)
			$mail->addCC($cc);   // Cc (copie) : autant d'adresse que souhaité = Cc (le nom est facultatif)
			$mail->addBCC($bcc); // Cci (Copie cachée) :  : autant d'adresse que souhaité = Cci (le nom est facultatif)

			/* PIECES JOINTES */
			##########################
			if ($_POST['type'] == "Multi") {

				$lien = "../public/documents/pdf/".$_POST['numfile'].".pdf";

				$mail->addAttachment($lien); // Pièces jointes en gardant le nom du fichier sur le serveur
			}

			// $mail->addAttachment('../dossier/fichier.zip', 'nouveau_nom.zip');    // Ou : pièce jointe + nouveau nom
			
			/* ACCUSES de RECP */
			$mail->ConfirmReadingTo = ($address1);/*pour recevoir un accusé réception de votre message*/

			/* CONTENU DE L'EMAIL*/
			##########################
			$mail->isHTML(true);             // email au format HTML
			$mail->Subject = $subject;      // Objet du message (éviter les accents là, sauf si utf8_encode)
			$mail->Body = $contenu;      // corps du message en HTML - Mettre des slashes si apostrophes
			$mail->addEmbeddedImage('../public/img/img_societe/iconegcs2.jpg', 'gcsM');
			$mail->AltBody = 'Contenu au format texte pour les clients e-mails qui ne le supportent pas'; // ajout facultatif de texte sans balises HTML (format texte)

			$mail->send();

			// ecriture dans la base de donnée email //

			if ($_POST['type'] == "Multi") {

				$this->Email->create([

					'contribut_id' => $_POST['IdContribu'],
					'pannes_id' => "0",
					'date_mail' => date('Y-m-d'),
					'email' => $_POST['mailselect'],
					'sujet' => $_POST['subject'],
					'cc' => $_POST['cc'],
					'bcc' => $_POST['bcc'],
					'message' => $_POST['mess'],
					'num_pdf' => $_POST['numfile'],
					'lien_pdf' => $lien
				]);

			} else {

				$this->Email->create([

					'contribut_id' => $_POST['IdContribu'],
					'pannes_id' => $_POST['Idpanne'],
					'date_mail' => date('Y-m-d'),
					'email' => $_POST['mailselect'],
					'sujet' => $_POST['subject'],
					'cc' => $_POST['cc'],
					'bcc' => $_POST['bcc'],
					'message' => $_POST['mess']
				]);
			}
			
			return true;
		
		}
		// si le try ne marche pas > exception ici
		catch (Exception $e) {
			return $mail->ErrorInfo; // Affiche l'erreur concernée le cas échéant
		}

	}

	// function qui envoi un mail a la compta pour relevés compteurs //
	
	public function sendmailcompta() {

		if ($_POST['etat'] === 'add') {

			if ($_POST['index'] === 'CC') {

				$subject = "Relevés Compteur Clinique Ajouté";
				$contenu = '

					<!DOCTYPE PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN” “https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd”>
					<html xmlns:v="urn:schemas-microsoft-com:vml">
					    <head>
					    <meta http-equiv="Content-Type" content="text/html; CharSet=UTF-8">
					    <meta name="viewport" content="width=device-width; initial-scale=1.0">					    
					    </head>
					    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
					        <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					            <tbody>
					                <tr>
					                    <td>&nbsp;</td>
					                </tr>
					            </tbody>
					        </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td align="center" style="padding:0; font-size:40px;"><b bgcolor="#FFFAF2">BD<span>CDL</span></b></td>
					            </tr>
					        </tbody>
					        </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td align="center" style="font-family: Helvetica, sans-serif; text-align: center; font-size: 20px; color: #fff; line-height: 28px;">COMPTEUR MENSUEL CLINIQUE</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td>&nbsp;</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td>&nbsp;</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td><b>Les Relevés des compteurs Clinique mensuel sont disponible sur BDCDL</b></td>                
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td><b>lien --> </b>http://10.40.1.202/bdcdl/public/</b></td>
					            </tr>
					        </tbody>
					    </table>  
					    
					    </body>
					</html>					
				';
			} else {

				$subject = "Relevés Compteur CTA Ajouté";
				$contenu = '

					<!DOCTYPE PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN” “https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd”>
					<html xmlns:v="urn:schemas-microsoft-com:vml">
					    <head>
					    <meta http-equiv="Content-Type" content="text/html; CharSet=UTF-8">
					    <meta name="viewport" content="width=device-width; initial-scale=1.0">					    
					    </head>
					    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
					        <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					            <tbody>
					                <tr>
					                    <td>&nbsp;</td>
					                </tr>
					            </tbody>
					        </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td align="center" style="padding:0; font-size:40px;"><b bgcolor="#FFFAF2">BD<span>CDL</span></b></td>
					            </tr>
					        </tbody>
					        </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td align="center" style="font-family: Helvetica, sans-serif; text-align: center; font-size: 20px; color: #fff; line-height: 28px;">COMPTEUR MENSUEL CTA</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td>&nbsp;</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td>&nbsp;</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td><b>Les Relevés des compteurs CTA mensuel sont disponible sur BDCDL</b></td>                
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td><b>lien --> </b>http://10.40.1.202/bdcdl/public/</b></td>
					            </tr>
					        </tbody>
					    </table>  
					    
					    </body>
					</html>
				';
			}			

		} else { // edition //

			if ($_POST['index'] === 'CC') { // compteur clinique //
				
				$subject = "Relevés Compteur Clinique Modifié";
				$contenu = '

					<!DOCTYPE PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN” “https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd”>
					<html xmlns:v="urn:schemas-microsoft-com:vml">
					    <head>
					    <meta http-equiv="Content-Type" content="text/html; CharSet=UTF-8">
					    <meta name="viewport" content="width=device-width; initial-scale=1.0">					    
					    </head>
					    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
					        <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					            <tbody>
					                <tr>
					                    <td>&nbsp;</td>
					                </tr>
					            </tbody>
					        </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td align="center" style="padding:0; font-size:40px;"><b bgcolor="#FFFAF2">BD<span>CDL</span></b></td>
					            </tr>
					        </tbody>
					        </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td align="center" style="font-family: Helvetica, sans-serif; text-align: center; font-size: 20px; color: #fff; line-height: 28px;">COMPTEUR MENSUEL CLINIQUE</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td>&nbsp;</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td>&nbsp;</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td><b>Le Relevé portant l\'id numéro: "'.$_POST['id'].'" du compteur mensuel Clinique à était modifié. Veuillez en prendre note sur BDCDL</b></td>                
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td><b>lien --> </b>http://10.40.1.202/bdcdl/public/</b></td>
					            </tr>
					        </tbody>
					    </table>  
					    
					    </body>
					</html>
					';

			} else { // compteur CTA //

				$subject = "Relevés Compteur CTA Modifié";
				$contenu = '
					<!DOCTYPE PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN” “https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd”>
					<html xmlns:v="urn:schemas-microsoft-com:vml">
					    <head>
					    <meta http-equiv="Content-Type" content="text/html; CharSet=UTF-8">
					    <meta name="viewport" content="width=device-width; initial-scale=1.0">					    
					    </head>
					    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
					        <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					            <tbody>
					                <tr>
					                    <td>&nbsp;</td>
					                </tr>
					            </tbody>
					        </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td align="center" style="padding:0; font-size:40px;"><b bgcolor="#FFFAF2">BD<span>CDL</span></b></td>
					            </tr>
					        </tbody>
					        </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td align="center" style="font-family: Helvetica, sans-serif; text-align: center; font-size: 20px; color: #fff; line-height: 28px;">COMPTEUR MENSUEL CTA</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#CACAC7" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td>&nbsp;</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td>&nbsp;</td>
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td><b>Le Relevé portant l\'id numéro: "'.$_POST['id'].'" du compteur mensuel CTA à était modifié. Veuillez en prendre note sur BDCDL </td>                
					            </tr>
					        </tbody>
					    </table>
					    <table bgcolor="#FFFFFF" width="100%" border="0" cellpadding="0" cellspacing="0">
					        <tbody>
					            <tr>
					                <td><b>lien --> </b>http://10.40.1.202/bdcdl/public/</b></td>
					            </tr>
					        </tbody>
					    </table>  
					    
					    </body>
					</html>
				';
			}
			
		}
		
		// on crée une nouvelle instance de la classe
		$mail = new PHPMailer();
		// puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
		try {
			/* DONNEES SERVEUR */
			#####################
			$mail->setLanguage('fr', '../core/PHPMailer/language/');   // pour avoir les messages d'erreur en FR
			$mail->SMTPDebug = 0;  // en production 
			//$mail->SMTPDebug = 2;  // décommenter en mode débug
			$mail->isSMTP();   // envoi avec le SMTP du serveur
			$mail->Host = 'smtp.office365.com'; // serveur SMTP
			$mail->SMTPAuth = true;    // le serveur SMTP nécessite une authentification ("false" sinon)
			$mail->Username = 'servicetechnique@cliniquedeslandes.com'; // login SMTP
			$mail->Password = 'kQyKLqCP'; // Mot de passe SMTP
			$mail->CharSet = 'UTF-8'; //Format d'encodage à utiliser pour les caractères
			$mail->Encoding = 'base64';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // encodage des données TLS (ou juste 'tls') > "Aucun chiffrement des données"; sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
			$mail->Port = 587; // port TCP (ou 25, ou 465...)

			/* DONNEES DESTINATAIRES */
			##########################
			$mail->setFrom('servicetechnique@cliniquedeslandes.com', 'GCS-DU-MARSAN BDCDL');  //adresse de l'expéditeur (pas d'accents)
			//$mail->addAddress('compta@cliniquedeslandes.com'); // Adresse du destinataire (le nom est facultatif)
			$mail->addAddress('servicetechnique@cliniquedeslandes.com');
			//$mail->addReplyTo('moi@mon_domaine.fr', 'son nom');  // réponse à un autre que l'expéditeur (le nom est facultatif)
			//$mail->addCC($cc);   // Cc (copie) : autant d'adresse que souhaité = Cc (le nom est facultatif)
			//$mail->addBCC($bcc); // Cci (Copie cachée) :  : autant d'adresse que souhaité = Cci (le nom est facultatif)

			/* PIECES JOINTES */
			##########################
			
			// $mail->addAttachment('../dossier/fichier.zip', 'nouveau_nom.zip'); // Ou : pièce jointe + nouveau nom
			
			/* ACCUSES RECP */
			$mail->ConfirmReadingTo = ('servicetechnique@cliniquedeslandes.com');  /*pour recevoir un accusé réception de votre message*/

			/* CONTENU DE L'EMAIL*/
			##########################
			$mail->isHTML(true);             // email au format HTML
			$mail->Subject = $subject;      // Objet du message (éviter les accents là, sauf si utf8_encode)
			$mail->Body = $contenu;      // corps du message en HTML - Mettre des slashes si apostrophes
			//$mail->addEmbeddedImage('../public/img/img_societe/iconegcs2.jpg', 'gcsM');
			$mail->AltBody = 'Contenu au format texte pour les clients e-mails qui ne le supportent pas'; // ajout facultatif de texte sans balises HTML (format texte)

			$mail->send();

			// ecriture dans la base de donnée email //
			$this->Email->create([

				'contribut_id' => '0',
				'pannes_id' => '0',
				'date_mail' => date('Y-m-d'),
				'email' => 'compta@cliniquedeslandes.com',
				'sujet' => $subject,
				'cc' => NULL,
				'bcc' => NULL,
				'message' => $contenu
			]);
			
			return true;
		
		}
		// si le try ne marche pas > exception ici
		catch (Exception $e) {
			return $mail->ErrorInfo; // Affiche l'erreur concernée le cas échéant
		}
	}

	// function qui envoi un mail a la technique pour ajout panne ou evolution panne //
	
	public function sendmailtech() {

		if ($_SESSION['name'] == "Dautricourt-Philippe" || $_SESSION['name'] == "admin") {
			//$address1 = 'm.clave@cliniquedeslandes.com';
			$address1 = 'servicetechnique@cliniquedeslandes.com';
			//$address2 = 'direction@cliniquedeslandes.com';
		} else if ($_SESSION['name'] == "Clavé-Mélanie") {
			$address1 = 'servicetechnique@cliniquedeslandes.com';
			//$address2 = 'direction@cliniquedeslandes.com';
		}

		if ($_POST) {		

			$datepannefr = implode('-', array_reverse(explode('-', $_POST['tab'][0])));
			$heure = $_POST['tab'][1];

			if ($_POST['index'] === 'add') { // add panne //

				$subject = "BDCDL: Panne Ajouté";
				$contenu = "<h4>Une panne à était déclaré par ".$_SESSION['name']." </h4>
					<p> pour le matériel inventorié n°: ".$_POST['tab'][5]." </p>
					<p> réf: ".$_POST['tab'][2]." </p>
					<p> le ".$datepannefr." à ".$heure."</p>
					<p>désignation panne: ".$_POST['tab'][3].".</p>
					<p>Celle-ci et disponible sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

			} else if ($_POST['index'] === 'events') { // events --> add evenements //

				$subject = "BDCDL: Etat avancement Panne";

				if ($_POST['Etat'] === '2') {
					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][6]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][7]."</p>
						<p>le ".$datepannefr." à ".$heure."</p>
						<p> Appel du contact: ".$_POST['tab'][3]." de la société ".$_POST['tab'][2]."</p>
						<p>Statut de l'appel: ".$_POST['tab'][4]."</p>
						<p> Commentaire: ".$_POST['tab'][5]."</p>
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['Etat'] === '3') {
					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][5]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][6]."</p>
						<p>le ".$datepannefr." à ".$heure."</p>
						<p> Appel du contact: ".$_POST['tab'][2]."</p>
						<p>Statut de l'appel: ".$_POST['tab'][3]."</p>
						<p> Commentaire: ".$_POST['tab'][4]."</p>
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";	

				} else if ($_POST['Etat'] === '3.1') {
					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][4]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][5]."</p>
						<p>le ".$datepannefr." à ".$heure."</p>
						<p>Statut de l'appel: ".$_POST['tab'][2]."</p>
						<p> Commentaire: ".$_POST['tab'][3]."</p>
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['Etat'] === '3.5' ) {
					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][5]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][6]."</p>
						<p>le ".$datepannefr." à ".$heure."</p>
						<p> Appel du contact: ".$_POST['tab'][2]."</p>
						<p>Statut de l'appel: ".$_POST['tab'][3]."</p>
						<p> Commentaire: ".$_POST['tab'][4]."</p>
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['Etat'] === '3.6' ) {
					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][5]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][6]."</p>
						<p>le ".$datepannefr." à ".$heure."</p>
						<p> Appel du contact: ".$_POST['tab'][2]."</p>
						<p>Statut de l'appel: ".$_POST['tab'][3]."</p>
						<p> Commentaire: ".$_POST['tab'][4]."</p> <p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['Etat'] === '3.7' ) {
					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][5]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][6]."</p>
						<p>le ".$datepannefr." à ".$heure."</p>
						<p> Appel un autre contact: ".$_POST['tab'][2]."</p>
						<p>Statut de l'appel: ".$_POST['tab'][3]."</p> 
						<p> Commentaire: ".$_POST['tab'][4]."</p>
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['Etat'] === '4' ) {
					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][3]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][4]."</p>
						<p>le ".$datepannefr." à ".$heure."</p> 
						<p> Commentaire: ".$_POST['tab'][2]."</p>
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['Etat'] === '5' ) {

					switch ($_POST['tab'][2]) {
						case '1':
							$select = "intervention sous garantie";
							break;

						case '2':
							$select = "Attente Devis";
							break;

						case '3':
							$select = "Réparation en cours";
							break;

						case '4':
							$select = "Panne Cloturé";
							break;

						case '5':
							$select = "Matériel non réparable";
							break;
						
						default:
							$select = "";
							break;
					}

					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][4]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][5]."</p>
						<p>le ".$datepannefr." à ".$heure."</p>
						<p> Evénement: Diagnostique </p> <p> Commentaire: ".$_POST['tab'][3]."</p>
						<p>Etat de la panne: ".$select."</p>
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['Etat'] === '8' ) { // réparation en cours //

					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][3]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][4]."</p>
						<p>le ".$datepannefr." à ".$_POST['tab'][1]."</p> 
						<p> Evénement: Intervention Réparation </p>
						<p> Commentaire: ".$_POST['tab'][2]."</p> 
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['Etat'] === '9' ) { // réparation en attente pas terminé / manque piéces ou autre devis //

					if ($_POST['tab'][3] == 1) { // BTNRadio 1 ou 2 //
						$stpanne = "Attente autre devis";
					} else {
						$stpanne = "Attente piéces";
					}

					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][4]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][5]."</p>
						<p>le ".$datepannefr." à ".$_POST['tab'][1]."</p> 
						<p> Evénement: Réparation non terminé</p>
						<p> Commentaire: ".$_POST['tab'][2]."</p>
						<p> Statut Panne: ".$stpanne."</p>
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['Etat'] == '10') {
					
					$contenu = "<h4>Un événement à était ajouter à la panne n° ".$_POST['tab'][3]." par ".$_SESSION['name'].".</h4>
						<P>pour le matériel n° ".$_POST['tab'][4]."</p>
						<p>le ".$datepannefr." à ".$_POST['tab'][1]."</p> 
						<p> Evénement: Fin de Réparation </p>
						<p> Commentaire: ".$_POST['tab'][2]."</p> 
						<p>Vous pouvez voir cette événement sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";
				}				
				
			} else if ($_POST['index'] === 'quota') { // envoi email pour quotation //

				if ($_POST['tab'][0] === "1") { // devis reçu //

					$datequota = implode('-', array_reverse(explode('-', $_POST['tab'][4])));
					
					$subject = "BDCDL: Devis Reçu";
					$contenu = "<h4>Un devis à était ajouté par ".$_SESSION['name']." </h4>
						<p> pour le ".$_POST['tab'][1]."</p>
						<p> le ".$datequota."</p>
						<p>Panne n°:".$_POST['tab'][2].".</p> 
						<p>Celle-ci et disponible sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['tab'][0] === "2" ) { // devis accépté //

					$subject = "BDCDL: Devis Accepté";
					$contenu = "<h4>Un événement vient d'être ajouter par ".$_SESSION['name']." </h4>
						<p> Evénement: ".$_POST['tab'][3]."</p>
						<p>Pour la panne n°: ".$_POST['tab'][2]."</p> 
						<p>Celle-ci et disponible sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";

				} else if ($_POST['tab'][0] === "3" ) { // devis refusé //

					$subject = "BDCDL: Devis Refusé";
					$contenu = "<h4>Un événement vient d'être ajouter par ".$_SESSION['name']." </h4>
						<p> Evénement: ".$_POST['tab'][3]."</p>
						<p>Pour la panne n°: ".$_POST['tab'][2]."</p> 
						<p>Celle-ci et disponible sur <strong>BDCDL</strong> lien --> http://10.40.1.202/bdcdl/public/</p>";
				}

			}

			$contenu .= "<img scr='cid:gcsM' />";

		}
		
		// on crée une nouvelle instance de la classe
		$mail = new PHPMailer();
		// puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
		try {
			/* DONNEES SERVEUR */
			#####################
			$mail->setLanguage('fr', '../core/PHPMailer/language/');   // pour avoir les messages d'erreur en FR
			$mail->SMTPDebug = 0; // en production (sinon "2" en mode débug) 
			$mail->isSMTP(); // envoi avec le SMTP du serveur
			$mail->Host = 'smtp.office365.com'; // serveur SMTP
			$mail->SMTPAuth = true;    // le serveur SMTP nécessite une authentification ("false" sinon)
			$mail->Username = 'servicetechnique@cliniquedeslandes.com'; // login SMTP
			$mail->Password = 'kQyKLqCP'; // Mot de passe SMTP
			$mail->CharSet = 'UTF-8'; //Format d'encodage à utiliser pour les caractères
			$mail->Encoding = 'base64';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // encodage des données TLS (ou juste 'tls') > "Aucun chiffrement des données"; sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
			$mail->Port = 587;   // port TCP (ou 25, ou 465...)

			/* DONNEES DESTINATAIRES */
			##########################
			$mail->setFrom($address1, 'GCS-DU-MARSAN BDCDL');  //adresse de l'expéditeur (pas d'accents)
			$mail->addAddress($address1); // Adresse du destinataire (le nom est facultatif)
			//$mail->addAddress($address2);
			//$mail->addReplyTo('moi@mon_domaine.fr', 'son nom');     // réponse à un autre que l'expéditeur (le nom est facultatif)
			//$mail->addCC($cc);   // Cc (copie) : autant d'adresse que souhaité = Cc (le nom est facultatif)
			//$mail->addBCC($bcc); // Cci (Copie cachée) :  : autant d'adresse que souhaité = Cci (le nom est facultatif)
			
			/* ACCUSES de RECP */
			$mail->ConfirmReadingTo = ($address1);/*pour recevoir un accusé réception de votre message*/

			/* PIECES JOINTES */
			##########################
			
			// $mail->addAttachment('../dossier/fichier.zip', 'nouveau_nom.zip');    // Ou : pièce jointe + nouveau nom

			/* CONTENU DE L'EMAIL*/
			##########################
			$mail->isHTML(true);             // email au format HTML
			$mail->Subject = $subject;      // Objet du message (éviter les accents là, sauf si utf8_encode)
			$mail->Body = $contenu;      // corps du message en HTML - Mettre des slashes si apostrophes
			$mail->addEmbeddedImage('../public/img/img_societe/iconegcs2.jpg', 'gcsM');
			$mail->AltBody = 'Contenu au format texte pour les clients e-mails qui ne le supportent pas'; // ajout facultatif de texte sans balises HTML (format texte)

			$mail->send();

			// ecriture dans la base de donnée email //
			$this->Email->create([

				'contribut_id' => '0',
				'pannes_id' => '0',
				'date_mail' => date('Y-m-d'),
				'email' => $address1,
				'sujet' => $subject,
				'cc' => NULL,
				'bcc' => NULL,
				'message' => $contenu
			]);			
			
			return true;
		
		}
		// si le try ne marche pas > exception ici
		catch (Exception $e) {
			return $mail->ErrorInfo; // Affiche l'erreur concernée le cas échéant
		}
	}

	//////////////////////////// Envoi email test ///////////////////////
		

	// function envoi email test //
	public function testmail() {

		$param = $this->Param->dataparamsemail();

		if ($param[0]->TLS == 1) {

			$encodage = 'PHPMailer::ENCRYPTION_SMTPS';

		} else if($param[0]->STARTTLS == 1) {

			$encodage = 'PHPMailer::ENCRYPTION_STARTTLS';

		} else { // pas d'encodage //

			$encodage = '';
		}

		$contenu = "<h4>TEST ENVOI EMAIL</h4>
					<p>Ceci et un email de test générer par le systéme pour vérifier l'envoi de mail.</p>
					<p>PS: mode debug activer</p>";		
		
		// on crée une nouvelle instance de la classe
		$mail = new PHPMailer();
		// puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
		try {
			/* DONNEES SERVEUR */
			#####################
			$mail->setLanguage('fr', '../core/PHPMailer/language/');   // pour avoir les messages d'erreur en FR
			$mail->SMTPDebug = 2;  // en production (0 sinon "2")
			$mail->isSMTP(); // envoi avec le SMTP du serveur
			$mail->Host = $param[0]->host; // serveur SMTP
			$mail->SMTPAuth = $param[0]->smtp_auth;   // le serveur SMTP nécessite une authentification ("false" sinon)
			$mail->Username = $param[0]->user_name; // login SMTP
			$mail->Password = $param[0]->password; // Mot de passe SMTP
			$mail->CharSet = 'UTF-8';
			$mail->Encoding = 'base64'; //Format d'encodage à utiliser pour les caractères
			$mail->SMTPSecure = $encodage; // encodage des données TLS (ou juste 'tls') > "Aucun chiffrement des données"; sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
			$mail->Port = $param[0]->port; // port TCP (ou 25, ou 465...)

			/* DONNEES DESTINATAIRES */
			##########################
			$mail->setFrom($param[0]->setfrom_addres, $param[0]->setfrom_name);  // adresse de l'expéditeur (pas d'accents) 
			$mail->addAddress($param[0]->setfrom_addres); // Adresse du destinataire (le nom est facultatif)
			//$mail->addReplyTo('moi@mon_domaine.fr', 'son nom');     // réponse à un autre que l'expéditeur (le nom est facultatif)
			//$mail->addCC($cc);   // Cc (copie) : autant d'adresse que souhaité = Cc (le nom est facultatif)
			//$mail->addBCC($bcc); // Cci (Copie cachée) :  : autant d'adresse que souhaité = Cci (le nom est facultatif)		

			//$mail->addAttachment('../dossier/fichier.zip', 'nouveau_nom.zip');    // Ou : pièce jointe + nouveau nom
			
			/* ACCUSES de RECP */
			//$mail->ConfirmReadingTo = ($address1);/*pour recevoir un accusé réception de votre message*/

			/* CONTENU DE L'EMAIL*/
			##########################
			$mail->isHTML(true); // email au format HTML
			$mail->Subject = 'Email de Test'; // Objet du message (éviter les accents là, sauf si utf8_encode)
			$mail->Body = $contenu;      // corps du message en HTML - Mettre des slashes si apostrophes
			$mail->addEmbeddedImage('../public/img/img_societe/iconegcs2.jpg', 'gcsM');
			$mail->AltBody = 'Ceci et un email de test générer par le systéme pour vérifier l\'envoi de mail'; // ajout facultatif de texte sans balises HTML (format texte)

			$mail->send();			
			
			return true;
		
		}
		// si le try ne marche pas > exception ici
		catch (Exception $e) {
			return $mail->ErrorInfo; // Affiche l'erreur concernée le cas échéant
		}

	}


	
}