<!-- Affichage des événement journalier-->

<div class="AffDailyEvents col-sm-12">

  <h1>Liste Evénements Journalier</h1>

  <p id="btn_addDailyEvent"></p>

  <table id="TableDailyEvents" class="table table-hover" style="width: 100%">        
    <thead>            
      <tr style="font-weight:bold;">  
        <td>Id</td>
        <td>Déclarant</td>
        <td>Date</td>
        <td>Désignation</td>
        <td>Commentaire</td>
        <td>Actions</td>
      </tr>
    </thead>
  </table> 

</div>

<div id="Ancre3" class="col-lg-6"> 
  <div id="BtnHaut" class="hidden">
    <a href="javascript:history.go(-1);" class="btn btn-default"><span class="glyphicon  glyphicon-arrow-left"></span> Retour</a>
  </div>
</div>


<!-- MODAL -->

<!-- modal ajout & edition événements journalier -->
  <div id="dailyevent" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">          

            <form role="form" data-toggle="validator" method="post" id="Dailyevents">

              <div class="form-group">
                <div class="input-group col-md-4">
                  <label for="datedailyE" class="control-label">Date Enregistrement : </label>
                  <input type="date" name="datedailyE" id="datedailyE" class="form-control" required>
                </div>
              </div>
                              
              <div class="input-group col-lg-8 hidden" id="succaddcate"></div>
              <!-- textarea designation -->
              <div class="form-group">
                <label for="designE">Désignation:</label>
                <textarea name="designE" id="designE" class="form-control" rows="3" required></textarea>              
              </div>

              <!-- textarea designation -->
              <div class="form-group">
                <label for="commentE">Commentaire:</label>
                <textarea name="commentE" id="commentE" class="form-control" rows="3"></textarea>              
              </div>

              <input type="hidden" id="str" name="str"><!-- indique la page -->
              <input type="hidden" id="id" name="id"><!-- id events -->

              <div class="modal-footer">             

                <button type="submit" class="btn btn-theme pull-right"><span class="glyphicon  glyphicon-ok"></span></button>                
                <button type="reset" onclick="this.form.reset();" class="btn btn-theme04 pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>    

              </div>               

            </form>
        </div>
      </div>
    </div>
  </div>

