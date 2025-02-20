<div class="AffCabDoctors col-sm-12">

	<h2>Cabinet Médecins GCS</h2>

	<p>
		<a href="#" data-role="addcab" class="btn btn-success btn-round"><span class="glyphicon  glyphicon-plus"></span></a>
	  <a class="btn btn-round btn-default" target="_blank" href="?p=billings.viewAllCabPdf" <abbr title="Créer un PDF">PDF</abbr></a>
  </p>
    
  <table id="TableCabDoctors" class="table table-hover" style="width: 100%">        
    <thead>            
      <tr>
        <th>id</th>
        <th>Nom Cabinet</th>
        <th>Téléphone</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
	
</div>

<!-- modal ajout et edit d'un cabinet médical -->

<div id="cabinet" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">          

          <form role="form" data-toggle="validator" method="post" id="CABINET">

            <div class="form-group has-feedback">
              <div class="input-group col-sm-6">
                <label for="nomcab" class="control-label">Nom Cabinet: </label>
                <input type="text" id="nomcab" name="nomcab" class="form-control" placeholder="Entrer Le Nom du cabinet" data-error="Veuillez entrer un nom" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                <div id="aff_nomcab" class=""></div>                 
              </div>                      
            </div>

            <div class="form-group has-feedback">
              <div class="input-group col-sm-5">
                <label for="phone" class="control-label">Téléphone: </label>
                <input class="form-control" type="tel" maxlength="14" id="phone" name="phone" data-error="Veuillez entrer un numéro valide" placeholder="Entrer Le téléphone" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                <div id="aff_numphone" class=""></div>
              </div>                      
            </div> 

            <div class="form-group has-feedback">
              <div class="input-group col-sm-8">
                <label for="email" class="control-label">Email: </label>
                <input type="email" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z.]{2,15}" id="email" name="email" class="form-control" data-error="Veuillez entrer une adresse email" placeholder="Entrer L'adresse mail">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>                      
            </div>     
            <br>

            <input type="hidden" name="id_cab" id="id_cab">
            <input type="hidden" name="op" id="op">

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
