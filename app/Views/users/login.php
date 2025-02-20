<?php	 

	if($namebase != 'bdcdl') {

		?>						
			<h2 class="alert alert-info text-center">Notre site et en cours de maintenance !!</h2>			

		<?php

	} 

?>

<!-- page de connexion a la base de données -->
    
<div id="name">
    <form role="form" method="post">
        <h2>Connexion</h2>
        <h2><b>BD<span>CDL</span></b></h2>
        <input type="text" name="username" placeholder="Entrer le login" />
        <input type="password" name="password" placeholder="Mot de Passe" />
        <input type="submit" name="login" value="Se Connecter"/>
        <button type="button" class="btn btn-theme" data-role="RequestAccess" style="width: 320px;">Demander un accés à l'administrateur !!! </button><br>
		<a type="button" class="btn btn-theme03" data-toggle="modal" href="login.php#ForgotPassword" style="width: 320px;">Mot De Passe Oublié !!! </a>
    </form>           
</div>

<!-- modal demande d'acces -->
<div id="RequestAccess" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Demande D'accés</h4>
	    </div>
	    <div class="modal-body">
	      	<form  role="form" data-toggle="validator" method="post" id="REQUESTACCESS">            
	        
		        <div class="form-group has-feedback">
		          <div class="input-group col-sm-6">
		            <label for="nom" class="control-label">Nom: </label>
		            <input type="text" id="nom" name="nom" class="form-control" placeholder="Entré votre Nom" data-error="Veuillez entrer votre nom" required>
		            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		            <div class="help-block with-errors"></div>
		          </div>
		        </div>

		        <div class="form-group has-feedback">
		          <div class="input-group col-sm-6">
		            <label for="prenom" class="control-label">Prénom: </label>
		            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entré votre Prénom" data-error="Veuillez entrer votre prénom" required>
		            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		            <div class="help-block with-errors"></div>
		          </div>              
		        </div>

		        <div class="form-group has-feedback">
		          <div class="input-group col-sm-8">
		            <label for="email" class="control-label">Email: </label>
		            <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="email" name="email" class="form-control" data-error="Veuillez entrer un email valide" placeholder="Entrer Un email" required>
		            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		            <div class="help-block with-errors"></div>
		          </div>                      
		        </div>                              
		    
		        <div class="modal-footer">                  
		          <button type="submit" name="request" class="btn btn-success pull-right" value="request"><span class="glyphicon  glyphicon-ok"></span></button>
		          <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
		        </div>               

	      	</form>
	    </div>
	  </div>
	</div>
</div>

<!-- modal demande de reinitialisation mot de passe  -->
<div id="ForgotPassword" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Mot de passe oublié ?</h4>
	    </div>
	    <div class="modal-body">

	      	<form  role="form" data-toggle="validator" method="post" id="FORGOTPASSWORD">       
		        
		        <div class="form-group has-feedback">
		          <div class="input-group col-sm-12">
		            <label for="Email" class="control-label">Entrez votre adresse e-mail ci-dessous pour réinitialiser votre mot de passe.</label>
		            <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="Email" name="Email" class="form-control" data-error="Veuillez entrer un email valide" placeholder="Entrer Un email" required>
		            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		            <div class="help-block with-errors"></div>
		          </div>                      
		        </div>                              
		    
		        <div class="modal-footer">                  
		          <button type="submit" name="forgotPass" class="btn btn-success pull-right" value="forgotPass"><span class="glyphicon  glyphicon-ok"></span></button>
		          <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
		        </div>               

	      	</form>
	    </div>
	  </div>
	</div>
</div>