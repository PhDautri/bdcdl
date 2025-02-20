<?php //var_dump($_GET); ?>

<div class="row">

<!-- Affichage du matériel  -->
	<div class="AffEventsMate col-sm-12">

    <div class="showback col-sm-12">
      <div class="col-sm-6">
        <h3>Matériel</h3>
        <p><?=$mate[0]->num_inventaire; ?> - <?=$mate[0]->mate; ?></p>
        <h3>Date Fabrication</h3><p><?= $mate[0]->datefabfr; ?></p>          
        <h3>Date Installation</h3><p><?= $mate[0]->dateinstallfr; ?></p>
        <h3>Caractéristique</h3>
        <p><?=$mate[0]->carac; ?></p>
        
      </div>
      <div class="col-sm-6">
        <h3>Zone Alimenté</h3>
        <p><?= $mate[0]->lieux; ?> - <?=$mate[0]->niveau; ?></p>
        <h3>Niveau - Lieux Installé</h3>
        <p><?=$mate[0]->lieux_install; ?> </p>
        <h3>Notes</h3>
        <p><?=$mate[0]->note; ?></p>
      </div>
    </div>

		<input type="hidden" id="IDpanne" name="IDpanne" value="<?= $_GET['id']; ?>"> <!--hidden -->
	    <input type="hidden" id="etatpanne" name="etatpanne" value="<?= $_GET['etatp']; ?>"> <!-- hidden -->	    

	    <!-- affiche la navs -->
	    <div class="AffNavs2 col-md-12">        
	        <div class="bs-example" data-example-id="simple-nav-justified">   
	          <ul class="nav nav-pills nav-justified"> 
	            <li role="presentation3"><a href="#" data-role="VEventsPanne">Evénements Panne</a></li> 
	            <li role="presentation4"></li>
	          </ul> 
	        </div>
	    </div>            
	  
	    <!-- Affichage des evenement pannes -->
	    <div class="AffEvents hidden">

	      <h3 id="title_event" class="col-lg-6"></h3>
	       <!-- affichage alert -->
	      <div class="col-lg-9">
	          <div id="info_event" class="" role="alert"></div>  
	      </div>

	      <br>

	      <div id="TableEventPanne">
	           <!-- Affichage de la table evenement panne matériel -->   
	      </div>

	    </div>      
	</div>

	<!-- Affichage de l'intervenant et des boutons  et les interventions -->
      <section id="Ancre2">
        <div class="AffContribu col-md-3 hidden">

          <h3>Intervenant</h3>
          <address>
            <p><strong id="nom"></strong></p>
            <p id="adresse"></p>
            <p id="lieux"></p>
            <p id="numphone"></p>
            <a id="email"></a>
          </address>

          <input type="hidden" id="IdContribu" name="IdContribu">                    

            <!-- BON INTERV -->
          
            <button type="button" data-role="uploadfile" data-b="BI" class="AffAddBI btn btn-success col-md-12">add Bon Intervention</button>

            <object type="application/pdf" width="100%" height="800px">      
              <a href="" target="_blank" id="viewPdfBI" class="AffViewBI btn btn-success col-md-9">View Bon Intervention</a>
              <button type="button" class="AffViewBI btn btn-theme col-md-3" data-role="uploadfile" data-b="BI"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>
            </object>

            <!-- FACTURE INTERVENTION --> 

            <button type="button" data-role="uploadfile" data-b="FI" class="AffAddFI btn btn-primary col-md-12">add Facture Intervention</button> 
            
            <object type="application/pdf" width="100%" height="800px">      
              <a href="" target="_blank" id="viewPdfFI" class="AffViewFI btn btn-primary col-md-9">View Facture Intervention</a>
              <button type="button" class="AffViewFI btn btn-theme col-md-3" data-role="uploadfile" data-b="FI"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>
            </object> 

            <!-- DEVIS -->

            <button type="button" data-role="uploadfile" data-b="DE" class="AffAddDE btn btn-danger col-md-12">add Devis</button>

            <object type="application/pdf" width="100%" height="800px">      
              <a href="" target="_blank" id="viewPdfDE" class="AffViewDE btn btn-danger col-md-9">View Devis</a>
              <button type="button" class="AffViewDE btn btn-theme col-md-3" data-role="uploadfile" data-b="DE"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>
            </object>                
          
        </div>

        <!-- AFFICHE TOUTES LES INTERVENTIONS OU UNE SEUL-->
      
        <div class="AffIntervs hidden">

          <!-- affichage des intervention des pannes du matériel-->
          <div class="col-md-12">
            <div class="col-md-5">
              <h2 id="h2Interv"></h2>
            </div>             
          </div>

          <div class="col-md-12">                     
             <!-- affichage alert -->
            <div class="col-md-5" >
              <div id="info_interv" class="" role="alert"></div>  
            </div>
            <input type="hidden" id="IDinterv" name="IDinterv"> <!-- hidden -->
          </div>

          <!-- Affichage des pannes du matériel -->
          <div class="col-md-12">          
            
            <div id="TableIntervPanne">

              <!-- Affichage de la table intervention des pannes du matériels -->

            </div>        

          </div>

        </div>        
        
      </section>

	  <div id="Ancre3" class="col-lg-12">  
    
      <a href="javascript:history.go(-1);" class="btn btn-default"><span class="glyphicon  glyphicon-arrow-left"></span> Retour</a>
    
  	</div>
  	
</div>

