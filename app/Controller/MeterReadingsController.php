<?php

namespace App\Controller;

use Core\Controller\Controller;

class MeterReadingsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('MeterReading');
		$this->loadModel('MeterReadingCta');
		$this->loadModel('MeterReadingEau');
		$this->loadModel('Lot');

	}

	///////////////////// COMPTEURS /////////////////////////	

	// function qui affiche les relevés des compteurs // 
	public function meterreading() {

		$this->render('meterReading.meterreading');
	}

	// function qui remonte tout les relevés //
	
	public function allmeterreading() {

		$result = $this->MeterReading->allMeterReading();

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui remonte le dernier relevé différent de 0 //
	
	public function findlastnonzeroelement() {

		$result = $this->MeterReading->FindLastNonZeroElement($_POST['col'], $_POST['page']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}	

	// function qui remonte le relevé précédent / id meter//
	
	public function findpreviousmeter() {

		$result = $this->MeterReading->FindPreviousMeter($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui ajoute les relevés de compteurs Clinique & radio/scan/irm //
	
	public function addmeter() {

		if (!empty($_POST['rst_eau'])) {
			$eau = 1;
		} else {
			$eau = 0;
		}

		if (!empty($_POST['rst_gaz'])) {
			$gaz = 1;
		} else {
			$gaz = 0;
		}

		if (!empty($_POST['rst_scan'])) {
			$scan = 1;
		} else {
			$scan = 0;
		}

		if (!empty($_POST['rst_irm'])) {
			$irm = 1;
		} else {
			$irm = 0;
		}

		if (!empty($_POST['rst_radio'])) {
			$radio = 1;
		} else {
			$radio = 0;
		}

		if (!empty($_POST['rst_eauR'])) {
			$eaur = 1;
		} else {
			$eaur = 0;
		}

		if (!empty($_POST['rst_eauA'])) {
			$apf = 1;
		} else {
			$apf = 0;
		}

		//var_dump($_POST);die();

		$this->MeterReading->create([			

			'date' => $_POST['date'],
			'eau' => $_POST['eau'],
			'conso_eau' => $_POST['conso_eau'],
			'rst_eau' => $eau,
			'gaz' => $_POST['gaz'],
			'conso_gaz' => $_POST['conso_gaz'],
			'rst_gaz' => $gaz,
			'elec_scan' => $_POST['scan'],
			'conso_scan' => $_POST['conso_scan'],
			'rst_scan' => $scan,
			'elec_irm' => $_POST['irm'],
			'conso_irm' => $_POST['conso_irm'],
			'rst_irm' => $irm,
			'elec_radio' =>$_POST['radio'],
			'conso_radio' =>$_POST['conso_radio'],
			'rst_radio' => $radio,
			'eau_radio' => $_POST['eauR'],
			'conso_eauradio' => $_POST['conso_eauR'],
			'rst_eauradio' => $eaur,
			'eau_apf' => $_POST['eauA'],
			'conso_apf' => $_POST['conso_eauA'],
			'rst_apf' => $apf,
		]);
	}

	// function qui edit les relevés de compteurs Clinique //

	public function editmeter() {

		//var_dump($_POST);die();

		$this->MeterReading->update($_POST['id_meter'],[

			'date' => $_POST['date'],
			'eau' => $_POST['eau'],
			'conso_eau' => $_POST['conso_eau'],
			'gaz' => $_POST['gaz'],
			'conso_gaz' => $_POST['conso_gaz'],
			'elec_scan' => $_POST['scan'],
			'conso_scan' => $_POST['conso_scan'],
			'elec_irm' => $_POST['irm'],
			'conso_irm' => $_POST['conso_irm'],
			'elec_radio' =>$_POST['radio'],
			'conso_radio' =>$_POST['conso_radio'],
			'eau_radio' => $_POST['eauR'],
			'conso_eauradio' => $_POST['conso_eauR'],
			'eau_apf' => $_POST['eauA'],
			'conso_apf' => $_POST['conso_eauA']

		]);
		
	}	

	// function qui supprime une ligne de relevées de compteur //
	
	public function deletemeter() {

		if (!empty($_POST)) {   		

			$this->MeterReading->delete($_POST['id']);
		}
	}
	
	////////////////////////////////////// CTA /////////////////////////////////////////
	
	// function qui affiche les relevés des compteurs CTA // 
	public function cta() {

		$this->render('meterReading.Cta');
	}

	// function qui remonte tout les relevés des compteurs cta //
	
	public function allmeterreadingcta() {

		$result = $this->MeterReadingCta->allMeterReadingCta();

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui ajoute les relevés de compteurs clinique//
	
	public function addmetercta() {

		$this->MeterReadingCta->create([

			'date' => $_POST['date'],
			'elec_ctaNord' => $_POST['ctan'],
			'conso_ctaNord' => $_POST['conso_ctan'],
			'elec_ctaSud' => $_POST['ctas'],
			'conso_ctaSud' => $_POST['conso_ctas']
		]);
	}

	// function qui edit les relevés de compteurs clinique//

	public function editmetercta() {

		$this->MeterReadingCta->update($_POST['id_meter'],[

			'date' => $_POST['date'],
			'elec_ctaNord' => $_POST['ctan'],
			'conso_ctaNord' => $_POST['conso_ctan'],
			'elec_ctaSud' => $_POST['ctas'],
			'conso_ctaSud' => $_POST['conso_ctas']

		]);

	}

	// function qui remonte le relevé précédent CTA / id meter//
	
	public function findpreviousmetercta() {

		$result = $this->MeterReadingCta->FindPreviousMeterCta($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($result);
	}

	// function qui supprime une ligne de relevées de compteur CTA //
	
	public function deletemetercta() {

		if (!empty($_POST)) {   		

			$this->MeterReadingCta->delete($_POST['id']);
		}
	}

	////////////////////////////////// EAU CABINET ///////////////////////////////////////////

	// function qui affiche les relevés des compteurs EAU // 
	public function eau() {

		$this->render('meterReading.Eau');
	}

	// function qui remonte tout les relevés des compteurs par sont année selectionner EAU //
	
	public function selectdataeau() {

		$result = $this->MeterReadingEau->SelectDataEau($_POST['id']);

		$output = array("data" => $result);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}		
	
	// function qui ajoute les relevés de compteurs eau cabinet //
	
	public function addmetereau() {

		//var_dump($_POST);die();

		$this->MeterReadingEau->create([

			'date' => $_POST['date'],
			'lotID' => $_POST['SelectLot'],
			'compteur_eau' => $_POST['counter'],
			'conso_eau' => $_POST['conso_counter'],
			'annee_ante' => $_POST['previousyear']
		]);
	}

	// function qui edit les relevés de compteurs eau cabinet //

	public function editmetereau() {

		$this->MeterReadingEau->update($_POST['id_meter'],[
			
			'compteur_eau' => $_POST['counter'],
			'conso_eau' => $_POST['conso_counter']			

		]);
	}	
	
	// extrait les années des relevés créer //
	
	public function extractyeareau() {

		$output = $this->MeterReadingEau->extractYearEau();

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// extrait l'année antérieur des relevés créer //
	
	public function previousyeareau() {

		$output = $this->MeterReadingEau->previousYearEau($_POST['id']);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}		

	// function qui remonte le dernier relever en fonction de l'année et du lot //
	
	public function findlastmetereau() {

		$output = $this->MeterReadingEau->findLastMeterEau($_POST['lot'], $_POST['year']);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}

	// function qui verifie si l'année et déja enregistrer dans la base //
	
	public function checkedyeareau() {

		$output = $this->Lot->CheckedYearEau($_POST['numlot']);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	////////////////LOT///////////////////////////////////////

	// function qui remonte la liste des lot pour select lot //
	
	public function selectlot() {

		$output = $this->Lot->selectLot();

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}

	// function qui remonte les lots déja enregistrer par année //
	
	public function findlot() {
		
		$output = $this->Lot->findLot($_POST['year']);

		header('Content-Type: aplication/json');

		echo json_encode($output);
	}  

	// function qui ajoute un lot //
	
	public function addlot() {

		$this->Lot->create([

			'num_lot' => $_POST['numlot'],
			'lieux_compt' => $_POST['lieux'],
			'appartenance' => $_POST['appcomp']
		]);
	}

	// function qui remonte si le lot existe ou pas //
	
	public function checkedlot() {

		$output = $this->Lot->CheckedLot($_POST['numlot']);

		header('Content-Type: aplication/json');

		echo json_encode($output);

	}	

	//////////////////////////////////PDF///////////////////////////////////
	
	// function qui affiche tout les relevés compteurs Clinique en pdf //
	
	public function allmeterreadingpdf() {

		$result = $this->MeterReading->allMeterReading();		

		$this->render('meterReading.viewMeterReadingpdf', compact('result'));
	}

	// function qui affiche tout les relevés compteurs CTA en pdf //
	
	public function allmeterreadingctapdf() {

		$result = $this->MeterReadingCta->allMeterReadingCta();		

		$this->render('meterReading.viewMeterReadingCtapdf', compact('result'));
	}

	// function qui affiche tout les relevés compteurs EAU cabinet en pdf //
	
	public function eaupdf() {
		
		$annee = $this->MeterReadingEau->extractYearEau();		

		$this->render('meterReading.viewEaupdf', compact('annee'));
	}

}