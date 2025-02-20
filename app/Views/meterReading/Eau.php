<div class="MeterReadingEau col-sm-12">

	<h2>Relevés Des Compteurs EAU Cabinet</h2>

	<p id="btn_MeterReading"></p>
  <br>
  <br>
  <br>
  <p class="h4">Année</p>  
  <ol class="breadcrumb"></ol>
  
  <div class="AffMeterReadingEAU hidden">

    <a class="btn btn-round btn-default" data-role="viewEauPdf"<abbr title="Créer un PDF">PDF</abbr></a>
    <input type="hidden" id="yearselect" name="yearselect">
    <br>
    <br>    

    <table id="TableMeterReadingEAU" class="table table-hover" style="width: 100%">        
      <thead>            
        <tr>
          <th>Id</th>                     
          <th>N° LOT</th>
          <th>Lieux Compteur</th>
          <th>Compteur(M3)</th>
          <th>Conso(M3)</th>
          <th>Appartenance</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>   

	</div>
</div>

<!--////////////////////////MODAL/////////////////////////////-->

<!-- modal ajout et edit des relevés compteurs -->

<div id="MeterReadingEau" class="modal fade bs-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titleMRE"></h4>
      </div>
      <div class="modal-body">
        <form role="form" data-toggle="validator" method="post" id="METERREADINGEAU">
          <!-- Date -->
          <div class="form-group">
            <div class="input-group input-group-sm col-sm-3 AffDateMRE">
              <label for="date" class="control-label">Date: </label>
              <input type="date" id="date" name="date" class="form-control" placeholder="Entrer La date du relevé" required />                 
            </div>                      
          </div>
          <!-- fin date -->

          <!-- Select Lot -->
          <div class="form-group SelectLot">  
            <label for="SelectLot" class="control-label">LOT:</label>
            <div class="input-group col-sm-10">                
              <select class="form-control" name="SelectLot" id="SelectLot" required></select>
              <span class="input-group-btn"><button class="btn btn-theme02" data-role="AddLot" type="button">Add Lot</button></span>
            </div>
          </div>
          <!-- Fin Select Lot -->

          <!-- relevé LOT -->
          <div class="form-inline">                       
            <div class="input-group input-group-sm col-sm-4">
              <label for="counter" class="control-label">Relevé: (M3)</label>
              <input type="number" step="0.001" class="form-control" id="counter" name="counter" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required>     
            </div>
                        
            <div class="input-group input-group-sm col-sm-3">
              <label for="last_counter" class="control-label">Dernier relevé: (M3)</label>
              <input type="text" class="form-control Reset" id="last_counter" name="last_counter" min="0" style="color: green; font-size: 20px;" readonly>    
            </div>           

            <div class="input-group input-group-sm col-sm-3 AffConsoLot">
              <label for="conso_counter" class="control-label">Conso: (M3)</label>
              <input type="text" class="form-control Reset" id="conso_counter" name="conso_counter" min="0" style="color: red; font-size: 20px;" readonly>            
            </div>
          </div>       
          <br> 
          <!-- fin relevé LOT -->          

          <input type="hidden" name="id_meter" id="id_meter">
          <input type="hidden" name="year">
          <input type="hidden" name="previousyear">
          <input type="hidden" name="op">

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

<!-- modal ajout ou edit lot -->
<div id="ModalLot" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titleLot"></h4>
      </div>
      <div class="modal-body">

        <form role="form" data-toggle="validator" method="POST" id="LOT">

          <div class="form-group has-feedback">
            <div class="input-group col-auto">
              <label for="numlot" class="control-label">Numéro de Lot: </label>
              <input type="text" id="numlot" name="numlot" class="form-control" placeholder="Entrer Le numéro du lot" data-error="Veuillez entrer un numéro" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group has-feedback">
            <div class="input-group col-auto">
              <label for="lieux" class="control-label">Lieux Compteur: </label>
              <input type="text" id="lieux" name="lieux" class="form-control" placeholder="Entrer Le lieux du compteur" data-error="Veuillez entrer un lieux" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>                      
          </div> 

          <div class="form-group has-feedback">
            <div class="input-group col-auto">
              <label for="appcomp" class="control-label">Appartenance Compteur: </label>
              <input type="text" id="appcomp" name="appcomp" class="form-control" placeholder="Entrer L'appartenance du compteur" data-error="Veuillez entrer une Appartenance" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>                      
          </div>

          <input type="hidden" name="IDlot">
          <input type="hidden" name="op">                            

          <div class="modal-footer">                
            <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>             
            <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>   
          </div>

          <div id="affinfolot" class="" role="alert"></div>
        </form>
      </div>
    </div>
  </div> 
</div>
