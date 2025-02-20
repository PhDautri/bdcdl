<div class="AffSendMail col-sm-12"> 
  <section class="panel">
    <header class="panel-heading wht-bg">
      <h4 class="gen-case">Tout Les Emails Envoyer</h4>
    </header>
    <div class="panel-body minimal">
      <div class="table-inbox-wrap ">
        <table id="TableMail" data-order='[[ 0, "desc" ]]' class="table table-inbox table-hover" style="width: 100%">
          <thead>                
            <tr class="odd" style="font-weight:bold;">
              <th>Id</th>
              <th>Date envoi</th>
              <th>Email</th>
              <th>Sujet</th>              
            </tr>
          </thead>          
        </table>
      </div>
    </div>
  </section>
</div>

<!-- MODAL -->

<div id="VIEWEMAIL" class="modal fade bs-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Email</h4>
      </div>
      <div class="modal-body">       

        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading wht-bg">
              <h4 class="gen-case"> Message Envoyer à <strong id="nom"></strong><span id="email"></span></h4>
            </header>
            <div class="panel-body">
              <div class="mail-header row">
                <div class="col-md-8 AffPA">
                  <h4 id="PanneID" class="pull-left"></h4>
                </div>        
              </div>

              <div class="mail-sender">
                <div class="row">
                  <div class="col-md-8">                    

                    <div class="AffCC">
                      <strong>CC.</strong>
                      <span id="cc"></span>
                    </div>

                    <div class="AffBCC">                      
                      <span id="bcc"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <p id="datemail" class="date"></p>
                  </div>
                </div>
              </div>
              <br>

              <div class="view-mail">
                <label for="message" class="control-label">Message: </label>
                <p id="message"></p>                
              </div>
              <br>

              <div class="attachment-mail">
                <p>
                  <span><i class="fa fa-paperclip"></i> Piéces Jointe </span>
                </p>
                <ul>
                  <li>
                    <i class="fa fa-file-pdf-o"> --  </i> <a class="atch-thumb" target="_blank" href=""></a>  
                  </li>                  
                </ul>
              </div><br>

              <div class="compose-btn pull-left">        
                <button class="btn  btn-sm tooltips" data-original-title="Print" type="button" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-print"></i> </button>
                <button class="btn btn-sm tooltips" data-original-title="Trash" data-toggle="tooltip" data-placement="top" title=""><i class="fa fa-trash-o"></i></button>
              </div>

            </div>
          </section>
        </div>       
    
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
        </div>

      </div>
    </div>
  </div>
</div>