
<div class="row">    

  <!-- messages --> 
  
  <div id="info_arm" class="hidden"></div>

<!-- ARMOIRE -->
    <div class="col-lg-12">

      <h2 id="Ancre">Armoires</h2>             

      <!-- affichage tables armoire -->
           
      <div class="col-lg-12">

          <table id="TableArmoire" class="table table-hover" style="width: 100%">
              
              <thead>
                  
	              <tr class="odd" style="font-weight:bold;">

                  <th>Id</th>
                  <th>Armoire</th>
                  <th>Type</th>
                  <th>Niveau</th>                      
                  <th>Lieux</th>
                  <th>Actions</th>

	              </tr>

              </thead>
              
          </table>

      </div>

      <input type="hidden" name="IdArm" id="IdArm">

    </div>

</div>

<!-- Modal edit arm -->
  <div class="modal fade" id="editarm" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edition de l'armoire</h4>
        </div>

        <div class="modal-body">

          <form role="form" data-toggle="validator" method="POST" id="EDITARM" enctype="multipart/form-data"> 

            <div class="form-input">
              <label for="arm" class="control-label">Armoire: </label>
              <div class="input-group col-lg-6">                                  
                <input type="text" name="arm" id="arm" class="form-control" />                
              </div>                                
            </div></br>

            <div class="form-input">
              <label for="type" class="control-label">Type: </label>
              <div class="input-group col-lg-6">                                  
                <input type="text" name="type" id="type" class="form-control" />                
              </div>                                
            </div></br>

            <div class="form-input">
              <label for="niveau" class="control-label">Niveau: </label>
              <div class="input-group col-lg-6">
                <select name="Levels" id="Levels" class="form-control"></select>                
              </div>                                
            </div></br>

            <div class="form-input">
              <label for="lieux" class="control-label">Lieux: </label>
              <div class="input-group col-lg-6">                                  
                <input type="text" name="lieux" id="lieux" class="form-control" />                
              </div>                                
            </div></br>

            <input type="hidden" id="armId" name="id"><!-- hidden -->

            <div class="modal-footer">

              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></button>                
              <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></button>
                              
            </div>

          </form>
        </div>          
      </div>        
    </div>
  </div> 