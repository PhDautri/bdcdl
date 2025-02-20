<div class="row">   
  
    <div class="col-lg-12">    

      <h1>Tous les Devis</h1></br>                   

      <table id="TableQuotation" class="table table-hover" style="width: 100%">            
        <thead>                
          <tr style="font-weight:bold;">
            <th>Id</th>
            <th>Date Demande Devis</th> 
            <th>Date Devis</th>
            <th>Société</th>
            <th>N° Panne</th>
            <th>N° Devis</th>
            <th>Date Validation</th>
            <th>Date Refus</th>
            <th>Montant Devis</th>
            <th>Etat Devis</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
             
    </div>
</div>

<!-- DEVIS -->
  <!-- Modal edition devis -->
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

              <!-- div affiche date demande devis -->
              <div class="form-group">
                <label for="daterequest" class="control-label">Date demande Devis : </label>
                <div class="input-group col-sm-5">
                  <input type="date" name="daterequest" id="daterequest" class="form-control" required />
                </div>
              </div>

              <div class="form-inline">
                <div class="input-group col-lg-3">
                  <label for="datequota" class="control-label">Date Devis</label>
                  <div class="input-group">
                    <input type="date" name="datequota" id="datequota" class="form-control" required />
                  </div>
                </div>
                <div class="input-group col-lg-3">
                  <label for="numQuota" class="control-label">Numéro Devis: </label>
                  <input name="numQuota" id="numQuota" class="form-control" type="text" required />
                </div>                    
              </div>                  
              <br>

              <div class="form-inline">
                <div class="input-group col-lg-3 AffdateV">
                  <label for="datev" class="control-label">Date Validation Devis</label>
                  <div class="input-group">
                    <input type="date" name="datev" id="datev" class="form-control" required />
                  </div>
                </div>
                <div class="input-group col-lg-3 AffdateR">
                  <label for="dater" class="control-label">Date Refus Devis</label>
                  <div class="input-group">
                    <input type="date" name="dater" id="dater" class="form-control" required />
                  </div>
                </div>                
              </div>
              <br>

              <!-- div affiche montant devis -->
              <div class="form-group">
                <label for="montantQuota" class="control-label">Montant Devis : </label>
                <div class="input-group col-sm-5">                    
                  <span class="input-group-addon">€</span>
                  <input name="montantQuota" id="montantQuota" class="form-control Montant" type="text" required />
                </div>
              </div>                                      

              <input type="hidden" id="IDQuota" name="IDQuota"> <!-- hidden -->                                  
              <input type="hidden" id="STQuota" name="STQuota"> <!-- hidden -->                                  

              <div class="modal-footer">
              
                <button type="reset" onclick="this.form.reset();" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success">Validé</button>
                  
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>

  <!-- Modal ajout & replace document devis -->
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
<!-- FIN DEVIS -->

<script>    

    // preview fichier 
  
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

</script> 