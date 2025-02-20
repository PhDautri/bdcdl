<div class="row">    

    <!-- Affichage du matériels -->    

      <div id="Ancre" class="col-lg-3">
          <h1>Matériel(s) Lié</h1>      
      </div>      
    
      <!-- affichage bouton add matériel -->
      <p class="col-lg-12">         
        <a class="btn btn-round btn-default" target="_blank" href="?p=materials.mateLierAllPdf" <abbr title="Créer un PDF">PDF</abbr></a>         
      </p>

      <!-- affichage tables matériel -->
      <div class="AffMatesLierAll col-lg-12">     

        <table id="TableMateLier" class="table table-hover" style="width:100%">            
          <thead>                
            <tr class="odd" style="font-weight:bold;">
              <th>Id</th>
              <th>N° INV</th>
              <th>Produit</th>
              <th>Marque</th>
              <th>Model</th>
              <th>Type</th>
              <th>Num Série</th>
              <th>Niveau</th>
              <th>Piéce</th>
              <th>Statut</th>
              <th>Montant Total Réparation</th>
              <th>Total Pannes</th>
              <th>Actions</th>
            </tr>
          </thead>            
        </table>
      </div>   
      
</div>

<!-- MODALS -->     

  <!-- Modal add product -->
    <div id="addproduct" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ajout Produit</h4>
          </div>
          <div class="modal-body">

            <form  role="form" data-toggle="validator" method="post" id="AddProduct">
              
              <div class="form-group has-feedback">
                <div class="input-group col-lg-5">
                  <label for="productadd" class="control-label">Produit: </label>
                  <input type="text" id="productadd" name="productadd" class="form-control" placeholder="Entré un produit" required>
                   <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
              </div>
              
              <div class="modal-footer">                  
                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
                <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
              </div>

              <div id="error_product" class="alert alert-danger danger-dismissable hidden"> Ce produit existe déja !!! </div>
              <div id="affaddproduct" class="" role="alert"></div>            

            </form>
          </div>
        </div>
      </div>
    </div>        
    
  <!-- Modal add mark-->
    <div id="addmark" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="titremark"></h4>
          </div>
          <div class="modal-body">

            <form role="form" data-toggle="validator" method="POST" id="AddMark">

              <div id="divMarkAdd" class="form-group has-feedback">
                  <div class="input-group col-auto">
                      <label for="markadd" class="control-label">Marque: </label>
                      <input type="text" id="markadd" class="form-control" placeholder="Entrer La marque" data-error="Veuillez entrer une marque" required>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <div class="help-block with-errors"></div>
                  </div>                      
              </div>                            

              <div class="modal-footer">                
                <button type="submit" id="submitmarkAdd" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>             
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>   
              </div>

              <div id="error_mark" class="alert alert-danger danger-dismissable hidden"> Cette marque existe déja !!! </div>

            </form>
          </div>
        </div>
      </div> 
    </div>

  <!-- Modal add model -->
    <div id="addmodel" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="titremodel"></h4>
          </div>
          <div class="modal-body">

            <form role="form" data-toggle="validator" method="post" id="AddModel">

              <div id="divModelAdd" class="form-group has-feedback">
                <div class="input-group col-sm-6">
                    <label for="modeladd" class="control-label">Model: </label>
                    <input type="text" id="modeladd" class="form-control" placeholder="Entrer Le model" data-error="Veuillez entrer un model" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>                      
              </div> 

              <input type="hidden" id="Id_mark" name="Id_mark"> <!-- hidden -->                                

              <div class="modal-footer">                
                              
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
               
                <button type="submit" id="submitModelAdd" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>         
              </div>                   
              <div id="error_model" class="alert alert-danger danger-dismissable hidden"> Ce model existe déja !!! </div>
            </form>
          </div>
        </div>
      </div> 
    </div>

  <!-- Modal add type -->
    <div id="addtype" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="Titretype"></h4>
          </div>
          <div class="modal-body">

            <form role="form" data-toggle="validator" method="post" id="AddType">

              <div id="selecttype" class="input-group col-lg-6">
                <label for="typeadd" class="control-label">Type:</label>
                  <select class="form-control" name="typeadd" id="typeadd" required></select>
              </div>

              <div id="inputtype" class="form-group has-feedback">

                <label for="othertypeadd" class="control-label">Type:</label>
                <div class="input-group col-lg-6">                  
                  <input type="text" class="form-control" name="othertypeadd" id="othertypeadd" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>                

              </div>

              <input type="hidden" name="Id_model" id="Id_model"> <!-- id du model hidden -->
              <input type="hidden" name="direct" id="direct">

              <br>
              <div class="modal-footer">                
                               
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
                <button id="submitTypeAdd" type="submit" class="btn btn-success"><span class="glyphicon  glyphicon-ok"></span></button>         
              </div>
              
            </form>
          </div>
        </div>
      </div> 
    </div>

  <!-- Modal add armoire -->
    <div id="addarm" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="Titrearm"></h4>
          </div>
          <div class="modal-body">

            <form role="form" data-toggle="validator" method="post" id="AddArm">
              <div class="form-group has-feedback">
                <div class="input-group col-lg-6">
                  <label for="nom_arm" class="control-label">Nom armoire:</label>
                    <input class="form-control" name="nom_arm" id="nom_arm" placeholder="Entrer L'armoire" data-error="Veuillez entrer une armoire" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="modal-footer">                
                               
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
                <button id="submitArmAdd" type="submit" class="btn btn-success"><span class="glyphicon  glyphicon-ok"></span></button>         
              </div>
              <div id="error_arm" class="alert alert-danger danger-dismissable hidden"> Cette armoire existe déja !!! </div>
            </form>
          </div>
        </div>
      </div> 
    </div>

  <!-- Modal add niveau -->
    <div id="addlevel" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ajout Niveau</h4>
          </div>
          <div class="modal-body">

            <form role="form" data-toggle="validator" method="post" id="AddLevel">
              
              <div class="form-group has-feedback">
                <div class="input-group col-sm-6">
                  <label for="leveladd" class="control-label">Niveau: </label>
                  <input type="text" id="leveladd" name="leveladd"class="form-control" placeholder="Entré un niveau" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
              </div>                  
          
              <div class="modal-footer">                  
                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
                <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
              </div>     

            </form>
          </div>
        </div>
      </div>
    </div>

  <!-- Modal add lieux -->
    <div id="addplace" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="titrePlace"></h4>
          </div>
          <div class="modal-body">
            <form role="form" data-toggle="validator" method="post" id="AddPlace">

              <div id="divPlaceAdd" class="form-group">
                <div class="form-group has-feedback">
                  <div class="input-group col-sm-6">
                    <label for="placeadd" class="control-label">Lieux: </label>
                    <input type="text" id="placeadd" name="placeadd" class="form-control" placeholder="Entré un lieux" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>              
              </div>
              <input type="hidden" id="Id_level"> <!-- id du niveau hidden-->                  
            
              <div class="modal-footer">                  
                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
                <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
              </div>

            </form>          
          </div>
        </div>
      </div>
    </div>  
  

<script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Bienvenue sur BDCDL !',
        // (string | mandatory) the text inside the notification
        text: 'Veuillez cliqué deux fois rapidement sur la ligne matériel pour voir les pannes.Et un click sur la ligne de la panne pour voir les événements !!!',
        // (string | optional) the image to display on the left
        image: '',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    }); 

</script>   