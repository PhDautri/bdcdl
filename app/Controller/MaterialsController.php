<?php

namespace App\Controller;

use Core\Controller\Controller;


class MaterialsController extends AppController{

	public function __construct(){

		parent::__construct();

		$this->loadModel('Material');

		$this->loadModel('Family'); 

		$this->loadModel('Product');

		$this->loadModel('Mark');

		$this->loadModel('Model');

		$this->loadModel('Type');		

	}

	/////// MATERIEL //////////////////////////////////////

		// voir le matériels  //

		public function materials(){					

			$this->render('materials.materials');

		}

		// function qui remonte toutes le matériels //
	
		public function materialsall(){
			
			$result = $this->Material->material();	
			
			$output = array("data" => $result);

			header('Content-Type: aplication/json');

			echo json_encode($output);
		}		

		// function qui remonte les données sur le matériel selectionner //
		
		public function materialSelect(){

			$mate = $this->Material->finddatamate($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($mate);
		}

		// redirige la vers la page add mat //
		
		public function addmat(){					

			$this->render('materials.addmat');

		}			

		// function qui ajoute un matériel ou matériel lier //
		
		public function addMaterial(){

			//var_dump($_POST);die();			

			if ($_POST['operation'] == "Add") {
				
				// si operation = Add //				    		
				if (!empty($_POST)) {

					if (isset($_POST['chk'])) { // verifie si chk existe //						
						$nacll = $_POST['chk'];
					} else {
						$nacll = "0";
					}

					if (isset($_POST['prop'])) { // verifie si prop existe 0=clinique 1=propriétaire //						
						$prop = $_POST['prop'];
					} else {
						$prop = "0";
					}

					if (isset($_POST['Rooms']) == false) {
						$room = NULL;
					} else {
						$room = $_POST['Rooms'];
					}

					if (isset($_POST['numcontrat']) == false) {
						$contrat = "0";
					} else {
						$contrat = $_POST['numcontrat'];
					}	

					$this->Material->create([

						'inventory' => $_POST['inventory'],
						'num_inventaire' => $_POST['NumInvent'],
						'family_id' => $_POST['family'],
						'produits_id' => $_POST['Products'],
						'marques_id' => $_POST['Marques'],
						'models_id' => $_POST['Models'],
						'types_id' => $_POST['Types_Id'],
						'num_serie' => $_POST['Num_serie'],
						'lieux_install' => $_POST['LieuxInst'],
						'date_fab' => $_POST['DateFab'],
						'date_install' => $_POST['DateInstall'],
						'arm_id' => $_POST['arm'],
						'niveau_id' => $_POST['Levels'],
						'lieux_id' => $_POST['Places'],
						'pieces_id' => $room,
						'prop' => $prop,
						'poids_charge' => $_POST['poidscharge'],
						'fluide' => $_POST['fluide'],
						'caract' => $_POST['Caract'],
						'disjoncteur' => $_POST['disj'],
						'note' => $_POST['Note'],
						'statut' => 'Actif',
						'mat_lier' => '0',
						'contrat_id' => $contrat,
						'nacelle' => $nacll	    		
					]);

				}

			} else if ($_POST['operation'] == "AddLier") {

				// si operation = AddLier //

				if (isset($_POST['inventory'])) { // verifie si inventory existe //						
					$inv = $_POST['inventory'];
				} else {
					$inv = NULL;
				}

				if (isset($_POST['Rooms']) == false) {
					$room = NULL;
				} else {
					$room = $_POST['Rooms'];
				}

				if (isset($_POST['numcontrat']) == false) {
					$contrat = "0";
				} else {
					$contrat = $_POST['numcontrat'];
				}

				if (isset($_POST['prop'])) { // verifie si prop existe 0=clinique 1=propriétaire //						
					$prop = $_POST['prop'];
				} else {
					$prop = "0";
				}

				if (!empty($_POST)) {

					$this->Material->create([

						'inventory' => $inv,
						'num_inventaire' => $_POST['NumInvent'],
						'produits_id' => $_POST['Products'],
						'marques_id' => $_POST['Marques'],
						'models_id' => $_POST['Models'],
						'types_id' => $_POST['Types_Id'],
						'num_serie' => $_POST['Num_serie'],
						'date_fab' => $_POST['DateFab'],
						'date_install' => $_POST['DateInstall'],
						'arm_id' => $_POST['arm'],
						'niveau_id' => $_POST['Levels'],
						'lieux_id' => $_POST['Places'],
						'pieces_id' => $room,
						'prop' => $prop,
						'caract' => $_POST['Caract'],
						'disjoncteur' => $_POST['disj'],
						'note' => $_POST['Note'],
						'statut' => 'Actif',
						'mat_lier' => '1',
						'contrat_id' => $contrat,
						'lier_id' => $_POST['id_mate']	    		
					]);
				
				}	

			} else if ($_POST['operation'] == "AddMulti") {				

				if (!empty($_POST)) {

					// si multiselect existe //
					$str = $_POST['multiselect']; 
					$exp = explode(",", $str); // créer un tableau
					$cnt = count($exp); // compte ne nombre d'entré dans le tableau //					

					for ($i=0; $i < $cnt ; $i++) {				
											
						$this->Material->update($exp[$i],[
							'statut' => 'Actif',
							'lier_id' => $_POST['id_mate']
						]);
						
					}
				}
				
			}			       
			
		}

		// redirige la vers la page edit mat//
		
		public function editmat(){					

			$this->render('materials.editmat');

		}	

		// function qui edit le matériel & matériel lier //
		
		public function editMaterials(){

			//var_dump($_POST);die();

			if (!empty($_POST)) {

				if (isset($_POST['inventory'])) { // verifie si inventory existe //					
					$inv = $_POST['inventory'];
				} else {
					$inv = NULL;
				}

				if (isset($_POST['prop']) == false) { // si prop n'existe pas -- matériel cabinet //
					$prop = "1";
				} else {					
					$prop = $_POST['prop'];
				}

				if (isset($_POST['Rooms']) == false) {
					$room = NULL;
				} else {
					$room = $_POST['Rooms'];
				}

				if (isset($_POST['Places']) == false) {
					$place = NULL;
				} else {
					$place = $_POST['Places'];
				}

				if (isset($_POST['numcontrat']) == false) {
					$contrat = "0";
				} else {
					$contrat = $_POST['numcontrat'];
				}

				if ($_POST['nacl'] == "NULL") {
					$nacelle = 0;
				} else {
					$nacelle = $_POST['nacl'];
				}				

				if (isset($_POST['Statut']) == false) {
					// statut n'existe pas //
					
					$this->Material->update($_POST['id_mate'],[

						'inventory' => $inv,
						'family_id' => $_POST['family'],
						'produits_id' => $_POST['id_product'],
						'marques_id' => $_POST['Marques'],
						'models_id' => $_POST['Models'],
						'types_id' => $_POST['Types_Id'],
						'lieux_install' => $_POST['LieuxInst'],
						'num_serie' => $_POST['Num_serie'],
						'date_fab' => $_POST['DateFab'],
			    		'date_install' => $_POST['DateInstall'],
			    		'arm_id' => $_POST['arm'],
			    		'niveau_id' => $_POST['Levels'],
						'lieux_id' => $place,
						'pieces_id' => $room,
						'prop' => $prop,
						'poids_charge' => $_POST['poidscharge'],
						'fluide' => $_POST['fluide'],
						'caract' => $_POST['Caract'],
						'disjoncteur' => $_POST['disj'],					
						'note' => $_POST['Note'],
						'contrat_id' => $contrat,
						'nacelle' => $nacelle
					]);									

				} else {// statut existe //					
					
					if ($_POST['Statut'] == 'Rebus') {

						$history = $_POST['history'];
						$daterebus = date('Y-m-d');

						if (isset($_POST['inventory']) == false) {
							$inventory = NULL;
						} else {
							$inventory = $_POST['inventory'];
						}

						if (isset($_POST['poidscharge']) == false) {
							$poidscharge = NULL;
						} else {
							$poidscharge = $_POST['poidscharge'];
						}

						if (isset($_POST['fluide']) == false) {
							$fluide = NULL;
						} else {
							$fluide = $_POST['fluide'];
						}

						if ($_POST['nacl'] == "NULL") {
							$nacelle = 0;
						} else {
							$nacelle = $_POST['nacl'];
						}

					} else {
						$history = NULL;
						$daterebus = NULL;
					}
					
					$this->Material->update($_POST['id_mate'],[

						'inventory' => $inventory,
						'family_id' => $_POST['family'],
						'produits_id' => $_POST['id_product'],
						'marques_id' => $_POST['Marques'],
						'models_id' => $_POST['Models'],
						'types_id' => $_POST['Types_Id'],
						'lieux_install' => $_POST['LieuxInst'],
						'num_serie' => $_POST['Num_serie'],
						'date_fab' => $_POST['DateFab'],
			    		'date_install' => $_POST['DateInstall'],
			    		'date_rebus' => $daterebus,
			    		'arm_id' => $_POST['arm'],
			    		'niveau_id' => $_POST['Levels'],
						'lieux_id' => $_POST['Places'],
						'prop' => $prop,
						'poids_charge' => $poidscharge,
						'fluide' => $fluide,
						'caract' => $_POST['Caract'],
						'disjoncteur' => $_POST['disj'],					
						'note' => $_POST['Note'],
						'statut' => $_POST['Statut'],
						'nacelle' => $nacelle,
						'contrat_id' => $contrat,
						'history' => $history
					]);
				}				

			}
		}

		// function qui remonte les volets en panne & attente envoi email //
		
		public function shutterfailure(){

			$mate = $this->Material->findvoletsfailure();

			header('Content-Type: aplication/json');

			echo json_encode($mate);

		}
		
		// FIND ////////////////////////////////////////////////////
		 
		// function qui remonte le matériel primaire //

		public function findMatePrimary() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {
				
				$matep = $this->Material->findDMPrimary($_POST['id']); // mat primary

				header('Content-Type: aplication/json');

			    echo json_encode($matep);		    
				
			}

		}
		
		// function qui verifie si le numero de serie existe déja //
		
		public function findNumSerie() {

			if (!empty($_POST['NumSerie']) ? $_POST['NumSerie'] : NULL) {

				$nserie = $this->Material->findNumserie($_POST['NumSerie']);

				header('Content-Type: aplication/json');

			    echo json_encode($nserie);		    
				
			}

		}

		// function qui remonte le nombre de numero de serie ayant un format particulier ####1 //
		
		public function findSerieGener() {

			$result = $this->Material->findseriegener();

			header('Content-Type: aplication/json');

		    echo json_encode($result);

		}

		// function qui remonte le dernier numero d'inventaire //
		
		public function findNumInvent() {			

			$result = $this->Material->findNuminvent($_POST['deb']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);		

		}

		// function recherche données matériels
		
		public function findDataMate() {

			$material = $this->Material->finddatamate($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($material);
		}		

		// AFF /////////////////////////////////////////////////////
		
		// function qui remonte le statut du matÃ©riel selectionner / id mate //
		
		public function materialstatut() {

			$result = $this->Material->findStatutMate($_POST['id']);

			header('Content-Type: aplication/json');

		    echo json_encode($result);

		}

		// CHECKED ////////////////////////////
		
		public function checkedStatut() {

			$result = $this->Material->findstatut();			

			$r = count($result);

			for ($i=0; $i < $r; $i++) { 
				
				$id = $result[$i]->id;

				$nbr = $result[$i]->nbrpa;

				if ($nbr == 0) {
					
					$this->Material->update($id,[
						'statut' => "Actif"
					]);
				}				

			}

			header('Content-Type: aplication/json');

		    echo json_encode($result);

		}

	////// MAT LIER //////////////////////////////////////////////////////////////
	
		// voir le matériels lier //

		public function materialslier(){					

			$this->render('materials.matelier');

		}

		// function qui affiche tout le matÃ©riel lier //
	
		public function materialsLierAll(){
			
			$material = $this->Material->allMaterialLier();	
			
			$output = array("data" => $material);

			header('Content-Type: aplication/json');

			echo json_encode($output);
		}

		// recherche les données sur matériel primaire & redirige la vers la page add mat //
		
		public function addmatlier(){

			$matep = $this->Material->finddatamate($_GET['id']);				

			$this->render('materials.addmatlier', compact('matep'));

		}

		// redirige la vers la page edit mat lier//
		
		public function editmatlier(){					

			$this->render('materials.editmatlier');

		}		
	
		// function qui verifie si le matériel a un matériel lier //
		
		public function checkedMateLier() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

				$result = $this->Material->checkedmatelier($_POST['id']);

				header('Content-Type: aplication/json');

			    echo json_encode($result);		    
				
			}

		}

		// function qui affiche le matériel lier au matériel par sont id //
		
		public function materialLier() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {
			
				$result = $this->Material->affmatelier($_POST['id']);

				header('Content-Type: aplication/json');

			    echo json_encode($result);
			   
			}

		}

		// function qui affiche que le matériel non lier //
		
		public function materialsNonLier() {

			$mate = $this->Material->affmatenonlier();

			header('Content-Type: aplication/json');

			echo json_encode($mate);
			
		}

		// function qui remonte le nombre de matÃ©riel lier par matÃ©riel //
		
		public function NbrMateLier() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

				$nbr = $this->Material->countnbrmatelier($_POST['id']);

				header('Content-Type: aplication/json');

			    echo json_encode($nbr);
			}
		}

	/////// MATERIEL REBUS //////////////////////////////////////

		// voir le matériels au rebus //

		public function materialsrebus(){					

			$this->render('materials.materialsrebus');

		}

		// function qui remonte tous les matériels au rebus //
	
		public function materialsAllTrash(){
			
			$material = $this->Material->MaterialTrash();	
			
			$output = array("draw"=> 1,"data" => $material);

			header('Content-Type: aplication/json');

			echo json_encode($output);
		}

		// function qui disocie le matériel avant la mise au rebus //
		
		public function materialsdiso(){

			if (!empty($_POST)) {

				// compter le nombre de valeur dans le tableau //
				
				$array = $_POST['tab'];
				$nbr = $_POST['nbr'];
				$e = 0;
				
				for ($i=0; $i < $nbr; $i++) {					 
					$id = substr($array, $i*$e, 2);
					$e = 3;								

					$this->Material->update($id,[

						'statut' => 'En Attente',
						'lier_id' => NULL

					]);
				}
			}

		}

		// function qui disocie le matériel primaire avant la mise au rebus //
		
		public function materialsdisoprim(){

			if (!empty($_POST)) {											

				$this->Material->update($_POST['id'],[
					
					'lier_id' => NULL

				]);
				
			}

		}

		// function qui met au rebus le matÃ©riel //
		
		public function scrapMate(){

			if (!empty($_POST)) {				

				$this->Material->update($_POST['id'],[

					'statut' => 'Rebus',
					'date_rebus' => date('Y-m-d'),
					'mat_lier' => '0',
					'lier_id' => NULL

				]);

			}
		}

	//////// FAMILY /////////////////////////

		// function qui remonte toute les familles pour le select //
		
		public function selectFamily() {

			$family = $this->Family->selectfamily();

			header('Content-Type: aplication/json');

			echo json_encode($family);

		}	

		// fonction qui verifie si la famille existe dans la base //
		 
		public function checkedFamily() {

			if (!empty($_POST['family'])) {
				
				$result = $this->Family->findfamily($_POST['family']);

				header('Content-Type: aplication/json');

			    echo json_encode($result);
			}

		}

		// fonction qui ajoute une famille //

		public function addFamily() {			

			if (!empty($_POST)) {			

				// ajoute la famille //				

				$this->Family->create([

				'famille' => $_POST['family']			

			   ]);			
			
			}	

		}	

	/////// PRODUCT ////////////////////////
	
		// function voir toutes les produits //

		public function ViewProduct() {

			$products = $this->Product->allproduct();

			$output = array("data" => $products);

			header('Content-Type: aplication/json');

			echo json_encode($output);			
			
		}
	
		// function qui remonte toute les produits pour le select //
		
		public function selectProduct() {

			$products = $this->Product->selectproduct($_POST['fam'],$_POST['btn']);

			header('Content-Type: aplication/json');

			echo json_encode($products);

		}				

		// fonction qui verifie si le produit existe dans la base //
		 
		public function checkedProduct() {

			if (!empty($_POST['product'])) {
				
				$products = $this->Product->findproduct($_POST['product']);

				header('Content-Type: aplication/json');

			    echo json_encode($products);
			}

		}

		// function pour rechercher le produit avec sont id //
		
		public function findProduct() {		

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

				$product = $this->Product->find($_POST['id']);

				header('Content-Type: aplication/json');

			    echo json_encode($product);		    
				
			}

		}

		// function qui remonte si le produit et lier a un matÃ©riel actif //
		
		public function findDelProduct() {

			$result = $this->Product->finddelproduct($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($result);

		}

		// function qui ajoute un produit //

		public function addProduct() {

			// ajoute le produit //
			
			if (!empty($_POST)) {

				if (empty($_POST['BTNRadio'])) { // BTNRadio n'existe pas //
					
					$this->Product->create([

						'produit' => $_POST['productadd'],
						'mat_primary' => '0',
						'mat_category' => 'E'				

					]);	

				} else { // BTNRadio existe //													

					$this->Product->create([

						'produit' => $_POST['productadd'],
						'mat_primary' => $_POST['btn'],
						'mat_category' => $_POST['BTNRadio'],
						'famille_id' => $_POST['family']				

					]);			
				}				
			
			}	

		}

		// function qui edit le produit //
		
		public function editProduct() {
			
			if (!empty($_POST['BTNRadio'])) { // BTNRadio existe //
				
				// edit le produit //
				$this->Product->update($_POST['IDProduct'],[

					'produit' => $_POST['product'],
					'mat_category' => $_POST['BTNRadio'],
					'famille_id' => $_POST['family']

				]);

			} else { // BTNRadio n'existe pas //

				// edit le produit //
				$this->Product->update($_POST['IDProduct'],[

					'famille_id' => $_POST['family'],
					'produit' => $_POST['product']	 

				]);

			}

		}

		// function qui efface le produit //
		
		public function deleteProduct() {

			$this->Product->delete($_POST['id']);
		}	

	/////// MARK ////////////////////////////
	
		// function voir toutes les marques //

		public function ViewMark() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

				$marques = $this->Mark->viewMark($_POST['id']);

				$output = array("data" => $marques);

				header('Content-Type: aplication/json');

				echo json_encode($output);
			}			
			
		}

		// fonction qui verifie si la marque existe dans la base //
		 
		public function checkedMark() {

			if (!empty($_POST['mark'])) {
				
				$marques = $this->Mark->checkedmark($_POST['mark']);

				header('Content-Type: aplication/json');

			    echo json_encode($marques);
			}

		}

		// function qui remonte si la marque et lier a un matÃ©riel actif //
		
		public function findDelMark() {

			$result = $this->Mark->finddelmark($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($result);

		}

		// fonction qui remonte toute les marques lier aux produit pour le select //
		
		public function selectMark() {

			$marks = $this->Mark->all();

			header('Content-Type: aplication/json');

			echo json_encode($marks);

		}

		// fonction qui ajoute une marque //

		public function addMark() {			

			if (!empty($_POST)) {			

				// ajoute la marque //				

				$this->Mark->create([

				'marque' => $_POST['mark']			

			   ]);			
			
			}	

		}

		// fonction qui edit la marque //
		
		public function editMark() {
			
			if (!empty($_POST)) {
				
				// edit la marque //
				$this->Mark->update($_POST['id'],[

					'marque' => $_POST['marque']

				]);
			}
		}

		// function qui efface la marque //
		
		public function deleteMark() {

			$this->Mark->delete($_POST['id']);
		}

	/////// MODEL /////////////////////////////////////
	
		// function qui affiche tous les models en fonction de la marque // 

		public function ViewModel() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

				$models = $this->Model->viewModels($_POST['id'], $_POST['idp']);

				$output = array("data" => $models);

				header('Content-Type: aplication/json');

				echo json_encode($output);		   
				
			}
		}

		// fonction pour recherche le model par rapport a la marque & au produit// 

		public function selectModel() {

			if (!empty($_POST)) {

				$models = $this->Model->findModels($_POST['idm'],$_POST['idp']);

				header('Content-Type: aplication/json');

			    echo json_encode($models);
				
			}

		}

		// function qui verifie si le model existe dans la base //
		
		public function checkedModel() {

			if (!empty($_POST['model'])) {
				
				$models = $this->Model->checkedmodel($_POST['model']);

				header('Content-Type: aplication/json');

			    echo json_encode($models);
			}
		}

		// function recherche si du matÃ©riels a ce model pour delete// 
		
		public function findDelModel() {

			$result = $this->Model->finddelmodel($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($result);
		}

		// function qui ajoute un model //
		
		public function addModel() {

			//die();	

			if(!empty($_POST)) {
				// ajoute le model //
				
				$this->Model->create([

					'produits_id' => $_POST['id_product'],

					'marques_id' => $_POST['id_mark'],

					'model' => $_POST['model']
					
				]); 
				
			}
		}

		// function qui edit le model //
		
		public function editModel(){

			if(!empty($_POST)) {

				$this->Model->update($_POST['id'],[

					'model' => $_POST['model']

				]);
			}
		}

		// function qui ajoute une image au model //
		
		public function addImgModel() {	

            if ($_FILES['fileIMGMODEL']['name']) {
            
                // image existe //          

                $image = $_FILES['fileIMGMODEL']['name'];

                $lien = '../public/img/'; // lien du dossier          

                $lienimage = $lien.$image; // reforme le lien //                

                if (file_exists($lienimage)) { // verifie si le fichier existe dans le dossier /public/img/ 
                    // si existe ont ecris rien //
                    
                } else {

                    // n'existe pas //
                    $uploadfile = $lien . basename($_FILES['fileIMGMODEL']['name']); // creer le chemin pour enrgegister le fichier //                    
                    move_uploaded_file($_FILES['fileIMGMODEL']['tmp_name'], $uploadfile); // ecris le fichier dans le dossier //

                }
            
            } else {

                // image n'existe pas //
                $lienimage = NULL;
                
            } 

            $this->Model->update($_POST['IDModel'],[

				'img' => $lienimage

			]);
		}

		// function qui verifie si une image existe pour le model / id mate//
		
		public function checkedImgModel() {

			if (!empty($_POST['id'])) {
				
				$img = $this->Model->checkedimgmodel($_POST['id']);

				header('Content-Type: aplication/json');

			    echo json_encode($img);
			}

		}

		// function qui efface le model //
		
		public function deleteModel() {

			$this->Model->delete($_POST['id']);
		}

	/////// TYPE ////////////////////////////////////
	
		// function qui affiche tous les types form markmodeltype en fonction du model (id model)//
		
		public function ViewType() {

			if (!empty($_POST['id']) ? $_POST['id'] : NULL) {

				$types = $this->Type->viewType($_POST['id']);

				$output = array("data" => $types);

				header('Content-Type: aplication/json');

				echo json_encode($output);

			}

		}	
		
		// function qui remonte les types en fonction de la marque //
		
		public function selectType() {

			$types = $this->Type->findSelectTypes($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($types);

		}

		// function qui verifie si le model existe dans la base //
		
		public function checkedType() {

			if (!empty($_POST['type'])) {
				
				$types = $this->Type->checkedtype($_POST['type']);

				header('Content-Type: aplication/json');

			    echo json_encode($types);
			}
			
		}	

		// function pour rechercher le type par rapport au model //
		
		public function findType() {		

			if (!empty($_POST['modelId']) ? $_POST['modelId'] : NULL) {

				$types = $this->Type->findTypes($_POST['modelId']);

				header('Content-Type: aplication/json');

			    echo json_encode($types);		    
				
			}

		}

		// function recherche si du matÃ©riels a ce type pour delete// 
		
		public function findDelType() {

			$result = $this->Type->finddeltype($_POST['id']);

			header('Content-Type: aplication/json');

			echo json_encode($result);
		}

		// function qui ajoute un type au model //
		
		public function addType() {

			if (!empty($_POST)) {

				if ($_POST['direct'] === "update") {
					
					// update le model //
					
					$this->Model->update($_POST['id_model'],[

						'types_id' => $_POST['id_type']
					]);

				} elseif ($_POST['direct'] === "add") {							

					// ajoute le type //
				
					$this->Type->create([

						'type' => $_POST['type']
					]);

					// récupére le dernier type créer //					

					$id_type = $this->Type->findIdType();

					// mise a jour de model //
						
					$this->Model->update($_POST['id_model'],[

						'types_id' => $id_type[0]->id
					]);

				}
				
			}
		}

		// function qui edit le type //
		
		public function editType(){			

			if(!empty($_POST)) {

				$this->Type->update($_POST['id'],[

					'type' => $_POST['type']

				]);
			}
		}

		// function qui efface le type //
		
		public function deleteType() {

			$this->Type->delete($_POST['id']);
		}
	
	////// DELETE ////////////////////////////////////////////////////////////////
	
		// efface deffinitivement le matériel de la base /********A Terminé************/
		
		public function deleteMate(){

			var_dump($_POST);
		}

		// efface le champ contrat_id dans materiels //
		
		public function deleteMateLierCont() {

			$this->Material->update($_POST['id'],[

				'contrat_id' => "0"

			]);
		}

	////// PMMT ////////////////////////////////////////////////////////////////		

		// function qui affiche la page voir marque model type //
		
		public function PMMT(){

			$page = 'MarkModelType';

			$this->render('materials.pmmt', compact('page'));	

		}

	///////////////////////////////  PDF //////////////////////////////////////
	
		// function qui affiche tous le matériels en pdf //
		
			public function ViewAllPdf(){					

				$this->render('materials.mateallpdf');

			}

		// function qui affiche le matériel selectionner en pdf//
		
			public function ViewMateSelectPdf(){					

				$this->render('materials.mateselectpdf');

			}	
			
		// function qui affiche le matériel lier au matériel primary en pdf //
		
			public function ViewMateLierPdf(){

				$this->render('materials.matelierpdf');
			}

		// function qui affiche tous le matériels lier en pdf //
		
			public function ViewMateLierAllPdf(){

				$this->render('materials.matlierallpdf');
			} 
		

		// function qui affiche le matériel selectionner lier en pdf //
		
			public function ViewMateLierSelectPdf(){

				$this->render('materials.matelierselectpdf');
			}

		// function qui affiche le matériel mise au rebus en pdf //
		
			public function ViewPdfRebus(){

				$this->render('materials.mateallrebuspdf');
			}

		// function qui affiche le matériel lier au contrat en pdf //
		
			public function ViewMateContratPdf(){

				$id = $_GET['id'];

				$this->render('contracts.matecontratpdf', compact('id'));
			}
}


