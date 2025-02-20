<div class="row">    

  <!-- Affichage des intervenants interne -->
    
  <div class="AffTContriInte col-sm-12">    

    <h1>Intervenants Interne</h1>

    <p id="btn_addContri"></p>

    <table id="TableContriInte" class="table table-hover" style="width: 100%">
        
        <thead>
            
          <tr class="odd" style="font-weight:bold;">              
              
            <th>Id</th>

            <th>Nom</th>

            <th>Téléphone</th>

            <th>Actions</th>

          </tr>

        </thead>                 

    </table> 

  </div>
        
</div>

<!-- CONTRIBUTORS INTERNE -->

<!-- modal ajout & edit d'intervenant interne -->

<div id="contributint" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titleContribut"></h4>
      </div>
      <div class="modal-body">
        <form role="form" data-toggle="validator" method="post" id="AEContributint">          

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
            <div class="input-group col-sm-5">
              <label for="Phone" class="control-label">Téléphone: </label>
              <input class="form-control TELINTE" type="tel" maxlength="4" id="Phone" name="Phone" data-error="Veuillez entrer un numéro valide" placeholder="Entrer Le téléphone Interne" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
              <div id="error_numphone"></div>
            </div>                      
          </div>      
          <br>          

          <input type="hidden" name="action" id="action">
          <input type="hidden" name="depend" id="depend">
          <input type="hidden" name="ContriID" id="ContriID">

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