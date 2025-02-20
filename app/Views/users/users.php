<div class="row">    

  <!-- Affichage des utilisateurs-->
    
  <div class="col-sm-12">
    
    <h1>Utilisateurs</h1>          

    <table id="TableUsers" class="table table-hover" style="width: 100%">          
      <thead>            
        <tr class="odd" style="font-weight:bold;">
          <th>Id</th>
          <th>Login</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Type</th>              
          <th>Niveau</th>            
          <th>Email</th>
          <th>N° Annu</th>
          <th>N° Sda</th>
          <th>Compte</th>
          <th>Nbr connection</th>
          <th>Date derniére</th>
          <th>Actions</th>
        </tr>
      </thead> 
      </table> 

  </div>
        
</div>

<div id="EtatUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modifier Utilisateur</h4>
      </div>
      <div class="modal-body">

        <form  role="form" data-toggle="validator" method="post" id="EDITUSER">

          <div class="form-group">
            <div class="input-group col-sm-6">
              <label for="login" class="control-label">Login: </label>
              <input type="text" id="login" name="login" class="form-control" required>
            </div>
          </div>             
          
          <div class="form-group">
            <div class="input-group col-sm-6">
              <label for="nom" class="control-label">Nom: </label>
              <input type="text" id="nom" name="nom" class="form-control" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-sm-6">
              <label for="prenom" class="control-label">Prénom: </label>
              <input type="text" id="prenom" name="prenom" class="form-control" required>
            </div>
          </div>

          <div class="form-group ">              
            <div class="input-group col-sm-6">
              <label for="type" class="control-label">Type compte</label>
              <select class="form-control" id="type" type="text" name="type" required>
                <option value="0">choix du type de compte</option>
                <option value="administrateur">Adminstrateur</option>
                <option value="utilisateur">Utilisateur</option>
              </select>
            </div>
          </div>

          <div class="form-group AffNiveauAuth">
            <label for="type" class="control-label">Niveau Autorisation</label>
            <div class="col-lg-10">
              <input type="checkbox" name="NT"> Niveau Technique 
              <input type="checkbox" name="NC"> Niveau Comptable 
              <input type="checkbox" name="ND"> Niveau Direction 
            </div>
          </div>
          <br>
          <!-- email -->
          <div class="form-group">
            <div class="input-group col-sm-9">
              <label for="email" class="control-label">Email: </label>
              <input type="email" id="email" name="email" class="form-control">
            </div>
          </div>
          <!-- Telephone Annuaire INT-->
          <div class="form-group">
            <div class="input-group col-sm-6">
            <label for="annu" class="control-label">N° Annuaire: </label>
              <input type="text" id="annu" name="annu" maxlength="4" class="form-control">
            </div>
          </div>
          <!-- Telephone SDA-->
          <div class="form-group">
            <div class="input-group col-sm-6">
              <label for="phone" class="control-label">N° Sda: </label>
              <input type="text" id="phone" name="phone" maxlength="14" class="form-control TEL">
            </div>
          </div>

          <input type="hidden" id="IdUser" name="IdUser"> <!-- hidden -->                  
      
          <div class="modal-footer">                  
            <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
            <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
          </div>               

        </form>
      </div>
    </div>
  </div>
</div>