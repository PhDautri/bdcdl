<div class="row"> 

    <!-- Affichage des contacts des entreprises-->
    
    <div class="AffTContact col-sm-12">
    
      <h1>Contacts des Sociétés</h1>          

        <table id="TableContact" class="table table-hover" style="width: 100%">
            
            <thead>
                
              <tr class="odd" style="font-weight:bold;">                                       
                  
                  <th>Id</th>

                  <th>Nom</th>

                  <th>Prénom</th>

                  <th>Fonction</th>

                  <th>Société</th>

                  <th>Téléphone</th>

                  <th>Email</th>

                  <th>Actions</th>

              </tr>

            </thead>                 

        </table> 

    </div>
        
</div>

<!-- modal edit contact -->

<div id="editContact" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="titleEditContact" class="modal-title"></h4>
      </div>
      <div class="modal-body">

        <form role="form" data-toggle="validator" method="post" id="EditContact">

          <div class="form-group has-feedback">
            <div class="input-group col-sm-6">
              <label for="EdNomCont" class="control-label">Nom: </label>
              <input type="text" id="EdNomCont" name="EdNomCont" class="form-control" placeholder="Entrer Le Nom" data-error="Veuillez entrer un nom" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>                 
            </div>                      
          </div> 
          <div class="form-group has-feedback">            
            <div class="input-group col-sm-6">
              <label for="EdPrenomCont" class="control-label">Prénom: </label>                 
              <input class="form-control" name="EdPrenomCont" id="EdPrenomCont" data-error="Veuillez entrer un prenom" placeholder="Veuillez entrer un prénom" required=""></input>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>                  
            </div>             
          </div>

          <div class="form-group has-feedback">                
            <div class="input-group col-sm-6">
              <label for="EdFonction" class="control-label">Fonction: </label>                 
              <input type="text" class="form-control" name="EdFonction" id="EdFonction" data-error="Veuillez entrer une fonction" placeholder="Entrer la fonction" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>                  
            </div>             
          </div>

          <div class="form-group has-feedback">
            <div class="input-group col-sm-5">
              <label for="EdPhoneCell" class="control-label">Numéro Portable: </label>
              <input type="tel" maxlength="14" id="EdPhoneCell" name="EdPhoneCell" class="form-control TEL" data-error="Veuillez entrer un numero valide" placeholder="Entrer Le numero de portable" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
              <div id="aff_numphone" class=" "></div>
            </div>                      
          </div> 

          <div class="form-group has-feedback">
            <div class="input-group col-sm-8">
              <label for="EdEmailCont" class="control-label">Email: </label>
              <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="EdEmailCont" name="EdEmailCont" class="form-control" data-error="Veuillez entrer un email valide" placeholder="Entrer Un email">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>                      
          </div>     
          <br>         

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

