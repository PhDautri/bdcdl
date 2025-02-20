<div class="row">

	<div class="AffPhoneService col-sm-12">
		<h1>Les Services</h1>

		<div class="col-sm-9">
      <table id="TableService" class="table table-hover" style="width: 100%;">	            
        <thead>	                
          <tr class="odd" style="font-weight:bold;">
            <th>Id</th>
            <th>Service</th>
            <th>Actions</th>
          </tr>
        </thead>	            
      </table>
    </div>

	</div>	
	
</div>

<!-- MODAL -->
<!-- Modal edit service -->
  <div class="modal fade" id="editservice" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edition du service</h4>
        </div>
        <form role="form" data-toggle="validator" method="POST" id="EDITSERVICE" enctype="multipart/form-data">
          <div class="modal-body">            

            <div class="form-inline">
              <label for="service" class="control-label">Service: </label>
              <div class="input-group col-auto">                                  
                <input type="text" name="service" id="service" class="form-control" />                
              </div>                                
            </div>

            <input type="hidden" name="id_service" id="id_service">

            <br>             

            <div class="modal-footer">

              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></button>                
              <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></button>
                              
            </div>
            
          </div>
        </form>          
      </div>        
    </div>
  </div>