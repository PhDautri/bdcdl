<?php  

  $mate = $this->Material->finddatamate($_GET['idm']); // id mate
  $panne = $this->Panne->finddatapanneDesig($_GET['idp']); // id panne  //

  if ($mate[0]->niveau == "R+1" || $mate[0]->niveau == "R+2") {
    alert("Veuillez vérifier si vous avez besoin d'une nacelle pour cette intervention et la noté dans le mail !!!!");
    $nacell = " ";
  } else {

    $nacell = "pas besoin de nacelle";
  }


?>

<!--main content start-->
    
  <!-- page start-->
  <div class="row mt SendEmail">
    
    <div class="col-sm-12">
      <section class="panel">
        <header class="panel-heading wht-bg">
          <h4 class="gen-case">Compose Email</h4>
        </header>
        <div class="panel-body">
          <div class="compose-mail">
            <form role="form-horizontal" action="?p=events.sendmail" method="post">
              <div class="form-group">

                <div class="form-group">           
                  <label for="Contributor" class="control-label">Intervenant:</label>         
                  <div class="input-group col-md-8">                                      
                    <select class="form-control ctrl" name="Contributor" id="Contributor" required></select>                    
                  </div>
                </div>

                <div class="AffSelectEmail">
                  <div class="form-group">
                    <label for="EmailEvent" class="control-label">Email:</label>                      
                    <div class="input-group col-md-8">                                        
                      <select class="form-control ctrl" name="to" id="to" required></select>                         
                    </div>  
                  </div>
                </div>

                <div class="compose-options">
                  <a onclick="$(this).hide(); $('#cc').parent().removeClass('hidden'); $('#cc').focus();" href="javascript:;">Cc</a>
                  <a onclick="$(this).hide(); $('#bcc').parent().removeClass('hidden'); $('#bcc').focus();" href="javascript:;">Bcc</a>
                </div>
              </div>
              <div class="form-group hidden">
                <label for="cc" class="">Cc:</label>
                <input type="text" tabindex="2" id="cc" name="cc" class="form-control">
              </div>
              <div class="form-group hidden">
                <label for="bcc" class="">Bcc:</label>
                <input type="text" tabindex="2" id="bcc" name="bcc" class="form-control">
              </div>
              <div class="form-group">
                <label for="subject" class="">Sujet:</label>
                <input type="text" tabindex="1" id="subject" name="subject" class="form-control" value="Demande de devis réparation">
              </div>
              <div class="compose-editor" style="overflow: auto;">
                <textarea class="wysihtml5 form-control" id="mess" name="mess" rows="9">

                Bonjour,

                Veuillez trouver ci joint une demande de devis pour un <?=$mate[0]->produit; ?>,  
                                              
                Marque: <?=$mate[0]->marque; ?>,

                Numéro Série: <?=$mate[0]->num_serie; ?>,

                situé au <?=$mate[0]->niveau; ?> - <?=$mate[0]->lieux; ?> - <?=$mate[0]->piece; ?>,

                Panne: <?=$panne[0]->designation; ?>, 

                P.S: <?=$nacell; ?>,


                Cordialement,

                <?=$_SESSION['name']; ?>

                </textarea>

                <br>
                <input type="file" class="default">
              </div>
              <br>
              <div class="compose-btn">
                <button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-check"></i> Envoyé</button>
                <button class="btn btn-sm"><i class="fa fa-times"></i> Annulé</button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
      

