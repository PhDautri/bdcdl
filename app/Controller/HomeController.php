<?php

namespace App\Controller;

use Core\Controller\Controller;

class HomeController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Home');
		$this->loadModel('Material');
		$this->loadModel('Contributor');
		$this->loadModel('Panne');
		$this->loadModel('Document');
		$this->loadModel('Interv');
		$this->loadModel('Quotation');
		$this->loadModel('IntervCab'); 
		$this->loadModel('Billing'); 
	}

	public function home() {

		$contri = $this->Contributor->Count(); // nbr d'intervenant

		$mate = $this->Material->CountMP(); // nbr de matériel Primaire enregister

		$matelier = $this->Material->CountML(); // nbr de matériel lier 

		$panne = $this->Panne->Count(); // nbr de panne déclarer 

		$attrep = $this->Panne->CountAttRep(); // nbr de panne en attente de rep		 

		$tinterv = $this->Interv->CountInterT(); // nbr total d'intervention

		$attinterep = $this->Interv->CountAttInterRep();// nbr interv en cours 

		$mtrep = $this->Document->Countmtr();  // montant total réparation //

		if ($mtrep[0]->montantT == NULL) {

	        $mtr = "0.00";

	    } else {

	        $mtr = number_format($mtrep[0]->montantT, 2, ',', ' ');
	    }

	    $mtquota = $this->Quotation->countmtquota();// montant total des devis /*********AC*******/

	    if ($mtquota[0]->montantDE == NULL) {

	        $mtquota = "0.00";

	    } else {

	        $mtquota = number_format($mtquota[0]->montantDE, 2, ',', ' '); 
	    }

	    $nbrfactrep = $this->Panne->nbrfactrep(); // nombre de facture réparation /***********AC********/

	    $mfactrep = $panne[0]->id - $nbrfactrep[0]->nbrfr;

		$nda = $this->Quotation->CountNda(); // nbr de devis en attente 

		$nbrtvolet = $this->Material->countnbrtvolets(); // remonte le nombre total de volets //

		$nbrptvolet = $this->Panne->CountNbrtPvolets(); // remonte le nbr total de pannes volets //

		$pvanacl = $this->Material->CountPVoletNacl(); // nbr de panne de volets nécésitant une nacelle en attente de demande devis//

		$pvsnacl = $this->Material->CountPVoletSnacl(); // nbr de panne de volets ne nécésitant pas de nacelle en attente de demande devis//

		$pvaquota = $this->Material->CountPVoletAquota(); // nbr de panne de volets en attente de devis //

		$this->render('home.home', compact('contri', 'mate', 'matelier', 'panne', 'tinterv', 'attinterep', 'attrep', 'mtr', 'mtquota', 'mfactrep', 'nda', 'nbrtvolet', 'nbrptvolet', 'pvanacl', 'pvsnacl', 'pvaquota'));
	}

	// affiche la home page compta //
	
	public function homecompta() {

		$ni = $this->IntervCab->CountIntervCab(); // nbr d'interv cab
		$nf = $this->Billing->CountFact(); // nbr facture cab
		$ninf = $this->IntervCab->CountIntervNoFact(); // nbr d'interv non facturer 

		$this->render('home.homeCompta', compact('ni', 'nf', 'ninf')); 

	}

	// verifie les notification //

	public function checkednotif() {

		$output = $this->Home->checkedNotif();

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}
	
	// verifie les notification compta//

	public function checkednotifcompta() {

		$output = $this->IntervCab->CountIntervNoFact();

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}	


}