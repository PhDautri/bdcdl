<div class="AffMeterReading col-sm-12">  

	<h2>Relevés Des Compteurs GCS </h2>

	<p id="btn_MeterReading">		
    <a class="btn btn-round btn-default" target="_blank" href="?p=meterreading.AllMeterReadingPdf" <abbr title="Créer un PDF">PDF</abbr></a>
  </p>
    
    <table  id="TableMeterReading" class="table table-hover" style="width: 100%">        
      <thead>            
        <tr>
          <th>id</th>           
          <th>Date</th>
          <th>Eau(m3)</th>
          <th>Conso(m3)</th>
          <th>Rst_Eau</th>
          <th>Gaz(m3)</th>
          <th>Conso(m3)</th>
          <th>Rst_Gaz</th>
          <th>Elec Scanner</th>
          <th>Conso(Kwh)</th>
          <th>Rst_Scan</th>
          <th>Elec IRM</th>
          <th>Conso(Kwh)</th>
          <th>Rst_Irm</th>
          <th>Elec Radio</th>
          <th>Conso(Kwh)</th>
          <th>Rst_Radio</th>
          <th>Eau Radio</th>
          <th>Conso(m3)</th>            
          <th>Rst_EauR</th>
          <th>Eau Apf</th>
          <th>Conso(Kwh)</th>
          <th>Rst_Apf</th>
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

          <!-- relevé Eau -->
          <div class="form-inline">                       
            <div class="input-group col-sm-3">
              <label for="eau" class="control-label">Relevé Eau: </label>
              <input type="number" class="form-control" id="eau" name="eau" min="0" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required>     
            </div>
                        
            <div class="input-group col-sm-3">
              <label for="last_eau" class="control-label">Dernier relevé: </label>
              <input type="text" class="form-control Reset" id="last_eau" name="last_eau" style="color: green; font-size: 20px;" readonly>                
            </div>
            <div class="input-group col-sm-3 AffConso AffConsoEau">
              <label for="conso_eau" class="control-label">Conso: </label>
              <input type="text" class="form-control Reset" id="conso_eau" name="conso_eau" style="color: red; font-size: 20px;" readonly>                
            </div>

            <div class="input-group checkbox AffRstCounter">
              <label><input type="checkbox" name="rst_eau" value="1"> Reset Compteur</label>
            </div>  

          </div>         
          <br> <!-- fin relevé eau -->            

          <!-- relevé Gaz -->
          <div class="form-inline">
            <div class="input-group col-sm-3">
              <label for="gaz" class="control-label">Relevé Gaz: </label>
              <input type="number" id="gaz" name="gaz" class="form-control" min="0" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required>               
            </div>

            <div class="input-group col-sm-3">
                <label for="last_gaz" class="control-label">Dernier relevé: </label>
                <input type="text" class="form-control Reset" id="last_gaz" name="last_gaz" style="color: green; font-size: 20px;" readonly>                
            </div>
            <div class="input-group col-sm-3 AffConso AffConsoGaz">
                <label for="conso_gaz" class="control-label">Conso: </label>
                <input type="text" class="form-control Reset" id="conso_gaz" name="conso_gaz" style="color: red; font-size: 20px;" readonly>                
            </div>

            <div class="input-group checkbox AffRstCounter">
              <label><input type="checkbox" name="rst_gaz" value="1"> Reset Compteur</label>
            </div> 

          </div>
          <br><!-- fin relevé gaz -->

          <!-- relevé Scanner -->
          <div class="form-inline">
            <div class="input-group col-sm-3">
              <label for="scan" class="control-label">Relevé Scanner: </label>
              <input type="number" id="scan" name="scan" class="form-control" min="0" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required> 
            </div>

            <div class="input-group col-sm-3">
                <label for="last_scan" class="control-label">Dernier relevé: </label>
                <input type="text" class="form-control Reset" id="last_scan" name="last_scan" style="color: green; font-size: 20px;" readonly>                
            </div>
            <div class="input-group col-sm-3 AffConso AffConsoScan">
                <label for="conso_scan" class="control-label">Conso: </label>
                <input type="text" class="form-control Reset" id="conso_scan" name="conso_scan" style="color: red; font-size: 20px;" readonly>                
            </div>

            <div class="input-group checkbox AffRstCounter">
              <label><input type="checkbox" name="rst_scan" value="1"> Reset Compteur</label>
            </div> 

          </div>
          <br><!-- fin relevé Scanner -->

          <!-- relevé IRM -->
          <div class="form-inline">
            <div class="input-group col-sm-3">
              <label for="irm" class="control-label">Relevé IRM: </label>
              <input type="number" id="irm" name="irm" class="form-control" min="0" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required>    
            </div>

            <div class="input-group col-sm-3">
                <label for="last_irm" class="control-label">Dernier relevé: </label>
                <input type="text" class="form-control Reset" id="last_irm" name="last_irm" style="color: green; font-size: 20px;" readonly>                
            </div>
            <div class="input-group col-sm-3 AffConso AffConsoIrm">
                <label for="conso_irm" class="control-label">Conso: </label>
                <input type="text" class="form-control Reset" id="conso_irm" name="conso_irm" style="color: red; font-size: 20px;" readonly>                
            </div>

            <div class="input-group checkbox AffRstCounter">
              <label><input type="checkbox" name="rst_irm" value="1"> Reset Compteur</label>
            </div> 

          </div>
          <br><!-- fin relevé IRM -->

          <!-- relevé Radio -->
          <div class="form-inline">
            <div class="input-group col-sm-3">
              <label for="radio" class="control-label">Relevé Radio: </label>
              <input type="number" id="radio" name="radio" class="form-control" min="0" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required>
            </div>

            <div class="input-group col-sm-3">
                <label for="last_radio" class="control-label">Dernier relevé: </label>
                <input type="text" class="form-control Reset" id="last_radio" name="last_radio" style="color: green; font-size: 20px;" readonly>                
            </div>
            <div class="input-group col-sm-3 AffConso AffConsoRadio">
                <label for="conso_radio" class="control-label">Conso: </label>
                <input type="text" class="form-control Reset" id="conso_radio" name="conso_radio" style="color: red; font-size: 20px;" readonly>                
            </div>

            <div class="input-group checkbox AffRstCounter">
              <label><input type="checkbox" name="rst_radio" value="1"> Reset Compteur</label>
            </div> 

          </div>    
          <br><!-- fin relevé Radio -->

          <!-- relevé Eau_radio -->
          <div class="form-inline">                       
            <div class="input-group col-sm-3">
              <label for="eauR" class="control-label">Relevé Eau Radio: </label>
              <input type="number" class="form-control" id="eauR" name="eauR" min="0" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required>    
            </div>
                        
            <div class="input-group col-sm-3">
              <label for="last_eauR" class="control-label">Dernier relevé: </label>
              <input type="text" class="form-control Reset" id="last_eauR" name="last_eauR" style="color: green; font-size: 20px;" readonly>                
            </div>
            <div class="input-group col-sm-3 AffConso AffConsoEauR">
              <label for="conso_eauR" class="control-label">Conso: </label>
              <input type="text" class="form-control Reset" id="conso_eauR" name="conso_eauR" style="color: red; font-size: 20px;" readonly>                
            </div>

            <div class="input-group checkbox AffRstCounter">
              <label><input type="checkbox" name="rst_eauR" value="1"> Reset Compteur</label>
            </div> 

          </div>         
          <br> <!-- fin relevé eau APF -->

          <!-- relevé Eau_radio -->
          <div class="form-inline">                       
            <div class="input-group col-sm-3">
              <label for="eauA" class="control-label">Relevé Eau APF: </label>
              <input type="number" class="form-control" id="eauA" name="eauA" min="0" placeholder="Entrer Le relevé" style="color: blue; font-size: 20px;" required>    
            </div>
                        
            <div class="input-group col-sm-3">
              <label for="last_eauA" class="control-label">Dernier relevé: </label>
              <input type="text" class="form-control Reset" id="last_eauA" name="last_eauA" style="color: green; font-size: 20px;" readonly>                
            </div>
            <div class="input-group col-sm-3 AffConso AffConsoEauA">
              <label for="conso_eauA" class="control-label">Conso: </label>
              <input type="text" class="form-control Reset" id="conso_eauA" name="conso_eauA" style="color: red; font-size: 20px;" readonly>                
            </div>

            <div class="input-group checkbox AffRstCounter">
              <label><input type="checkbox" name="rst_eauA" value="1"> Reset Compteur</label>
            </div> 

          </div>         
          <br> <!-- fin relevé eau -->

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