      
<!-- FORM VALIDATION -->
<div class="row mt">
  <div class="col-lg-12">
    <h3>Ajout utilisateur</h3>
    <div class="form-panel">
      <div class=" form">        
        <form class="cmxform form-horizontal style-form" id="adduser" method="post">

          <div class="form-group ">
            <label for="nom" class="control-label col-lg-2">Nom </label>
            <div class="col-lg-10">
              <input class=" form-control" id="nom" name="nom" minlength="2" placeholder="Entrer Un Nom" type="text" required />
            </div>
          </div>

          <div class="form-group ">
            <label for="prenom" class="control-label col-lg-2">Prénom</label>
            <div class="col-lg-10">
              <input class="form-control " id="prenom" type="text" name="prenom" placeholder="Entrer Un Prénom" required />
            </div>
          </div>

          <div class="form-group ">
            <label for="password" class="control-label col-lg-2">Mot de Passe</label>
            <div class="col-lg-10">
              <div class="input-group">
                <input class="form-control " id="pass" type="password" name="pass" placeholder="Entrer un mot passe générique" required />
                <span class="input-group-btn">
                  <button class="btn btn-default viewpass" data-id="pass" type="button"><span id="span_eye" class="glyphicon glyphicon-eye-close"></span></button>
                </span>
              </div>                
            </div>
          </div>            

          <div class="form-group ">
            <label for="type" class="control-label col-lg-2">Type compte</label>
            <div class="col-lg-10">
              <select class="form-control" id="type" type="text" name="type" required>
              	<option value="0">choix du type de compte</option>
              	<option value="1">Adminstrateur</option>
              	<option value="2">Utilisateur</option>
              </select>
            </div>
          </div>

          <div class="form-group AffNiveauAuth">
            <label for="type" class="control-label col-lg-2">Niveau Autorisation</label>
            <div class="col-lg-10">
              <input type="checkbox" name="NT"> Niveau Technique 
              <input type="checkbox" name="NC"> Niveau Comptable 
              <input type="checkbox" name="ND"> Niveau Direction 
            </div>
          </div>

          <div class="form-group ">
            <label for="email" class="control-label col-lg-2">Email</label>
            <div class="col-lg-10">
              <input class="form-control" id="email" placeholder="Entrer Un email valide" type="email" name="email" required />
            </div>
          </div>

          <div class="form-group">
            <label for="annu" class="control-label col-lg-2">N° Annuaire</label>
            <div class="col-lg-10">              
              <input class="form-control" type="text" maxlength="4" placeholder="Entrer le numéro d'annuaire valide" id="annu" name="annu">
            </div>
          </div>

          <div class="form-group">
            <label for="phone" class="control-label col-lg-2">N° SDA</label>
            <div class="col-lg-10">              
              <input class="form-control TEL" type="text" maxlength="14" placeholder="Entrer le numéro SDA valide" id="phone" name="phone">
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
              <button class="btn btn-theme" type="submit"><span class="glyphicon  glyphicon-ok"></span></button>
              <button class="btn btn-theme04" type="reset" onclick="this.form.reset();"><span class="glyphicon  glyphicon-remove"></span></button>
            </div>
          </div>

        </form>
      </div>
    </div>
    <!-- /form-panel -->
  </div>
  <!-- /col-lg-12 -->
</div>
        

