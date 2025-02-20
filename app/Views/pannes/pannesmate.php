<div class="row">  
  <div class="AffDataMate col-sm-12">      
    <input type="hidden" name="CateProduit" id="CateProduit" /> <!-- hidden -->
    <input type="hidden" name="Family" id="Family" /> <!-- hidden -->
    <input type="hidden" id="IDmate" name="IDmate" class="col-lg-2" value="<?= $_GET['id']; ?>" class="col-lg-2"> <!-- hidden id matériel-->
    <input type="hidden" id="IDmatep" name="IDmatep" class="col-lg-2"> <!-- hidden id matériel primaire-->
    <input type="hidden" id="Propi" name="Propi" class="col-lg-2"> <!-- hidden propriétaire-->

    <!-- affichage pannes matériels  -->
    <div class="showback col-sm-12">
      <!-- affiche le matériel parent ou lier -->
      <div class="col-sm-3">
        <h3 id="num_invent"></h3>
        <p id="mate"></p>
        <p id='numserie'></p>     

        <!-- affiche le matériel parent lier au matériel Enfant -->  
        <div class="AffMatP">
          <h3 id="num_inventP"></h3>
          <p id="matep"></p>
          <p id="Nums_St"></p>
        </div>

        <div>
          <h3><span style="text-decoration: underline;">Date Fabrication</span></h3><p id="datefab"></p>          
          <h3><span style="text-decoration: underline;">Date Installation</span></h3><p id="dateinst"></p>
          <h3><span style="text-decoration: underline;">Armoire & Disjoncteur</span></h3><p id="armdisj"></p>          
        </div>      
      </div>      

      <!-- caract zone alim / niveau lieux install / notes / contrat -->
      <div class="col-sm-3">
        <div>
          <h3>
            <span id="btnCTM" style="text-decoration: underline;">Caractéristique </span>            
          </h3>
          <p id="d"></p>
        </div>
        <div id="Za"><h3><span style="text-decoration: underline;">Zone Alimenté</span></h3><p id="za"></p></div>        
        <div id="Nli"><h3><span style="text-decoration: underline;">Niveau - Lieux Installé</span></h3><p id="nli"></p></div>
        <div id="Pi"><h3><span style="text-decoration: underline;">Piéce</span></h3><p id="piece"></p></div>        
        <div id="Nte" class=""></div>
        <div id="contrat" class="hidden"></div>
      </div>

      <!-- image model materiel -->
      <div class="AffbtnImg col-sm-3">        
        <div class="AffImgMat col-sm-3"></div>
      </div>      
      
      <!-- affichage des montant total devis - interv - repair - du matériel --> 
      <div class="col-sm-3">
        <div id="mtd"></div>
        <div id="mti"></div>
        <div id="mtr"></div>
        <div id="mtm"></div>
        <div>
          <button class="AffAddFA btn btn-success col-md-12 hidden" data-role="addfile" data-b="FA" type="button">add Facture Achat</button>
          <a href="" target="_blank" id="viewPdfFA" class="AffViewFA btn btn-info col-md-9 hidden">View Facture Achat</a>
          <button type="button" id="changeFA" class="AffViewFA btn btn-theme col-md-3 hidden" data-role="uploadfile" data-b="FA"<abbr title="Changer de document">
          <i class="fa fa-refresh"></i>
          </abbr></button>
          <h3 id="MontantAchat"></h3>
        </div>
      </div>         
    </div>  

    <section id="Ancre1">
      <!-- affichage onglets panne / interv / mat lier / Interv / contrat maintenance -->
      <div class="bs-example col-lg-12" data-example-id="simple-nav-justified">   
        <ul class="nav nav-pills nav-justified"> 
          <li role="presentation1"></li>
          <li role="presentation3"></li> 
          <li role="presentation2"></li>          
          <li role="presentation4"></li>
        </ul> 
      </div>        

      <!-- PANNES MAT -->
      <div class="AffPannes hidden">
        <input type="hidden" id="IDPanne" name="IDPanne"> <!-- id de la panne selectionner hidden -->
        <!-- affichage des pannes du matériel -->
        <div class="col-sm-12">
          <div class="col-sm-3">
            <h2 class="h2Panne"></h2>
          </div>
          <!-- affichage alert -->
          <div class="col-sm-4" >
            <div id="info_panne" class="" role="alert"></div>  
          </div>
          <!-- affichage email envoyer -->
          <div class="col-sm-4">
            <div id="info_emailP" class="" role="alert"></div>  
          </div>             
        </div>

        <!-- Affichage table  pannes du matériel -->
        <div class="col-lg-12">          
          <!-- Affichage de la table pannes du matériels -->
          <div id="TablePanneMate"></div>
        </div>
      </div>

      <!-- MAT LIER -->
      <div class="AffMatesLier  hidden">        
        <!-- affichage btn -->
        <div class="col-sm-12">
          <div class="col-sm-6">
            <h2>Matériel(s) Lier  <button id="btnAddMatLier" class="btn btn-round btn-success" data-role="AddMaterialLier" data-id="<?= $_GET['id']; ?>"<abbr title="Ajouter un matériel à lier"><span class="glyphicon glyphicon-plus"></span></abbr></button>
            <a class="ViewPdf btn btn-round btn-default" target="_blank" data-role="ViewPdfMateLier"<abbr title="Créer un PDF">PDF</abbr></a></h2>         
          </div>
        </div>
        <div class="col-lg-6" id="info_matelier"></div>
        <!-- Affichage du matériel lier-->
        
        <div class="col-lg-12">         
          <!-- Affichage de la table matériels lier-->
          <table id="TableMateLier" class="table table-hover" style="width:100%">
            <thead>
              <tr class="odd" style="font-weight:bold;">            
                <th>Id</th>
                <th>N° Inventaire</th>
                <th>Produit</th>
                <th>Marque</th>
                <th>Model</th>
                <th>Type</th>
                <th>N° Série</th>
                <th>Niveau</th>
                <th>Piéce</th>
                <th>Statut</th>
                <th>Montant Total Réparation</th>
                <th>Total Pannes</th>
                <th>Actions</th>
              </tr>
            </thead>            
          </table>                 
        </div>
      </div>
    </section>      

  </div>

  <!-- affichage des montant total devis interv repair de la panne -->
  <div class="AffMontant">
    <div class="showback col-sm-4 showbackmd">
      <div class="col-sm-12" id="md"></div>  
    </div>

    <div class="showback col-sm-4 showbackmi">
      <div class="col-sm-12" id="mi"></div>
    </div>

    <div class="showback col-sm-4 showbackmr">
      <div class="col-sm-12" id="mr"></div>
    </div>  
  </div>

  <div class="AffDataPanne hidden col-lg-12">
    
    <!-- affiche la navs onglets Event / interv -->
    <div class="AffNavs2 hidden col-md-12">        
      <div class="bs-example" data-example-id="simple-nav-justified">   
        <ul class="nav nav-pills nav-justified"> 
          <li role="presentation5"><a href="#" data-role="VEventsPanne">Evénements Panne</a></li> 
          <li role="presentation6"></li>
          <li role="presentation7"></li>
        </ul> 
      </div>
    </div>                 
      
    <!-- Affichage des evenement pannes -->
    <div class="AffEvents hidden col-lg-12">
      <div class="col-sm-12">
        <div class="col-lg-4">
          <h3 id="title_event"></h3>
        </div>
        <!-- affichage alert -->
        <div class="col-lg-4">
          <div id="info_event" class="" role="alert"></div>  
        </div>
        <!-- affichage alert -->
        <div class="col-lg-4">
          <div id="info_emailE" class="" role="alert"></div>  
        </div>
      </div>
      <br>
      <!-- Affichage de la table evenement panne matériel -->
      <div id="TableEventPanne">              
        <table id="TableEvent" class="table table-hover table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Id</th>           
              <th>Date</th>
              <th>Heure</th>
              <th>Evénement</th>
              <th>Désignation</th>
              <th>Créer par</th>                                          
              <th>Actions</th>            
            </tr>
          </thead>
        </table>  
      </div>
    </div>

    <!-- affichage envoi email -->
    <div class="AffSendMail hidden">
      <div class="row mt">  
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading wht-bg">
              <h4 class="gen-case">Compose Email</h4>
            </header>
            <div class="panel-body">
              <div class="compose-mail">
                <form role="form-horizontal" data-toggle="validator" id="SendMail" method="post">
                  <div class="form-group">

                    <div class="AffSelectContribut">
                      <div class="form-group">           
                        <label for="Contributors" class="control-label">Intervenant:</label>         
                        <div class="input-group col-md-5">                                      
                          <select class="form-control" name="Contributors" id="Contributors" required="required"></select>                   
                        </div>
                      </div>
                    </div>

                    <div class="AffSelectEmail">
                      <div class="form-group">
                        <label for="EmailEvent" class="control-label">Email:</label>                      
                        <div class="input-group col-md-5">                                        
                          <select class="form-control" name="to" id="to" required="required"></select>
                          <span class="input-group-btn"><button class="btn btn-theme" name="btnAddContact" data-role="addContact" data-btn="email" type="button">Add Contact</button></span>                         
                        </div>  
                      </div>
                    </div>

                    <div class="compose-options">
                      <a onclick="$(this).hide(); $('#cc').parent().removeClass('hidden'); $('#cc').focus();" href="javascript:;">Cc</a>
                      <a onclick="$(this).hide(); $('#bcc').parent().removeClass('hidden'); $('#bcc').focus();" href="javascript:;">Bcc</a>
                    </div>
                  </div>
                  <div class="form-group hidden">
                    <label for="cc" class="">Cc:</label>
                    <input type="text" tabindex="2" id="cc" name="cc" class="form-control">
                  </div>
                  <div class="form-group hidden">
                    <label for="bcc" class="">Bcc:</label>
                    <input type="text" tabindex="2" id="bcc" name="bcc" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="subject" class="">Sujet:</label>
                    <input type="text" tabindex="1" id="subject" name="subject" class="form-control" value="">
                  </div>
                  <div class="compose-editor" style="overflow: auto;">
                    <textarea class="wysihtml5 form-control" id="mess" name="mess" rows="9"></textarea>
                  </div>

                  <div class="form-group h4 AffPieceJointe">
                    <label>Piéce Jointe: </label>
                    <i class="fa fa-file-pdf-o AffFileEmail"> </i>
                  </div>

                  <input type="hidden" name="type">
                  <input type="hidden" name="IdContribu">
                  <input type="hidden" name="Idpanne">
                  <input type="hidden" name="IdContact">
                  <input type="hidden" name="numfile">
                  <input type="hidden" name="mailselect">

                  <br>
                  <div class="compose-btn">
                    <button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-check"></i> Envoyé</button>
                    <button type="reset" onclick="myFunction();" class="btn btn-sm"><i class="fa fa-times"></i> Annulé</button>
                    <button id="btn_passStage" class="btn btn-success">passer étape</button>
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>      
    </div>    

    <!-- Affichage de l'intervenant et des boutons  et les interventions -->        
    <div class="AffContribu col-md-3 hidden">
      <h3>Intervenant</h3>
      <address>
        <p><strong id="nom"></strong></p>
        <p id="adresse"></p>
        <p id="lieux"></p>
        <p id="numphone"></p>
        <a id="siteweb" target="_blank"></a>
      </address>

      <input type="hidden" id="IdContribu" name="IdContribu"> <!-- a voir si encore besoin -->                    

        <!-- BON INTERV -->
      <div style="height: 120px;">
        <button type="button" data-role="addfile" data-b="BI" class="AffAddBI btn btn-success col-md-12">add Bon Intervention</button>
             
        <a href="" target="_blank" id="viewPdfBI" class="AffViewBI btn btn-success col-md-9">View Bon Intervention</a>
        <button type="button" id="changeBI" class="AffViewBI btn btn-theme col-md-3" data-role="uploadfile" data-b="BI"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>          

        <!-- FACTURE INTERVENTION --> 

        <button type="button" data-role="addfile" data-b="FI" class="AffAddFI btn btn-primary col-md-12">add Facture Intervention</button>          
             
        <a href="" target="_blank" id="viewPdfFI" class="AffViewFI btn btn-primary col-md-9">View Facture Intervention</a>
        <button type="button" id="changeFI" class="AffViewFI btn btn-theme col-md-3" data-role="uploadfile" data-b="FI"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>                                 
      </div>
    </div>

    <!-- AFFICHE TOUTES LES INTERVENTIONS OU UNE SEUL-->    
    <div class="AffIntervs hidden">

      <!-- affichage des intervention des pannes du matériel & alert -->
      <div class="col-md-12">
        <div class="col-md-6">
          <h3 id="h3Interv"></h3> 
        </div>

        <!-- affichage alert -->
        <div class="col-md-6">
          <div id="info_interv" class="" role="alert"></div>  
        </div>                     
      </div>                            
                    
      <input type="hidden" id="IDinterv" name="IDinterv"> <!-- hidden -->       

      <!-- Affichage des interventions panne et matériel -->
      <div class="col-md-12">         
        <div id="TableIntervPanne"></div><!-- Affichage de la table intervention des pannes du matériels -->
        <div id="TableIntervSP"></div><!-- Affichage de la table intervention sans panne du matériels -->
        <div id="TableIntervCM">
          <table id="TableInterv" class="table table-hover table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>Id</th>           
                <th>Date</th>
                <th>Heure</th>
                <th>Type</th>
                <th>Intervenant</th>
                <th>Désignation</th>
                <th>Créer par</th>
                <th>Etats</th>
                <th>Actions</th>            
              </tr>
            </thead>
          </table>
        </div><!-- Affichage de la table intervention contrat maintenance du matériels -->
      </div>

      <!-- Affichage des evenements interv sans panne -->
      <div class="AffEventsSP hidden col-lg-12">
        <div class="col-sm-12">
          <div class="col-lg-4">
            <h3 id="title_eventsp"></h3>
          </div>
          <!-- affichage alert -->
          <div class="col-lg-4">
            <div id="info_event" class="" role="alert"></div>  
          </div>
        </div>
        <br>
        <!-- Affichage de la table evenement panne matériel -->
        <div id="TableEventPanneSP">              
          <table id="TableEventSP" class="table table-hover table-bordered" style="width: 100%">
            <thead>
              <tr>
                <th>Id</th>           
                <th>Date</th>
                <th>Heure</th>
                <th>Evénement</th>
                <th>Désignation</th>
                <th>Créer par</th>                                          
                <th>Actions</th>            
              </tr>
            </thead>
          </table>  
        </div>
      </div>        

    </div>

    <!-- AFFICHE TOUS LES DEVIS DE LA PANNES -->
    <div class="AffQuota hidden">
      <!-- affichage des intervention des pannes du matériel & alert -->
      <div class="col-sm-12">
        <div class="col-sm-2">
          <h3 id="h3Quota"></h3> 
        </div>

        <!-- affichage alert -->
        <div class="col-sm-4">
          <div id="info_quota" class="" role="alert"></div>  
        </div>
        <!-- affichage email envoyer -->
        <div class="col-sm-4">
          <div id="info_emailQ" class="" role="alert"></div>  
        </div>                       
      </div>       

      <div class="col-md-12">
        <!-- affiche les devis de la panne  -->
        <table id="TableQuota" class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Date Devis</th> 
              <th>Société</th> 
              <th>N° Devis</th>
              <th>Date Validation</th>
              <th>Date Refus</th>
              <th>Montant Devis</th>
              <th>Etats Devis</th>
              <th>Actions</th>            
            </tr>
          </thead>  
        </table>
      </div>
    </div>

    <!-- affiche le bouton facture -->
    <div class="AffBtnFACT col-md-6 pull-left hidden" style="height: 40px;">
    
      <!-- FACTURE Réparation --> 
      <p>
        <button type="button" data-role="addfile" data-b="FR" class="AffAddFR btn btn-info col-md-12">add Facture réparation</button>     
              
        <a href="" target="_blank" id="viewPdfFR" class="AffViewFR btn btn-info col-md-9">View Facture Réparation</a>
        <button type="button" id="changeFR" class="AffViewFR btn btn-theme col-md-3" data-role="uploadfile" data-b="FR"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>
        
      </p>
    </div>

    <!-- affiche le bouton ce -->
    <div class="AffBtnCERT col-md-6 pull-right hidden" style="height: 40px;">
      <!-- CERTIFICAT ETANCHEITE --> 
      <p>
        <button type="button" data-role="addfile" data-b="CE" class="AffAddCE btn btn-warning col-md-12">add Certificat Etancheité</button>
            
        <a href="" target="_blank" id="viewPdfCE" class="AffViewCE btn btn-warning col-md-9">View Certificat Etancheité</a>
        <button type="button" id="changeCE" class="AffViewCE btn btn-theme col-md-3" data-role="uploadfile" data-b="CE"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>
        
      </p>
    </div>                
        
  </div>
  
  <div id="Ancre3" class="col-lg-12">  
    <div id="BtnHaut" class="hidden">
      <a href="javascript:history.go(-1);" class="btn btn-default"><span class="glyphicon  glyphicon-arrow-left"></span> Retour</a>
    </div>
  </div>  

</div>

<!-- MODALS --> 

<!-- PANNE -->
  <!-- Modal add & edit panne / input id = MateId - Idpanne - IndexP -->
  <div id="panne" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <div id="affMateriel"></div><br>

          <form  role="form" data-toggle="validator" method="post" id="PANNE">
          
            <div class="form-inline">

              <div class="input-group col-md-3">
                <label for="DatePanne" class="control-label">Date de panne: </label>
                <input name="DatePanne" id="DatePanne" class="form-control" type="date" value="<?= date("Y-m-d"); ?>" required />
              </div>

              <div class="input-group col-md-3">
                <label for="HeurePanne" class="control-label">Heure de panne: </label>
                <input name="HeurePanne" id="HeurePanne" class="form-control" type="text" value="" required />
              </div>

            </div>

            <div class="form-group has-feedback"> 
              <label for="Designation" class="control-label">Désignation: </label>              
              <div class="input-group ">                              
                <textarea class="form-control" name="Designation" id="Designation" cols="200" rows="5" data-error="Veuillez entrer la designation de la panne" placeholder="Entrer la designation de la panne" required="required"></textarea>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>                  
              </div>             
            </div>            

            <input type="hidden" id="MateId" name="MateId"> <!-- hidden -->
            <input type="hidden" name="Mate"> <!-- hidden -->
            <input type="hidden" name="Idpanne" id="Idpanne"> <!-- hidden -->
            <input type="hidden" name="CatProd"> <!-- hidden -->                                         
            <input type="hidden" name="IndexP" id="IndexP"> <!-- hidden -->                                         
        
            <div class="modal-footer">                  
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
            </div>               

          </form>
        </div>
      </div>
    </div>
  </div>
<!-- FIN PANNE -->

<!-- EVENEMENTS PANNE -->
  <!-- Modal ajout évenement / input id - IdPanne = IdMate - Etat - IdInterv - IdContribut - IdContact - ContriContact - IdAppel - TypeAppel -->
  <div id="ModalAddEvent" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id="titleAddEvent" class="modal-title"></h4>
        </div>

          <form role="form" method="post" data-toggle="validator" id="AddEvent">
            <div class="modal-body">              

              <!-- affiche input date et heure evenement -->
              <div class="form-inline">                                        
                <div class="input-group col-md-3">
                  <label for="DateEvent" class="AffLabel control-label"></label>
                  <input type="date" name="DateEvent" id="DateEvent" class="form-control" value="<?= date("Y-m-d"); ?>" required />
                </div>                  
                <div class="input-group col-md-3">
                  <label for="HeureEvent" class="control-label">Heure Evénement: </label>
                  <input name="HeureEvent" id="HeureEvent" class="form-control" type="text" value="" required />
                </div>                    
              </div>
              <br>

              <!-- div affiche select event -->
              <div class="form-group AffAddEvent">
                <div class="input-group col-md-6">            
                  <label for="Event" class="control-label">Evénement : </label>
                  <select class="form-control ctrl" name="Event" id="Event" required ></select>
                </div>
              </div>

              <!-- div affiche si il faut attribuer la panne au matériel lier -->
              <div class="form-group AffInfoDiag">
                <p class="alert alert-info">Le Diagnostique du technicien indique t'il qu'un matériel lier et en cause !!!</p>             
                <label class="radio-inline"><input for="oui" type="radio" id="oui" name="BTN" value="1">Oui</label>
                <label class="radio-inline"><input for="non" type="radio" id="non" name="BTN" value="2">Non</label>                
                <br>
                <p class="alert alert-danger AffInfoNoMaterial">Ce Matériel n'a pas de matériel lier. vous devez en ajouter !!! </p>  
              </div>

              <div class="AffInfoBascule"></div>

              <!-- div affiche intervenant et contact ou intervenant et tech-->
              <div class="form-group AffContriContact">
                <div class="input-group col-md-12">            
                  <label for="nomContribut" class="control-label">Intervenant Contacter: </label>
                  <h4 id="nomContribut"></h4>

                  <label for="nomContact" class="control-label AffnomContact">Contact appeler: </label>
                  <h4 id="nomContact" class="AffnomContact"></h4>

                  <label for="nomTech" class="control-label AffnomTech">Technicien appeler: </label>
                  <h4 id="nomTech" class="AffnomTech"></h4>

                </div>
              </div>              

              <!-- div affiche appel contribut -->
              <div class="AffAppelContribut">
                <div class="form-group">           
                  <label for="Contributor" class="control-label">Intervenant:</label>         
                  <div class="input-group col-md-8">                                      
                    <select class="form-control ctrl" name="Contributor" id="Contributor" required></select>
                    <span class="input-group-btn"><button class="btn btn-success" data-role="ADDContributor" type="button">Add Intervenant</button></span>
                  </div>
                </div>
              </div>

              <!-- div affiche select contact -->
              <div class="AffSelectContact">
                <div class="form-group">
                  <label for="Contact" class="control-label">Contact:</label>                      
                  <div class="input-group col-md-8">                                        
                    <select class="form-control ctrl" name="Contact" id="Contact" required></select>
                    <span class="input-group-btn"><button class="btn btn-warning AddContact" data-btn="panne" data-role="addContact" type="button">Add Contact</button></span> 
                  </div>  
                </div>                    
              </div>              

              <!-- div affiche appel tech -->
              <div class="AffAppelTech">                  
                <div class="form-group">
                  <label for="Technicien" class="control-label">Téchnicien:</label>                      
                  <div class="input-group col-md-8">                                        
                    <select class="form-control ctrl" name="Tech" id="Tech" required></select>
                    <span class="input-group-btn"><button class="btn btn-warning AddTech" data-role="addTech" type="button">Add Téchnicien</button></span> 
                  </div>  
                </div>
              </div>

              <!-- div affiche statut appel -->
              <div class="AffStatutAppel">
                <div class="form-group">
                  <label for="StatutAppel" class="control-label">Statut Appel:</label>                      
                  <div class="input-group col-md-8">                                        
                    <select class="form-control ctrl" name="StatutAppel" id="StatutAppel" required></select>
                  </div>  
                </div>                    
              </div>

              <!-- div affiche statut rappel -->
              <div class="AffStatutRappel">
                <div class="form-group">
                  <label for="StatutRappel" class="control-label">Statut Rappel:</label>                      
                  <div class="input-group col-md-8">                                        
                    <select class="form-control ctrl" name="StatutRappel" id="StatutRappel" required></select>
                  </div>  
                </div>                    
              </div>

              <!-- div affichage table quota --> 
              <div class="form-group AffQuotaPanne">
                <!-- affiche les devis de la panne  -->
                <table id="Tablequota" class="table table-hover">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Date Devis</th> 
                      <th>Société</th> 
                      <th>N° Devis</th>
                      <th>Date Validation</th>
                      <th>Date Refus</th>
                      <th>Montant Devis</th>
                      <th>Etats Devis</th>           
                    </tr>
                  </thead>  
                </table>
              </div>

              <br>
              <!-- div affiche commentaire -->
              <div class="AffComment form-group has-feedback"> 
                <label for="Commentaire" class="control-label">Commentaire: </label>              
                <div class="input-group ">                              
                  <textarea class="form-control" name="Commentaire" id="Commentaire" cols="200" rows="5" data-error="Veuillez entrer le commentaire" placeholder="Entrer le commentaire"></textarea>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>                  
                </div>             
              </div>

              <!-- div affiche statut panne -->
              <div class="AffStatutPanne hidden">
                <div class="form-group">
                  <label for="StatutPanne" class="control-label">Statut Panne:</label>                      
                  <div class="input-group col-md-8">                                        
                    <select class="form-control ctrl" name="StatutPanne" id="StatutPanne" required></select>
                  </div>  
                </div>                    
              </div>                 

              <!-- affichage checkbox 0 Interv SG-->
              <div class="form-inline AffCheckBox0">
                <div class="form-group">
                  <div class="input-group">
                    <label class="radio-inline" for="IntervSG">
                      <input type="radio" id="IntervSG" name="BTNRadio" value="1" required> Intervention Sous Garantie 
                    </label>

                    <label class="radio-inline" for="Mnr">
                      <input type="radio" id="Mnr" name="BTNRadio" value="5" required> Matériel Non Réparable
                    </label>
                  </div>
                </div>  
              </div>

              <!-- affichage checkbox 1 Attente devis ect-->
              <div class="form-inline AffCheckBox1">
                <div class="form-group">
                  <div class="input-group">

                    <label class="radio-inline" for="quote">
                      <input type="radio" id="quote" name="BTNRadio" value="2" required> Attente Devis 
                    </label>

                    <label class="radio-inline" for="Repair">
                      <input type="radio" id="Repair" name="BTNRadio" value="3" required> Réparation en cours
                    </label>

                    <label class="radio-inline" for="Clotur">
                      <input type="radio" id="Clotur" name="BTNRadio" value="4" required> Intervention Cloturé
                    </label>                      

                  </div>
                </div>  
              </div>

              <!-- affichage checkbox 1_1 / Attente diag constructeur / Attente autre devis ou devis / attente piéces -->
              <div class="form-inline AffCheckBox1_1">
                <div class="form-group">
                  <div class="input-group">

                    <label class="radio-inline" for="attrepconstruct">
                      <input type="radio" id="attrepconstruct" name="BTNRadio" value="0" required> Attente Réponse Contructeur 
                    </label>

                    <label class="radio-inline" for="Othquote">
                      <input type="radio" id="Othquote" name="BTNRadio" value="1" required><span id="AffOthquote"></span>  
                    </label>

                    <label class="radio-inline" for="ap">
                      <input type="radio" id="ap" name="BTNRadio" value="2" required> Attente Piéces
                    </label>

                  </div>
                </div>  
              </div>

              <!-- affichage checkbox 2 Panne cloturé ect-->
              <div class="form-inline AffCheckBox2">                
                <div class="form-group">
                  <div class="input-group">

                    <label class="radio-inline" for="CloPanne">
                      <input type="radio" id="CloPanne" name="BTNRadio" value="1" required> Panne Cloturé 
                    </label>

                    <label class="radio-inline" for="AppInterv">
                      <input type="radio" id="AppInterv" name="BTNRadio" value="2" required> Appel Intervenant
                    </label>

                    <label class="radio-inline" for="DemDevis">
                      <input type="radio" id="DemDevis" name="BTNRadio" value="3" required> Demande devis par Email
                    </label>

                  </div>
                </div>
              </div>

              <!-- affichage checkbox 3 Recup fluide-->
              <div class="form-inline AffCheckBox3">                
                <div class="form-group">
                  <div class="input-group">
                    <label class="radio-inline" for="BcertEtanch">
                      <input type="radio" id="BcertEtanch" name="BTNRadio" value="1"> Recup Fluide 
                    </label>
                  </div>
                </div>
              </div>                              

              <input type="hidden" id="IdPanne" name="IdPanne"> <!-- hidden -->                
              <input type="hidden" id="IdMate" name="IdMate"> <!-- hidden -->              
              <input type="hidden" id="Etat" name="Etat"> <!-- hidden -->

              <input type="hidden" id="IdInterv" name="IdInterv"> <!-- hidden -->                
              <input type="hidden" id="IdContribut" name="IdContribut"> <!-- hidden -->                
              <input type="hidden" id="IdContact" name="IdContact"> <!-- hidden -->                
              <input type="hidden" id="ContriContact" name="ContriContact"> <!-- hidden -->
              <input type="hidden" id="IdAppel" name="IdAppel"> <!-- hidden -->
              <input type="hidden" id="TypeAppel" name="TypeAppel"> <!-- hidden -->

              <div id="InpHidden"></div>

            </div><!-- fin modal body -->

            <div class="modal-footer">                
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
              <button type="submit" class="btn btn-success"><span class="glyphicon  glyphicon-ok"></span></button>                    
            </div>                              
            
          </form>
      </div>
    </div>
  </div>

  <!-- Modal edition évenement / input id - IdEvent = IdpanneEd -->
  <div id="ModalEditEvent" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>

        <div class="modal-body">

          <form role="form" method="post" data-toggle="validator" id="EditEvent">

            <div class="form-inline">

              <div class="input-group col-lg-3">
                <label for="dateevent" class="AffLabel control-label">Date Evénement</label>
                <div class="input-group">
                  <input type="date" name="dateevent" id="dateevent" class="form-control" required />
                </div>
              </div>

              <div class="input-group col-lg-3">
                <label for="heureevent" class="control-label">Heure Evénement: </label>
                <input name="heureevent" id="heureevent" class="form-control" type="text" required />
              </div>                    
            </div>                  
            <br>
            <!-- div affiche add event -->
            <div class="form-group">
              <div class="input-group col-sm-5">            
                  <label for="event" class="control-label">Evénement : </label>
                  <p id="event"></p>
              </div>
            </div>                  
           <!-- div affiche commentaire -->
            <div class="form-group has-feedback"> 
              <label for="commentaire" class="control-label">Commentaire: </label>              
              <div class="input-group ">                              
                <textarea class="form-control" name="commentaire" id="commentaire" cols="200" rows="5" data-error="Veuillez entrer le commentaire" required=""></textarea>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>                  
              </div>             
            </div>                                  

            <input type="hidden" id="IdEvent" name="IdEvent"> <!-- hidden -->                                  
            <input type="hidden" id="IdpanneEd" name="IdpanneEd"> <!-- hidden -->                                  

            <div class="modal-footer">
            
                <button type="reset" onclick="this.form.reset();" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
                <button type="submit" class="btn btn-success"><span class="glyphicon  glyphicon-ok"></span></button>
                
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
<!-- EVENEMENTS SANS PANNE -->
  <!-- Modal ajout & edit évenement sur l'intervention sans panne  -->
  <div id="ModalEventSP" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id="titleEventSP" class="modal-title"></h4>
        </div>

          <form role="form" method="post" data-toggle="validator" id="AE_EventSP">
            <div class="modal-body">

              <!-- affiche input date et heure evenement -->
              <div class="form-inline">                                        
                <div class="input-group col-md-3">
                  <label for="DateEvSP" class="AffLabel control-label"></label>
                  <input type="date" name="DateEvSP" id="DateEvSP" class="form-control" value="<?= date("Y-m-d"); ?>" required />
                </div>                  
                <div class="input-group col-md-3">
                  <label for="HeureEvSP" class="control-label">Heure Evénement: </label>
                  <input name="HeureEvSP" id="HeureEvSP" class="form-control" type="text" required />
                </div>                    
              </div>
              <br>

              <!-- div affiche select event -->
              <div class="form-group AffAddEvent">
                <div class="input-group col-md-6">            
                  <label for="EventSP" class="control-label">Evénement: </label>
                  <input type="text" id="EventSP" name="EventSP" class="form-control" placeholder="Entrer l'événement" required />
                </div>
              </div>
              <br>

              <!-- div affiche désignation  -->
              <div class="AffComment form-group has-feedback"> 
                <label for="CommentSP" class="control-label">Désignation: </label>              
                <div class="input-group ">                              
                  <textarea class="form-control" name="CommentSP" id="CommentSP" cols="200" rows="5" data-error="Veuillez entrer la désignation" placeholder="Entrer la désignation"></textarea>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>                  
                </div>             
              </div>
                           
              <input type="hidden" name="index"> <!-- hidden -->
              <input type="hidden" name="IdInterv"> <!-- hidden -->              
              <input type="hidden" name="IdEvents"> <!-- hidden -->              

            </div><!-- fin modal body -->

            <div class="modal-footer">                
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
              <button type="submit" class="btn btn-success"><span class="glyphicon  glyphicon-ok"></span></button>                    
            </div>                              
            
          </form>
      </div>
    </div>
  </div>
  
<!-- FIN EVENEMENTS -->

<!-- INTERVENTIONS SANS PANNE & CONTRAT MAINTENANCE -->  
  <!-- Modal add interv sans panne / input id = MateId_Interv / dependance = dependI -->
  <div id="ModalAddInterv" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <form role="form" data-toggle="validator" method="post" id="ADDInterv">
          
            <div class="form-inline">
              <div class="input-group col-md-3">
                <label for="DateInterv" class="control-label">Date d'intervention: </label>
                <input name="DateInterv" id="DateInterv" class="form-control" type="date" value="<?= date("Y-m-d"); ?>" required />
              </div>

              <div class="input-group col-md-3">
                <label for="HeureInterv" class="control-label">Heure d'intervention: </label>
                <input name="HeureInterv" id="HeureInterv" class="form-control" type="text" value="" required />
              </div>
            </div>
            </br>

            <!-- div intervenant interne ou externe -->            
            <div class="form-group AffInfoUser">
              <p class="alert alert-info">Selectionner l'intervenant !!!</p>             
              <label class="radio-inline"><input for="int" type="radio" id="int" name="BTNI" value="1">Interne</label>
              <label class="radio-inline"><input for="ext" type="radio" id="ext" name="BTNI" value="2">Externe</label>                
            </div>            

            <!-- div affiche select contribut -->
            <div class="AffSelectContribut">
              <div class="form-group">           
                <label for="ContributIC" class="control-label">Intervenant:</label>         
                <div class="input-group col-md-8">                                      
                  <select class="form-control ctrl" name="ContributIC" id="ContributIC" required></select>
                  <span class="input-group-btn"><button class="btn btn-success" id="btnAddContr" data-role="ADDContributor" type="button">Add Intervenant</button></span>
                </div>
              </div>
            </div>

            <!-- div affiche select type -->
            <div class="AffSelectType">
              <div class="form-group">           
                <label for="typeinterv" class="control-label">Type d'intervention:</label>         
                <div class="input-group col-md-8">                                      
                  <select class="form-control ctrl" name="typeinterv" id="typeinterv" required></select>
                </div>
              </div>
            </div>

            <div class="form-group has-feedback"> 
              <label for="DesignInterv" class="control-label">Désignation: </label>              
              <div class="input-group ">                              
                <textarea class="form-control" name="DesignInterv" id="DesignInterv" cols="200" rows="5" data-error="Veuillez entrer la designation de la panne" placeholder="Entrer la designation de l'intervention" required="required"></textarea>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>                  
              </div>             
            </div>            

            <input type="hidden" id="MateId_Interv" name="MateId_Interv"> <!-- hidden -->                                         
            <input type="hidden" id="cateInt" name="cateInt"> <!-- hidden -->                                         
            <input type="hidden" id="dependI" name="dependI"> <!-- hidden -->                                         
        
            <div class="modal-footer">                  
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
            </div>               

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal edit intervention panne & sans panne / input id = IDInterv -->
  <div id="ModalEditInterv" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>

          <div class="modal-body">

              <form role="form" method="post" data-toggle="validator" id="EditInterv">

                <div class="form-inline">
                  <div class="input-group col-lg-3">
                    <label for="dateinterv" class="control-label">Date Intervention</label>
                    <div class="input-group">
                      <input type="date" name="dateinterv" id="dateinterv" class="form-control" required />
                    </div>
                  </div>

                  <div class="input-group col-lg-3">
                    <label for="heureinterv" class="control-label">Heure Intervention: </label>
                    <input name="heureinterv" id="heureinterv" class="form-control" type="text" required />
                  </div>                    
                </div>                  
                <br>
                
                <div class="input-group">
                  <label for="Tinterv" class="control-label">Type Intervention: </label>                    
                  <p id="Tinterv" class="h3"></p>                    
                </div>                
                <br>

                <div class="input-group">
                  <label for="contriInterv" class="control-label">Intervenant: </label>
                  <p class="h3" id="contriInterv"></p>                    
                </div>
                <br>                

                <div class="input-group AffDesign">            
                  <label for="designInterv" class="control-label">Désignation: </label>
                  <textarea class="form-control" name="designInterv" id="designInterv" cols="500" rows="5" data-error="Veuillez entrer la désignation" placeholder="Entrer la désignation"></textarea>                     
                </div>                                                       

                <input type="hidden" id="IDInterv" name="IDInterv"> <!-- hidden -->                                  

                <div class="modal-footer">
                
                  <button type="reset" onclick="this.form.reset();" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-success">Validé</button>
                    
                </div>
              </form>
          </div>
      </div>
    </div>
  </div>
    
  <!-- Modal changement etats intervention sans panne / input id = id_interv -->
  <div id="ModalEtat" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4> <!--affiche "Changer l'état de l'interv n°:"-->
        </div>

          <div class="modal-body">

            <form  role="form" method="post" data-toggle="validator" id="ChangeStatesInterv">

              <div class="form-group">
                <div class="input-group col-sm-5">            
                  <label for="etats" class="control-label">Etat: </label>
                  <select class="form-control" name="etats" id="etats">
                      <option value="1">En Cours</option>
                      <option value="2">Terminé</option>
                  </select>
                </div>
              </div>                  

              <div class="form-group">
                <div class="input-group col-sm-5">                        
                  <div id="date_fin" class="hidden">
                    <label for="date_finInterv" class="control-label">Date de fin d'intervention :</label>
                    <input type="date" id="date_finInterv" class="form-control">               
                  </div>              
                </div>
              </div>

              <input type="hidden" id="id_interv" name="id_interv"> <!-- hidden id -->                  

              <div class="modal-footer">
              
                <button type="button" onclick="this.form.reset();" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
                <button type="submit" class="btn btn-success" id="modif_valid"><span class="glyphicon  glyphicon-ok"></span></button>
                  
              </div>
            </form>
          </div>
      </div>

    </div>
  </div>  

<!--FIN INTERVENTIONS -->

<!-- DEVIS -->
  <!-- Modal ajout & replace document devis / input id = IDquota - NumQuota-->
  <div id="ModalQuota" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <form role="form" enctype="multipart/form-data" data-toggle="validator" id="FileQuota" method="post">

            <div class="AffdocEnreg alert alert-danger" role="alert"></div>

            <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />

            <div class="input-group">               
              Envoyez ce fichier : <input class="btn btn-primary" id="fileQuota" name="file" type="file" required />
              <br>                
              <button class="AffbtnViewer btn btn-info hidden" type="button" value="Preview" onclick="PreviewImageQuota();">Voir!</button>
            </div>           
            <br>
            <div class="ViewerPdf hidden" style="clear:both">
              <iframe id="viewerQuota" frameborder="0" scrolling="no" width="550" height="200"></iframe>
            </div>

            <!-- div affiche inputs num devis & montant devis -->
            <div class="AffNMD">
              <div class="input-group col-lg-4">
                <label for="NumQuot" class="control-label">Numéro Devis:</label>
                <input type="text" name="NumQuot" id="NumQuot" class="form-control"/>
              </div>

              <label for="montantQuot" class="control-label">Montant Devis:</label>
              <div class="input-group col-lg-4">                
                <input type="text" name="montantQuot" id="montantQuot" class="form-control Montant"/>
                <span class="input-group-addon">&euro;</span>
              </div>
            </div>
              
            <br>           

            <input type="hidden" name="MateID" /> <!-- hidden / id materiel -->            

            <input type="hidden" id="IDquota" name="IDquota" /> <!-- hidden / id devis -->
            <input type="hidden" id="NumQuota" name="NumQuota" /> <!-- hidden / numéro devis -->             

            <input type="hidden" name="docenreg" /> <!-- hidden -->
            <input type="hidden" name="PanneID" />  <!-- hidden -->
            <input type="hidden" name="IndexUp" /> <!-- hidden -->
            <input type="hidden" name="op" /> <!-- hidden -->  

            <div class="modal-footer">                  
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
            </div>              

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal edition devis / input id = IDQuota - IDP_ED_Quota - ID_CONTRIB - contribut - numquota - inp - valslc -->
  <div id="ModalEditQuota" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>

          <div class="modal-body">
            <form role="form" method="post" data-toggle="validator" id="EditQuota">

              <div class="form-inline">
                <div class="input-group col-lg-3 AffdateQ">
                  <label for="datequota" class="control-label">Date Devis</label>
                  <div class="input-group">
                    <input type="date" name="datequota" id="datequota" class="form-control AffdateQ" required />
                  </div>
                </div>
                <div class="input-group col-lg-3 AffNumQ">
                  <label for="numQuota" class="control-label">Numéro Devis: </label>
                  <input name="numQuota" id="numQuota" class="form-control AffNumQ" type="text" required />
                </div>                    
              </div>                  
              <br>

              <div class="form-inline">
                <div class="input-group col-lg-3 AffdateV">
                  <label for="datev" class="control-label">Date Validation Devis</label>
                  <div class="input-group">
                    <input type="date" name="datev" id="datev" class="form-control AffdateV" required />
                  </div>
                </div>
                <div class="input-group col-lg-3 AffdateR">
                  <label for="dater" class="control-label">Date Refus Devis</label>
                  <div class="input-group">
                    <input type="date" name="dater" id="dater" class="form-control AffdateR" required />
                  </div>
                </div>                
              </div>
              <br>
              
              <!-- div affiche Montant devis -->
              <div class="form-group AffMontantQ">
                <label for="montantQuota" class="control-label">Montant Devis: </label>
                <div class="input-group col-sm-5">                    
                  <span class="input-group-addon">€</span>
                  <input name="montantQuota" id="montantQuota" class="form-control Montant AffMontantQ" type="text" required />
                </div>
              </div>                                      

              <input type="hidden" id="IDQuota" name="IDQuota"> <!-- hidden -->                               
              <input type="hidden" id="IDP_ED_Quota" name="IDP_ED_Quota"> <!-- hidden -->                               
              <input type="hidden" id="ID_CONTRIB" name="ID_CONTRIB"> <!-- hidden -->                            
              <input type="hidden" id="inp" name="inp"> <!-- hidden -->                              

              <div class="modal-footer">
              
                <button type="reset" onclick="this.form.reset();" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
                <button type="submit" class="btn btn-success"><span class="glyphicon  glyphicon-ok"></span></button>
                  
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>

  <!-- Modal etat devis / input id = IDQuota - IDP_ED_Quota - ID_CONTRIB - contribut - numquota - inp - valslc -->
  <div id="ModalEtatQuota" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>

          <div class="modal-body">
            <form role="form" method="post" data-toggle="validator" id="EtatQuota">

              <div class="form-inline">
                <div class="input-group col-lg-3 AffdateQ">
                  <label for="datequota" class="control-label">Date Devis</label>
                  <div class="input-group">
                    <input type="date" name="datequota" class="form-control AffdateQ" required />
                  </div>
                </div>
                <div class="input-group col-lg-3 AffNumQ">
                  <label for="numQuota" class="control-label">Numéro Devis: </label>
                  <input name="numQuota" class="form-control AffNumQ" type="text" required />
                </div>                    
              </div>                  
              <br>

              <div class="form-inline">
                <div class="input-group col-lg-3 AffdateV">
                  <label for="datev" class="control-label">Date Validation Devis</label>
                  <div class="input-group">
                    <input type="date" name="datev" class="form-control AffdateV" required />
                  </div>
                </div>
                <div class="input-group col-lg-3 AffdateR">
                  <label for="dater" class="control-label">Date Refus Devis</label>
                  <div class="input-group">
                    <input type="date" name="dater" class="form-control AffdateR" required />
                  </div>
                </div>                
              </div>
              <br>
              
              <!-- div affiche Montant devis -->
              <div class="form-group AffMontantQ">
                <label for="montantQuota" class="control-label">Montant Devis: </label>
                <div class="input-group col-sm-5">                    
                  <span class="input-group-addon">€</span>
                  <input id="mQuota" name="mQuota" class="form-control Montant AffMontantQ" type="text" required />
                </div>
              </div>                                      

              <input type="hidden" name="IDQuota"> <!-- hidden -->                               
              <input type="hidden" name="IDP_ED_Quota"> <!-- hidden -->                               
              <input type="hidden" name="ID_CONTRIB"> <!-- hidden -->
              <input type="hidden" name="contribut"> <!-- hidden -->
              <input type="hidden" name="numquota"> <!-- hidden -->                               
              <input type="hidden" name="valslc"> <!-- hidden -->                               

              <div class="modal-footer">
              
                <button type="reset" onclick="this.form.reset();" class="btn btn-danger Close" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
                <button type="submit" class="btn btn-success"><span class="glyphicon  glyphicon-ok"></span></button>
                  
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>

<!-- FIN DEVIS --> 

<!-- ADD & UPLOAD DOCUMENTS -->
  <!-- Modal ajout document bi/fac/rep/ fac achat/ doc_mat/ input id = intervID - facID - numFac - MateID - IDdoc - docenreg - PanneID - IndexUp - year -->
  <div id="ModalAddDoc" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <form role="form" enctype="multipart/form-data" data-toggle="validator" id="ValidateUpload" method="post">

            <div class="AffdocEnreg" role="alert"></div>

            <div class="Affaddfile">
              <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
              <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />

              <div class="input-group">               
                Envoyez ce fichier : <input class="btn btn-primary" id="file" name="file" type="file" required />
                <br>                
                <button class="AffbtnViewer btn btn-info hidden" type="button" value="Preview" onclick="PreviewImage();">Voir!</button>
              </div>           
              <br>
            </div>            

            <div class="ViewerPdf hidden" style="clear:both">
              <iframe id="viewer" frameborder="0" scrolling="no" width="550" height="200"></iframe>
            </div>             

            <!-- div affiche inputs num facture ou numéro BI-->
            <div class="AffNDOC">
              <div class="input-group col-lg-4">
                <label for="NumDoc" class="AffLabelNDC control-label"></label>
                <input type="text" name="NumDoc" class="form-control"/>
              </div>
            </div>
            <!-- div affiche montant ttc -->
            <div class="AffMTTC">
              <label for="montantTTC" class="AffLabelMTTC control-label"></label>
              <div class="input-group col-lg-4">                
                <input type="text" name="montantTTC" id="montantTTC" class="form-control Montant" placeholder="ex: 1200.00" />
                <span class="input-group-addon">&euro;</span>
              </div>
            </div>
              
            <br>

            <input type="hidden" id="intervID" name="intervID" /> <!-- hidden / id interv -->
            <input type="hidden" id="facID" name="facID" /> <!-- hidden / id facture -->

            <input type="hidden" id="numFac" name="numFac" /> <!-- hidden / numero fac existante-->

            <input type="hidden" id="MateID" name="MateID" /> <!-- hidden / id materiel -->

            <input type="hidden" id="IDdoc" name="IDdoc" /> <!-- hidden / id doc -->
            <input type="hidden" id="docenreg" name="docenreg" /> <!-- hidden -->

            <input type="hidden" id="PanneID" name="PanneID" />  <!-- hidden -->

            <input type="hidden" id="propi" name="propi" />  <!-- hidden -->            

            <input type="hidden" id="IndexUp" name="IndexUp" /> <!-- hidden -->              
            <input type="hidden" id="year" name="year" /> <!-- hidden passe l'année-->
            <input type="hidden" name="op" /> <!-- hidden op = addF ou upF -->

            <div class="modal-footer">                  
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
            </div>              

          </form>
        </div>
      </div>
    </div>
  </div>
<!-- FIN ADD DOCUMENT -->

<!-- ADD & EDIT INTERVENANT -->
  <!-- modal ajout d'intervenant / input id = modal -->
  <div id="contributor" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id="titleContribut" class="modal-title"></h4>
        </div>
        <div class="modal-body">          

          <form role="form" data-toggle="validator" method="post" id="AEContributor">

            <div class="form-group has-feedback">
              <div class="input-group col-sm-6">
                <label for="Nom" class="control-label">Nom: </label>
                <input type="text" id="Nom" name="Nom" class="form-control" placeholder="Entrer Le Nom" data-error="Veuillez entrer un nom" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                <div id="aff_contributor" class=""></div>                 
              </div>                      
            </div>

            <div class="AffACPV">
              <div class="form-group has-feedback">
                <label for="Adresse" class="control-label">Adresse: </label>
                <div class="input-group">                 
                  <textarea class="form-control" name="Adresse" id="Adresse" cols="60" rows="5" data-error="Veuillez entrer une adresse" placeholder="Entrer L'adresse" required=""></textarea>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>                  
                </div>             
              </div>

              <div class="form-group has-feedback">                
                <div class="input-group col-sm-6">
                  <label for="CodePostal" class="control-label">Code Postal: </label>                 
                  <input type="text" class="form-control CDP" maxlength="6" name="CodePostal" id="CodePostal" data-error="Veuillez entrer le code postal" placeholder="Entrer le code postal" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>                  
                </div>             
              </div>

              <div class="form-group has-feedback">                
                <div class="input-group col-sm-6">
                  <label for="Ville" class="control-label">Ville: </label>                 
                  <input type="text" class="form-control" name="Ville" id="Ville" data-error="Veuillez entrer une ville" placeholder="Entrer la ville" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>                  
                </div>             
              </div>
            </div>

            <div class="form-group has-feedback">
              <div class="input-group col-sm-5">
                <label for="Phone" class="control-label">Téléphone: </label>
                <input type="tel" pattern="^0[1-9]([ ][0-9]{2}){4}$" maxlength="" id="Phone" name="Phone" class="form-control TEL" data-error="Veuillez entrer un numéro valide" placeholder="Entrer Le téléphone" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                <div id="aff_numphone" class=" "></div>
              </div>                      
            </div> 

            <div class="AffSW">
              <div class="form-group has-feedback">
                <div class="input-group col-sm-8">
                  <label for="Siteweb" class="control-label">Site Web: </label>
                  <input type="url" pattern="^(http(s)?:\/\/)+[\w\-\._~:\/?#[\]@!\$&'\(\)\*\+,;=.]+$" id="Siteweb" name="Siteweb" class="form-control" data-error="Veuillez entrer L'adresse du site" placeholder="Entrer L'adresse internet">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>                      
              </div>
            </div>
            <br>

            <input type="hidden" name="modal" id="modal" value="panne">
            <input type="hidden" name="depend" id="depend">
            <input type="hidden" name="action" id="action">

            <div class="modal-footer">
              <button type="submit" class="btn btn-theme pull-right"><span class="glyphicon  glyphicon-ok"></span></button>       
              <button type="reset" onclick="this.form.reset();" class="btn btn-theme04 pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span>
              </button>
            </div>               

          </form>
        </div>
      </div>
    </div>
  </div>
<!-- FIN ADD INTERVENANT -->

<!-- ADD CONTACT -->
  <!-- modal add contact / input id = idContrib -->
  <div id="addContact" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id="titleAddContact" class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <form role="form" data-toggle="validator" method="post" id="AddContact">

            <div class="form-group has-feedback">
              <div class="input-group col-sm-6">
                <label for="NomCont" class="control-label">Nom: </label>
                <input type="text" id="NomCont" name="NomCont" class="form-control" placeholder="Entrer Le Nom" data-error="Veuillez entrer un nom" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>                 
              </div>                      
            </div> 
            <div class="form-group has-feedback">            
              <div class="input-group col-sm-6">
                <label for="PrenomCont" class="control-label">Prénom: </label>                 
                <input class="form-control" name="PrenomCont" id="PrenomCont" data-error="Veuillez entrer un prénom" placeholder="Veuillez entrer un prénom" required=""></input>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>                  
              </div>             
            </div>

            <div class="form-group has-feedback">                
              <div class="input-group col-sm-6">
                <label for="Fonction" class="control-label">Fonction: </label>                 
                <input type="text" class="form-control" name="Fonction" id="Fonction" data-error="Veuillez entrer une fonction" placeholder="Entrer la fonction" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>                  
              </div>             
            </div>

            <div class="form-group has-feedback">
              <div class="input-group col-sm-5">
                <label for="PhoneCell" class="control-label">Numéro Téléphone: </label>
                <input type="tel" pattern="^0[5-6-7]([ ][0-9]{2}){4}$" maxlength="14" id="PhoneCell" name="PhoneCell" class="form-control TEL" data-error="Veuillez entrer un numéro valide" placeholder="Ex: 05 58 75 45 69" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                <div id="aff_numphone" class=" "></div>
              </div>                      
            </div> 

            <div class="form-group has-feedback">
              <div class="input-group col-sm-8">
                <label for="EmailCont" class="control-label">Email: </label>
                <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="EmailCont" name="EmailCont" class="form-control" data-error="Veuillez entrer un email valide" placeholder="Entrer Un email">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>                      
            </div>     
            <br>

            <input type="hidden" id="idContrib" name="idContrib"> <!-- hidden -->

            <div class="modal-footer">
              <button type="submit" class="btn btn-theme pull-right"><span class="glyphicon  glyphicon-ok"></span></button>       
              <button type="reset" onclick="this.form.reset();" class="btn btn-theme04 pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span>
              </button>
            </div>               

          </form>             
                    
        </div>
      </div>
    </div>
  </div>
<!-- FIN ADD CONTACT -->

<!-- ADD IMG MODEL -->
  <!-- Modal add img model / input id = IDModel -->
  <div id="addimgmodel" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title titremodel"></h4>
        </div>

        <form  role="form" enctype="multipart/form-data" data-toggle="validator" method="post" id="ADDIMGMODEL">
          <div class="modal-body">
          
            <div class="form-group">
              
              <div class="col-md-12">                  
                <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />                
                <label class="control-label col-md-12">Image Upload (le poids de l'image ne doit pas dépasser 1Mb !!!)</label>

                <div class="col-md-12">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                    <div>
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" id="fileIMGMODEL" name="fileIMGMODEL" accept="image/jpg, image/jpeg" class="default" />
                      </span>
                      <a href="#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Suppr</a>
                    </div>
                  </div>                    
                </div>                  

                <input type="hidden" id="IDModel" name="IDModel">
                                    
              </div>  
            </div>

            <div class="modal-footer">                
              <button type="button"  onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
              <button type="submit" id="btnIMG" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
            </div>

          </div>

        </form>                  
      </div>
    </div>       
  </div>
<!-- FIN ADD IMG MODEL -->

  <!-- modal selection matériel lier / input id = IDMateL - IDMateP - IDP -->
  <div id="selectmatlier" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog tableMateLier">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id="title_selectmatlier" class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <form role="form" data-toggle="validator" method="post" id="SelectMatLier">

            <div class="col-lg-12">         
              <!-- Affichage de la table matériels lier-->
              <table id="TMateLier" class="table table-hover">
                <thead>

                  <tr class="odd" style="font-weight:bold;">                 

                    <th>Id</th>

                    <th>Numéro Inventaire</th>

                    <th>Produit</th>

                    <th>Marque</th>

                    <th>Model</th>

                    <th>Type</th>

                    <th>Numéro Série</th>

                    <th>Niveau</th>

                    <th>Piéce</th>

                    <th>Statut</th>

                  </tr>

                </thead>  
                
              </table>                 
            </div>

            <input type="hidden" name="IDMateL" id="IDMateL">
            <input type="hidden" name="IDMateP" id="IDMateP">
            <input type="hidden" name="IDP" id="IDP">            

            <div class="modal-footer">
              <button type="submit" class="btn btn-theme pull-right"><span class="glyphicon  glyphicon-ok"></span></button>       
              <button type="reset" onclick="this.form.reset();" class="btn btn-theme04 pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span>
              </button>
            </div>               

          </form>             
                    
        </div>
      </div>
    </div>
  </div>

  <!-- modal selection volets en panne / input id = tabM - tabP - key - numfile -->
  <div id="selectvolets" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id="title_selectvolets" class="modal-title"></h4>
        </div>
        <div class="modal-body">         

          <form role="form" data-toggle="validator" method="post" id="SelectVolets">

            <!-- div affiche si il faut envoyer le mail seul ou avec d'autre volets en panne -->
            <div class="form-group AffInfo hidden">
              <p class="alert alert-info" id="request"></p>
              <label class="radio-inline"><input for="oui" type="radio" name="BTN" value="1">Oui</label>
              <label class="radio-inline"><input for="non" type="radio" name="BTN" value="2">Non</label>               
              <br>  
            </div>

            <div class="col-lg-12 AffTableVolet hidden">         
              <!-- Affichage de la table matériels lier-->
              <table id="TableVoletSelect" class="table table-hover">
                <thead>

                  <tr class="odd" style="font-weight:bold;">                

                    <th>Id</th>

                    <th>Panne n°</th>

                    <th>N° Inventaire</th>

                    <th>Produit</th>

                    <th>Marque</th>

                    <th>Model</th>

                    <th>Type</th>

                    <th>N° Série</th>

                    <th>Niveau</th>

                    <th>Piéce</th>

                    <th>Statut</th>

                  </tr>

                </thead>  
                
              </table>                 
            </div>
            
            <input type="hidden" name="tabM" id="tabM"> 
            <input type="hidden" name="tabP" id="tabP"> 
            <input type="hidden" id="key" name="key">
            <input type="hidden" id="numfile" name="numfile">           

            <div class="modal-footer">
              <button type="submit" id="validateVolet" class="btn btn-theme pull-right"><span class="glyphicon  glyphicon-ok"></span></button>       
              <button type="reset" onclick="this.form.reset();" class="btn btn-theme04 pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span>
              </button>
            </div>               

          </form>             
                    
        </div>
      </div>
    </div>
  </div>

<script> 
    // preview fichier //
  
    function PreviewImage() {
        pdffile=document.getElementById("file").files[0];
        pdffile_url=URL.createObjectURL(pdffile);
        $('#viewer').attr('src',pdffile_url);
    }

    // preview fichier quota //
    function PreviewImageQuota() {
        pdffile=document.getElementById("fileQuota").files[0];
        pdffile_url=URL.createObjectURL(pdffile);
        $('#viewerQuota').attr('src',pdffile_url);
    }

    function myFunction() {

      $('.AffSendMail').removeClass('display').addClass('hidden') // efface la div //
    }   
    

</script> 

