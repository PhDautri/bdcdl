<div class="row ADDMAT">
	<div class="col-lg-12">
    <h1>Ajout de Matériel</h1>    
    <div class=" form">
      <form role="form" data-toggle="validator" method="post" id="Material">            

        <div class="form-group SAddMate">
          
          <input type="hidden" name="cat" id="cat">

          <!-- Numéro Inv / Ancien num INV -->
          <div class="showback col-sm-12">
            <div class="form-inline">
              <h4 class="col-sm-3">Numéro Inventaire: <span id="numInvent"></span></h4>

              <label for="inventory" class="control-label">Ancien N° INV:</label>
              <div class="input-group col-sm-auto">                
                <input class="form-control" name="inventory" id="inventory"></input>
              </div>             

            </div> 
          </div>
          
          <!-- Family / Produit / Marque  -->
          <div class="showback col-sm-12">
            <div class="form-inline">
              <label for="family" class="control-label">Famille:</label>
              <div class="input-group col-sm-auto">                
                <select class="form-control" name="family" id="family" required></select>
                <span class="input-group-btn"><button class="btn btn-theme0" data-role="AddFamily" type="button">Add Famille</button></span>
              </div>

              <label for="Products" class="control-label">Produit:</label>
              <div class="input-group col-sm-auto">                
                <select class="form-control" name="Products" id="Products" required></select>
                <span class="input-group-btn"><button id="btnproduct" class="btn btn-theme0" data-btn="1" data-role="AddProduct" type="button" disabled>Add Produit</button></span>
              </div>

              <label for="Marques" class="control-label">Marque:</label>
              <div class="input-group col-sm-auto">                
                <select class="form-control" name="Marques" id="Marques" required></select>
                <span class="input-group-btn"><button id="btnmark" class="btn btn-theme02" data-role="AddMark" type="button" disabled>Add marque</button></span> 
              </div>              
            </div>
          </div>

          <!--  model / type -->
          <div class="showback col-sm-12">
            <div class="form-inline">
              <label for="Models" class="control-label">Model:</label>                
              <div class="input-group col-sm-auto">                                  
                <select class="form-control" name="Models" id="Models" required></select>
                <span class="input-group-btn"><button id="btnmodel" class="btn btn-theme03" data-role="AddModel" type="button" disabled>Add model</button></span> 
              </div>

              <label for="Types" class="control-label">Type:</label> 
              <div class="input-group col-sm-auto">                                
                <input type="text" class="form-control" id="Types" name="Types" disabled>
                <span class="input-group-btn"><button id="btntype" class="btn btn-theme04" data-role="AddType" type="button" disabled>Add type</button></span>          
              </div>
            </div>
          </div>
          
          <!-- Model Type Num Serie -->
          <div class="showback col-sm-8">
            <div class="form-inline">
              <label for="Num_serie" class="control-label">Num Série:</label>
              <div class="input-group col-sm-4">                                                     
                <input type="text" name="Num_serie" id="Num_serie" class="form-control" placeholder="Ex: 180 48 11" required disabled>
                <span class="input-group-btn"><button id="btngener" class="btn btn-primary" data-role="GeneNumSerie" type="button" disabled>Générer N° Série</button></span>
              </div>
              <div class="input-group col-sm-2">
                <div id="Success_Error_NumSerie" role="alert"></div>
              </div>

              <!-- Lieux Installé / ctrl 3 -->
              <label for="LieuxInst" class="control-label AffLieuxInstall">Lieux installé:</label>
              <div class="input-group col-sm-3 AffLieuxInstall">                
                <select class="form-control ctrl3" name="LieuxInst" id="LieuxInst"></select>                    
              </div>
            </div>

          </div>

          <!-- numero de contrat -->
          <div class="showback col-sm-4">           
            <div class="form-inline col-sm-12">
              <label for="numcontrat" class="control-label">Num contrat:</label>
              <div class="input-group">
                <select class="form-control" name="numcontrat" id="numcontrat"></select>
                <span class="input-group-btn"><button id="btncontrat" class="btn btn-success" data-role="ADDContract" type="button" disabled>Add contrat</button></span>
              </div>
            </div>  
          </div>

          <!-- Zone Alimenté Niveau Lieux Piece -->
          <div class="showback col-sm-12 Affshowback hidden">
            <label for="za" class="za"></label>
            <div class="form-inline">
              <label for="Levels" class="control-label AffLevels">Niveau:</label>
              <div class="input-group col-sm-3 AffLevels">                
                <select class="form-control ctrl" name="Levels" required></select>
                <span class="input-group-btn"><button id="btnlevel" class="btn btn-theme" data-role="AddLevel" type="button" disabled>Add niveau</button></span>
              </div>

              <!-- affichage lieux / ctrl -->
              <label for="Places" class="control-label AffPlace hidden">Lieux:</label>
              <div class="input-group col-sm-4 AffPlace hidden">                
                <select class="form-control ctrl" name="Places" id="Places" required></select>
                <span class="input-group-btn"><button id="btnplace" class="btn btn-primary" data-role="AddPlace" type="button" disabled>Add lieux</button></span>
              </div>

              <!-- affichage select piéces / ctrl1 -->
              <label for="Rooms" class="control-label AffPiece hidden">Pièce:</label>
              <div class="input-group col-sm-3 AffPiece hidden">                
                <select class="form-control ctrl1" name="Rooms" id="Rooms"></select>
                <span class="input-group-btn"><button id="btnroom" class="btn btn-success" data-role="AddRoom" type="button" disabled>Add pièce</button></span>
              </div>            

            </div>
          </div>          

          <!-- datefab -- dateinstall--numfacture-- BTN add facture Achat -- montant achat / affiche le bouton facture achat ou view achat -->
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
              
              <!-- checkbox nacelle -->
              <div class="Nacelle col-sm-2 hidden">
                <label>
                  <input type="checkbox" name="chk" value="1">
                   Besoin d'une nacelle !!!
                </label>
              </div>

              <!-- checkbox propriété -->
              <div class="AffProp col-sm-2 hidden">
                <label>
                  <input type="checkbox" name="prop" value="0" checked>
                    Propriété Clinique !!!
                </label>
              </div> 

            </div>                            
          </div>

          <!-- caractéristique clim / ctrl 2 -->
          <div class="showback CaractClim col-sm-6 hidden">
            <label for="ca" class="ca">Caractéristique Technique:</label>
            <!-- Poids en Charge Fluide -->
            <div class="form-inline">

              <label for="poidscharge" class="control-label">Poids Charge:</label>
              <div class="input-group col-sm-2">
                <input type="text" class="form-control ctrl2" name="poidscharge" id="poidscharge"><span class="input-group-addon">Kgrs</span>
              </div>

              <label for="fluide" class="control-label">Fluide:</label>
              <div class="input-group col-sm-2">
                <input type="text" class="form-control ctrl2" name="fluide" id="fluide">
              </div>
                                
            </div>             
          </div>

          <!-- Autres Caracteristique-->
          <div class="showback Caract">
            <label for="aca" class="aca"></label>
            <textarea name="Caract" id="Caract" class="form-control" cols="100"></textarea>
          </div>

          <!-- Armoire & Disjoncteur -->
          <div class="showback col-sm-12">  
            <div class="form-inline">
              <label for="arm" class="control-label">Armoire:</label>
              <div class="input-group col-sm-3">
                <select class="form-control" name="arm" id="arm"></select>
                <span class="input-group-btn"><button id="btnarm" class="btn btn-theme04" data-role="AddArm" type="button" disabled>Add ARM</button></span>
              </div>

              <label for="disj" class="control-label">Disjoncteur:</label>
              <div class="input-group col-sm-2">
                <input type="text" class="form-control" placeholder="Ex: D1.5" name="disj" id="disj">
              </div>                    
            </div>
          </div>

          <!--textarea Note-->
          <div class="showback col-sm-12">
            <label for="Note">Entrer une note:</label>
            <textarea name="Note" id="Note" class="form-control" rows="4"></textarea>  
          </div>

        </div>
        
        <!-- Statut /ctrl4 -->
        <div class="form-group AffStatut hidden">
          <label for="Statut" class=" control-label">Statut:</label>
          <div class="input-group col-lg-3">                
            <select class="form-control ctrl4" id="Statut" name="Statut" disabled></select>
            <span class="input-group-btn"><button id="btnstatut" class="btn btn-success" data-role="MajStatut" type="button" disabled>Maj Statut</button></span>              
          </div>
        </div>          

        <!-- inputs hidden -->
        <input type="hidden" name="NumInvent" id="NumInvent" /> <!-- hidden-->
        <input type="hidden" name="Types_Id" id="Types_Id"/> <!-- passe l'id type pour edition hidden -->
        <input type="hidden" name="operation" id="operation" /> <!-- hidden -->                  
                  
        <div class="form-group">
          <div class="col-lg-12">
            <button type="submit" id="AddMat" class="btn btn-theme pull-right"><span class="glyphicon  glyphicon-ok"></span></button>      
            <button type="reset" onclick="history.go(-1);" class="btn btn-theme04 pull-left"><span class="glyphicon  glyphicon-remove"></span></button>
          </div>
        </div>                                    
                   
      </form> 
      <br>
      <br>  
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

            <!-- affichage checkbox choix catégorie produit-->
            <div class="form-inline">
              <div class="form-group">
                <div class="input-group">
                  <p>Catégorie du Produit </p>

                  <label class="radio-inline" for="parent">
                      <input type="radio" id="parent" name="BTNRadio" value="P" required> Matériel Primaire 
                  </label>                      

                  <label class="radio-inline" for="seul">
                      <input type="radio" id="seul" name="BTNRadio" value="S" required> Matériel Seul 
                  </label>

                  <label class="radio-inline" for="seulN">
                    <input type="radio" id="seulN" name="BTNRadio" value="SN" required> Matériel Seul(avec ou sans nacelle)
                </label>

                </div>
              </div>  
            </div>

            <br>

            <input type="hidden" name="btn" id="btn">
            <input type="hidden" name="family">
            
            <div class="modal-footer">                  
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
            </div>
            
            <div id="affinfoproduct" class="" role="alert"></div>            

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

              <div id="affinfomark" class="" role="alert"></div>
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
          <form role="form" enctype="multipart/form-data" data-toggle="validator" method="post" id="AddModel">

            <div class="modal-body">            

                <div class="form-group has-feedback">
                  <div class="input-group col-sm-6">
                      <label for="modeladd" class="control-label">Model: </label>
                      <input type="text" id="modeladd" namae="modeladd" class="form-control" placeholder="Entrer Le model" data-error="Veuillez entrer un model" required>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <div class="help-block with-errors"></div>
                  </div>                      
                </div>                        

                <div id="affinfomodel" class=""></div>                      

                <input type="hidden" id="Id_mark" name="Id_mark"> <!-- hidden -->          
            </div>

            <div class="modal-footer">                
                            
              <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
             
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>         
            </div>             

          </form>                      
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

              <div class="form-input">
                <label for="n_arm" class="control-label">Nom armoire:</label>
                <div class="input-group col-lg-6">                
                  <input class="form-control" name="n_arm" id="n_arm" placeholder="Entrer Le nom de l'armoire" required>
                </div>
              </div></br>                            

              <div class="form-input">
                <label for="levels" class="control-label">Niveau: </label>
                <div class="input-group col-lg-6">
                  <select name="Levels" class="form-control" required></select>                
                </div>                                
              </div></br>

              <div class="form-input">
                <label for="lieux" class="control-label">Lieux: </label>
                <div class="input-group col-lg-6">                                  
                  <input type="text" name="lieux" id="lieux" class="form-control" required />                
                </div>                                
              </div></br>

              <div class="modal-footer">                
                               
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal">
                  <span class="glyphicon  glyphicon-remove"></span></button>
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

              <div id="affinforoom" class="" role="alert"></div>

            </form>          
          </div>
        </div>
      </div>
    </div>

  <!-- modal ajout de contrat -->
    <div id="contract" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="titleContribut"></h4>
          </div>
          <div class="modal-body">
            <form role="form" data-toggle="validator" method="post" id="AEContract">          

              <div class="form-group has-feedback">
                <div class="input-group col-sm-8">
                  <label for="NumContract" class="control-label">N° Contrat: </label>
                  <input type="text" id="NumContract" name="NumContract" class="form-control" placeholder="Entrer Le N° de contrat" data-error="Veuillez entrer un numéro de contrat" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <span class="error_numcontrat"></span>
                  <div class="help-block with-errors"></div>                 
                </div>                      
              </div>

              <!-- div affiche select contribut -->          
              <div class="form-group">           
                <label for="ContributIC" class="control-label">Intervenant:</label>         
                <div class="input-group col-sm-8">                                      
                  <select class="form-control" name="ContributIC" id="ContributIC" required></select>
                  <span class="input-group-btn"><button class="btn btn-success" data-role="ADDContributor" type="button">Add Intervenant</button></span>
                </div>
              </div>          
              
              <div class="form-group">
                <label for="datedeb" class="control-label">Date début:</label>
                <div class="input-group col-sm-8">
                  <input type="date" name="datedeb" id="datedeb" class="form-control" required />
                </div>
              </div>

              <div class="form-group">
                <label for="durer" class="control-label">Durer:</label>
                <div class="input-group col-sm-8">
                  <input type="text" name="durer" id="durer" class="form-control" placeholder="Entrer La durer du contrat"required />
                  <span class="input-group-addon" id="basic-addon2">Mois</span>
                </div>
              </div>
                   
              <br>          

              <input type="hidden" name="str" id="str">
              <input type="hidden" name="ContractID" id="ContractID"> <!-- pour edit -->

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

  
