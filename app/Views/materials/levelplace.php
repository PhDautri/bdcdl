<div class="row AffLevelPlaceRoom">  

  <!-- LEVEL --> 
  <div class="col-lg-6">

    <h2>Niveau</h2>     

    <!-- affichage table niveau -->
         
    <div class="col-lg-12">

        <table id="TableLevel" class="table table-hover" style="width: 100%">
            
            <thead>
                
            <tr class="odd" style="font-weight:bold;">

                <th>Id</th>

                <th>Niveau</th>                      

                <th>Actions</th>

            </tr>

            </thead>
            
        </table>

    </div>
  </div>

  <!-- PLACE -->
  <div class="col-lg-6 hidden" id="viewPlace">

    <h2>Lieux <button class="btn btn-round btn-warning" data-role="AddPlace" <abbr title="Ajouter un lieux"</abbr><span class="fa fa-plus"></span></button></h2>      
                  
    <div class="col-lg-12">

      <input type="hidden" id="IdLevel" name="IdLevel" />
      <input type="hidden" id="NLevel" name="NLevel" />

      <table id="TablePlace" class="table table-hover" style="width: 100%">
    
          <thead>
              
          <tr class="odd" style="font-weight:bold;">

              <th>Id</th>

              <th>Lieux</th>                      

              <th>Actions</th>

          </tr>

          </thead>
          
      </table>  

    </div>

  </div> 

  <!-- ROOM -->
  <div class="col-lg-12 hidden" id="viewRoom">

    <h2>Pièces <button class="btn btn-round btn-warning" data-role="AddRoom" <abbr title="Ajouter une piéce"</abbr><span class="fa fa-plus"></span></button></h2>    
                  
    <div class="col-lg-12">

      <input type="hidden" id="IdPlace" name="IdPlace" />
      <input type="hidden" id="NPlace" name="NPlace" />

      <table id="TableRoom" class="table table-hover">
    
          <thead>
              
          <tr class="odd" style="font-weight:bold;" style="width: 100%">

              <th>Id</th>

              <th>Pièce</th>                      

              <th>Actions</th>

          </tr>

          </thead>
          
      </table>  

    </div>

  </div>   

</div> 

  <!-- MODAL -->

  <!-- Modal edit level / niveau -->
  <div class="modal fade" id="editlevel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edition du Niveau</h4>
        </div>

        <div class="modal-body">

          <form role="form" data-toggle="validator" method="POST" id="EDITLEVEL" enctype="multipart/form-data"> 

            <div class="form-inline">
              <label for="level" class="control-label">Niveau: </label>
              <div class="input-group col-auto">                                  
                <input type="text" name="level" id="level" class="form-control" />                
              </div>                                
            </div></br>

            <input type="hidden" id="levelId" name="levelId"><!-- hidden -->

            <div class="modal-footer">

              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></button>                
              <button type="button" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></button>
                              
            </div>

          </form>
        </div>          
      </div>        
    </div>
  </div>

  <!-- Modal add lieux  / place -->
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
            <input type="hidden" id="Id_level" name="Id_level"> <!-- id du niveau hidden-->                  
          
            <div class="modal-footer">                  
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
              <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
            </div>

          </form>          
        </div>
      </div>
    </div>
  </div> 

  <!-- Modal edit Lieux / place -->
  <div class="modal fade" id="editplace" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edition du Lieu</h4>
        </div>
        <div class="modal-body">
          <form  role="form" data-toggle="validator" method="post" id="EDITPLACE">
            <div class="form-group">
              <div class="input-group col-sm-6">            
                <label for="place" class="control-label">Lieu: </label>                  
                <input type="text" name="place" id="place" class="form-control" />                  
              </div> 
            </div></br>

            <input type="hidden" id="placeId" name="placeId"><!-- hidden -->                

            <div class="modal-footer">
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>          
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>                
            </div>
          </form>
        </div>
      </div>  
    </div>
  </div>

  <!-- Modal displace Lieux / place -->
  <div class="modal fade" id="displaceplace" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Déplacement du Lieu</h4>
        </div>
        <div class="modal-body">
          <form  role="form" data-toggle="validator" method="post" id="DISPLACEPLACE">
            <div class="form-group">
              <div class="input-group col-sm-12">            
                <h4 id="Place"></h4>                  
              </div>
            </div>
            </br>

            <div class="form-group">
              <div class="input-group col-sm-6">
                <label for="action">Action</label>
                <select class="form-control" name="action" id="action" required>
                  <option value="0" selected disabled>Choisisez une action</option>
                  <option value="1">du lieux vers un autre lieux</option>
                  <option value="2">du lieux vers un autre niveau</option>                  
                </select>
              </div>
            </div>              

            <div class="form-group AffSelectPlace hidden">
              <p> Vers Lieux </p>
              <div class="input-group col-sm-6">
                <label for="Places">Lieux:</label>
                <select class="form-control" name="Places" id="Places" required></select>                  
              </div>
            </div>

            <div class="form-group AffSelectLevel hidden">
              <p> Vers Niveau </p>
              <div class="input-group col-sm-6">
                <label for="Levels">Niveau:</label>
                <select class="form-control" name="Levels" id="Levels" required></select>                  
              </div>
            </div>
            
            <div class="AffinfoDeplace" role="alert"></div>

            <input type="hidden" name="id">
            <input type="hidden" name="idl">
            <input type="hidden" name="name">

            <div class="modal-footer">
              <button type="submit" class="btn btn-success pull-right" ><span class="glyphicon  glyphicon-ok"></span></button>          
              <button type="button" class="btn btn-danger pull-left" onclick="this.form.reset()" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>                
            </div>
          </form>
        </div>
      </div>  
    </div>
  </div>

  <!-- Modal add pièce / room -->
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
            <input type="hidden" id="Id_place" name="Id_place"> <!-- id du lieux hidden-->                  
          
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

  <!-- Modal edit pièce / room -->
  <div class="modal fade" id="editroom" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title Afftitle_room"></h4>
        </div>
        <div class="modal-body">
          <form  role="form" data-toggle="validator" method="post" id="EDITROOM">
            <div class="form-group">
              <div class="input-group col-sm-6">            
                <label for="room" class="control-label">Pièce: </label>                  
                <input type="text" name="room" id="room" class="form-control" />                  
              </div> 
            </div></br>

            <input type="hidden" id="roomId" name="roomId"><!-- hidden -->                

            <div class="modal-footer">
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>          
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>                
            </div>
          </form>
        </div>
      </div>  
    </div>
  </div>

  <!-- Modal displace pièce / room -->
  <div class="modal fade" id="displaceroom" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Déplacement de la piéce</h4>
        </div>
        <div class="modal-body">
          <form  role="form" data-toggle="validator" method="post" id="DISPLACEROOM">
            <div class="form-group">
              <div class="input-group col-sm-12">            
                <h4 id="Room"> </h4>                  
              </div>
            </div></br>

            <p> Vers Lieux </p>

            <div class="form-group">
              <div class="input-group col-sm-6">
                <label for="PlacesR">Lieux:</label>
                <select class="form-control" name="PlacesR" id="PlacesR" required></select>                  
              </div>
            </div>

            <br>

            <input type="hidden" name="id">
            <input type="hidden" name="idp">

            <div class="modal-footer">
              <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>          
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>                
            </div>
          </form>
        </div>
      </div>  
    </div>
  </div>

  

  


    