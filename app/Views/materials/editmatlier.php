<div class="row EDITMATLIER">
	<div class="col-lg-12">
    <h1>Edition Matériel Lié</h1>    
    <div class=" form">
      <form role="form" data-toggle="validator" method="post" id="MaterialLier">        

        <div class="form-group SAddMate">              

          <h4 id="numInvent"></h4>
          
          <!-- Family / Produit / Marque -->
          <div class="showback col-sm-12">                
            <div class="form-inline">
              <label for="family" class="control-label">Famille:</label>
              <div class="input-group col-sm-auto">                
                <select class="form-control" name="family" id="family" required></select>
                <span class="input-group-btn"><button class="btn btn-theme0"  data-role="AddFamily" type="button">Add Famille</button></span>
              </div>

              <label for="Products" class="control-label">Produit:</label>
              <div class="input-group col-sm-auto">                
                <input class="form-control" name="Products" id="Products" disabled></input>
              </div>

              <label for="Marques" class="control-label">Marque:</label>
              <div class="input-group col-sm-auto">                
                <select class="form-control" name="Marques" id="Marques" required></select>
                <span class="input-group-btn"><button id="btnmark" class="btn btn-theme02" data-role="AddMark" type="button" disabled>Add marque</button></span> 
              </div>
            </div>
          </div>

          <!-- Model Type Num Serie -->
          <div class="showback col-sm-12">
            <div class="form-inline">
              <label for="Models" class="control-label">Model:</label>
              <div class="input-group col-lg-3">                
                  <select class="form-control" name="Models" id="Models" required></select>
                  <span class="input-group-btn"><button id="btnmodel" class="btn btn-theme03" data-role="AddModel" type="button" disabled>Add model</button></span> 
              </div>

              <label for="Types" class="control-label">Type:</label>
              <div class="input-group col-lg-3">                
                <input type="text" class="form-control" id="Types" name="Types" disabled>
                <span class="input-group-btn"><button id="btntype" class="btn btn-theme04" data-role="AddType" type="button" disabled>Add type</button></span>            
              </div>

              <label for="Num_serie" class="control-label">Num Série:</label>   
              <div class="input-group col-lg-auto">                                   
                <input type="text" name="Num_serie" id="Num_serie" class="form-control" placeholder="Ex: 180 48 11" required>
                <span class="input-group-btn"><button id="btngener" class="btn btn-primary" data-role="GeneNumSerie" type="button" disabled>Générer N° Série</button></span>
                <div id="Success_Error_NumSerie" class=""></div>
              </div>
            </div>
          </div>             
            
          <!-- Zone Alimenté Niveau Lieux Piece-->
          <div class="showback col-sm-12">
            <label for="za">Localisation:</label>
            <div class="form-inline">
              <label for="Levels" class="control-label">Niveau:</label>
              <div class="input-group col-lg-3">                
                <select class="form-control" name="Levels" id="Levels" required></select>
                <span class="input-group-btn"><button id="btnlevel" class="btn btn-theme" data-role="AddLevel" type="button" disabled>Add niveau</button></span>
              </div>

              <label for="Places" class="control-label">Lieux:</label>
              <div class="input-group col-lg-3">                
                <select class="form-control" name="Places" id="Places" required></select>
                <span class="input-group-btn"><button id="btnplace" class="btn btn-primary" data-role="AddPlace" type="button" disabled>Add lieux</button></span>
              </div>              

              <label for="Rooms" class="control-label AffPiece">Pièce:</label>
              <div class="input-group col-lg-3 AffPiece">                
                <select class="form-control" name="Rooms" id="Rooms"></select>
                <span class="input-group-btn"><button id="btnroom" class="btn btn-success" data-role="AddRoom" type="button" disabled>Add pièce</button></span>
              </div>
            </div>
          </div>

          <!-- datefab -- dateinstall--numfacture / affiche le bouton facture achat ou view achat & montant achat-->
          <div class="showback col-sm-12">
            <div class="form-inline">

              <label for="DateFab" class="control-label">Date Fabrication: </label>
              <div class="input-group col-sm-2">
                <input type="date" class="form-control" id="DateFab" name="DateFab" value="" required>
              </div>

              <label for="DateInstall" class="control-label">Date Installation: </label>
              <div class="input-group col-sm-2">
                <input type="date" class="form-control" id="DateInstall" name="DateInstall" required>                  
              </div>
              
              <div class="input-group btn col-sm-2 AffbtnFA">
                <span><button id="" class="AffAddFA btn btn-success col-md-12" data-role="uploadfile" data-b="FA" type="button">add Facture Achat</button></span>
                <span><a href="" target="_blank" id="viewPdfFA" class="AffViewFA btn btn-info col-md-9 hidden">View Facture Achat</a>
                <button type="button" id="changeFA" class="AffViewFA btn btn-theme col-md-3 hidden" data-c="CH" data-role="uploadfile" data-b="FA"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button></span>
              </div>

              <div class="input-group col-sm-2 AffMontantAchat hidden">
                  <h4 id="MontantAchat"></h4>
              </div>
            </div>
          </div>

          <!-- Poids en Charge Fluide -->
          <div class="showback CaractClim col-sm-12 hidden">
            <div class="form-inline">
              <label for="poidscharge" class="control-label">Poids Charge:</label>
              <div class="input-group col-lg-2">
                <input type="text" class="form-control" name="poidscharge" id="poidscharge" required><span class="input-group-addon">Kgrs</span>
              </div>

              <label for="fluide" class="control-label">Fluide:</label>
              <div class="input-group col-lg-2">
                <input type="text" class="form-control" name="fluide" id="fluide" required>
              </div>                  
            </div>
          </div>            

          <!-- Armoire & Disjoncteur  -->
          <div class="showback col-sm-12">
            <div class="form-inline">
              <label for="arm" class="control-label">Armoire:</label>
              <div class="input-group col-lg-3">
                <select class="form-control" name="arm" id="arm"></select>
                <span class="input-group-btn"><button id="btnarm" class="btn btn-theme04" data-role="AddArm" type="button" disabled>Add ARM</button></span>
              </div>

              <label for="disj" class="control-label">Disjoncteur:</label>
              <div class="input-group col-lg-2">
                <input type="text" class="form-control" placeholder="Ex: D1.5" name="disj" id="disj">
              </div>
            </div>
          </div>

          <!-- Autres Caracteristique-->
          <div class="showback Caract">
            <label for="aca" class="aca">Caractéristique Technique:</label>
            <textarea name="Caract" id="Caract" class="form-control" rows="2" cols="100"></textarea>
          </div>

          <!--textarea Note-->
          <div class="showback col-sm-12">
            <label for="Note">Entrer une note:</label>
            <textarea name="Note" id="Note" class="form-control" rows="4"></textarea>  
          </div>

        </div>

        <!-- Statut -->
        <div class="form-group AffStatut hidden">
          <label for="Statut" class=" control-label">Statut:</label>
            <div class="input-group col-lg-3">                
              <select class="form-control" id="Statut" name="Statut" disabled></select>
              <span class="input-group-btn"><button id="btnstatut" class="btn btn-success" data-role="MajStatut" type="button" disabled>Maj Statut</button></span>              
            </div>
        </div>

          <!-- inputs hidden ***********************-->
          <input type="hidden" name="id_mate" id="id_mate" value="<?= $_GET['id']; ?>" /> <!-- hidden id materiel -->
          <input type="hidden" name="id_product" id="id_product" /> <!-- hidden-->
          <input type="hidden" name="Types_Id" id="Types_Id"/> <!-- hidden -->
          <input type="hidden" name="operation" id="operation" /> <!-- hidden -->
          <input type="hidden" name="nacl" value="NULL" /> <!-- hidden-->
          <input type="hidden" name="LieuxInst" value="NULL"> <!-- hidden-->
          <input type="hidden" name="history" id="history" /> <!-- hidden -->                    
                  
        <div class="form-group">
          <div class="col-lg-12">
            <a href="?p=materialslier" class="btn btn-theme04 pull-left"><span class="glyphicon  glyphicon-remove"></span></a>

            <div class="btn-group center">
              <a href="" id="preced" class="btn btn-default">précédent</a>
              <a href="" id="suivan" class="btn btn-default">Suivant</a>              
            </div>
            
            <button type="submit" class="btn btn-theme pull-right"><span class="glyphicon  glyphicon-ok"></span></button>                   
          </div>
        </div>                                    
                   
      </form>   
    </div>    
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
              <div id="affaddmark" class="hidden" role="alert"></div>
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
              <div id="success_model" class="alert alert-success success-dismissable hidden">Le model à bien était enregistré !!!</div>
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
              <div id="error_type" class=""> Ce type existe déja !!! </div>
              
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
              <div class="form-inline">
                <label for="n_arm" class="control-label">Nom armoire:</label>
                <div class="input-group col-lg-6">                
                  <input class="form-control" name="n_arm" id="n_arm" placeholder="Entrer Le nom de l'armoire" required>
                </div>
              </div></br>                            

              <div class="form-inline">
                <label for="Levels" class="control-label">Niveau: </label>
                <div class="input-group col-auto">
                  <select name="Levels" class="form-control" required></select>                
                </div>                                
              </div></br>

              <div class="form-inline">
                <label for="lieux" class="control-label">Lieux: </label>
                <div class="input-group col-auto">                                  
                  <input type="text" name="lieux" id="lieux" class="form-control" required />                
                </div>                                
              </div></br>

              <div class="modal-footer">                
                               
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
                <button id="submitArmAdd" type="submit" class="btn btn-success"><span class="glyphicon  glyphicon-ok"></span></button>         
              </div>
              <div id="error_arm" class=""></div>
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

  <!-- Modal add pièce -->
    <div id="addroom" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="titreRoom"></h4>
          </div>
          <div class="modal-body">
            <form role="form" data-toggle="validator" method="post" id="AddRoom">

              <div class="form-group">
                <div class="form-group has-feedback">
                  <div class="input-group col-sm-6">
                    <label for="roomadd" class="control-label">Pièce: </label>
                    <input type="text" id="roomadd" name="roomadd" class="form-control" placeholder="Entré une pièce" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>
                </div>              
              </div>
              <input type="hidden" id="Id_place"> <!-- id du lieux hidden-->                  
            
              <div class="modal-footer">                  
                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
                <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
              </div>

            </form>          
          </div>
        </div>
      </div>
    </div>

  <!-- Modal ajout document fact nouveau materiel -->
    <div id="ModalAddDoc" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">

            <form role="form" enctype="multipart/form-data" data-toggle="validator" id="ValidateUpload" method="post">

              <div id="affdocEnreg"></div><br>

              <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
              <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />

              <div class="input-group">               
                Envoyez ce fichier : <input class="btn btn-primary" id="file" name="file" type="file" />
                <br>                
                <button class="AffbtnViewer btn btn-info hidden" type="button" value="Preview" onclick="PreviewImage();">Voir!</button>
              </div>           
              <br>
              <div class="ViewerPdf hidden" style="clear:both">
                 <iframe id="viewer" frameborder="0" scrolling="no" width="550" height="200"></iframe>
              </div>
              <div class="AffInpMontant input-group col-lg-4">
                <label for="montantTTC" class="AffLabel control-label"></label>
                <input type="text" name="montantTTC" id="montantTTC" class="form-control"/> <!-- required -->
              </div>
              <br>
              <input type="hidden" id="MateID" name="MateID" /> <!-- hidden / id materiel -->              
              <input type="hidden" id="IndexUp" name="IndexUp" /> <!-- hidden -->
              <input type="hidden" id="docenreg" name="docenreg" /> <!-- hidden -->

              <input class="btn btn-success" type="submit" value="Envoyer le fichier" />

            </form>
          </div>
        </div>
      </div>
    </div>

  <script>    

    // preview fichier 
  
    function PreviewImage() {
        pdffile=document.getElementById("file").files[0];
        pdffile_url=URL.createObjectURL(pdffile);
        $('#viewer').attr('src',pdffile_url);
    }    

  </script> 