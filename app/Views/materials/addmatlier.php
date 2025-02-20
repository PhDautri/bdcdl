<?php //var_dump($_GET['id']); 
  
  if (empty($matep)) {
    $title = 'Ajout de Matériel lier';
  } else {

    $title = 'Ajout de Matériel lier à '.$matep[0]->num_inventaire;

  }

?>

<div class="row ADDMATLIER">
	<div class="col-lg-12">
    <h1><?= $title; ?></h1>    
    <div class=" form">
      <form role="form" data-toggle="validator" method="post" id="MaterialLier"> 

        <!-- section mat lier exist oui/non -->
        <section class="SBtnRadio hidden">            
          <div class="form-inline">                
            <div class="form-group">
              <label class="radio-inline" for="CloPanne">Le Matériel lié et il existant ?</label>
              <div class="input-group">                  
                <input type="radio" id="Oui" name="BTNRadio" value="1" required> Oui                        
                <input type="radio" id="Non" name="BTNRadio" value="2" required> Non 
              </div>
            </div>
          </div>
        </section>                
        <br>

        <div class="form-group SAddMate hidden">              

          <h4 id="numInvent"></h4>
          <!-- Produit Marque -->
          <div class="showback col-sm-12">              
            <div class="form-inline">
              <label for="Products" class="control-label">Produit:</label>
              <div class="input-group col-sm-5">                
                <select class="form-control ctrl" name="Products" id="Products" required></select>
                <span class="input-group-btn"><button class="btn btn-theme0" data-btn="0"  data-role="AddProduct" type="button">Add Produit</button></span>
              </div>

              <label for="Marques" class="control-label">Marque:</label>
              <div class="input-group col-sm-5">                
                <select class="form-control ctrl" name="Marques" id="Marques" required></select>
                <span class="input-group-btn"><button id="btnmark" class="btn btn-theme02" data-role="AddMark" type="button" disabled>Add marque</button></span> 
              </div>
            </div>
          </div>

          <!-- Model / Type / Num Serie -->
          <div class="showback col-sm-12">  
            <div class="form-inline">
              <label for="Models" class="control-label">Model:</label>
              <div class="input-group col-lg-3">                
                  <select class="form-control ctrl" name="Models" id="Models" required></select>
                  <span class="input-group-btn"><button id="btnmodel" class="btn btn-theme03" data-role="AddModel" type="button" disabled>Add model</button></span> 
              </div>

              <label for="Types" class="control-label">Type:</label>
              <div class="input-group col-lg-3">                
                <input type="text" class="form-control" id="Types" name="Types" disabled>
                <span class="input-group-btn"><button id="btntype" class="btn btn-theme04" data-role="AddType" type="button" disabled>Add type</button></span>              
              </div>

              <label for="Num_serie" class="control-label">Num Série:</label>   
              <div class="input-group col-lg-2">                                   
                <input type="text" name="Num_serie" id="Num_serie" class="form-control ctrl" placeholder="Ex: 180 48 11" required>
                <span class="input-group-btn"><button id="btngener" class="btn btn-primary" data-role="GeneNumSerie" type="button" disabled>Générer N° Série</button></span>
              </div>

              <div class="input-group col-lg-2">                                   
                <div id="Success_Error_NumSerie" class="" role="alert"></div>
              </div> 
            </div>
          </div>
          
          <!-- Zone Alimenté Niveau Lieux Piece -->
          <div class="showback col-sm-12">
            <label for="za" class="za">Localisation:</label>
            <div class="form-inline">
              <label for="Levels" class="control-label">Niveau:</label>
              <div class="input-group col-lg-3">                
                  <select class="form-control ctrl" name="Levels" id="Levels" required></select>
                  <span class="input-group-btn"><button id="btnlevel" class="btn btn-theme" data-role="AddLevel" type="button" disabled>Add niveau</button></span>
              </div>

              <label for="Places" class="control-label">Lieux:</label>
              <div class="input-group col-lg-3">                
                  <select class="form-control ctrl" name="Places" id="Places" required></select>
                  <span class="input-group-btn"><button id="btnplace" class="btn btn-primary" data-role="AddPlace" type="button" disabled>Add lieux</button></span>
              </div>

              <label for="Rooms" class="control-label">Pièce:</label>
              <div class="input-group col-lg-3 AffPiece">                
                <select class="form-control ctrl" name="Rooms" id="Rooms" required></select>
                <span class="input-group-btn"><button id="btnroom" class="btn btn-success" data-role="AddRoom" type="button" disabled>Add pièce</button></span>
              </div>

            </div>
          </div>

          <!-- datefab -- dateinstall--numfacture-- BTN add facture Achat -- montant achat / affiche le bouton facture achat ou view achat -->
          <div class="showback col-sm-12">
            <div class="form-inline">
              <label for="DateFab" class="control-label">Date Fabrication: </label>
              <div class="input-group col-sm-2">
                  <input type="date" class="form-control ctrl" id="DateFab" name="DateFab" value="" required>
              </div>
              <label for="DateInstall" class="control-label">Date Installation: </label>
              <div class="input-group col-sm-2">
                  <input type="date" class="form-control ctrl" id="DateInstall" name="DateInstall" required>                    
              </div>                
            </div>
          </div>            

          <!-- Armoire & Disjoncteur  -->
          <div class="showback col-sm-12">
            <div class="form-inline">
              <label for="arm" class="control-label">Armoire:</label>
              <div class="input-group col-lg-4">
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

          <!--textarea Note -->
          <div class="showback col-sm-12">
            <label for="Note">Entrer une note:</label>
            <textarea name="Note" id="Note" class="form-control" rows="4"></textarea>  
          </div>

        </div>
        <!-- div affichage statut -->
        <div class="form-group AffStatut hidden">
          <label for="Statut" class=" control-label">Statut:</label>
          <div class="input-group col-lg-3">                
            <select class="form-control" id="Statut" name="Statut" disabled></select>
            <span class="input-group-btn"><button id="btnstatut" class="btn btn-success" data-role="MajStatut" type="button" disabled>Maj Statut</button></span>              
          </div>
        </div>
        <!-- section aff mateériel non lier -->
        <section class="AffMateNonLier hidden">

          <table id="TableMateNonLier" class="table table-hover" style="width:100%;">
          
              <thead>
                  
                <tr class="odd" style="font-weight:bold;">

                    <th></th>                         
                    
                    <th>Id</th>

                    <th>Numéro Inventaire</th>

                    <th>Produit</th>

                    <th>Marque</th>
                  
                    <th>Model</th>

                    <th>Type</th>

                    <th>Numéro Série</th>

                    <th>Statut</th>

                </tr>

              </thead>                 

          </table>

      </section>

        <!-- inputs hidden -->
        <input type="hidden" name="NumInvent" id="NumInvent" /> <!-- passe le num inventaire hidden-->
        <input type="hidden" name="Types_Id" id="Types_Id"/> <!-- passe l'id type pour edition hidden -->
        <input type="hidden" name="operation" id="operation" /> <!-- passe l'operation hidden -->
        <input type="hidden" name="id_mate" id="id_mate" value="<?= $_GET['id']; ?>" /> <!-- hidden id materiel primaire-->
        <input type="hidden" name="multiselect" id="multiselect"> <!-- hidden tableau multi select -->                   
                  
        <div class="form-group">
          <div class="col-lg-12">
            <button type="submit" class="btn btn-theme pull-right affbtns hidden"><span class="glyphicon  glyphicon-ok"></span></button>      
            <button type="reset" onclick="history.go(-1);" class="btn btn-theme04 pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button></span></button>
          </div>
        </div>                                    
        <br>
        <br>           
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
              <input type="hidden" name="direct" id="direct"> <!-- passe la direction hidden -->

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
  