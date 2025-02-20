<div class="row"> 
<!-- VIEWS-->
  <!-- PRODUCT -->
    <div class="col-lg-12">

      <h1 id="Ancre">Editions Produits Marques Models & Types</h1>

      <h2>Produits</h2> 

      <!-- messages --> 
  
      <div id="info_product" class="hidden"></div>    

      <!-- affichage tables produits -->
           
      <div class="col-lg-12">

        <table id="TableProduct" class="table table-hover" style="width: 100%">
            
            <thead>
                
            <tr class="odd" style="font-weight:bold;">

              <th>Id</th>
              <th>Famille</th>
              <th>Produit</th>
              <th>Catégorie</th>
              <th>Actions</th>

            </tr>

            </thead>
            
        </table>

      </div>      
    </div> 

  <!-- MARK -->
    <div class="col-lg-12 hidden" id="viewMark">      

      <h2>Marques</h2>

      <div id="info_mark" class="hidden"></div>    

      <!-- affichage tables marques -->
           
      <div class="col-lg-12">

          <table id="TableMark" class="table table-hover" style="width: 100%">
              
              <thead>
                  
              <tr class="odd" style="font-weight:bold;">

                  <th>Id</th>

                  <th>Marques</th>                      

                  <th>Actions</th>

              </tr>

              </thead>
              
          </table>

      </div>
    </div>

  <!-- MODELS -->
    <div class="col-lg-6 hidden" id="viewModel">     

      <h2>Models</h2>

      <div id="info_model" class="hidden"></div>             
                    
      <div class="col-lg-12">

        <table id="TableModel" class="table table-hover" style="width: 100%">
      
            <thead>
                
            <tr class="odd" style="font-weight:bold;">

                <th>Id</th>

                <th>Models</th>

                <th>Image Model</th>                      

                <th>Actions</th>

            </tr>

            </thead>
            
        </table>  

      </div>
    </div>

  <!-- TYPE -->
    <div class="col-lg-6 hidden" id="viewType">      

      <h2>Type</h2>

      <div id="info_type" class="hidden"></div>                 
       
      <div class="col-lg-lg-6">

        <table id="TableType" class="table table-hover" style="width: 100%">
      
            <thead>
                
            <tr class="odd" style="font-weight:bold;">

                <th>Id</th>

                <th>Type</th>                      

                <th>Actions</th>

            </tr>

            </thead>
            
        </table>  
        
      </div>

    </div>

  <!-- INPUT HIDDEN -->
  <input type="hidden" name="IdProduct" id="IdProduct">
  <input type="hidden" id="IdMark" name="IdMark">
  <input type="hidden" id="IdModel" name="IdModel">

<!-- FIN VIEWS -->
</div>

<!-- MODALS -->  

  <!-- PRODUIT --> 
    
    <!-- Modal edit product -->
    <div class="modal fade" id="editproduct" tabindex="-1" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edition Produit</h4>
          </div>
          <form role="form" data-toggle="validator" method="POST" id="EDITPRODUCT" enctype="multipart/form-data">
            <div class="modal-body">            

              <div class="form-inline">
                <label for="product" class="control-label">Produit: </label>
                <div class="input-group col-auto">                                  
                  <input type="text" name="product" id="product" class="form-control" />                
                </div>                                
              </div>
              <br>

              <div class="form-inline">
                <label for="family" class="control-label">Famille: </label>
                <div class="input-group col-sm-auto">
                  <select id="family" name="family" class="form-control"></select>
                  <span class="input-group-btn"><button class="btn btn-theme0" data-role="AddFamily" type="button">Add Famille</button></span>
                </div>
              </div>
              <br>

              <!-- affichage checkbox choix catégorie produit-->
              <div class="form-inline AffCategoryProduit">
                <div class="form-group">
                  <div class="input-group">
                    <p>Catégorie du Produit: </p>

                    <label class="radio-inline" for="Parent">
                        <input type="radio" id="parent" name="BTNRadio" value="P" required> Matériel Primaire 
                    </label>                      

                    <label class="radio-inline" for="Seul">
                        <input type="radio" id="seul" name="BTNRadio" value="S" required> Matériel Seul 
                    </label>

                    <label class="radio-inline" for="SeulN">
                        <input type="radio" id="seulN" name="BTNRadio" value="SN" required> Matériel Seul(avec ou sans nacelle)
                    </label>

                  </div>
                </div>  
              </div>

              <input type="hidden" name="IDProduct" id="IDProduct">

              </br>              

              <div class="modal-footer">

                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></button>                
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></button>
                                
              </div>
              
            </div>
          </form>          
        </div>        
      </div>
    </div>

  <!-- FAMILY -->

    <!-- Modal add family -->
    <div id="addfamily" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ajout De Famille</h4>
          </div>
          <div class="modal-body">

            <form role="form" data-toggle="validator" method="POST" id="AddFamily">

              <div id="divFamilyAdd" class="form-group has-feedback">
                <div class="input-group col-auto">
                  <label for="familyadd" class="control-label">Famille: </label>
                  <input type="text" id="familyadd" mane="familyadd" class="form-control" placeholder="Entrer La famille" data-error="Veuillez entrer une famille" required>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>                      
              </div>                            

              <div class="modal-footer">                
                <button type="submit" id="submitfamilyAdd" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>             
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>   
              </div>

              <div id="affinfofamily" class="" role="alert"></div>
            </form>
          </div>
        </div>
      </div> 
    </div>      

  <!-- MARK -->  

    <!-- Modal edit mark -->
    <div class="modal fade" id="editmark" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edition Marque</h4>
          </div>
          <form role="form" data-toggle="validator" method="POST" id="EDITMARK" enctype="multipart/form-data"> 
            <div class="modal-body">   

              <div class="form-inline">
                <label for="marque" class="control-label">Marque: </label>
                <div class="input-group col-auto">                                  
                  <input type="text" name="marque" id="marque" class="form-control" />                
                </div>                                
              </div>
              </br>              

              <div class="modal-footer">

                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></button>                
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></button>
                                
              </div>              
            </div>
          </form>          
        </div>        
      </div>
    </div>

  <!-- MODEL --> 

    <!-- Modal edit model  -->
    <div class="modal fade" id="editmodel" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edition Model</h4>
          </div>
           <form  role="form" data-toggle="validator" method="post" id="EDITMODEL">
            <div class="modal-body">           
              <div class="form-group">
                <div class="input-group col-sm-6">            
                  <label for="model" class="control-label">Model: </label>                  
                  <input type="text" name="model" id="model" class="form-control" />                  
                </div> 
              </div>                

              <div class="modal-footer">
                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>          
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>                
              </div>              
            </div>
          </form>
        </div>  
      </div>
    </div>

  <!-- TYPE -->   

    <!-- Modal edit type  -->
    <div class="modal fade" id="edittype" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edition type</h4>
          </div>
          <form  role="form" data-toggle="validator" method="post" id="EDITTYPE">
            <div class="modal-body">
             
              <div class="form-group">
                <div class="input-group col-sm-6">            
                  <label for="type" class="control-label">Type: </label>                  
                  <input type="text" class="form-control" id="type"/>                  
                </div> 
              </div>
                     
              <div class="modal-footer">                
                <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
             </div>                   
            </div>
          </form>        
        </div>
      </div>       
    </div>

  <!-- ADD IMG MODEL -->

    <!-- Modal add img model  -->
    <div class="modal fade" id="addimgmodel" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title titremodel"></h4>
          </div>

          <form  role="form" enctype="multipart/form-data" data-toggle="validator" method="post" id="ADDIMGMODEL">
            <div class="modal-body">
           
              <div class="form-group">
                
                <div class="col-md-12">
                  
                  <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
                  <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />              


                  <label class="control-label col-md-3">Image Upload</label>
                  <div class="col-md-12">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" id="fileIMGMODEL" name="fileIMGMODEL" accept="image/jpg, image/jpeg" class="default" />
                        </span>

                        <a href="#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Suppr</a>
                      </div>
                    </div>                    
                  </div>                  

                  <input type="hidden" id="IDModel" name="IDModel">
                                      
                </div>  
              </div>

              <div class="modal-footer">                
                <button type="button"  onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
                <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
             </div>

            </div>

          </form>                  
        </div>
      </div>       
    </div>







