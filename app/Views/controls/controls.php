<div class="row"> 

  <!-- Affichage des contrôles réglementaires -->
  
  <div class="AffContReg col-sm-12">
  
    <h1>Contrôles Réglementaires</h1>

    <p id="btn_addcontrol"></p>

    <table id="TableControls" class="table table-hover" style="width: 100%">          
      <thead>              
        <tr class="odd" style="font-weight:bold;">  
          <th>Id</th>
          <th>Type</th>
          <th>category_id</th>
          <th>Catégorie</th>          
          <th>Prestation</th>
          <th>Contrôleur</th>
          <th>Nom</th>
          <th>Fréq.</th>                          
          <th>Planification</th>
          <th>Vérification</th>
          <th>Der. Contrôle</th>                
          <th>Echéance</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>

  </div>


</div>

<!-- MODAL -->

  <!-- modal ajout & edition controles réglementaires -->
  <div id="controls" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">          

            <form role="form" data-toggle="validator" method="post" id="Controls">

              <label for="typecont" class="control-label">Type de contrôle:</label>
              <div class="input-group col-sm-8">                
                <select class="form-control ctrl" name="typecont" id="typecont" required disabled="true">
                  <option value="0" selected disabled>Veuillez choisir le type</option>
                  <option value="Interne">Interne</option>
                  <option value="Réglementaire">Réglementaire</option>
                </select>
              </div><br>

              <label for="categorie" class="control-label">Catégorie:</label>
              <div class="input-group col-sm-8">                
                <select class="form-control ctrl" name="categorie" id="categorie" required></select>
                <span class="input-group-btn" id="btn-AddCategorie"><button class="btn btn-theme03" data-role="Addcategorie" type="button">Add Catégorie</button></span>
              </div><br>
              
              <div class="input-group col-sm-8 hidden" id="btn-addcategorie">
                <input type="text" name="addcategorie" id="addcategorie" class="form-control">
                <span class="input-group-btn"><button class="btn btn-info" id="AddCategorie" type="button"><span class="glyphicon  glyphicon-ok"></span></button></span>      
              </div>

              <label for="prestation" class="control-label">Prestation:</label>
              <div class="input-group col-sm-8">
                <input class="form-control" type="text" name="prestation" id="prestation" required>  
              </div><br>                                

              <label for="freq" class="control-label">Fréquence du contrôle:</label>
              <div class="input-group col-sm-8">                
                <select class="form-control ctrl" name="freq" id="freq" required>
                  <option value="0" selected disabled>Veuillez choisir la fréquence</option>
                  <option value="Mensuel">Mensuel</option>
                  <option value="Trimestriel">Trimestriel</option>
                  <option value="Semestriel">Semestriel</option>
                  <option value="Annuel">Annuel</option>
                  <option value="Triennal">Triennal</option>
                  <option value="Quinquennal">Quinquennal</option>
                  <option value="Décennal">Décennal</option>
                </select>
              </div><br>              

              <label for="lastcont">Dernier Contrôle</label>
              <div class="input-group col-sm-8">
                <input class="form-control ctrl" type="date" id="lastcont" name="lastcont">  
              </div><br>

              <label for="controleur">Contrôleur</label>
              <div class="input-group col-sm-8">
                <input class="form-control ctrl" type="text" id="controleur" name="controleur" placeholder="Entrer un contrôleur" required>  
              </div><br>

              <label for="nom" class="tech">Nom Technicien</label>
              <div class="input-group col-sm-8 tech">
                <input class="form-control ctrl" type="text" id="nom" name="nom" placeholder="Entrer le nom du Technicien">  
              </div><br>

              <div id="info_control"></div>

              <input type="hidden" id="str" name="str"><!-- indique la page -->
              <input type="hidden" id="id" name="id"><!-- id travaux -->

              <div class="modal-footer">             

                <button type="submit" class="btn btn-theme pull-right"><span class="glyphicon  glyphicon-ok"></span></button>                
                <button type="reset" onclick="this.form.reset();" class="btn btn-theme04 pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>    

              </div>               

            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- modal change planification -->
  <div id="planif" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <form  role="form" data-toggle="validator" method="post" id="PLANIF">
                          
            <div class="form-group">
              <div class="input-group col-sm-6">
                <label for="dateP" class="control-label">Date: </label>
                <input type="date" id="dateP" name="dateP" class="form-control" placeholder="Entré une date de planification" required>
              </div>
            </div>
                      
            <div class="modal-footer">                  
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal">
                <span class="glyphicon  glyphicon-remove"></span>
              </button>
            </div>

            <input type="hidden" name="ControlID">               

          </form>
        </div>
      </div>
    </div>
  </div> 

  <!-- modal change verification -->
  <div id="verif" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <form  role="form" data-toggle="validator" method="post" id="VERIF">
                          
            <div class="form-group">
              <div class="input-group col-sm-6">
                <label for="dateV" class="control-label">Date: </label>
                <input type="date" id="dateV" name="dateV" class="form-control" placeholder="Entré une date de planification" required>
              </div><br>

              <label for="nom" class="tech">Nom Technicien:</label>
              <div class="input-group col-sm-8 tech">
                <input class="form-control ctrl" type="text" name="nom" placeholder="Entrer le nom du Technicien">  
              </div><br>
            </div>
                      
            <div class="modal-footer">                  
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal">
                <span class="glyphicon  glyphicon-remove"></span>
              </button>
            </div>

            <input type="hidden" name="ControlID">               

          </form>
        </div>
      </div>
    </div>
  </div>
  
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
            <input type="hidden" name="ControlID">
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


  <script> 
    // preview fichier //
  
    function PreviewImage() {
        pdffile=document.getElementById("file").files[0];
        pdffile_url=URL.createObjectURL(pdffile);
        $('#viewer').attr('src',pdffile_url);
    }
</script>