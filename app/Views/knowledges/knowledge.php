<div class="AffKnowledge col-sm-12">

	<h1>Base De Connaissance</h1>

	<div class="col-sm-3">
	    <section class="panel">
	      <div class="panel-body">
	        <p>Catégories <button class="btn btn-round btn-success" data-role="Addcategories"<abbr title="Ajouter une catégorie "><span class="glyphicon  glyphicon-plus"></span></abbr></button></p>
	        <ul class="categories"></ul>
	      </div>
	    </section>	    
	</div>

	<div class="col-sm-9 AffKnowledge hidden">
		<h4 id="affpsujet"></h4>
		<input type="hidden" name="idcategory" id="idcategory">

		<table id="TableKnowledge" class="table table-bordered" style="width: 100%">        
      <thead>          
        <tr class="odd" style="font-weight:bold;">            
          <td>Id</td>
          <td>Sujet</td>
          <td>Probléme</td>
          <td>Actions</td>
        </tr>
      </thead>
	  </table>

	  <br>		

		<div class="panel panel-warning AffResolution hidden">
			<input type="hidden" name="id_resolut"> 
			<div class="panel-heading"><h3 class="panel-title">Résolution Probléme</h3><button id="btneditresolut" class="btn btn-primary btn-round pull-right" data-role="Editresolut"><span class="glyphicon  glyphicon-pencil"></span></button></div> 
			<div class="panel-body" id="affresolution"></div> 
		</div>

	</div>	
	
</div>

<!-- Modal add categorie -->
	<div id="addcategorie" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title"></h4>
		      </div>
		      <div class="modal-body">

		        <form role="form" data-toggle="validator" method="post" id="AddCategorie">
		            <div class="form-group has-feedback">
	                <div class="input-group col-lg-6">
                    <label for="cate" class="control-label">Catégorie:</label>
                    <input class="form-control" name="cate" id="cate" placeholder="Entrer La Catégorie" data-error="Veuillez entrer une Catégorie" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
	                </div>
		            </div>
		            <div class="modal-footer">                
		                           
		            	<button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
		            	<button type="submit" class="btn btn-success"><span class="glyphicon  glyphicon-ok"></span></button>

		          	</div>
		          	<div id="error_cate" class="alert alert-danger danger-dismissable hidden"> Cette catégorie existe déja !!! </div>
		        </form>
		      </div>
		    </div>
		</div> 
	</div>

<!-- Modal add ou edit suject & probleme -->
	<div id="Suject" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title"></h4>
				</div>
				<form role="form" data-toggle="validator" method="POST" id="SUJECT" enctype="multipart/form-data">
				  <div class="modal-body">            

				    <div class="form-group Affinpsujet">
				      <label for="suject" class="control-label">Sujet: </label>
				      <div class="input-group col-sm-12">                                  
				        <input type="text" name="suject" id="suject" class="form-control" />                
				      </div>

				      <label for="probleme" class="control-label">Probléme: </label>
				      <div class="input-group col-sm-12">                                  
				        <input type="text" name="probleme" id="probleme" class="form-control" />                
				      </div>
				    </div>

				    <div class="form-group AffAreaResolut">
				    	<label for="resolution">Résolution: </label>
				    	<textarea name="resolution" id="resolution" class="form-control" rows="3"></textarea>
				    </div>

				    <input type="hidden" name="id_suject" id="id_suject">
				    <input type="hidden" name="id_category" id="id_category">
				    <input type="hidden" name="op" id="op">

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

<script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Bienvenue sur BDCDL !',
        // (string | mandatory) the text inside the notification
        text: 'Veuillez cliqué sur une catégorie et puis une fois sur la ligne sujet pour voir la résolution possible !!!',
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