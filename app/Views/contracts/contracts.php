<div class="row"> 

  <!-- Affichage des contrats -->
  
  <div class="AffContracts col-sm-12">  
    <h1>Contrats</h1>
    <p id="btn_addcontract"></p>
    <table id="TableContracts" class="table table-hover Contracts" style="width: 100%">          
      <thead>              
        <tr class="odd" style="font-weight:bold;"> 
          <th>Id</th>
          <th>Num Contrat</th>
          <th>id_contribu</th>
          <th>Intervenant</th>
          <th>Date debut</th>
          <th>Durer (Mois)</th>
          <th>Reconduction</th>
          <th>Montant</th>
          <th>Actions</th>
        </tr>
      </thead>   
    </table>
  </div>

  <div class="AffMatesLier hidden">        
    <!-- affichage btn -->
    <div class="col-sm-12">
      <div class="col-sm-6">
        <h2>Matériel(s) Lié  <button id="btnAddMatContrat" class="btn btn-round btn-success" data-role="AddMaterialContrat" data-id=""<abbr title="Ajouter un matériel au contrat"><span class="glyphicon glyphicon-plus"></span></abbr></button>
        <a class="ViewPdf btn btn-round btn-default" target="_blank" data-role="ViewPdfMateContract"<abbr title="Créer un PDF">PDF</abbr></a></h2>         
      </div>
    </div>

    <div class="col-lg-6" id="info_matecontrat"></div>

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
            <th>Statut</th>
            <th>Montant Total Réparation</th>
            <th>Total Pannes</th>
            <th>Actions</th>
          </tr>
        </thead>            
      </table>                 
    </div>
  </div>


</div>

<!-- modal ajout & edit de contrat -->

<div id="contract" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titleContract"></h4>
      </div>
      <div class="modal-body">
        <form role="form" data-toggle="validator" method="post" id="AEContract">          

          <div class="form-group has-feedback">
            <div class="input-group col-sm-8">
              <label for="NumContract" class="control-label">N° Contrat: </label>
              <input type="text" id="NumContract" name="NumContract" class="form-control" placeholder="Entrer Le N° de contrat" data-error="Veuillez entrer un numéro de contrat" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <span class="error_numcontrat"></span>
              <div class="help-block with-errors"></div>                 
            </div>                      
          </div>

          <!-- div affiche select contribut -->          
          <div class="form-group">           
            <label for="ContributIC" class="control-label">Intervenant:</label>         
            <div class="input-group col-sm-8">                                      
              <select class="form-control" name="ContributIC" id="ContributIC" required></select>
              <span class="input-group-btn"><button class="btn btn-success" data-role="ADDContributor" data-s="1" type="button">Add Intervenant</button></span>
            </div>
          </div>          
          
          <div class="form-group">
            <label for="datedeb" class="control-label">Date début:</label>
            <div class="input-group col-sm-8">
              <input type="date" name="datedeb" id="datedeb" class="form-control" required />
            </div>
          </div>

          <div class="form-group">
            <label for="durer" class="control-label">Durer:</label>
            <div class="input-group col-sm-8">
              <input type="text" name="durer" id="durer" class="form-control" placeholder="Entrer La durer du contrat" required />
              <span class="input-group-addon" id="basic-addon2">Mois</span>
            </div>
          </div>

          <!-- div affiche select reconduction -->          
          <div class="form-group">           
            <label for="recond" class="control-label">Reconduction:</label>         
            <div class="input-group col-sm-8">                                      
              <select class="form-control" name="recond" id="recond" required>
                <option value="0" selected disabled>Choix de la reconduction</option>
                <option value="Tacite">Tacite</option> 
                <option value="Renouvellement">Renouvellement</option> 
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="montant" class="control-label">Montant:</label>
            <div class="input-group col-sm-8">
              <input type="text" name="montant" id="montant" class="form-control" placeholder="Entrer Le montant du contrat" required />
              <span class="input-group-addon" id="basic-addon2">Euros</span>
            </div>
          </div>
               
          <br>          

          <input type="hidden" name="str" id="str">
          <input type="hidden" name="ContractID" id="ContractID"> <!-- pour edit -->

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

<!-- modal ajout d'intervenant -->

<div id="contributor" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titleContribut"></h4>
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

          <div class="form-group has-feedback">
            <div class="input-group col-sm-5">
              <label for="Phone" class="control-label">Téléphone: </label>
              <input class="form-control TEL" type="tel" maxlength="14" id="Phone" name="Phone" data-error="Veuillez entrer un numéro valide" placeholder="Entrer Le téléphone" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
              <div id="error_numphone"></div>
            </div>                      
          </div>  

          <div class="form-group has-feedback">
            <div class="input-group col-sm-8">
              <label for="Siteweb" class="control-label">Site Web: </label>
              <input type="url" class="form-control" 
              pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?" 
              id="Siteweb" name="Siteweb"  data-error="Veuillez entrer L'adresse du site" placeholder="Entrer L'adresse internet">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>                      
          </div>     
          <br>          

          <input type="hidden" name="action" id="action">
          <input type="hidden" name="depend" id="depend">
          <input type="hidden" name="ContriID" id="ContriID">
          <input type="hidden" name="S" id="S">

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

<!-- ADD & UPLOAD DOCUMENTS -->
  <!-- Modal ajout document  -->
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
              
            <br>
            <input type="hidden" name="ContractID">
            <input type="hidden" name="NumContract">
            <input type="hidden" id="docenreg" name="docenreg" /> <!-- hidden -->
            <input type="hidden" id="IndexUp" name="IndexUp" /> <!-- hidden -->
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

<script> 
    // preview fichier //
  
    function PreviewImage() {
        pdffile=document.getElementById("file").files[0];
        pdffile_url=URL.createObjectURL(pdffile);
        $('#viewer').attr('src',pdffile_url);
    }
</script>