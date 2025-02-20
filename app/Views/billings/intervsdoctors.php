<div class="AffIntervCabDoctors col-sm-12">

	<h2>Intervention Cabinet Médecins GCS</h2>

	<p>
		<button data-role="addInterv" class="btn btn-success btn-round"<abbr title="Créer une intervention"><span class="glyphicon  glyphicon-plus"></span></abbr></button>	
    <a class="btn btn-round btn-default" target="_blank" href="?p=billings.viewAllInterv" <abbr title="Créer un PDF">PDF</abbr></a>
  </p>

  <table id="TableIntervDoctors" class="table table-hover" style="width: 100%">        
    <thead>          
      <tr class="odd" style="font-weight:bold;">  
        <th>Id</th>
        <th>Date Interv</th>
        <th>N° Intervention</th>
        <th>Client</th>
        <th>Désignation</th>
        <th>Etat</th>
        <th>Actions</th>
      </tr>
    </thead>
  </table>


    <div class="AffTableLines hidden">

      <h2>Lignes <button data-role="addLines" class="btn btn-success btn-round AddLines"<abbr title="Ajouter des lignes"><span class="glyphicon  glyphicon-plus"></span></abbr></button></h2>
      <div id="info_lines" class="" role="alert"></div>

      <input type="hidden" id="Id_Interv" name="Id_Interv">

      <table id="TableLines" class="table table-hover">
        
        <thead>
            
          <tr class="odd" style="font-weight:bold;">              
              
              <th>Id</th>
              <th>Désignation</th>
              <th>Quantité</th>
              <th>Prix Unit HT</th>
              <th>Actions</th>

          </tr>

        </thead>                 

    </table>    
      
    </div> 
	
</div>

<!--/////////////////////////MODAL//////////////////////////////-->


<!-- ajoute une intervention -->
<div id="intervdoc" class="modal fade bs-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>        
      </div>
      <div class="modal-body">

        <form role="form" data-toggle="validator" method="post" id="INTERVDOC">

          <div class="col-md-10 Affcolor hidden"><h3 class="Affnuminterv"></h3></div>

          <div class="col-lg-10 AffDateInterv hidden" style="background-color:#c2d6d6; border-radius: 6px; border: 1px solid black; margin-bottom: 9px;">
            <div class="form-horizontal col-lg-10">
              <div class="form-group"><legend>Date Intervention</legend></div>
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-xs-2 col-sm-2 col-lg-2 control-label">Date :</label>
                  <div class="col-xs-10 col-sm-8 col-lg-8">
                    <input type="date" id="dateI" name="dateI" class="form-control">
                  </div>
                </div>
              </div>              
            </div>  
          </div>

          <div class="col-lg-10 AffIntervenant" style="background-color:#c2d6d6; border-radius: 6px; border: 1px solid black; margin-bottom: 9px;">
            <div class="form-horizontal col-lg-10">
              <div class="form-group">
                <legend>Intervenant</legend>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-sm-2 col-lg-2 control-label">Nom : </label>
                  <div class="col-sm-8 col-lg-8">                       
                    <select type="text" class="form-control" id="contribut" name="contribut" required>
                      <option value="" selected>Veuillez Choisir l'intervenant !!!</option>
                      <option value="1">Service Technique</option>
                      <option value="2">Service Informatique</option>
                    </select>             
                  </div>
                </div>
              </div>              
            </div>
          </div>

          <div class="col-lg-10" style="background-color:#c2d6d6; border-radius: 6px; border: 1px solid black; margin-bottom: 9px;">
            <div class="form-horizontal col-lg-10">
              <div class="form-group">
                <legend>Client</legend>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-sm-2 col-lg-2 control-label">Nom : </label>
                  <div class="col-sm-8 col-lg-8">                       
                    <select type="text" class="form-control" id="nomcab" name="nomcab" required></select>             
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-sm-2 col-lg-2 control-label">Téléphone : </label>
                  <div class="col-sm-3 col-lg-3">
                    <input type="text" class="form-control" id="telephone" readonly>
                  </div>            
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-sm-2 col-lg-2 control-label">E-Mail : </label>
                  <div class="col-sm-6 col-lg-8">
                    <input type="email" class="form-control" id="email" readonly>
                  </div>
                </div>
              </div>              
            </div>
          </div>
    
          <div class="col-lg-10" style="background-color:#c2d6d6; border-radius: 6px; border: 1px solid black; margin-bottom: 9px;">
            <div class="form-horizontal col-lg-10">
              <div class="form-group"><legend>Désignation Intervention</legend></div>
              <div class="row">
                <div class="form-group">
                  <label for="text" class="col-xs-3 col-sm-3 col-lg-2 control-label">Désignation:</label>
                  <div class="col-xs-12 col-sm-12 col-lg-12">
                      <input type="text" id="design" name="design" class="form-control" required>
                  </div>
                </div>
              </div>              
            </div>            
          </div>
              
          <!--///////////////////// -->

          <input type="hidden" id="id_interv" name="id_interv" > <!-- hidden -->
          <input type="hidden" id="numinterv" name="numinterv">
          <input type="hidden" id="op" name="op">                  
      
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

<!-- ajoute une ou plusieurs lignes a l'intervention -->
<div id="line" class="modal fade bs-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>        
      </div>

      <form role="form" data-toggle="validator" method="post" id="LINE">
        <div class="modal-body">          

          <div style="background-color:#c2d6d6; border-radius: 6px; border: 1px solid black; ">
            
            <div class="form-group">
              <legend>Ligne(s)</legend>
            </div>
            
            <div class="form-group">
              <label for="text" class="col-sm-2 col-lg-2 control-label">Désignation </label>
              <div class="col-sm-9 col-lg-9">
                <input type="text" class="form-control" id="designation" name="designation" required>
              </div>
            </div>
          
            <br><br><br>
          
            <div class="form-group">
              <label for="text" class="col-sm-2 col-lg-2 control-label">Quantité </label>
              <div class="col-sm-2 col-lg-2">
                <input type="text" class="form-control" id="quantite" name="quantite" required>            
              </div>

              <label for="text" class="col-sm-2 col-lg-2 control-label">Prix Unit HT </label>
              <div class="input-group col-sm-3 col-lg-3">
                <input type="text" class="form-control Montant" id="prix_ht" name="prix_ht" required>
                <span class="input-group-addon">&euro;</span>
              </div>
            </div>                                     
           
          </div>

          <input type="hidden" id="id_line" name="id_line" > <!-- hidden id line -->
          <input type="hidden" id="ID_interv" name="ID_interv"> <!-- hidden id interv -->
          <input type="hidden" id="Op" name="Op">                  
        </div>

        <div class="modal-footer">          

          <div class="col-sm-3 col-lg-offset-4 col-lg-3">
            <button class="pull-right btn btn-primary" type="submit">Insérer cette ligne</button>
          </div>
          
        </div>

      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Bienvenue sur BDCDL !',
        // (string | mandatory) the text inside the notification
        text: 'Veuillez cliqué deux fois rapidement sur la ligne Intervention pour voir les lignes !!!',
        // (string | optional) the image to display on the left
        image: '',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 6000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    }); 

</script>   
