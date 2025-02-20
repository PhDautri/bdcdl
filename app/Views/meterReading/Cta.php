<div class="AffMeterReadingCTA col-sm-12">

	<h2>Relevés Des Compteurs Electrique CTA </h2>

	<p id="btn_MeterReading">		
    <a class="btn btn-round btn-default" target="_blank" href="?p=meterreading.AllMeterReadingCtaPdf" <abbr title="Créer un PDF">PDF</abbr></a>
  </p>
    
  <table id="TableMeterReadingCTA" class="table table-hover" style="width: 100%">        
    <thead>            
      <tr>
        <th>id</th>  
        <th>Date</th>
        <th>Electricitée CTA NORD (Kwh)</th>
        <th>Conso(Kwh)</th>
        <th>Electricité CTA SUD (Kwh)</th>
        <th>Conso(Kwh)</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
	
</div>

<!--////////////////////////MODAL/////////////////////////////-->

<!-- modal ajout et edit des relevés compteurs -->

<div id="MeterReading" class="modal fade bs-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form role="form" data-toggle="validator" method="post" id="METERREADING">
          <!-- Date -->
          <div class="form-group">
            <div class="input-group col-sm-3">
              <label for="date" class="control-label">Date: </label>
              <input type="date" id="date" name="date" class="form-control" placeholder="Entrer La date du relevé" required>                 
            </div>                      
          </div>
          <!-- fin date -->

          <!-- relevé Electricité CTA NORD -->
          <div class="form-inline">                       
            <div class="input-group col-sm-4">
              <label for="ctan" class="control-label">Relevé CTA Nord: (Kwh)</label>
              <input type="number" class="form-control" id="ctan" name="ctan" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required>     
            </div>
                        
            <div class="input-group col-sm-3">
              <label for="last_ctan" class="control-label">Dernier relevé: (Kwh)</label>
              <input type="number" class="form-control Reset" id="last_ctan" name="last_ctan" min="0" style="color: green; font-size: 20px;" readonly>    
            </div>           

            <div class="input-group col-sm-3 AffConsoCtaNord">
              <label for="conso_ctan" class="control-label">Conso: (Kwh)</label>
              <input type="text" class="form-control Reset" id="conso_ctan" name="conso_ctan" min="0" style="color: red; font-size: 20px;" readonly>            
            </div>
          </div>       
          <br> <!-- fin relevé CTA NORD -->            

          <!-- relevé CTA SUD -->
          <div class="form-inline">
            <div class="input-group col-sm-4">
              <label for="ctas" class="control-label">Relevé CTA SUD: (Kwh)</label>
              <input type="number" id="ctas" name="ctas" class="form-control" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required>               
            </div>

            <div class="input-group col-sm-3">
                <label for="last_ctas" class="control-label">Dernier relevé: (Kwh)</label>
                <input type="number" class="form-control Reset" id="last_ctas" name="last_ctas" min="0" style="color: green; font-size: 20px;" readonly>                
            </div>
            <div class="input-group col-sm-3 AffConsoCtaSud">
                <label for="conso_ctas" class="control-label">Conso: (Kwh)</label>
                <input type="text" class="form-control Reset" id="conso_ctas" name="conso_ctas" min="0" style="color: red; font-size: 20px;" readonly>                
            </div>                                 
          </div>

          <br><!-- fin relevé CTA SUD -->

          <input type="hidden" name="id_meter" id="id_meter">
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