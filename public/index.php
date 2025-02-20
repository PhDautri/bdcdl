<?php

use Core\Auth\DbAuth;

define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';

App::load();


if(isset($_GET['p'])){

	$p = $_GET['p'];	

} else {

	$p = 'login';

}

// AUTH 

	$app = App::getInstance();

	$auth = new DbAuth($app->getDb());

    if(!$auth->logged()){

		$controller = new \App\Controller\UserController();
	
		$controller->Login();

// HOME //
 	
	} elseif ($p === 'home') {

		$controller = new \App\Controller\HomeController();
	
		$controller->home();

	} elseif ($p === 'home.compta') {

		$controller = new \App\Controller\HomeController();
	
		$controller->homecompta();
		
	} elseif ($p === 'home.notif') {

		$controller = new \App\Controller\HomeController();
		
		$controller->checkednotif();

	} elseif ($p === 'home.notifcompta') {

		$controller = new \App\Controller\HomeController();
		
		$controller->checkednotifcompta();

	} elseif ($p === 'home.affchart') {

		$controller = new \App\Controller\ChartsController();
		
		$controller->affchart();

	} elseif ($p === 'home.affchartvolet') {

		$controller = new \App\Controller\ChartsController();
		
		$controller->affchartvolet();

	} elseif ($p === 'home.extractyear') { 

		$controller = new \App\Controller\ChartsController();
		
		$controller->extractyear();

	} elseif ($p === 'home.extractnbrpanne') { 

		$controller = new \App\Controller\ChartsController();
		
		$controller->extractnbrpanne();

	} elseif ($p === 'home.checkedyear') { 

		$controller = new \App\Controller\ChartsController();
		
		$controller->checkedyear();

	} elseif ($p === 'home.addyearchart') { 

		$controller = new \App\Controller\ChartsController();
		
		$controller->addyearchart();

	} elseif ($p === 'home.countpricetotalrepair') { 

		$controller = new \App\Controller\ChartsController();
		
		$controller->countpricetotalrepair();

	} elseif ($p === 'home.countPTRV') { 

		$controller = new \App\Controller\ChartsController(); // ************AC*******//
		
		$controller->countPTRV();	

	} elseif ($p === 'home.updatechartpanne') { 

		$controller = new \App\Controller\ChartsController();
		
		$controller->updatechartpanne();

	} elseif ($p === 'home.updateCPV') { //***************AC***********//

		$controller = new \App\Controller\ChartsController();
		
		$controller->updateCPV();

// CONTRIBUTORS //

	} elseif ($p === 'contributors') {

		$controller = new \App\Controller\ContributorsController();

        $controller->contributors();	
	
	} elseif ($p === 'contributors.allExt') {

		$controller = new \App\Controller\ContributorsController();

		$controller->contributorsAllExt();
	
	} elseif ($p === 'contributors.affContribut') {

		$controller = new \App\Controller\ContributorsController();

		$controller->viewsContribPanne();
	
	} elseif ($p === 'contributors.add') {

		$controller = new \App\Controller\ContributorsController();

		$controller->addContributors();
	
	} elseif ($p === 'contributors.find') {

		$controller = new \App\Controller\ContributorsController();

		$controller->findContributors();
	
	} elseif ($p === 'contributors.findCCQuotaReactu') {

		$controller = new \App\Controller\ContributorsController();

		$controller->findCCQuotaReactu();

	} elseif ($p === 'contributors.findCCQuota') {

		$controller = new \App\Controller\ContributorsController();

		$controller->findCCQuota();
	
	} elseif ($p === 'contributors.edit') {

		$controller = new \App\Controller\ContributorsController();

		$controller->editContributors();
	
	} elseif ($p === 'contributors.checkedContributor') {

		$controller = new \App\Controller\ContributorsController();

		$controller->checkedContributors();
	
	} elseif ($p === 'contributors.checkedappel') {

		$controller = new \App\Controller\ContributorsController();

		$controller->checkedAppelContribut();
	
	} elseif ($p === 'contributors.checkedNumPhone') {

		$controller = new \App\Controller\ContributorsController();

		$controller->checkedNumphone();
	
	} elseif ($p === 'contributors.checkedIntervContribut') {

		$controller = new \App\Controller\ContributorsController();

		$controller->checkedIntervContribut();
	
	} elseif ($p === 'contributors.checkedContact') {

		$controller = new \App\Controller\ContributorsController();

		$controller->checkedContact();
	
	} elseif ($p === 'contributors.selectContri') {

		$controller = new \App\Controller\ContributorsController();

		$controller->selectContri();
	
	} elseif ($p === 'contributors.selectEmailContact') { 

		$controller = new \App\Controller\ContributorsController();

		$controller->selectEmailContact(); 
	
	} elseif ($p === 'contributors.viewPdf') {

		$controller = new \App\Controller\ContributorsController();

		$controller->viewContriPdf();
	
	} elseif ($p === 'contributors.delete') {

		$controller = new \App\Controller\ContributorsController();

		$controller->deleteContributor();

// CONTRIBUTORS INTERNE //

	} elseif ($p === 'contributors.interne') {

		$controller = new \App\Controller\ContributorsController();

        $controller->contributorsInte();	
	
	} elseif ($p === 'contributors.allInte') {

		$controller = new \App\Controller\ContributorsController();

		$controller->contributorsAllInte();

	} elseif ($p === 'contributors.viewIntPdf') {

		$controller = new \App\Controller\ContributorsController();

		$controller->viewContriIntPdf();

// CONTACTS //
	
	} elseif ($p === 'contacts') {
		
		$controller = new \App\Controller\ContactsController();

		$controller->contacts();		
	
	}  elseif ($p === 'contacts.all') {

		$controller = new \App\Controller\ContactsController();

		$controller->contactsAll();
	
	}  elseif ($p === 'contacts.add') {

		$controller = new \App\Controller\ContactsController();

		$controller->addContacts();
	
	}  elseif ($p === 'contacts.edit') {

		$controller = new \App\Controller\ContactsController();

		$controller->editContacts();
	
	}  elseif ($p === 'contacts.selectContact') {

		$controller = new \App\Controller\ContactsController();

		$controller->selectContact();
	
	} elseif ($p === 'contacts.selectTech') { 

		$controller = new \App\Controller\ContactsController();

		$controller->selectTech();
	
	} elseif ($p === 'contacts.finddatacontact') {

		$controller = new \App\Controller\ContactsController();

		$controller->findDataContact();
	
	} elseif ($p === 'contacts.checkedappel') {

		$controller = new \App\Controller\ContactsController();

		$controller->checkedAppelContact();
	
	} elseif ($p === 'contacts.delete') {

		$controller = new \App\Controller\ContactsController();

		$controller->deleteContact();

// APPEL/ CALL //

	} elseif ($p === 'call.findCallPanne') {

		$controller = new \App\Controller\CallsController();

		$controller->findcallpanne();

// MATERIALS //
	
		} elseif ($p === 'materials') {		

			$controller = new \App\Controller\MaterialsController();

			$controller->materials();

		} elseif ($p === 'materials.all') {	

			$controller = new \App\Controller\MaterialsController();

			$controller->materialsall();

		} elseif ($p === 'materialslier') {		

			$controller = new \App\Controller\MaterialsController();

			$controller->materialslier();		

		} elseif ($p === 'materials.affMateSelect') {

			$controller = new \App\Controller\MaterialsController();

			$controller->materialSelect();

		} elseif ($p === 'materials.lierall') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->materialsLierAll();

		} elseif ($p === 'materials.affMateLier') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->materialLier();

		} elseif ($p === 'materials.affMateNonlier') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->materialsNonLier();

		} elseif ($p === 'materials.nbrMateLier') {

			$controller = new \App\Controller\MaterialsController();

			$controller->NbrMateLier();

		} elseif ($p === 'materials.affRebus') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->materialsrebus();

		} elseif ($p === 'materials.rebus') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->materialsAllTrash();

		} elseif ($p === 'materials.affStatut') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->materialstatut();		

		} elseif ($p === 'materials.disomate') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->materialsdiso();

		} elseif ($p === 'materials.disomateprim') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->materialsdisoprim();
		
		} elseif ($p === 'materials.shutterfailure') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->shutterfailure();		

	// ADD //
	
		} elseif ($p === 'materials.add') {

			$controller = new \App\Controller\MaterialsController();

			$controller->addMaterial();

		} elseif ($p === 'materials.addmat') {		

			$controller = new \App\Controller\MaterialsController();

			$controller->addmat();		

		} elseif ($p === 'materials.addmatlier') {		

			$controller = new \App\Controller\MaterialsController();

			$controller->addmatlier();

		} elseif ($p === 'materials.addFamily') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->addFamily();		

		} elseif ($p === 'materials.addProduct') {

			$controller = new \App\Controller\MaterialsController();

			$controller->addProduct();		

		} elseif ($p === 'materials.addMark') {

			$controller = new \App\Controller\MaterialsController();

			$controller->addMark();

		} elseif ($p === 'materials.addModel') {

			$controller = new \App\Controller\MaterialsController();

			$controller->addModel();

		} elseif ($p === 'materials.addType') {

			$controller = new \App\Controller\MaterialsController();

			$controller->addType();					

		} elseif ($p === 'materials.addImgModel') {

			$controller = new \App\Controller\MaterialsController();

			$controller->addImgModel();

	// EDIT //
	
		} elseif ($p === 'materials.edit') {

			$controller = new \App\Controller\MaterialsController();

			$controller->editMaterials();

		} elseif ($p === 'materials.editmat') {		

			$controller = new \App\Controller\MaterialsController();

			$controller->editmat();		

		} elseif ($p === 'materials.editmatlier') {		

			$controller = new \App\Controller\MaterialsController();

			$controller->editmatlier();		

		} elseif ($p === 'materials.editProduct') {

			$controller = new \App\Controller\MaterialsController();

			$controller->editProduct();

		} elseif ($p === 'materials.editMark') {

			$controller = new \App\Controller\MaterialsController();

			$controller->editMark();

		} elseif ($p === 'materials.editModel') {

			$controller = new \App\Controller\MaterialsController();

			$controller->editModel();

		} elseif ($p === 'materials.editType') {

			$controller = new \App\Controller\MaterialsController();

			$controller->editType();				

	// SELECT //
		
		} elseif ($p === 'materials.selectFamily') {

			$controller = new \App\Controller\MaterialsController();
			
			$controller->selectFamily();

		} elseif ($p === 'materials.selectProduct') {

			$controller = new \App\Controller\MaterialsController();
			
			$controller->selectProduct();		

		} elseif ($p === 'materials.selectMark') {

			$controller = new \App\Controller\MaterialsController();
			
			$controller->selectMark();

		} elseif ($p === 'materials.selectModel') {

			$controller = new \App\Controller\MaterialsController();

			$controller->selectModel();

		} elseif ($p === 'materials.selectType') {

			$controller = new \App\Controller\MaterialsController();

			$controller->selectType();		

	// CHECKED (verifié) //
		
		} elseif ($p === 'materials.checkedFamily') {

			$controller = new \App\Controller\MaterialsController();
			
			$controller->checkedFamily();

		} elseif ($p === 'materials.checkedProduct') {

			$controller = new \App\Controller\MaterialsController();
			
			$controller->checkedProduct();		

		} elseif ($p === 'materials.checkedMark') {

			$controller = new \App\Controller\MaterialsController();
			
			$controller->checkedMark();

		} elseif ($p === 'materials.checkedModel') {

			$controller = new \App\Controller\MaterialsController();

			$controller->checkedModel();

		} elseif ($p === 'materials.checkedImgModel') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->checkedImgModel();

		} elseif ($p === 'materials.checkedType') {

			$controller = new \App\Controller\MaterialsController();

			$controller->checkedType();					
		
		} elseif ($p === 'materials.checkedMateLier') {

			$controller = new \App\Controller\MaterialsController();

			$controller->checkedMateLier();

		} elseif ($p === 'materials.checkedstatut') {

			$controller = new \App\Controller\MaterialsController();

			$controller->checkedStatut();

	// FIND (trouver) //
	
		} elseif ($p === 'materials.findProduit') {

			$controller = new \App\Controller\MaterialsController();

			$controller->findProduct();
	
		} elseif ($p === 'materials.findtype') {

			$controller = new \App\Controller\MaterialsController();

			$controller->findType();

		} elseif ($p === 'materials.findnumserie') {

			$controller = new \App\Controller\MaterialsController();

			$controller->findNumSerie();

		} elseif ($p === 'materials.findseriegener') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->findSerieGener();
		
		} elseif ($p === 'materials.findnuminvent') {

			$controller = new \App\Controller\MaterialsController();

			$controller->findNumInvent();
		
		} elseif ($p === 'materials.findDataMate') {

			$controller = new \App\Controller\MaterialsController();

			$controller->findDataMate();

		} elseif ($p === 'materials.findDelProduct') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->findDelProduct();

		} elseif ($p === 'materials.findDelMark') {

			$controller = new \App\Controller\MaterialsController();

			$controller->findDelMark();

		} elseif ($p === 'materials.findDelModel') {

			$controller = new \App\Controller\MaterialsController();

			$controller->findDelModel();

		} elseif ($p === 'materials.findDelType') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->findDelType();
	
		} elseif ($p === 'materials.findMateSecond') {

			$controller = new \App\Controller\MaterialsController();

			$controller->materialsNonLier();

		} elseif ($p === 'materials.findMatePrimary') {

			$controller = new \App\Controller\MaterialsController();

			$controller->findMatePrimary();					

	// VIEW //		
	
		} elseif ($p === 'materials.PMMT') {

			$controller = new \App\Controller\MaterialsController();

			$controller->PMMT();				
		
		} elseif ($p === 'materials.viewProduct') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewProduct();
		
		} elseif ($p === 'materials.viewMark') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewMark();
		
		} elseif ($p === 'materials.viewModel') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewModel();
		
		} elseif ($p === 'materials.viewType') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewType();				
		
		// PDF //
		
		} elseif ($p === 'materials.viewAllPdf') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewAllPdf(); 
		
		} elseif ($p === 'materials.viewMateSelectPdf') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewMateSelectPdf();
		
		} elseif ($p === 'materials.viewPdfRebus') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewPdfRebus();
		
		} elseif ($p === 'materials.mateLierPdf') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewMateLierPdf();
		
		} elseif ($p === 'materials.mateLierAllPdf') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewMateLierAllPdf();		
		
		} elseif ($p === 'materials.mateLierSelectPdf') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewMateLierSelectPdf();

		} elseif ($p === 'materials.mateContratPdf') {

			$controller = new \App\Controller\MaterialsController();

			$controller->ViewMateContratPdf();	

	// SCRAP MAT //
	
		} elseif ($p === 'materials.scrap') {

			$controller = new \App\Controller\MaterialsController();

			$controller->scrapMate();	

	// DELETE //
	
		} elseif ($p === 'materials.delete') {

			$controller = new \App\Controller\MaterialsController();

			$controller->deleteMate();

		} elseif ($p === 'materials.deleteProduct') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->deleteProduct();

		} elseif ($p === 'materials.deleteMark') {  

			$controller = new \App\Controller\MaterialsController();

			$controller->deleteMark();

		} elseif ($p === 'materials.deleteModel') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->deleteModel();

		} elseif ($p === 'materials.deleteType') { 

			$controller = new \App\Controller\MaterialsController();

			$controller->deleteType();		

		} elseif ($p === 'materials.deleteMateLierCont') {

			$controller = new \App\Controller\MaterialsController();

			$controller->deleteMateLierCont();

// LEVEL / NIVEAU //

	} elseif ($p === 'levels.addLevel') {

		$controller = new \App\Controller\LevelsController();

		$controller->addLevel();

	} elseif ($p === 'levels.editLevel') {

		$controller = new \App\Controller\LevelsController();

		$controller->editLevel();

	} elseif ($p === 'levels.selectLevel') {

		$controller = new \App\Controller\LevelsController();

		$controller->selectLevel();

	} elseif ($p === 'levels.selectLevelMateLier') {

		$controller = new \App\Controller\LevelsController();

		$controller->selectLevelMateLier();

	} elseif ($p === 'levels.checkedLevel') {

		$controller = new \App\Controller\LevelsController();

		$controller->checkedLevel();

	} elseif ($p === 'levels.viewLevel') {

		$controller = new \App\Controller\LevelsController();

		$controller->ViewLevel();

// PLACE / LIEUX //

	} elseif ($p === 'places.selectPlace') {

		$controller = new \App\Controller\PlacesController();

		$controller->selectPlace();

	} elseif ($p === 'places.selectPlaceMateLier') {

		$controller = new \App\Controller\PlacesController();

		$controller->selectPlaceMateLier();

	} elseif ($p === 'places.DisplacePlace') {

		$controller = new \App\Controller\PlacesController();

		$controller->displaceplace();

	} elseif ($p === 'places.addPlace') {

		$controller = new \App\Controller\PlacesController();

		$controller->addPlace();

	} elseif ($p === 'places.editPlace') {

		$controller = new \App\Controller\PlacesController();

		$controller->editPlace();

	} elseif ($p === 'places.checkedPlace') {

		$controller = new \App\Controller\PlacesController();

		$controller->checkedPlace();

	} elseif ($p === 'places.LevelPlace') {

		$controller = new \App\Controller\PlacesController();

		$controller->LevelPlace();

	} elseif ($p === 'places.viewPlace') {

		$controller = new \App\Controller\PlacesController();

		$controller->ViewPlace();

// ROOM/PIECES //

	} elseif ($p === 'rooms.DisplaceRoom') {

		$controller = new \App\Controller\RoomsController();

		$controller->displaceroom();

	} elseif ($p === 'rooms.addRoom') {

		$controller = new \App\Controller\RoomsController();

		$controller->addRoom();

	} elseif ($p === 'rooms.editRoom') {

		$controller = new \App\Controller\RoomsController();

		$controller->editRoom();

	} elseif ($p === 'rooms.selectRoom') {

		$controller = new \App\Controller\RoomsController();

		$controller->selectRoom();

	} elseif ($p === 'rooms.checkedRoomBind') {

		$controller = new \App\Controller\RoomsController();

		$controller->checkedRoomBind();

	} elseif ($p === 'rooms.checkedRoom') {

		$controller = new \App\Controller\RoomsController();

		$controller->checkedRoom();

	} elseif ($p === 'rooms.viewRoom') {

		$controller = new \App\Controller\RoomsController();

		$controller->ViewRoom();

	} elseif ($p === 'rooms.deleteRoom') {

		$controller = new \App\Controller\RoomsController();

		$controller->deleteRoom();	

// ARMOIRES //

	} elseif ($p === 'armoires') {

			$controller = new \App\Controller\ArmoiresController();

			$controller->armoire();

	} elseif ($p === 'armoires.addArm') {

		$controller = new \App\Controller\ArmoiresController();

		$controller->addArm();

	} elseif ($p === 'armoires.editArm') {

			$controller = new \App\Controller\ArmoiresController();

			$controller->editArm();

	} elseif ($p === 'armoires.selectArmoire') {

			$controller = new \App\Controller\ArmoiresController();

			$controller->selectArm();

	} elseif ($p === 'armoires.checkedArm') {

			$controller = new \App\Controller\ArmoiresController();

			$controller->checkedArm();

	} elseif ($p === 'armoires.findArmoire') {

			$controller = new \App\Controller\ArmoiresController();

			$controller->findArmoire();	

	} elseif ($p === 'armoires.viewArmoire') {

			$controller = new \App\Controller\ArmoiresController();

			$controller->ViewArmoire();	

// PANNES //
	
	} elseif ($p === 'pannes') {

		$controller = new \App\Controller\PannesController();

		$controller->pannes();
	
	} elseif ($p === 'pannes.all') {

		$controller = new \App\Controller\PannesController();

		$controller->pannesAll();
	
	} elseif ($p === 'pannes.affPanne') {

		$controller = new \App\Controller\PannesController();

		$controller->affPanne();

	} elseif ($p === 'pannes.pannesAttRep') {

		$controller = new \App\Controller\PannesController();

		$controller->pannesAttenteRep();

	} elseif ($p === 'pannes.attenterep') { 

		$controller = new \App\Controller\PannesController();

		$controller->attenterep();

	} elseif ($p === 'pannes.pannesVolets') { 

		$controller = new \App\Controller\PannesController();

		$controller->pannesAttenteRepVolets();
	
	} elseif ($p === 'pannes.attenterepvolet') { 

		$controller = new \App\Controller\PannesController();

		$controller->attenterepvolet();
	
	} elseif ($p === 'pannes.add') {

		$controller = new \App\Controller\PannesController();

		$controller->addPanne();
	
	} elseif ($p === 'pannes.edit') {

		$controller = new \App\Controller\PannesController();

		$controller->editPanne();
	
	} elseif ($p === 'pannes.mate') {

		$controller = new \App\Controller\PannesController();

		$controller->panneMate();	

	} elseif ($p === 'pannes.findPanneMate') {

		$controller = new \App\Controller\PannesController();

		$controller->findPanneMate();
	
	} elseif ($p === 'pannes.findDataPanne') {

		$controller = new \App\Controller\PannesController();

		$controller->findDataPanne();

	} elseif ($p === 'pannes.findDataPanneMate') {

		$controller = new \App\Controller\PannesController();

		$controller->findDataPanneMate();
	
	} elseif ($p === 'pannes.findEtatPanne') { // ********AVerif**********//

		$controller = new \App\Controller\PannesController();

		$controller->findEtatPanne();
	
	} elseif ($p === 'pannes.checkedPanne') {

		$controller = new \App\Controller\PannesController();

		$controller->checkedPanne();
	
	} elseif ($p === 'pannes.nbrPannesMate') {

		$controller = new \App\Controller\PannesController();

		$controller->NbrPannesMate();
	
	} elseif ($p === 'pannes.changeMate') {

		$controller = new \App\Controller\PannesController();

		$controller->ChangeMate();

	// *****PDF*****//
	
	} elseif ($p === 'pannes.viewPannePdf') {

		$controller = new \App\Controller\PannesController();

		$controller->viewPannePdf();

	} elseif ($p === 'pannes.viewPanneVoletsPdf') {

		$controller = new \App\Controller\PannesController();

		$controller->viewPanneVoletsPdf();	

// DEVIS / QUOTATION //	
	
	} elseif ($p === 'quotation') { 

		$controller = new \App\Controller\QuotationsController();

		$controller->quotation();	
	
	} elseif ($p === 'quotation.all') { 

		$controller = new \App\Controller\QuotationsController();

		$controller->quotationAll();	
	
	} elseif ($p === 'quotation.affpendingquote') { 

		$controller = new \App\Controller\QuotationsController();

		$controller->affpendingquote();	
	
	} elseif ($p === 'quotation.pendingquote') { 

		$controller = new \App\Controller\QuotationsController();

		$controller->pendingquote();	
	
	} elseif ($p === 'quotation.edit') { 

		$controller = new \App\Controller\QuotationsController();

		$controller->editQuota();	
	
	} elseif ($p === 'quotation.NbrQuota') { 

		$controller = new \App\Controller\QuotationsController();

		$controller->nbrQuota();	
	
	} elseif ($p === 'quotation.nbrdenyquota') { 

		$controller = new \App\Controller\QuotationsController();

		$controller->nbrDenyQuota();	
	
	} elseif ($p === 'quotation.countquotat') {

		$controller = new \App\Controller\QuotationsController();

		$controller->countQuotaT();	
	
	} elseif ($p === 'quotation.countquota') {

		$controller = new \App\Controller\QuotationsController();

		$controller->countQuota();	
	
	} elseif ($p === 'quotation.affquota') { 

		$controller = new \App\Controller\QuotationsController();

		$controller->affQuota();	
	
	} elseif ($p === 'quotation.etatquota') { 

		$controller = new \App\Controller\QuotationsController();

		$controller->etatQuota();	
	
	} elseif ($p === 'quotation.findDataQuotaValidate') {

		$controller = new \App\Controller\QuotationsController();

		$controller->findDataQuotaValidate();

	} elseif ($p === 'quotation.findDataQuota') {

		$controller = new \App\Controller\QuotationsController();

		$controller->findDataQuota();

// INTERVS //
	
	} elseif ($p === 'intervs') {

		$controller = new \App\Controller\IntervsController();

		$controller->intervs();
	
	} elseif ($p === 'intervs.all') {

		$controller = new \App\Controller\IntervsController();

		$controller->intervsall();	
	
	} elseif ($p === 'intervs.affIntervsPanne') {

		$controller = new \App\Controller\IntervsController();

		$controller->affIntervPanne();	
	
	} elseif ($p === 'intervs.intervsEnCours') { 

		$controller = new \App\Controller\IntervsController();

		$controller->intervsencours();
	
	} elseif ($p === 'intervs.affintervsencours') {

		$controller = new \App\Controller\IntervsController();

		$controller->affintervsencours();	
	
	} elseif ($p === 'intervs.affContribut') {

		$controller = new \App\Controller\IntervsController();

		$controller->viewsContribinterv();
	
	} elseif ($p === 'intervs.checkedInterv') {

		$controller = new \App\Controller\IntervsController();

		$controller->checkedInterv();
	
	} elseif ($p === 'intervs.stateinterv') {

		$controller = new \App\Controller\IntervsController();

		$controller->stateinterv();
	
	} elseif ($p === 'intervs.closeInterv') {

		$controller = new \App\Controller\IntervsController();

		$controller->CloseInterv();
	
	} elseif ($p === 'intervs.NbrIntervs') {

		$controller = new \App\Controller\IntervsController();

		$controller->Nbrinterv();

	} elseif ($p === 'intervs.countintervst') {

		$controller = new \App\Controller\IntervsController();

		$controller->countIntervsT();
	
	} elseif ($p === 'intervs.countintervs') {

		$controller = new \App\Controller\IntervsController();

		$controller->countIntervs();

	} elseif ($p === 'intervs.selectType') { 

		$controller = new \App\Controller\IntervsController();

		$controller->selecttype();

	} elseif ($p === 'intervs.findTypeI') {

		$controller = new \App\Controller\IntervsController();

		$controller->findtypeI();

	} elseif ($p === 'intervs.checkedStatutInterv') { 

		$controller = new \App\Controller\IntervsController();

		$controller->checkedStatutInterv();	

// INTERVS SANS PANNE //
	
	} elseif ($p === 'intervssanspanne') {

		$controller = new \App\Controller\IntervsController();

		$controller->intervssanspanne();
	
	} elseif ($p === 'intervs.allSansPanne') {

		$controller = new \App\Controller\IntervsController();

		$controller->intervsallSansPanne();

	} elseif ($p === 'intervs.affIntervsSP') {

		$controller = new \App\Controller\IntervsController();

		$controller->affIntervsp();
	
	} elseif ($p === 'intervs.NbrIntervSansPanne') { 

		$controller = new \App\Controller\IntervsController();

		$controller->Nbrintervsanspanne();	
	
	} elseif ($p === 'intervs.countintervssanspanne') { 

		$controller = new \App\Controller\IntervsController();

		$controller->countIntervsSansPanne();

	} elseif ($p === 'intervs.add') {

		$controller = new \App\Controller\IntervsController();

		$controller->addInterv();
	
	} elseif ($p === 'intervs.editInterv') { // edit interv panne & sans panne //

		$controller = new \App\Controller\IntervsController();

		$controller->editInterv();

// INTERVS LIER AUX CONTRATS DE MAINTENANCE //

	} elseif ($p === 'intervscm') {

		$controller = new \App\Controller\IntervsController();

		$controller->intervscm();

	} elseif ($p === 'intervs.allcm') {

		$controller = new \App\Controller\IntervsController();

		$controller->intervsallcm();
	 
	} elseif ($p === 'intervs.affIntervcm') {

		$controller = new \App\Controller\IntervsController();

		$controller->Affintervscm();
	
	} elseif ($p === 'intervs.NbrIntervsCM') {

		$controller = new \App\Controller\IntervsController();

		$controller->NbrintervCM();

	} elseif ($p === 'intervs.countintervcm') {

		$controller = new \App\Controller\IntervsController();

		$controller->countIntervcm(); 		
		
// EVENTS //
	
	} elseif ($p === 'events.eventsMate') {

		$controller = new \App\Controller\EventsController();

		$controller->eventsMate(); // a suprimé ??
	
	} elseif ($p === 'events.affEvent') {

		$controller = new \App\Controller\EventsController();

		$controller->affEvent();

	} elseif ($p === 'events.addEvent') {

		$controller = new \App\Controller\EventsController();

		$controller->addEvent();

	} elseif ($p === 'events.editEvent') {

		$controller = new \App\Controller\EventsController();

		$controller->editEvent();

	} elseif ($p === 'events.checkedEvent') {

		$controller = new \App\Controller\EventsController();

		$controller->checkedEvent();
	
	} elseif ($p === 'events.attachementpdf') {

		$controller = new \App\Controller\EventsController();

		$controller->attachementpdf();

// EVENTS SANS PANNE //

	} elseif ($p === 'events.affEventSP') {

		$controller = new \App\Controller\EventsController();

		$controller->affEventSP();

	} elseif ($p === 'events.AE_EventSP') {

		$controller = new \App\Controller\EventsController();

		$controller->AE_EventSP();

// EVENTS WORKS //
	
	} elseif ($p === 'events.affEventWork') {

		$controller = new \App\Controller\EventsController();

		$controller->affEventWork();	
	
	} elseif ($p === 'events.addEventWork') {

		$controller = new \App\Controller\EventsController();

		$controller->addEventWork();	
	
	} elseif ($p === 'events.editEventWork') {

		$controller = new \App\Controller\EventsController();

		$controller->editEventWork();		

// REPAIR //
	
	} elseif ($p === 'repairs.countrepairst') {

		$controller = new \App\Controller\RepairsController();

		$controller->countRepairsT();
	
	} elseif ($p === 'repairs.countrepairs') {

		$controller = new \App\Controller\RepairsController();

		$controller->countRepairs();	

// DOCUMENTS //
	
	} elseif ($p === 'documents') {

		$controller = new \App\Controller\DocumentsController();

		$controller->documentsaff();

	} elseif ($p === 'documents.afftable') {

		$controller = new \App\Controller\DocumentsController();

		$controller->documentsAffTable();
	
	} elseif ($p === 'documents.checkeddocfactachat') {

		$controller = new \App\Controller\DocumentsController();

		$controller->checkedDocFactAchat();
	
	} elseif ($p === 'documents.checkeddocCe') {

		$controller = new \App\Controller\DocumentsController();

		$controller->checkedDocCe();
	
	} elseif ($p === 'documents.addfile') {

		$controller = new \App\Controller\DocumentsController();

		$controller->addFiles();
	
	} elseif ($p === 'documents.upload') {

		$controller = new \App\Controller\DocumentsController();

		$controller->uploadF();	

	} elseif ($p === 'documents.deletefilevmc') {

		$controller = new \App\Controller\DocumentsController();

		$controller->deletefilevmc();

	} elseif ($p === 'documents.docCM') {

		$controller = new \App\Controller\DocumentsController();

		$controller->doccm();		

// FACTURE INTERV //
	
	} elseif ($p === 'factureinterv.checkeddocinterv') {

		$controller = new \App\Controller\FacturesInteController();

		$controller->checkedDocinterv();	

// FACTURE REP //
	
	} elseif ($p === 'facturerep.checkeddocfactrep') {

		$controller = new \App\Controller\FacturesRepController();

		$controller->checkedDocFactRep();	

// DAILY WORKS / TRAVAUX JOURNALIER //
	
	} elseif ($p === 'dailyWorks') {

		$controller = new \App\Controller\DailyworksController();

		$controller->dailyworks();
	
	} elseif ($p === 'dailyWorks.all') {

		$controller = new \App\Controller\DailyworksController();

		$controller->dailyworksAll();	
	
	} elseif ($p === 'dailyWorks.addDailyWorks') {

		$controller = new \App\Controller\DailyworksController();

		$controller->AddDailyworks();	
	
	} elseif ($p === 'dailyWorks.editDailyWorks') {

		$controller = new \App\Controller\DailyworksController();

		$controller->EditDailyworks();
	
	} elseif ($p === 'dailyWorks.findDataDaily') {

		$controller = new \App\Controller\DailyworksController();

		$controller->findDataDaily();

	} elseif ($p === 'dailyWorks.delete') { // DELETE //

		$controller = new \App\Controller\DailyworksController();

		$controller->DeleteDailyworks();

	} elseif ($p === 'dailyWorks.viewPdf') {

		$controller = new \App\Controller\DailyworksController();

		$controller->viewPdf();

// DAILY EVENTS //

	} elseif ($p === 'dailyEvents') {

		$controller = new \App\Controller\DailyworksController();

		$controller->dailyEvents();

	} elseif ($p === 'dailyEvents.all') {

		$controller = new \App\Controller\DailyworksController();

		$controller->dailyAll();

	} elseif ($p === 'dailyEvents.add') {

		$controller = new \App\Controller\DailyworksController();

		$controller->Addevent();

	} elseif ($p === 'dailyEvents.edit') {

		$controller = new \App\Controller\DailyworksController();

		$controller->Editevent();

	} elseif ($p === 'dailyEvents.delete') { // DELETE //

		$controller = new \App\Controller\DailyworksController();

		$controller->DeleteEvent();

	} elseif ($p === 'dailyEvents.viewPdf') {

		$controller = new \App\Controller\DailyworksController();

		$controller->viewEventsPdf();

// CATEGORIES //

	} elseif ($p === 'categories.Select') {

		$controller = new \App\Controller\DailyworksController();

		$controller->selectCategories();

	} elseif ($p === 'categories.add') {

		$controller = new \App\Controller\DailyworksController();

		$controller->AddCategorie();

// LINKS //

	} elseif ($p === 'links') {		
			
		$controller = new \App\Controller\PhoneController();

		$controller->links();		

	} elseif ($p === 'links.alllink') { 
	
		$controller = new \App\Controller\PhoneController();

		$controller->alllink();

	} elseif ($p === 'links.linkselect') { 
	
		$controller = new \App\Controller\PhoneController();

		$controller->linkselect();

	} elseif ($p === 'links.selectlink') { 
	
		$controller = new \App\Controller\PhoneController();

		$controller->selectlink();

	} elseif ($p === 'links.add') {
	
		$controller = new \App\Controller\PhoneController();

		$controller->addlink();

	} elseif ($p === 'links.edit') {
	
		$controller = new \App\Controller\PhoneController();

		$controller->editlink();

	} elseif ($p === 'links.datalinks') {	
			
		$controller = new \App\Controller\PhoneController();

		$controller->datalinks();

	} elseif ($p === 'links.delete') { 
		
		$controller = new \App\Controller\PhoneController();

		$controller->deletelink();

	} elseif ($p === 'links.ViewAllLinkIpbxPdf') { 
		
		$controller = new \App\Controller\PhoneController();

		$controller->viewalllinkipbxpdf();
	
	} elseif ($p === 'links.ViewSelectLinkIpbxPdf') {
		
		$controller = new \App\Controller\PhoneController();

		$controller->viewselectlinkipbxpdf();

// PHONES BOOK //
	
	} elseif ($p === 'phones.book') { 
		
		$controller = new \App\Controller\PhoneController();

		$controller->phonesbook();

	} elseif ($p === 'phonesbook') { 
		
		$controller = new \App\Controller\PhoneController();

		$controller->pagephonesbook();
	
	} elseif ($p === 'phones.addphonebook') { 
		
		$controller = new \App\Controller\PhoneController();

		$controller->addphonebook();
	
	} elseif ($p === 'phones.editphonebook') { 
		
		$controller = new \App\Controller\PhoneController();

		$controller->editphonebook();
	
	} elseif ($p === 'phones.deletephonebook') { 
		
		$controller = new \App\Controller\PhoneController();

		$controller->deletephonebook();
	
	} elseif ($p === 'phones.finddataphonebook') { 
		
		$controller = new \App\Controller\PhoneController();

		$controller->finddataphonebook();
	
	} elseif ($p === 'phones.checkedFields') {
		
		$controller = new \App\Controller\PhoneController();

		$controller->checkedfields();
	
	} elseif ($p === 'phones.checkedPorts') {
		
		$controller = new \App\Controller\PhoneController();

		$controller->checkedports();

	} elseif ($p === 'phones.viewAllPhoneBookPdf') {
		
		$controller = new \App\Controller\PhoneController();

		$controller->viewallphonesbookpdf();

	// HEADBAND //
	
	} elseif ($p === 'phones.bandeau') {
		
		$controller = new \App\Controller\HeadBandController();

		$controller->bandeau();
	
	} elseif ($p === 'phones.findband') {
		
		$controller = new \App\Controller\HeadBandController();

		$controller->findband();

	} elseif ($p === 'phones.addheadband') {
		
		$controller = new \App\Controller\HeadBandController();

		$controller->addband();

	} elseif ($p === 'phones.editheadband') {
		
		$controller = new \App\Controller\HeadBandController();

		$controller->editband();
	
	} elseif ($p === 'phones.selectheadband') {
		
		$controller = new \App\Controller\HeadBandController();

		$controller->selectheadband();	

// SERVICE //

	} elseif ($p === 'services') {
	
		$controller = new \App\Controller\ServiceController();

		$controller->annuservice();	

	} elseif ($p === 'services.allservices') {
	
		$controller = new \App\Controller\ServiceController();

		$controller->allservices();	

	} elseif ($p === 'services.addService') {
	
		$controller = new \App\Controller\ServiceController();

		$controller->addService();		

	} elseif ($p === 'services.editService') {
	
		$controller = new \App\Controller\ServiceController();

		$controller->editService();		

	} elseif ($p === 'services.selectService') {
		
		$controller = new \App\Controller\ServiceController();

		$controller->selectService();

	} elseif ($p === 'services.checkedService') {
		
		$controller = new \App\Controller\ServiceController();

		$controller->checkedService();

// BASE_OF_KNOWLEDGE //
		
	} elseif ($p === 'knowledges') {

		$controller = new \App\Controller\KnowledgesController();

		$controller->knowledge();

	} elseif ($p === 'knowledges.addsuject') {

		$controller = new \App\Controller\KnowledgesController();

		$controller->addsuject();

	} elseif ($p === 'knowledges.editsuject') {

		$controller = new \App\Controller\KnowledgesController();

		$controller->editsuject();

	} elseif ($p === 'knowledges.editresolution') {

		$controller = new \App\Controller\KnowledgesController();

		$controller->editresolution();

	} elseif ($p === 'knowledges.deletesuject') {

		$controller = new \App\Controller\KnowledgesController();

		$controller->deletesuject();

	} elseif ($p === 'knowledges.PanelCategories') {

		$controller = new \App\Controller\KnowledgesController();

		$controller->knowledgePanelCategories();

	} elseif ($p === 'knowledges.checkedCategorie') {

		$controller = new \App\Controller\KnowledgesController();

		$controller->knowledgecheckedCategories();

	} elseif ($p === 'knowledges.findknowledge') {

		$controller = new \App\Controller\KnowledgesController();

		$controller->findknowledge();

	} elseif ($p === 'knowledges.findresolution') {

		$controller = new \App\Controller\KnowledgesController();

		$controller->findresolution();

// BILLINGS / FACTURATION CAB MEDECINS //	

	// INTERVENTION CABINET //	

	} elseif ($p === 'intervsdoctors') {

		$controller = new \App\Controller\BillingsController();

		$controller->intervsdoctors();	

	} elseif ($p === 'billings.affinterv') {

		$controller = new \App\Controller\BillingsController();

		$controller->affTableinterv();

	} elseif ($p === 'billings.viewAllInterv') {

		$controller = new \App\Controller\BillingsController();

		$controller->viewallinterv(); // ********PDF*********//

	} elseif ($p === 'billings.viewinterv') {

		$controller = new \App\Controller\BillingsController();

		$controller->viewinterv();

	} elseif ($p === 'intervcab.addinterv') {

		$controller = new \App\Controller\BillingsController();

		$controller->addinterv();

	} elseif ($p === 'intervcab.editinterv') {

		$controller = new \App\Controller\BillingsController();

		$controller->editinterv();

	} elseif ($p === 'intervcab.findnumInterv') {

		$controller = new \App\Controller\BillingsController();

		$controller->findnuminterv();	
	
	} elseif ($p === 'billings.checkedIntervCab') {

		$controller = new \App\Controller\BillingsController();

		$controller->checkedintervcab();

	} elseif ($p === 'intervcab.deleteIntervCab') {

		$controller = new \App\Controller\BillingsController();

		$controller->deleteintervcab();

	} elseif ($p === 'billings.etatfact') { 

		$controller = new \App\Controller\BillingsController();

		$controller->etatfacture(); 

	} elseif ($p === 'intervcab.etatinterv') { 

		$controller = new \App\Controller\BillingsController();

		$controller->etatintervcab();

	} elseif ($p === 'intervcab.findvalidinterv') { 

		$controller = new \App\Controller\BillingsController();

		$controller->findvalidinterv();

	// CABINET //

	} elseif ($p === 'listpratice') {

		$controller = new \App\Controller\BillingsController();

		$controller->listpratice();

	} elseif ($p === 'billings.listcabdoctors') {

		$controller = new \App\Controller\BillingsController();

		$controller->listcabdoctors();

	} elseif ($p === 'billings.addcab') {

		$controller = new \App\Controller\BillingsController();

		$controller->addcab();

	} elseif ($p === 'billings.editcab') {

		$controller = new \App\Controller\BillingsController();

		$controller->editcab();

	} elseif ($p === 'billings.deletecab') {

		$controller = new \App\Controller\BillingsController();

		$controller->deletecab();

	} elseif ($p === 'billings.affdatacabinet') {

		$controller = new \App\Controller\BillingsController();

		$controller->affdatacabinet();

	} elseif ($p === 'billings.viewAllCabPdf') {

		$controller = new \App\Controller\BillingsController();

		$controller->viewallcabpdf();

	// LINES //

	} elseif ($p === 'lines.findlines') {

		$controller = new \App\Controller\BillingsController();

		$controller->findlines();

	} elseif ($p === 'lines.addline') {

		$controller = new \App\Controller\BillingsController();

		$controller->addline();	

	} elseif ($p === 'lines.editline') {

		$controller = new \App\Controller\BillingsController();

		$controller->editline();

	} elseif ($p === 'lines.deleteline') {

		$controller = new \App\Controller\BillingsController();

		$controller->deleteline();

	// FACTURATION //

	} elseif ($p === 'billings') {

		$controller = new \App\Controller\BillingsController();

		$controller->billings();

	} elseif ($p === 'billings.allbillings') {

		$controller = new \App\Controller\BillingsController();

		$controller->allbillings();

	} elseif ($p === 'billings.editbilling') {

		$controller = new \App\Controller\BillingsController();

		$controller->editbilling();

	} elseif ($p === 'billings.viewfact') {

		$controller = new \App\Controller\BillingsController();

		$controller->viewfact();

	} elseif ($p === 'billings.viewAllFactPdf') {

		$controller = new \App\Controller\BillingsController();

		$controller->viewallfactpdf();

	} elseif ($p === 'billings.generateBilling') {

		$controller = new \App\Controller\BillingsController();

		$controller->generatebilling();	
		
	} elseif ($p === 'billings.checkedIntervCab') {

		$controller = new \App\Controller\BillingsController();

		$controller->checkedintervcab();

	} elseif ($p === 'billings.deleteBilling') {

		$controller = new \App\Controller\BillingsController();

		$controller->deletebilling();		

// METER READING //

	} elseif ($p === 'meterreading') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->meterreading();

	} elseif ($p === 'meterreading.allmeterreading') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->allmeterreading();	

	} elseif ($p === 'meterreading.cta') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->cta();

	} elseif ($p === 'meterreading.eau') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->eau();	

	} elseif ($p === 'meterreading.extractyear') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->extractyeareau();

	} elseif ($p === 'meterreading.previousyear') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->previousyeareau();

	} elseif ($p === 'meterreading.dataeauselect') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->selectdataeau();

	} elseif ($p === 'meterreading.findlastmetereau') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->findlastmetereau();	

	} elseif ($p === 'meterreading.selectLot') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->selectlot();

	} elseif ($p === 'meterreading.addLot') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->addlot();

	} elseif ($p === 'meterreading.checkedLot') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->checkedlot();

	} elseif ($p === 'meterreading.findLot') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->findlot();

	} elseif ($p === 'meterreading.checkedyear') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->checkedyeareau();
	
	} elseif ($p === 'meterreading.allmeterreadingcta') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->allmeterreadingcta();
	
	} elseif ($p === 'meterreading.findpreviousmeter') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->findpreviousmeter();

	} elseif ($p === 'meterreading.findlastnonzeroelement') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->findlastnonzeroelement();
	
	} elseif ($p === 'meterreading.addmeter') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->addmeter();

	} elseif ($p === 'meterreading.addmetereau') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->addmetereau();

	} elseif ($p === 'meterreading.editmeter') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->editmeter();

	} elseif ($p === 'meterreading.editmetereau') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->editmetereau();
	
	} elseif ($p === 'meterreading.addmetercta') { 

		$controller = new \App\Controller\MeterReadingsController();

		$controller->addmetercta();
	
	} elseif ($p === 'meterreading.editmetercta') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->editmetercta();
	
	} elseif ($p === 'meterreading.findpreviousmetercta') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->findpreviousmetercta();
	
	} elseif ($p === 'meterreading.AllMeterReadingPdf') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->allmeterreadingpdf();
	
	} elseif ($p === 'meterreading.AllMeterReadingCtaPdf') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->allmeterreadingctapdf();

	} elseif ($p === 'meterreading.EauPdf') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->eaupdf();	
		
	} elseif ($p === 'meterreading.deleteMeter') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->deletemeter();
	
	} elseif ($p === 'meterreading.deleteMeterCta') {

		$controller = new \App\Controller\MeterReadingsController();

		$controller->deletemetercta();

// REGULATORY CONTROLS //

	}  elseif ($p === 'controls') {

			$controller = new \App\Controller\ControlsController();
	
			$controller->controls();
	
	} elseif ($p === 'controls.All') {

			$controller = new \App\Controller\ControlsController();
	
			$controller->controlsAll();

	} elseif ($p === 'controls.add') {

			$controller = new \App\Controller\ControlsController();
	
			$controller->Add();

	} elseif ($p === 'controls.edit') {

			$controller = new \App\Controller\ControlsController();
	
			$controller->Edit();

	}  elseif ($p === 'controls.find') { 

			$controller = new \App\Controller\ControlsController();
	
			$controller->findcontrol();

	} elseif ($p === 'controls.datactrl') {

			$controller = new \App\Controller\ControlsController();
	
			$controller->datactrl();

	}  elseif ($p === 'controls.planif') { 

			$controller = new \App\Controller\ControlsController();
	
			$controller->planif();

	}  elseif ($p === 'controls.verif') {

			$controller = new \App\Controller\ControlsController();
	
			$controller->verif();

	}  elseif ($p === 'controls.prestation') {

			$controller = new \App\Controller\ControlsController();
	
			$controller->prestation();	

	} elseif ($p === 'controls.viewPdf') {

			$controller = new \App\Controller\ControlsController();
	
			$controller->ViewControlPdf();

// CONTRACTS //

	}  elseif ($p === 'contracts') {

			$controller = new \App\Controller\ContractsController();
	
			$controller->contracts();
	
	} elseif ($p === 'contracts.All') {

			$controller = new \App\Controller\ContractsController();
	
			$controller->contractsAll();

	} elseif ($p === 'contracts.add') {

			$controller = new \App\Controller\ContractsController();
	
			$controller->Add();

	} elseif ($p === 'contracts.edit') {

			$controller = new \App\Controller\ContractsController();
	
			$controller->Edit();

	} elseif ($p === 'contracts.SelectContrat') {

			$controller = new \App\Controller\ContractsController();
	
			$controller->selectcontrat();

	} elseif ($p === 'contracts.checkednumcontract') {

			$controller = new \App\Controller\ContractsController();
	
			$controller->checkedcontrat();

	}  elseif ($p === 'contracts.findmatescontract') {

			$controller = new \App\Controller\ContractsController();
	
			$controller->findmatescontract();

	} elseif ($p === 'contracts.viewPdf') {

			$controller = new \App\Controller\ContractsController();
	
			$controller->ViewPdf();	  
	
// SESSION //
	
	} elseif ($p === 'destroy') {

		$controller = new \App\Controller\UserController();
		
		$controller->destroy();

// USERS //

	} elseif ($p === 'change_mp') {

		$controller = new \App\Controller\UserController();
		
		$controller->changemp();	

	} elseif ($p === 'adduser') {
		
		$controller = new \App\Controller\UserController();
		
		$controller->AddUser();

	} elseif ($p === 'users.add_user') {
		
		$controller = new \App\Controller\UserController();
		
		$controller->Add_User();

	} elseif ($p === 'users.viewall') {
		
		$controller = new \App\Controller\UserController();
		
		$controller->viewallusers();

	} elseif ($p === 'users.all') {
		
		$controller = new \App\Controller\UserController();
		
		$controller->UsersAll();

	} elseif ($p === 'users.edit_user') {
		
		$controller = new \App\Controller\UserController();
		
		$controller->EditUser();

	} elseif ($p === 'users.checked_User') {
		
		$controller = new \App\Controller\UserController();
		
		$controller->checkedUser();

	} elseif ($p === 'users.ChangeEtat_User') {
		
		$controller = new \App\Controller\UserController();
		
		$controller->ChangeEtatUser();

	} elseif ($p === 'users.delete_user') {
		
		$controller = new \App\Controller\UserController();
		
		$controller->deleteUser();

// EMAILS //	

	} elseif ($p === 'emails') {

		$controller = new \App\Controller\EmailsController();

		$controller->email();

	} elseif ($p === 'emails.all') {

		$controller = new \App\Controller\EmailsController();

		$controller->emailAll();

	} elseif ($p === 'emails.view') {

		$controller = new \App\Controller\EmailsController();

		$controller->viewemail();	

	} elseif ($p === 'emails.sendmail') {

		$controller = new \App\Controller\EmailsController();

		$controller->sendemail();
	
	} elseif ($p === 'emails.sendmailcompta') {

		$controller = new \App\Controller\EmailsController();

		$controller->sendmailcompta();
	
	} elseif ($p === 'emails.sendmailtech') {

		$controller = new \App\Controller\EmailsController();

		$controller->sendmailtech();

	} elseif ($p === 'emails.test') {

		$controller = new \App\Controller\EmailsController();

		$controller->testmail();

// PARAMETRAGES //

	} elseif ($p === 'params.email') {

		$controller = new \App\Controller\ParamsController();

		$controller->emailparams();	

	} elseif ($p === 'params.data') {

		$controller = new \App\Controller\ParamsController();

		$controller->dataparams();

	} elseif ($p === 'params.validparams') {

		$controller = new \App\Controller\ParamsController();

		$controller->validparams();

// ERRORS URL //
	} else {

		header('Location:index.php?p=home');		

	}





	  





