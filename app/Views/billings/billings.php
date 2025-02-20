<div class="AffBillingsCabDoctors col-sm-12">

	<h2>Facturations Intervention Cabinet Médecins GCS</h2>

	<p>		
    <a class="btn btn-round btn-default" target="_blank" href="?p=billings.viewAllFactPdf" <abbr title="Créer un PDF">PDF</abbr></a>
  </p>
    
  <table id="TableBillings" class="table table-hover" style="width: 100%">      
    <thead>          
      <tr>
        <th>id</th>
        <th>N° Facture</th>
        <th>Date</th>
        <th>Client</th>
        <th>Montant TTC</th>
        <th>Etat</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
	
</div>

<!--///////////////////////////MODAL////////////////////////////-->

<!-- edition facture -->
<div id="editbilling" class="modal fade bs-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edition Eléments Facture</h4>        
      </div>
      <div class="modal-body">

        <form role="form" data-toggle="validator" method="post" id="EDITBILLING">

          <div class="col-lg-10" style="background-color:#c2d6d6; border-radius: 6px; border: 1px solid black; margin-bottom: 9px;">
            <div class="form-horizontal col-lg-10">
              <div class="form-group"><legend>Date Facture</legend></div>
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-xs-2 col-sm-2 col-lg-2 control-label">Date :</label>
                  <div class="col-xs-10 col-sm-8 col-lg-8">
                    <input type="date" id="dateF" name="dateF" class="form-control" required>
                  </div>
                </div>
              </div>              
            </div>  
          </div>         

          <div class="col-lg-10" style="background-color:#c2d6d6; border-radius: 6px; border: 1px solid black; margin-bottom: 9px;">
            <div class="form-horizontal col-lg-10">
              <div class="form-group">
                <legend>Facture (éléments non modifiable)</legend>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-sm-2 col-lg-2 control-label">N° Facture : </label>
                  <div class="col-sm-8 col-lg-8">                       
                    <input type="text" class="form-control" id="numfac" name="numfac" readonly />             
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-sm-2 col-lg-2 control-label">Client : </label>
                  <div class="col-sm-3 col-lg-8">
                    <input type="text" class="form-control" id="nomcab" name="nomcab" readonly />
                  </div>            
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-sm-2 col-lg-2 control-label">Montant : </label>
                  <div class="col-sm-6 col-lg-8">
                    <input type="text" class="form-control" id="montant" name="montant" readonly>
                  </div>
                </div>
              </div>              
            </div>
          </div>         
              
          <!--///////////////////// -->

          <input type="hidden" id="id_fact" name="id_fact" > <!-- hidden -->                  
      
          <div class="modal-footer">
            <div class="col-lg-10">
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
            </div>
          </div>               

        </form>
      </div>
    </div>
  </div>
</div>
