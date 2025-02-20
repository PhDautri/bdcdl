<div class="row">    

  <!-- Affichage des intervenants-->
    
  <div class="AffTContri col-sm-12">    

    <h1>Intervenants Extérieur</h1>

    <p id="btn_addContri"></p>

    <table id="TableContri" class="table table-hover" style="width:100%">        
      <thead>          
        <tr class="odd" style="font-weight:bold;">            
          <th>Id</th>
          <th>Nom</th>
          <th>Adresse</th>
          <th>Code Postal</th>        
          <th>Ville</th>
          <th>Téléphone</th>
          <th>Site Web</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
          
</div>

<!-- CONTRIBUTORS -->

<!-- modal ajout & edit d'intervenant -->

<div id="contributor" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titleContribut"></h4>
      </div>
      <div class="modal-body">
        <form role="form" data-toggle="validator" method="post" id="AEContributor">          

          <div class="form-group has-feedback">
            <div class="input-group col-sm-6">
              <label for="Nom" class="control-label">Nom: </label>
              <input type="text" id="Nom" name="Nom" class="form-control" placeholder="Entrer Le Nom" data-error="Veuillez entrer un nom" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
              <div id="aff_contributor" class=""></div>                 
            </div>                      
          </div>
          
          <div class="form-group has-feedback">
            <label for="Adresse" class="control-label">Adresse: </label>
            <div class="input-group">                 
              <textarea class="form-control" name="Adresse" id="Adresse" cols="60" rows="5" data-error="Veuillez entrer une adresse" placeholder="Entrer L'adresse" required=""></textarea>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>                  
            </div>             
          </div>

          <div class="form-group has-feedback">                
            <div class="input-group col-sm-6">
              <label for="CodePostal" class="control-label">Code Postal: </label>                 
              <input type="text" class="form-control CDP" maxlength="6" name="CodePostal" id="CodePostal" data-error="Veuillez entrer le code postal" placeholder="Entrer le code postal" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>                  
            </div>             
          </div>

          <div class="form-group has-feedback">                
            <div class="input-group col-sm-6">
              <label for="Ville" class="control-label">Ville: </label>                 
              <input type="text" class="form-control" name="Ville" id="Ville" data-error="Veuillez entrer une ville" placeholder="Entrer la ville" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>                  
            </div>             
          </div>

          <div class="form-group has-feedback">
            <div class="input-group col-sm-5">
              <label for="Phone" class="control-label">Téléphone: </label>
              <input class="form-control TEL" type="tel" maxlength="14" id="Phone" name="Phone" data-error="Veuillez entrer un numéro valide" placeholder="Entrer Le téléphone" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
              <div id="error_numphone"></div>
            </div>                      
          </div>  

          <div class="form-group has-feedback">
            <div class="input-group col-sm-8">
              <label for="Siteweb" class="control-label">Site Web: </label>
              <input type="url" class="form-control" 
              pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?" 
              id="Siteweb" name="Siteweb"  data-error="Veuillez entrer L'adresse du site" placeholder="Entrer L'adresse internet">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>                      
          </div>     
          <br>

          <div id="error"></div>

          <input type="hidden" name="action" id="action">
          <input type="hidden" name="depend" id="depend">
          <input type="hidden" name="ContriID" id="ContriID">

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

<!-- CONTACTS --> 

<!-- modal view contact -->

<div id="viewContact" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="titleContact" class="modal-title"></h4>
      </div>
      <div class="modal-body">

        <button class="btn_addContact btn btn-success" data-role="addContact"<abbr title="Ajouter un contact"><span class="glyphicon  glyphicon-plus"></span></abbr></button>

        <input type="hidden" id="IdContribut"> <!-- id contribut -->
        <input type="hidden" id="Contribut"> <!-- nom du contributor -->

        <table id="TableViewContact" class="table table-hover" style="width:100%;">
                
          <thead>
              
            <tr class="odd" style="font-weight:bold;">                                       
                
                <th>Id</th>

                <th>Nom</th>

                <th>Prénom</th>

                <th>Function</th>
              
                <th>Téléphone</th>

                <th>Email</th>

                <th>Actions</th>

            </tr>

            </thead>                 

        </table>                        
      
        <div class="modal-footer">                  
            
        </div>          
      </div>
    </div>
  </div>
</div>

<!-- modal add contact -->

<div id="addContact" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="titleAddContact" class="modal-title"></h4>
      </div>
      <div class="modal-body">

        <form role="form" data-toggle="validator" method="post" id="AddContact">

          <div class="form-group has-feedback">
            <div class="input-group col-sm-6">
              <label for="NomCont" class="control-label">Nom: </label>
              <input type="text" id="NomCont" name="NomCont" class="form-control" placeholder="Entrer Le Nom" data-error="Veuillez entrer un nom" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>                 
            </div>                      
          </div> 
          <div class="form-group has-feedback">            
            <div class="input-group col-sm-6">
              <label for="PrenomCont" class="control-label">Prénom: </label>                 
              <input class="form-control" name="PrenomCont" id="PrenomCont" data-error="Veuillez entrer un prenom" placeholder="Veuillez entrer un prénom" required=""></input>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>                  
            </div>             
          </div>

          <div class="form-group has-feedback">                
            <div class="input-group col-sm-6">
              <label for="Fonction" class="control-label">Fonction: </label>                 
              <input type="text" class="form-control" name="Fonction" id="Fonction" data-error="Veuillez entrer une fonction" placeholder="Entrer la fonction" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>                  
            </div>             
          </div>

          <div class="form-group has-feedback">
            <div class="input-group col-sm-5">
              <label for="PhoneCell" class="control-label">Numéro Téléphone: </label>
              <input type="tel" maxlength="14" id="PhoneCell" name="PhoneCell" class="form-control TEL" data-error="Veuillez entrer un numéro valide" placeholder="Ex: 05 58 75 12 45" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
              <div id="aff_numphone" class=" "></div>
            </div>                      
          </div> 

          <div class="form-group has-feedback">
            <div class="input-group col-sm-8">
              <label for="EmailCont" class="control-label">Email: </label>
              <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="EmailCont" name="EmailCont" class="form-control" data-error="Veuillez entrer un email valide" placeholder="Entrer Un email">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>                      
          </div>     
          <br>

          <input type="hidden" id="idContrib" name="idContrib"> <!-- hidden -->

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
              <label for="EdPhoneCell" class="control-label">Numéro Téléphone: </label>
              <input type="tel" maxlength="14" id="EdPhoneCell" name="EdPhoneCell" class="form-control TEL" data-error="Veuillez entrer un numero valide" placeholder="Ex: 05 58 75 45 78" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
              <div id="error_numphone"></div>
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

