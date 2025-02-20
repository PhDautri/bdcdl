<div class="row">   
  
    <div class="AffTLinkSelect col-sm-12">

        <input type="hidden" name="id" value="<?=$_GET['id']; ?>">    

        <h1>Liaisons entre Ipbx et prise </h1></br>

        <p>
          <a href="?p=links.ViewSelectLinkIpbxPdf&id=<?=$_GET['id']; ?>" class="btn btn-round btn-default" target="_blank"<abbr title="Créer un PDF">PDF</abbr></a>
        </p>                   

        <table id="TableLinkSelect" class="table table-bordered" style="width:100%">
            
            <thead>
                
                <tr style="font-weight:bold;">
                    <th colspan="1"></th>                    

                    <th colspan="5" class="text-center success">IPBX</th>

                    <th colspan="3" class="text-center danger">Armoire Divisionnaire</th>

                    <th colspan="2" class="text-center info">Piéce/Bureau</th>
                </tr>
                <tr>
                    <th>Id</th>

                    <th>Annuaire</th>

                    <th>Nom Usager</th>

                    <th>Emplacement</th>

                    <th>Bandeau</th>

                    <th>Port RG</th>

                    <th>Nom Armoire</th>

                    <th>Port</th>

                    <th>Niveau</th>                    

                    <th>Numéro Prise</th>

                    <th>Lieux</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tfoot>

                <tr style="font-weight:bold;">

                    <th>Id</th>

                    <th>Annuaire</th>

                    <th>Nom Usager</th>

                    <th>Emplacement</th>

                    <th>Bandeau</th>

                    <th>Port RG</th>

                    <th>Nom Armoire</th>

                    <th>Port</th>

                    <th>Niveau</th>                    

                    <th>Numéro Prise</th>

                    <th>Lieux</th>

                    <th>Action</th>

                </tr>
                
            </tfoot>                        

        </table>
             
    </div>
</div>

<!-- modal edit liaisons -->

<div id="link" class="modal fade bs-modal-lg" tabindex="-1" role="dialog">
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
                        <div class="form-group col-md-6">
                          <label for="Num">Annuaire</label>
                          <input type="text" class="form-control input-sm" maxlength="4" id="Num" name="Num" pattern="^([1-9]{1,1})[0-9]{3,3}$" placeholder="ex: 4000" required>
                          <div id="aff_num" class=""></div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="NomU">Nom Usager</label>
                          <input type="text" class="form-control input-sm" name="NomU" id="NomU" required>
                          <div id="aff_nomu" class=""></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="Empla">Emplacement</label>
                          <input type="text" class="form-control input-sm" pattern="^([1-2]{1,2})+-([0-9]{2,2})+-([0-7]{2,2})$" maxlength="7" name="Empla" id="Empla" placeholder="ex: 1-01-01" required>
                          <div id="aff_empla" class=""></div>
                        </div>                        
                    </div>                                     
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Section Bandeau</div>
                <div class="panel-body">
                  <div class="form-row">                        
                      <div class="form-group col-md-6">
                        <label for="Bandeau">Bandeau</label>
                        <input type="text" class="form-control input-sm" pattern="^([RG]{2,2})|([SR]{2,2})([0]{1,1})([1-7]{1,1})$" maxlength="4" name="Bandeau" id="Bandeau" onkeyup="this.value=this.value.toUpperCase()" placeholder="ex: RG / SR01 / SR02 / SR03"  required>                  
                      </div>
                      <div class="form-group col-md-6">
                        <label for="Port_rg">Port</label>
                        <input type="text" class="form-control input-sm" pattern="^([A,B,C]{1,1}[1-9]{1,2}[T,I])$|^([1-2]{1,1})+-([0-9]{1,2})$" maxlength="4" name="Port_rg" id="Port_rg" onkeyup="this.value=this.value.toUpperCase()" placeholder="ex: A9T / B5I / C5T OU 1-9 / 1-15 / 1-24 etc..."  required>
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
                          <input type="text" class="form-control input-sm" name="Armoir" id="Armoir" readonly>                     
                        </div>
                        <div class="form-group col-md-6">
                          <label for="Port_arm">Port</label>
                          <input type="text" class="form-control input-sm" pattern="^([1-2]{1,1})+-([1-9]{1,2})$" maxlength="7" name="Port_arm" id="Port_arm" placeholder="ex: 1-9 / 1-15 / 1-24 / 1-48">
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
                        <input type="text" class="form-control input-sm" pattern="^([A-Z0-9]{3,3})|([RG])+.([0])+.([0-9]{3,3})|([SR]{2,2})([0]{1,1})([1-7]{1,1})+.([0-2]{1,1})+.([0-9]{3,3})$" name="NumP" id="NumP" onkeyup="this.value=this.value.toUpperCase()" placeholder="ex: SR05-0.1" required>
                        <div id="aff_nump" class=""></div>                          
                      </div>
                      <div class="form-group col-md-6">
                        <label for="Lieux">Lieux</label>
                        <input type="text" class="form-control input-sm" pattern="^[a-zA-Z-1-9-\s]+$" placeholder="ex: Bureau" name="Lieux" id="Lieux" required>
                        <div id="aff_lieux" class=""></div>
                      </div>
                  </div>                    

                </div>
            </div>

            <input type="hidden" id="op" name="op"> <!-- hidden -->
            <input type="hidden" id="id_link" name="id_link"> <!-- hidden -->
            <input type="hidden" id="id_band" name="id_band"> <!-- hidden -->

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