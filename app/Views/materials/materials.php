<div class="row AffMates">      

  <!-- Affichage du matériels  -->
  <input type="hidden" id="index" name="index" value="<?= $_GET['index'] ?? null; ?>">    

  <div id="Ancre" class="col-md-12"><h1>Matériels</h1></div>

  <!-- affichage bouton add matériel -->
  <p id="btn_addMate" class="col-md-1"></p>   
  <p id="btn_searchMate" class="col-md-11"></p>   

    <!-- affichage tables matériels -->
    <div class="col-md-12"> 
      <table id="TableMate" class="table table-hover Mates" style="width:100%">  
        <thead>                         
          <tr class="odd" style="font-weight:bold;">
            <th></th>               
            <th>Id</th>
            <th>N° INV</th>
            <th>Ancien INV</th>
            <th>Produit</th>
            <th>Marque</th>
            <th>Model</th>
            <th>Type</th>
            <th>N° Série</th>
            <th>Statut</th>
            <th>M Total Rép</th>
            <th>Total Pannes</th>
            <th>Actions</th>
          </tr>
        </thead>         
      </table>
    </div>     
      
</div>

 <!-- ADD DOCUMENTS -->
  <!-- Modal ajout document img place -->
    <div id="ModalAddDoc" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">

            <form role="form" enctype="multipart/form-data" data-toggle="validator" id="ValidateUploadPlace" method="post">
              
              <div id="affdocEnreg"></div><br>

              <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
              <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />

              <div class="input-group">               
                Envoyez ce fichier : <input class="btn btn-primary" id="file" name="file" type="file" required />
                <br>                
                <button class="AffbtnViewer btn btn-info hidden" type="button" value="Preview" onclick="PreviewImage();">Voir!</button>
              </div>           
              <br>
              <div class="ViewerPdf hidden" style="clear:both">
                <iframe id="viewer" frameborder="0" scrolling="no" width="550" height="200"></iframe>
              </div>              
              <br>

              <input type="hidden" id="MateID" name="MateID" /> <!-- hidden -->
              <input type="hidden" id="op" name="op" /> <!-- hidden -->
              <input type="hidden" id="IndexUp" name="IndexUp" /> <!-- hidden -->
              <input type="hidden" id="docenreg" name="docenreg" /> <!-- hidden -->

              <input class="btn btn-success" type="submit" value="Envoyer le fichier" />

            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- FIN ADD DOCUMENT -->  
  

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
        time: 6000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });

    // preview fichier //    
    function PreviewImage() {
        pdffile=document.getElementById("file").files[0];
        pdffile_url=URL.createObjectURL(pdffile);
        $('#viewer').attr('src',pdffile_url);
    }     

</script>   