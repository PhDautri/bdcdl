<?php

$contribut = explode(",", $_POST['Contributor']);
$destinataire = $_POST['to'];
$subject = $_POST['subject'];
$contenu = $_POST['mess'];

$expl = explode(",",$contenu);

$contenu = '

<html>  
  <body>
   <p>'.$expl[0].',</p>
   <p>'.$expl[1].'</p>
   <p>'.$expl[2].'</p>
   <p>'.$expl[3].'</p>
   <p>'.$expl[4].'</p>
   <p>'.$expl[5].'</p>
   <p><strong>'.$expl[6].'</strong></p><br>
   <p>'.$expl[7].'</p>
   <p>'.$expl[8].'</p>   
  </body>
</html>
';

$cc = $_POST['cc'];
$bcc = $_POST['bcc'];

// lance les classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// path du dossier PHPMailer % fichier d'envoi du mail
require '../core/PHPMailer/src/Exception.php';
require '../core/PHPMailer/src/PHPMailer.php';
require '../core/PHPMailer/src/SMTP.php';

 
  // on crée une nouvelle instance de la classe
  $mail = new PHPMailer();
  // puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
  try {
    /* DONNEES SERVEUR */
    #####################
    $mail->setLanguage('fr', '../core/PHPMailer/language/');   // pour avoir les messages d'erreur en FR
    $mail->SMTPDebug = 0;            // en production (sinon "2")
    //$mail->SMTPDebug = 2;            // décommenter en mode débug
    $mail->isSMTP();                                               // envoi avec le SMTP du serveur
    $mail->Host       = 'smtp.auth.orange-business.com';          // serveur SMTP
    $mail->SMTPAuth   = true;                                    // le serveur SMTP nécessite une authentification ("false" sinon)
    $mail->Username   = 'servicetechnique@clinlan3.fr.fto';     // login SMTP
    $mail->Password   = 'kQyKLqCP';                            // Mot de passe SMTP
    $mail->CharSet = 'UTF-8';                                  //Format d'encodage à utiliser pour les caractères
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // encodage des données TLS (ou juste 'tls') > "Aucun chiffrement des données"; sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
    $mail->Port       = 587;                                 // port TCP (ou 25, ou 465...)

    /* DONNEES DESTINATAIRES */
    ##########################
    $mail->setFrom('servicetechnique@cliniquedeslandes.com', 'GCS-DU-MARSAN');  //adresse de l'expéditeur (pas d'accents)
    $mail->addAddress($destinataire, $contribut[1]); // Adresse du destinataire (le nom est facultatif)
    // $mail->addReplyTo('moi@mon_domaine.fr', 'son nom');     // réponse à un autre que l'expéditeur (le nom est facultatif)
    $mail->addCC($cc);   // Cc (copie) : autant d'adresse que souhaité = Cc (le nom est facultatif)
    $mail->addBCC($bcc); // Cci (Copie cachée) :  : autant d'adresse que souhaité = Cci (le nom est facultatif)

    /* PIECES JOINTES */
    ##########################
    // $mail->addAttachment('../dossier/fichier.zip');         // Pièces jointes en gardant le nom du fichier sur le serveur
    // $mail->addAttachment('../dossier/fichier.zip', 'nouveau_nom.zip');    // Ou : pièce jointe + nouveau nom

    /* CONTENU DE L'EMAIL*/
    ##########################
    $mail->isHTML(true);             // email au format HTML
    $mail->Subject = $subject;      // Objet du message (éviter les accents là, sauf si utf8_encode)
    $mail->Body    = $contenu;      // corps du message en HTML - Mettre des slashes si apostrophes
    $mail->AltBody = 'Contenu au format texte pour les clients e-mails qui ne le supportent pas'; // ajout facultatif de texte sans balises HTML (format texte)

    $mail->send();
    echo 'Message envoyé.';
  
  }
  // si le try ne marche pas > exception ici
  catch (Exception $e) {
    echo "Le Message n'a pas été envoyé. Mailer Error: {$mail->ErrorInfo}"; // Affiche l'erreur concernée le cas échéant
  }  


