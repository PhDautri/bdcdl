<?php

namespace App\Controller;

use Core\Controller\Controller;

class DocumentsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Document');

		$this->loadModel('Interv');

		$this->loadModel('Quotation');

		$this->loadModel('FactureRep');

		$this->loadModel('FactureInte');

		$this->loadModel('Material');

		$this->loadModel('Contract'); // contrats //

		$this->loadModel('Control'); // controle //
	}

	// affiche la table documents /************AC**&***A_C******/
	
	public function documentsaff() {

		$this->render('documents.documents');

	}

	// retoune les données pour la table documents /*************AC***&*****A_C***/
	
	public function documentsAffTable() {

		$result = $this->Document->documentsall();

		header('Content-Type: aplication/json');

		echo json_encode($result);

	}	

	// verifie la facture existe pour le matériel  (id mate)//

	public function checkedDocFactAchat(){

		$result = $this->Document->chekeddocfactachat($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// retourne les données document caractéristique pour le matériel (id mate) //

	public function doccm(){

		$result = $this->Document->DocCm($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// verifie si le certificat existe pour la panne  (id panne)//

	public function checkedDocCe(){

		$result = $this->Document->chekeddocce($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}	

	// ajoute les fichiers pdf /*********M************/
	
	public function addFiles(){

		//var_dump($_POST);die();	

		if ($_POST['IndexUp'] == 'BI') { // ok //

			$rep = '../public/documents/bonintervs/';
			$numdoc = $_POST['NumDoc'];
			$deb = $_POST['intervID']; 									

		} else if ($_POST['IndexUp'] == 'FI') { // ok //
			
			$rep = '../public/documents/factures/intervs/';			
			$numdoc = $_POST['NumDoc'];
			$deb = $_POST['intervID'];			

		} else if ($_POST['IndexUp'] == 'DE') { 

			$rep = '../public/documents/devis/';			
			$numdoc = $_POST['NumQuota'];
			$deb = $_POST['PanneID']; // numero de la panne

		} else if ($_POST['IndexUp'] == 'FR') { 
			
			$rep = '../public/documents/factures/repair/';			
			$numdoc = $_POST['NumDoc'];
			$deb = $_POST['PanneID']; // numero de la panne

		} else if ($_POST['IndexUp'] == 'CE') { 

			$rep = '../public/documents/certif/';
			$array = explode(".", $_FILES['file']['name']); // récupére le nom du fichier sans le point et l'extension
			$numdoc = $array[0];
			$deb = $_POST['PanneID']; // numero de la panne 

		} else if ($_POST['IndexUp'] == 'FA') {

			$rep = '../public/documents/factures/achat/';
			$numdoc = $_POST['NumDoc'];
			$deb = $_POST['MateID']; // numero du matériel

		} else if ($_POST['IndexUp'] == 'VMC') { // *********AV************//

			$rep = '../public/img/img_zonevmc/';			

		} else if ($_POST['IndexUp'] == 'CO') { // contrat //

			$rep = '../public/documents/contrats/';
			$numdoc = $_POST['NumContract'];
			$deb = $_POST['ContractID'];

		} else if ($_POST['IndexUp'] == 'CON') { // contrôle //

			$rep = '../public/documents/controls/';
			$deb = $_POST['ControlID'];

		} else if ($_POST['IndexUp'] == 'ICM') { // Interv contrat maintenance //
			
			$rep = '../public/documents/bonintervs/';
			$deb = $_POST['intervID'];

		} else if ($_POST['IndexUp'] == 'DCM') { // documents caracteristique materiels //

			$rep = '../public/documents/materiels/';
			$deb = $_POST['MateID'];
		}

		if ($_POST['IndexUp'] == 'VMC' || $_POST['IndexUp'] == 'CON' || $_POST['IndexUp'] == 'ICM' || $_POST['IndexUp'] == 'DCM') {  // *********AV*pour VMC*******//

			$uploadfile = $rep.basename($_FILES['file']['name']); // forme le fichier

			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile); // ecris le fichier dans le dossier //

			$error = $_FILES['file']['error'];

		} else {

			$uploadfile = $rep.basename($_FILES['file']['name']); // forme le fichier

			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile); // ecris le fichier dans le dossier //

			$error = $_FILES['file']['error'];

			$doc = $deb.$_POST['IndexUp'].$numdoc.".pdf"; // re-forme le fichier
		
			rename($uploadfile,$rep.$doc); // renome le fichier //
		}				

		if ($_POST['IndexUp'] == 'BI') { // bon d'intervention //

			$this->Interv->update($_POST['intervID'],[ 

				'num_bi' => $doc
			]);

		} else if ($_POST['IndexUp'] == 'DE') { // devis //

			$this->Quotation->update($_POST['IDquota'],[

				'lien_devis' => $doc
			]);								

		} else if ($_POST['IndexUp'] == 'FI') { // Facture Intervention //			
			
			$this->FactureInte->create([
				'materiel_id' => $_POST['MateID'],
				'pannes_id' => $deb,
				'intervs_id' => $_POST['intervID'],
				'annee_factinterv' => $_POST['year'],
				'num_fac_interv' => $numdoc,
				'lien_fac_interv' => $doc,
				'montantFI' => $_POST['montantTTC'],
				'prop' => $_POST['propi']			
			]);				

		} else if ($_POST['IndexUp'] == 'FR') { // FACTURE REP//  			
			
			$this->FactureRep->create([
				'materiel_id' => $_POST['MateID'],
				'pannes_id' => $deb,
				'annee_factrepair' => $_POST['year'],
				'num_fac_rep' => $numdoc,
				'lien_fac_rep' => $doc,
				'montantFR' => $_POST['montantTTC'],
				'prop' => $_POST['propi']
			]);				

		} else if ($_POST['IndexUp'] == 'CE') { // CE //

			$this->Document->update($_POST['IDdoc'],[
				'num_cert_etanch' => $doc
			]);

		} else if ($_POST['IndexUp'] == 'FA') { //Fact Achat //			

			$this->Material->update($_POST['MateID'],[
				
				'montantAchat' => $_POST['montantTTC'],
				'num_factAchat' => $doc
			]);			
			
		} else if ($_POST['IndexUp'] == 'VMC') {  // *********AV************//
			
			$this->Material->update($_POST['MateID'],[

				'img_zone' => $uploadfile
			]);

		} else if ($_POST['IndexUp'] == 'CO') { // CONTRATS //

			$this->Contract->update($_POST['ContractID'],[

				'lien_contrat' => $rep.$doc
			]);

		} else if ($_POST['IndexUp'] == 'CON') { // CONTROLS //

			$this->Control->update($_POST['ControlID'],[

				'lien_control' => $uploadfile
			]);

		} else if ($_POST['IndexUp'] == 'ICM') { // Interv Contrat Maintenance //

			$this->Interv->update($_POST['intervID'],[

				'lien_icm' => $uploadfile
			]);

		} else if ($_POST['IndexUp'] == 'DCM') { // Document Caractéristique Matériel //

			$this->Document->create([

				'materiel_id' => $_POST['MateID'],
				'doc_mat' => $uploadfile

			]);

		} 				    	
		
		return $error;

	}	

	// upload les fichiers en fonction des bouton //
	
	public function uploadF(){	

		//var_dump($_POST);die();
		
		if ($_POST['propi'] == "") {
			$propi = "0";
		} else {
			$propi = $_POST['prop'];
		}				

		if ($_POST['IndexUp'] == 'BI' || $_POST['IndexUp'] == 'ICM') { 

			$rep = '../public/documents/bonintervs/';
			$numdoc = $_POST['NumDoc'];
			$deb = $_POST['intervID'];									

		} else if ($_POST['IndexUp'] == 'FI') { 
			
			$rep = '../public/documents/factures/intervs/';
			$numdoc = $_POST['NumDoc'];	
			$deb = $_POST['intervID'];						

		} else if ($_POST['IndexUp'] == 'DE') { 

			$rep = '../public/documents/devis/';			
			$numdoc = $_POST['NumQuot'];
			$deb = $_POST['PanneID']; // numero de la panne

		} else if ($_POST['IndexUp'] == 'FR') { 
			
			$rep = '../public/documents/factures/repair/';
			$numdoc = $_POST['NumDoc'];
			$deb = $_POST['PanneID']; // numero de la panne						

		} else if ($_POST['IndexUp'] == 'CE') { 

			$rep = '../public/documents/certif/';
			$deb = $_POST['PanneID']; // numero de la panne
			$array = explode(".", $_FILES['file']['name']); // récupére le nom du fichier sans le point et l'extension
			$numdoc = $array[0]; 

		} else if ($_POST['IndexUp'] == 'FA') {

			$rep = '../public/documents/factures/achat/';
			$numdoc = $_POST['NumDoc'];
			$deb = $_POST['MateID']; // numero du matériel

		} else if ($_POST['IndexUp'] == 'VMC') {

			$rep = '../public/img/img_zonevmc/';			

		} else if ($_POST['IndexUp'] == 'CO') { // CONTRAT //

			$rep = '../public/documents/contrats/';
			$numdoc = $_POST['NumContract'];
			$deb = $_POST['ContractID'];

		} else if ($_POST['IndexUp'] == 'CON') { // contrôle //

			$rep = '../public/documents/controls/';
			$deb = $_POST['ControlID'];

		} else if ($_POST['IndexUp'] == 'DCM') { // documents caracteristique materiels //

			$rep = '../public/documents/materiels/';
			$deb = $_POST['MateID'];
		}

		// efface le fichier existant //
		
		$doc = $rep . $_POST['docenreg'];

		if (file_exists($doc) == true ) {

			unlink($doc);
		}

		// forme le fichier et l'enregistre // 
		if ($_POST['IndexUp'] == 'VMC' || $_POST['IndexUp'] == 'CON' || $_POST['IndexUp'] == 'ICM' || $_POST['IndexUp'] == 'DCM' ) {

			$uploadfile = $rep.basename($_FILES['file']['name']); // forme le fichier

			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile); // ecris le fichier dans le dossier //

			$error = $_FILES['file']['error'];

		} else {

			$uploadfile = $rep.basename($_FILES['file']['name']); // forme le fichier

			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile); // ecris le fichier dans le dossier //

			$error = $_FILES['file']['error']; // recupére l'erreur

			$doc = $deb.$_POST['IndexUp'].$numdoc.".pdf"; // reforme le fichier

			rename($uploadfile,$rep.$doc); // renome le fichier //
		}


		if ($_POST['IndexUp'] == 'BI') { // update le bon d'intervention //ok//

			$this->Interv->update($_POST['intervID'],[ 

				'num_bi' => $doc
			]);

		} else if ($_POST['IndexUp'] == 'DE') { // devis //

			$this->Quotation->update($_POST['IDquota'],[

				'num_devis' => $numdoc,
				'lien_devis' => $doc,
				'montantDE' => $_POST['montantQuot']

			]);								

		} else if ($_POST['IndexUp'] == 'FI') { // Facture Intervention //			
								
			$this->FactureInte->update($_POST['facID'],[
				'num_fac_interv' => $numdoc,
				'lien_fac_interv' => $doc,
				'montantFI' => $_POST['montantTTC'],
				'prop' => $propi
			]);				

		} else if ($_POST['IndexUp'] == 'FR') { // FACTURE REP //			
				 
			$this->FactureRep->update($_POST['facID'],[
				'num_fac_rep' => $numdoc,
				'lien_fac_rep' => $doc,
				'montantFR' => $_POST['montantTTC'],
				'prop' => $propi

			]);					

		} else if ($_POST['IndexUp'] == 'CE') { // CE //

			$this->Document->update($_POST['IDdoc'],[
				'num_cert_etanch' => $doc
			]);

		} else if ($_POST['IndexUp'] == 'FA') { //Fact Achat //			
			
			$this->Material->update($_POST['MateID'],[			
				'montantAchat' => $_POST['montantTTC'],
				'num_factAchat' => $doc
			]);				
			
		} else if ($_POST['IndexUp'] == 'VMC') {
			
			$this->Material->update($_POST['MateID'],[

				'img_zone' => $uploadfile
			]);

		} else if ($_POST['IndexUp'] == 'CO') { // CONTRATS //

			$this->Contract->update($_POST['ContractID'],[

				'lien_contrat' => $rep.$doc
			]);

		} else if ($_POST['IndexUp'] == 'CON') { // CONTROLS //

			$this->Control->update($_POST['ControlID'],[

				'lien_control' => $uploadfile
			]);

		} else if ($_POST['IndexUp'] == 'ICM') { // Intervention contrat maintenance //

			$this->Interv->update($_POST['intervID'],[

				'lien_icm' => $uploadfile
			]);

		} else if ($_POST['IndexUp'] == 'DCM') { // Document Caractéristique Matériel //

			$this->Document->update($_POST['IDdoc'], [

				'doc_mat' => $uploadfile

			]);
		}			    	
		
		return $error;

	}

	// efface l'ancien fichier pdf vmc //
	
	public function deletefilevmc(){

		$doc = $_POST['doc'];

		if (file_exists($doc) == true ) {

			unlink($doc);
		}

	}	
	
}