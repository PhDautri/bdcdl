
<div class="AffPhoneBook col-sm-12">
	<h1>Annuaire</h1>

	<p>                    
    <button class="btn btn-round btn-success" id="btn_addphonebook" data-role="ADDPhoneBook"<abbr title="Ajouter un Téléphone "><span class="glyphicon  glyphicon-plus"></span></abbr></button>

    <a href="?p=phones.viewAllPhoneBookPdf" class="btn btn-round btn-default VPDF" target="_blank"<abbr title="Créer un PDF">PDF</abbr></a>
  </p>                   

  <table id="TablePhoneBook" class="table table-bordered" style="width: 100%">        
    <thead>            
      <tr style="font-weight:bold;">
        <th>Id</th>
        <th>Annuaire</th>
        <th>Num SDA</th>
        <th>Type</th>
        <th>Nom Usager</th>
        <th>Service</th>
        <th>Zone</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</div>

<!-- modal add & edit annuaire -->
<div id="phonebook" class="modal fade bs-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-lg" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ajout Numéro à l'annuaire</h4>
      </div>
      <div class="modal-body">          

        <form role="form" data-toggle="validator" method="post" id="PHONEBOOK">

          <div class="panel panel-default">
              <div class="panel-heading">Section Annuaire</div>
              <div class="panel-body">

                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="num">Annuaire</label>
                      <input type="text" class="form-control input-sm" maxlength="4" id="num" name="num" pattern="^([1-9]{1,1})[0-9]{3,3}$" placeholder="ex: 4000" required>
                      <div id="aff_num" class=""></div>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="numSda">Num SDA</label>
                      <input type="text" class="form-control input-sm" maxlength="14" id="numSda" name="numSda" placeholder="ex: 6700 ou 05 58 06 67 00" required>
                      <div id="aff_numsda" class=""></div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nomU">Nom Usager</label>
                      <input type="text" class="form-control input-sm" name="nomU" id="nomU" required>
                      <div id="aff_nomu" class=""></div>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="serv" class="control-label">Service</label>                      
                      <div class="input-group col-md-12">                                        
                        <select class="form-control ctrl" name="serv" id="serv" required></select>
                        <span class="input-group-btn"><button class="btn btn-warning AddService" data-btn="Annu" data-role="addService" type="button">Add Service</button></span> 
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="zone">Zone</label>
                      <input type="text" class="form-control input-sm" name="zone" id="zone" placeholder="ex: RDC / 1er étage" required>
                      <div id="aff_lieux" class=""></div>
                    </div>                                                
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="typephone" class="control-label">Type</label>                      
                      <div class="input-group col-md-6">                                        
                        <select class="form-control ctrl" name="typephone" id="typephone" required>
                        <option value=" " selected disabled>Veuillez choisir un type</option>
                        <option value="ANA">ANA</option>
                        <option value="DECT">DECT</option>
                        <option value="NUM">NUM</option>
                        </select> 
                      </div>
                    </div>                                               
                  </div>                                                
              </div>
          </div>           

          <input type="hidden" id="op" name="op"> <!-- hidden -->
          <input type="hidden" id="id_book" name="id_book"> <!-- hidden -->

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

<!-- modal add service -->
<div id="addservice" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter un service</h4>
      </div>
      <div class="modal-body">

        <form  role="form" data-toggle="validator" method="post" id="AddService">
          
          <div class="form-group has-feedback">
            <div class="input-group col-lg-5">
              <label for="serviceadd" class="control-label">Service: </label>
              <input type="text" id="serviceadd" name="serviceadd" class="form-control" placeholder="Entrer un service" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
          </div>             

          <br>
          
          <div class="modal-footer">                  
            <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
            <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
          </div>

          <div id="error_service" class="alert alert-danger danger-dismissable hidden"> Ce service existe déja !!! </div>
          <div id="affaddservice" class="" role="alert"></div>            

        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal ajout & edit liaisons / link -->

<div id="addlink" class="modal fade bs-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-lg" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">          

        <form role="form" data-toggle="validator" method="post" id="Link">

            <div class="panel panel-default">
              <div class="panel-heading">Section IPBX</div>
              <div class="panel-body">                    
                <div class="form-row">                        
                  <div class="form-group col-md-3">
                    <label for="Empla">Emplacement Port</label>
                    <input type="text" class="form-control input-sm" pattern="^([1-2]{1,2})+-([0-9]{2,2})+-([0-9]{2,2})$" maxlength="7" name="Empla" id="Empla" placeholder="ex: 1-01-01" required>                          
                  </div>
                  <div id="aff_empla" class=""></div>                        
                </div>                                     
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">Section Bandeau</div>
              <div class="panel-body">
                <div class="form-row">                        
                  <div class="form-group col-md-6">
                    <label for="Slcheadband">Bandeau</label>
                    <div class="input-group col-md-12">
                      <select id="Slcheadband" name="Slcheadband" class="form-control"></select>
                      <span class="input-group-btn">
                        <button class="btn btn-warning AddHeadBand" data-role="addHeadBand" type="button">Add</button>
                        <button class="btn btn-primary EditHeadBand" data-role="editHeadBand" type="button" disabled>Edit</button>
                      </span>
                    </div>               
                  </div>
                  <div class="form-group col-md-6">
                    <label class="title_port" for="Port_rg"></label>
                    <input type="text" class="form-control input-sm" pattern="^([A,B,C]{1,1}[1-9]{1,2}[T,I])$|^([1-2]{1,1})+-([0-9]{1,2})$" maxlength="4" name="Port_rg" id="Port_rg" onkeyup="this.value=this.value.toUpperCase()" placeholder="ex: A9T / B5I / C5T OU 1-9 / 1-15 / 1-24 etc..." required>
                    <div id="aff_portrg" class=""></div>
                  </div>
                </div>                                       
              </div>
            </div>                        

            <div id="ArmDiv" class="panel panel-default">
              <div class="panel-heading">Section Armoire Divisionnaire</div>
              <div class="panel-body">

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="Armoir">Nom Armoire</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control input-sm" name="Armoir" id="Armoir" readonly>
                    </div>                                
                  </div>                                    

                  <div class="form-group col-sm-4">
                    <label for="Port_arm">Port</label>
                    <input type="text" class="form-control input-sm" pattern="^([1-2]{1,1})+-([1-9]{1,2})$" maxlength="7" name="Port_arm" id="Port_arm" onkeyup="this.value=this.value.toUpperCase()" placeholder="ex: 1-9 / 1-15 / 1-24 / 1-48">
                    <div id="aff_portarm" class=""></div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="Niv">Niveau</label>
                    <input type="text" class="form-control input-sm" name="Niv" id="Niv" readonly>
                  </div>                        
                </div>               

              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">Piéce/Bureau</div>
              <div class="panel-body">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="NumP">Numéro Prise</label>
                    <input type="text" class="form-control input-sm" 
                      pattern="^([A-Z0-9]{3,3})|([RG])+.([0])+.([0-9]{3,3})|([SR]{2,2})([0]{1,1})([1-7]{1,1})+.([0-2]{1,1})+.([0-9]{1,3})$" 
                      name="NumP" id="NumP" onkeyup="this.value=this.value.toUpperCase()" placeholder="ex: SR05.0.1 / SR03.0.047 / RG.0.143 / A15 / B10" required>
                    <div id="aff_nump" class=""></div>                          
                  </div>
                  <div class="form-group col-md-6">
                    <label for="Lieux">Lieux</label>
                    <input type="text" class="form-control input-sm" name="Lieux" id="Lieux" placeholder="ex: Bureau" required>
                    <div id="aff_lieux" class=""></div>
                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" id="Op" name="Op"> <!-- hidden -->            
            <input type="hidden" id="id_link" name="id_link"> <!-- hidden -->
            <input type="hidden" name="Bandeau"> <!-- hidden -->

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

<!-- modal add & edit bandeau -->
<div id="headband" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">

        <form  role="form" data-toggle="validator" method="post" id="HeadBand">
          
          <div class="form-group has-feedback">
            <div class="input-group col-sm-6">
              <label for="headband" class="control-label">Bandeau: </label>
              <input type="text" name="headband" pattern="^([RG]{2,2})|([SR]{2,2})+-([0]{1,1})([1-7]{1,1})$" maxlength="5" class="form-control" onkeyup="this.value=this.value.toUpperCase()" placeholder="ex: RG / SR-01 / SR-02 / SR-03" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
          </div>             

          <br>
          
          <div class="modal-footer">                  
            <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
            <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
          </div>

          <input type="hidden" name="id_band">
          <input type="hidden" name="op">

          <div id="aff_band" class="hidden"></div>           

        </form>
      </div>
    </div>
  </div>
</div>
	
	
