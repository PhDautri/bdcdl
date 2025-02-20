<div class="col-sm-12 AffEmailParams">

	<section class="panel">
	    <header class="panel-heading wht-bg">
	      <h4 class="gen-case">Paramétrage Email</h4>
	    </header>
	    <div class="panel-body minimal">	    	

	    	<form role="form" data-toggle="validator" method="post" id="PARAMS_EMAIL">
	    		<fieldset disabled>
					<div class="form-row">
					    <div class="form-group col-md-6">
					      <label for="host">Nom d'hôte ou adresse IP du serveur SMTP/SMTPS</label>
					      <input type="text" class="form-control" id="host" name="host" required>
					    </div>
					    <div class="form-group col-md-6">
					      <label for="port">Port du serveur SMTP/SMTPS</label>
					      <input type="text" class="form-control" id="port" name="port" placeholder="25-587" required>
					    </div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
						    <label for="username">Identifiant d'authentification SMTP si authentification SMTP requise</label>
						    <input type="text" class="form-control" id="username" name="username" placeholder="" required>
						</div>
						<div class="form-group col-md-6">
						    <label for="password">Mot de passe d'authentification SMTP si authentification SMTP requise</label>
						    <input type="password" class="form-control" id="password" name="password" required>
						</div>
					</div>				

					<div class="form-row">
					    <div class="form-group col-md-4">
					      <label for="TLS">Utilisation du chiffrement TLS (SSL)</label>
					      <select id="TLS" name="TLS" class="form-control">
					        <option  value="0" selected>Non</option>
					        <option value="1" >Oui</option>
					      </select>
					    </div>
					    <div class="form-group col-md-4">
					      <label for="STARTTLS">Utiliser le cryptage TTS (STARTTLS)</label>
					      <select id="STARTTLS" name="STARTTLS" class="form-control">
					        <option  value="0" selected>Non</option>
					        <option value="1" >Oui</option>
					      </select>
					    </div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
						    <label for="EMAIL_FROM">Adresse email de l'émetteur pour l'envoi d'emails automatiques</label>
						    <input type="email" class="form-control" id="EMAIL_FROM" name="EMAIL_FROM" required>
						</div>
						<div class="form-group col-md-6">
						    <label for="NAME_FROM">Nom de l'expéditeur</label>
						    <input type="text" class="form-control" id="NAME_FROM" name="NAME_FROM" required>
						</div>					
					</div>

				</fieldset>

				<input type="hidden" id="op" name="op" />
				<input type="hidden" id="id" name="id" />

				<div class="form-group AffbtnValid hidden">
				    <div class="col-sm-10">
				      <button type="submit" id="Valid" class="btn btn-success"><span class="fa fa-plus"></span></button>
				      <button type="reset" class="btn btn-danger"><span class="fa fa-times"></span></button>
				    </div>
				</div>				

			</form>

			<div class="form-group AffbtnModif">
			    <div class="col-sm-10">
			      <button type="submit" id="Modif" class="btn btn-primary">Modifier</button>
			      <button type="" id="test" class="btn btn-primary">Test Email</button>
			    </div>
			</div>			

	    </div>

	</section>

	<section class="panel Affresult hidden">
		<textarea class="form-control" rows="8" name="result" id="result"></textarea>
	</section>
	
</div>