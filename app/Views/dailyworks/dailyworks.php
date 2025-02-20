<!-- Affichage des Travaux Journalier -->

<div class="AffDailyWork col-sm-12">

  <h1>Travaux Journalier</h1>

  <p id="btn_addDailyWork"></p>

  <table id="TableDailyworks" class="table table-hover" style="width: 100%">        
    <thead>            
      <tr style="font-weight:bold;">  
        <td>Id</td>
        <td>Déclarant</td>
        <td>Date</td>
        <td>Catégorie</td>
        <td>Désignation</td>
        <td>Commentaire</td>
        <td>Statut</td>
        <td>Actions</td>
      </tr>
    </thead>
  </table> 

</div>

<div id="AffEventsDaily" class="hidden">

  <h3 id="affDailywork" class="col-sm-12"></h3>    		
  <div id="info_work"></div>    		

  <div class="col-sm-6">
    <div class="col-sm-4">
      <h2>Evénements<span><button class="btn btn-warning pull-right btn_eventDailyWork" data-role="ADDEventWork" data-table="Work"<abbr title="Ajouter un événement"><span class="glyphicon glyphicon-plus"></span></abbr></button></span></h2>
    </div>
    <input type="hidden" name="IDWork" id="IDWork"> <!-- hidden id work -->
    <input type="hidden" name="statut" id="statut"> <!-- hidden statut -->          			
  </div>

  <!-- Affichage des evenement work -->
  <div class="AffEventsWork hidden">         

    <div id="TableEventWork">
          <!-- Affichage de la table evenement travail  -->   
    </div>

  </div>

</div>

<div id="Ancre3" class="col-lg-6"> 
  <div id="BtnHaut" class="hidden">
    <a href="javascript:history.go(-1);" class="btn btn-default"><span class="glyphicon  glyphicon-arrow-left"></span> Retour</a>
  </div>
</div> 

<!-- MODAL -->

  <!-- modal ajout & edition travail journalier-->
    <div id="dailyworks" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">          

              <form role="form" data-toggle="validator" method="post" id="Dailyworks">

                <div class="form-group">
                  <div class="input-group col-md-4">
                    <label for="datedaily" class="control-label">Date Enregistrement : </label>
                    <input type="date" name="datedaily" id="datedaily" class="form-control" required>
                  </div>
                </div>

                <label for="categorie" class="control-label">Catégorie:</label>
                <div class="input-group col-lg-8">                
                  <select class="form-control" name="categorie" id="categorie" required></select>
                  <span class="input-group-btn" id="btn-AddCategorie"><button class="btn btn-theme03" data-role="Addcategorie" type="button">Add Catégorie</button></span>
                </div><br>
                
                <div class="input-group col-lg-8 hidden" id="btn-addcategorie">
                  <input type="text" name="addcategorie" id="addcategorie" class="form-control">
                  <span class="input-group-btn"><button class="btn btn-info" id="AddCategorie" type="button"><span class="glyphicon  glyphicon-ok"></span></button></span>              			
                </div>
                              	
                <div class="input-group col-lg-8 hidden" id="succaddcate"></div>
                <!-- textarea designation -->
                <div class="form-group">
                  <label for="design">Désignation du travail:</label>
                  <textarea name="design" id="design" class="form-control" rows="3" required></textarea>              
                </div>

                <!-- textarea designation -->
                <div class="form-group">
                  <label for="comment">Commentaire:</label>
                  <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>              
                </div>

                <input type="hidden" name="str"><!-- indique la page -->
                <input type="hidden" id="id" name="id"><!-- id travaux -->

                <div class="modal-footer">             

                  <button type="submit" class="btn btn-theme pull-right"><span class="glyphicon  glyphicon-ok"></span></button>                
                  <button type="reset" onclick="this.form.reset();" class="btn btn-theme04 pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>    

                </div>               

              </form>
          </div>
        </div>
      </div>
    </div>

  <!-- Modal ajout & edition évenement Work-->
    <div id="EventWork" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>

            <div class="modal-body">

              <form role="form" method="post" data-toggle="validator" id="Eventwork">

                <!-- affiche input date et heure evenement -->
                <div class="form-inline">                                        
                  <div class="input-group col-lg-3">
                    <label for="DateEvent" class="AffLabel control-label">Date Evenement</label>
                    <input type="date" name="DateEvent" id="DateEvent" class="form-control" value="<?= date("Y-m-d"); ?>" required />
                  </div>                  
                  <div class="input-group col-lg-3">
                    <label for="HeureEvent" class="control-label">Heure Evenement: </label>
                    <input name="HeureEvent" id="HeureEvent" class="form-control" type="time" value="<?= date("H:i"); ?>" required />
                  </div>                    
                </div>                
                <!-- div affiche add event -->
                <div class="form-group has-feedback AffAddEvent">
                  <label for="Event" class="control-label">Evenement : </label>
                  <div class="input-group">                    
                    <textarea type="text" id="Event" name="Event" class="form-control" cols="200" rows="5" data-error="Veuillez entrer l' événement" placeholder="Entrer l'événement" required=""></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div> 
                  </div>
                </div>                  
                <!-- div affiche commentaire -->
                <div class="form-group has-feedback AffComment"> 
                  <label for="Commentaire" class="control-label">Commentaire: </label>              
                  <div class="input-group ">                              
                    <textarea class="form-control" name="Commentaire" id="Commentaire" cols="200" rows="5" data-error="Veuillez entrer le commentaire" placeholder="Entrer le commentaire" required=""></textarea>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>                  
                  </div>             
                </div>
                <!-- div select statut -->
                <div class="form-group">
                  <label for="Statut">Statut</label>
                  <select id="Statut" name="Statut"class="form-control">
                    <option value="Actif" selected>Actif</option>
                    <option value="Terminé">Terminé</option>
                  </select>
                </div>

                <input type="hidden" id="IdWork" name="IdWork"> <!-- hidden -->                
                <input type="hidden" id="IdEvent" name="IdEvent"> <!-- hidden -->
                <input type="hidden" name="str" id="str"> <!-- hidden -->

                <div class="modal-footer">
                
                    <button type="reset" onclick="this.form.reset();" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Validé</button>
                    
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>

<script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Bienvenue sur BDCDL !',
        // (string | mandatory) the text inside the notification
        text: 'Veuillez cliqué deux fois rapidement sur la ligne du travail pour voir les événements !!!',
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
</script>   