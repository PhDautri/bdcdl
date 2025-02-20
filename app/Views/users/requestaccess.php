<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function sendmail($nom,$prenom,$email){	

	//Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
		$mail->CharSet = "UTF-8";
	    $mail->SMTPDebug = 0;                      //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.auth.orange-business.com';   //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'servicetechnique@cliniquedeslandes.com'; //SMTP username
	    $mail->Password   = 'kQyKLqCP';                               //SMTP password
	    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged	    
		$mail->setLanguage('fr', '../PHPMailer/language/phpmailer.lang-fr.php'); //To load the French version
	    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('servicetechnique@cliniquedeslandes.com', 'administrateur bdcdl');
	    $mail->addAddress('servicetechnique@cliniquedeslandes.com', 'P.Dautricourt');     //Add a recipient
	    //$mail->addAddress('ellen@example.com');               //Name is optional
	    //$mail->addReplyTo('info@example.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = 'Demande d\'accés';
	    $mail->Body    = 'Demande d\'accés à la base de donnée BDCDL pour '. $nom .' - '.$prenom.' - ' .$email;
	    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();

	    ?>						
			<h3 class="alert alert-success text-center">Le Message a bien était transmis </h3>			

		<?php
	   
	} catch (Exception $e) {
		
		?>	

			<h3 class="alert alert-danger text-center">Le message n'a pas pu être envoyé. Erreur de l'expéditeur : <?= $mail->ErrorInfo; ?></h3>			

		<?php	    
	}
}

function forgotpassword($email){	

	//Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->CharSet = "UTF-8";
	    $mail->SMTPDebug = 0;                      //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.auth.orange-business.com';   //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'servicetechnique@cliniquedeslandes.com'; //SMTP username
	    $mail->Password   = 'kQyKLqCP';                               //SMTP password    
		$mail->setLanguage('fr', '../PHPMailer/language/phpmailer.lang-fr.php'); //To load the French version
	    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('servicetechnique@cliniquedeslandes.com', 'administrateur bdcdl');
	    $mail->addAddress('servicetechnique@cliniquedeslandes.com', 'P.Dautricourt');     //Add a recipient

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = 'Mot de Passe oublié';
	    $mail->Body    = 'Demande de réinitialisation de mot de passe pour ' .$email;

	    $mail->send();

	    ?>						
			<h3 class="alert alert-success text-center">Le Message de demande de réinitialisation à bien était transmis </h3>			

		<?php
	    
	} catch (Exception $e) {

		?>	

			<h3 class="alert alert-danger text-center">Le message n'a pas pu être envoyé. Erreur de l'expéditeur : <?= $mail->ErrorInfo; ?></h3>			

		<?php		
	    
	}
}