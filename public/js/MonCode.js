$(document).ready(function() {

    // FUNCTIONS GENERIQUE //
        let typeU = $("#typeUser").text(); // type de compte administrateur ou utilisateur //
        let nameUser = $('#nameUser').text();
        let phoneUser = $('#phoneUser').val(); 
        let niveauUser = $('#niveauUser').val(); // niveau d'authorization de l'utilisateur //

        $('.I, .M, .P, .IN, .D, .DO, .TJ, .T, .EM, .BDC, .FA, .RC, .CR, .CO, .PA').attr('hidden', true); // ***********M***************//

        if ( typeU === "administrateur") {

            $('.I, .M, .P, .IN, .D, .DO, .TJ, .T, .EM, .BDC, .FA, .RC, .CR, .CO, .PA').attr('hidden', false);
            //notif();

        } else { 

            $('.PA').attr('hidden', true);

            if (niveauUser == 9) { // niveau direction //

                $('.I, .M, .P, .IN, .D, .TJ, .T, .EM, .BDC, .FA, .RC, .CR, .CO').attr('hidden', false);
                //notif();

            } else if (niveauUser == 7) { // niveau technique //

                $('.I, .M, .P, .IN, .D, .TJ, .EM, .FA, .RC, .CR, .CO').attr('hidden', false);
                //$('.CC').attr('hidden', true); // compteur Clinique caché
                //notif(); 

            } else if (niveauUser == 2) { // niveau compta //

                $('.FA, .RC, .CO').attr('hidden', false);
                $('a[href="?p=home"]').attr('href', '?p=home.compta');
                //notifcompta(); 

            }
        } 

        // Exécutez cette fonction une fois par jour (toutes les 24 heures) //
        function actionQuotidienne() {           
            

            
        }

        // Démarrez l'exécution de l'action une fois par jour // 
        setInterval(actionQuotidienne, 24 * 60 * 60 * 1000); // 24 heures en millisecondes     

        // function notification admin / tech /*****AC*M******/
        function notif() {

            $('.affliennotif, .affnotifquota').html('');

            $.ajax({
         
                url: "?p=home.notif",     
                ifModified:true,
                method: 'POST',
                success: function(content){

                  if (content[0].nbrpanne == "0") {

                    $('#affnotif').html('Vous avez aucune notifications');

                  } else {

                    $('#notif').html(content[0].nbrpanne); //span où tu veux que ce nombre apparaisse
                    $('#affnotif').html('Vous avez '+content[0].nbrpanne+ ' notifications');
                    $('.affliennotif').append('<a href="?p=pannes.pannesAttRep"><span class="label label-warning"><i class="fa fa-bell"></i></span> Vous avez ' +content[0].nbrpanne+ ' panne active </a>');
                    $('.affnotifquota').append('<a href="?p="><span class="label label-danger"><i class="fa fa-bolt"></i></span> Vous avez ' +content[0].nbrpanne+ ' devis en attente </a>');
                  } 
                 
                }
            });
            setTimeout(notif, 300000);
        }

        // function notification compta //
        function notifcompta() {

            $('.affliennotif').html('');

            $.ajax({
         
                url: "?p=home.notifcompta",     
                ifModified:true,
                method: 'POST',
                success: function(reponse){

                  if (reponse[0].ninf == "0") {

                    $('#affnotif').html('Vous avez aucune notifications');

                  } else {

                    $('#notif').html(reponse[0].ninf); //span où tu veux que ce nombre apparaisse
                    $('#affnotif').html('Vous avez '+reponse[0].ninf + ' notifications');
                    $('.affliennotif').append('<a href="?p=billings.notbilled"><span class="label label-warning"><i class="fa fa-bell"></i></span> il y a '+reponse[0].ninf+' intervention non facturer</a>');                    

                  } 
                 
                }
            });
            setTimeout(notifcompta, 300000);
        }        

        // fonction  rafraichir la page // 
        function refresh(){            

            setTimeout(function(){ location.reload(true); }, 2000);            
                              
        }

        // function qui donne la date //
        function getCurrentDate() {
            let dateObj = new Date();
            let month = String(dateObj.getMonth() + 1).padStart(2, '0');
            let day = String(dateObj.getDate()).padStart(2, '0');
            let year = dateObj.getFullYear();
            let output = year + '-' + month + '-' + day;
            return output;
        }

        // function qui créer l'heure pour les input //

        let heurebd = function(){

            let d = new Date() // création de l'heure //
            let hours = d.toLocaleString('fr-FR',{
                hour: '2-digit',
                minute: '2-digit'
            });

            return hours
        } 

        // function qui formate le code postal //

        function checkedpostal(id){

            let value = $("#"+id).val();        

            if (value.length == 2) {

                $('#'+id).val(value + " ");            

            }                 

        }           

        // function scroll ancre //

        function ScrollAncre (ancre){
            
            $('html, body').animate({scrollTop: $(ancre).offset().top}, 'slow')

            return false
        } 

        // function qui récupére la class de la div et efface les info ( vari = id variable & temp = temporisation de fermeture modal) //   
            
        function recupclassdiv (vari, temp, modal) {        

            var recupclass = $("div[id='"+vari+"']").attr('class');

            if (modal == undefined) { // sans modal //
                
                setTimeout(function(){
                    $("div[id='"+vari+"']").removeClass(recupclass).addClass(' ').html('');
                    $("#"+modal+"");
                }, temp);

            } else { // avec modal //

                setTimeout(function(){
                    $("div[id='"+vari+"']").removeClass(recupclass).addClass(' ').html(''); 
                    $("#"+modal+"").modal('hide');
                }, temp);
            }       

        }
        
        // function qui remplace la virgule par un point et ajoute deux chiffre aprés la virgule //
        
        function montant (inp, val) {
            let num = parseFloat(val.replace(/\s/g, "").replace(",", ".")).toFixed(2);
            $('#'+inp).val(num);
        }

        // function qui formate le numéro de téléphone à 10 chiffres / id = champ input tel / index = add ou edit / phone = numéro existant dans input //

        function checkednum (id, index, phone){

            let numtel = $('#'+id).val();

            let separator = " ";

            if (numtel.length == 2) {

                $('#'+id).val(numtel + separator);

            } else if (numtel.length == 5) {

                $('#'+id).val(numtel + separator);

            } else if (numtel.length == 8) {

                $('#'+id).val(numtel + separator);

            } else if (numtel.length == 11) {

                $('#'+id).val(numtel+ separator);               

            } else if (numtel.length == 14) {

                // récupére la valeur compléte value pour vérif //
                
                if (index == "add") {

                    checkedNumPhone(numtel, id);                    

                } else {

                    if (numtel != phone){ // si le numéro entré n'est pas égal a l'ancien on fait une recherche dans la base //

                        checkedNumPhone(numtel, id);
                    } 

                    $('#'+id).val(numtel);
                }               

                return true;
            }

        }

        // function qui verifie le numéro de téléphone /id = champ input tel / index = add ou edit / phone = numéro existant dans input //

        function checkednumQ (id, index, phone){

            let numtel = $('#'+id).val();            

            // récupére la valeur compléte value pour vérif //
            
            if (index == "add") {

                checkedNumPhone(numtel, id);                    

            } else {

                if (numtel != phone){ // si le numéro entré et différent de l'ancien on fait une recherche dans la base //

                    checkedNumPhone(numtel, id);
                } 

                $('#'+id).val(numtel);
            }               

            return true;            

        } 

        // function qui verifie si le téléphone existe en base //
        
        function checkedNumPhone (numtel, id){         

           $("#error_numphone").removeClass('display').addClass('hidden'); // efface le message erreur                

            $.post('?p=contributors.checkedNumPhone', 

                {
                    numtel:numtel 

                }, function(data) {                
                    
                    if (data != false ) { //  ont fait l'enregistrement  // 

                        $("#error_numphone")
                        .removeClass('hidden').
                        addClass('alert alert-danger danger-dismissable')
                        .html("Ce numéro existe déja !!!");

                        recupclassdiv("error_numphone", 3000);

                        $('#'+id).val(''); // on efface le champs input téléphone //                                                                                                      
                       
                    }

            });            

        }
        
    // HOME //         
        
        // function qui verifie le nbrs de pannes par année & prixTotal //
        function checkedchartpanne () {

            // récupére dans un tableau les années des pannes [2009,2010,etc]//
            
            $.post('?p=home.extractyear',

                function(data) {                   

                    for (var i = 0; i < data.length; i++) {                       
                       
                       // faire un ajax pour consulter la base chart_panne et voir si l'année exsiste sinon l'enregistrer //
                       
                        let id = data[i].annee;
                       
                        $.ajax({
                            url: '?p=home.checkedyear',
                            data: {id:id},
                            method: 'POST',
                            dataType: 'json',
                            success: function(reponse) {
                                // selon la reponse on enregistre ou non dans la base // 
                                if (reponse.length == 0) {                                    
                                    
                                    // récupére le nbres de panne de l'année & montant FI & FR //
                                    
                                    $.post('?p=home.extractnbrpanne',

                                        {
                                            id:id

                                        }, function(data) {

                                            let pt = Number(data[0].mfi) + Number(data[0].mfr);
                                            let nbr = data[0].nbrpanne;

                                            let nbrpv = data[0].nbrpV;
                                            let ptv = Number(data[0].mfiv) + Number(data[0].mfrv); 

                                            // ajoute l'année dans la base et le nbr de panne & prix_total //
                                            $.post('?p=home.addyearchart',

                                              {
                                                id:id, nbr:nbr, pt:pt, nbrpv:nbrpv, ptv:ptv

                                              }, function(data) {                
                                                  
                                                refresh();  

                                            });

                                    });
                                }                                                        
                                                    
                            }
                              
                        });

                    }                    
                    
            })

        }

        // function qui affiche les charts clim //
        function ShowGraph(data) {

            new Morris.Bar({

              // ID of the element in which to draw the chart.
              element: 'mychartannee',
              // Chart data records -- each entry in this array corresponds to a point on
              // the chart.
              data: data,
              // The name of the data record attribute that contains x-values.
              xkey: 'year',
              // A list of names of data record attributes that contain y-values.
              ykeys: ['nbrs_panne'],
              // Labels for the ykeys -- will be displayed when you hover over the
              // chart.
              labels: ['Nbrs Panne']
            });

            new Morris.Bar({
              // ID of the element in which to draw the chart.
              element: 'mychartprixT',
              // Chart data records -- each entry in this array corresponds to a point on
              // the chart.
              data: data,
              // The name of the data record attribute that contains x-values.
              xkey: 'year',
              // A list of names of data record attributes that contain y-values.
              ykeys: ['prix_total_rep'],
              // Labels for the ykeys -- will be displayed when you hover over the
              // chart.
              labels: ['PrixT'],
              preUnits: "€ "
            });        
        }

        // function qui affiche les charts Volets //
        function ShowGraphVolet(data) {

            new Morris.Bar({

              // ID of the element in which to draw the chart.
              element: 'mychartpavolet',
              // Chart data records -- each entry in this array corresponds to a point on
              // the chart.
              data: data,
              // The name of the data record attribute that contains x-values.
              xkey: 'year',
              // A list of names of data record attributes that contain y-values.
              ykeys: ['nbr_pvolet'],
              // Labels for the ykeys -- will be displayed when you hover over the
              // chart.
              labels: ['Nbrs Panne']
            });

            new Morris.Bar({
              // ID of the element in which to draw the chart.
              element: 'mychartvoletprixT',
              // Chart data records -- each entry in this array corresponds to a point on
              // the chart.
              data: data,
              // The name of the data record attribute that contains x-values.
              xkey: 'year',
              // A list of names of data record attributes that contain y-values.
              ykeys: ['prixT_rep_volet'],
              // Labels for the ykeys -- will be displayed when you hover over the
              // chart.
              labels: ['PrixT'],
              preUnits: "€ "
            });        
        }

        // function qui calclul le prix total reparation et qui l'ecris dans chart_panne /id annee//
        
        function CountPriceTotalRepair(annee) {            
                       
            var annee = annee || '0';
            
            $.post('?p=home.countpricetotalrepair',

              {
                annee : annee 

              }, function(data) {

                if (data[0].mt == null) {

                } else {

                    let pt = Number(data[0].mt) + Number(data[1].mt); //aditionne facture interv & facture réparation //               
                      
                    $.post('?p=home.updatechartpanne',

                        {
                            annee:annee, pt:pt 

                    }); 
                }  
            }); 
        }

        // function qui calclul le prix total reparation volet et qui l'ecris dans chart_panne /id annee/***********AC********/
        
        function CountPTRV(annee) {            
                       
            var annee = annee || '0';
            
            $.post('?p=home.countPTRV',

              {
                annee : annee 

              }, function(data) {

                if (data[0].mt == null) {

                } else {

                    let pt = Number(data[0].mt) + Number(data[1].mt); //aditionne facture interv & facture réparation des volets//               
                      
                    $.post('?p=home.updateCPV',

                        {
                            annee:annee, pt:pt 

                    }); 
                }  
            }); 
        }  

        // verifie si home et affiché //       

        if($('.AffHome').is(':visible') == true){

            $('a.item-A').attr('class', 'active');

            (function () {

                $.post('?p=home.extractyear',

                    function(data) {

                        var data1 = data.length; // nbrs années des pannes //

                        $.post('?p=home.affchart',

                            function(data) {

                                // faire vérification du nombre d'année dans la table et dans panne //

                                if (data.length == 0 || data.length != data1) {

                                    checkedchartpanne(); // recalcul les données 

                                } else {

                                    ShowGraph(data); // affiche le graph panne total
                                }                                               
                            
                        });

                });

            })();

            (function () {

                $.post('?p=home.affchartvolet',

                    function(data) {

                        if (data.length != 0) {

                            ShowGraphVolet(data);

                        }                                              
                    
                });

            })(); 

        }
    
    // CONTRIBUTORS //
     
        // AFF CONTRIBUTORS EXT / ALL //
        
        if($('.AffTContri').is(':visible') == true){
            
            if (typeU == "administrateur") {
                let btn = $(`<button class="btn btn-round btn-success" id="btn_addcontri" data-toggle="modal" data-role="ADDContributor"<abbr title="Ajouter un Intervenant"><span class="glyphicon  glyphicon-plus"></span></abbr></button> `+ 
                            `<a class="btn btn-round btn-default" target="_blank" href="?p=contributors.viewPdf" <abbr title="Créer un PDF">PDF</abbr></a>`); 
                btn.appendTo($("p[id=btn_addContri]"));
            } else {
                let btn = $(`<a class="btn btn-round btn-default" target="_blank" href="?p=contributors.viewPdf" <abbr title="Créer un PDF">PDF</abbr></a>`); 
                btn.appendTo($("p[id=btn_addContri]"));
            }          

            $('a.item-I').attr('class', 'active');
            $('ul.item-i').attr('style', 'display:block;');
            $('li.item-li').attr('class', 'active');

        }

        // affiche tout les intervenants Externe //  

        var TableContri = $('#TableContri').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '45vh',
            scrollX: true,
            scollCollapse: true,
            processing: true,
            paging: true,
            ajax: {
                url:'?p=contributors.allExt',
                type: "POST"
                },                
                columns: [                    
                    { data: "id" },
                    { data: "nom" },
                    { data: "adresse" },
                    { data: "code_postal" },
                    { data: "ville" },
                    { data: "num_phone" },
                    { data: null, render: function ( data, type, row ) {return '<a href="'+data.site_web+'" target="_blank">'+data.site_web+'</a>';}},                    
                    { render : function(id) {
                        if (typeU == "administrateur") {

                            return  `<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editcontributor" data-role="EDITContributor"<abbr title="Edition Intervenant"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                    `<button class="btn btn-info btn-xs" data-role="viewContact"<abbr title="Voir les Contacts"><span class="glyphicon glyphicon-eye-open"></span></abbr></button> `+
                                    `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteContributor"<abbr title="Supprimé intervenant"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`

                        } else {

                            return  `<button class="btn btn-primary btn-xs disabled" <abbr title="Edition Intervenant"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                    `<button class='btn btn-info btn-xs' data-role='viewContact'<abbr title='Voir les Contacts'><span class='glyphicon glyphicon-eye-open'></span></abbr></button> `+
                                    `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé intervenant"><span class="glyphicon  glyphicon-trash"></span></abbr></button> `
                        }
                    }}    
                ]            

        });                     
        
        // function qui verifie si l'intervenant existe en base //
        
        function checkedContributor(){            

            $('#Nom').change(function(){

                let Nom = $('#Nom').val();
                
                $("#error_numphone").removeClass('display').addClass('hidden'); // efface l'info telephone //

                if (Nom == "") {

                } else {

                    $.ajax({
                        url : '?p=contributors.checkedContributor', 
                        method : 'POST',
                        data : {Nom : Nom},
                        dataType: 'json',
                        success : function(data){                                         

                            if (data == false ) {                                 
                                // si l'intervenant n'existe pas //

                                $("#aff_contributor")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable')
                                .html("Cette intervenant et valide !!!");

                                recupclassdiv('aff_contributor', 3000, 'aff_contributor');                              

                            } else { 

                                // msg d'erreur si l'intervenant existe //
                                
                                $("#aff_contributor")
                                .removeClass('hidden')
                                .addClass('alert alert-danger danger-dismissable')
                                .html("Cette intervenant existe déja !!!");

                                recupclassdiv('aff_contributor', 3000, 'aff_contributor');

                                $('#AEContributor')[0].reset();
                            }

                        }

                    });

                }

            });

        }

        // function qui verifie si l'intervenant a déja etait appeler pour la panne en cours / ****a voir si encore besoin *********/
        
        function checkedAppelcontribut(idc, idp){

            $('.AffContriAlreadyContact').removeClass('display').addClass('hidden');            

            $.ajax({
                url : '?p=contributors.checkedappel', 
                method : 'POST',
                data : {idp:idp},
                dataType: 'json',
                success : function(data){

                    if (data.length == 0) {

                    } else if (idc == data[0].contribut_id) {

                        $('.AffContriAlreadyContact').removeClass('hidden').addClass('display');
                        
                    }

                }

            });

        }         

        // function qui affiche l'intervenant en fonction de l'intervention id =id interv //
        
        function affContribuInterv(id){

            $('.AffContribu').removeClass('hidden').addClass('display');                        

            // affiche les données intervenant pour interv avec panne //
            $.ajax({
                url: '?p=intervs.affContribut',
                data: {id:id},
                method: 'POST',
                success:function(data){

                    $('#nom').html(data[0].nom);
                    $('#adresse').html(data[0].adresse);
                    $('#lieux').html(data[0].lieux);
                    $('#numphone').html(data[0].num_phone);
                    $('#siteweb').html(data[0].site_web).attr('href', data[0].site_web);

                    $('#IdContribu').val(data[0].id);

                }

            });
            
        }

        // function select Contributor pour event /id= id panne / EXT //
            
        function load_SelectContri(id) {            

            $('#Contributor').prop('required', true); // active le champ required

            // consulte la table appel pour desactiver l'intervenant déja appeler / id //
            $.post('?p=contributors.checkedappel',

                {
                    id:id 

                }, function(data) {                
                    
                    let idcontribut

                    let nbrIC = data // nbr d'intervenant contacté //                                  

                    // retourne tous les intervenant EXT //

                    $.ajax({
                        url: '?p=contributors.selectContri',
                        data: {index: 'EXT'},
                        method: 'POST',
                        async: false,
                        success: function(reponse) {

                            $('#Contributor option').remove();

                            let nbrint = reponse.length // nombre d'intervenant 

                            $('#Contributor').append('<option value="0" disabled selected>Choix Intervenant</option>') // remplis les données dans le select //

                            for (var i = 0; i < nbrint; i++) {                        

                                let id = reponse[i].id
                                let contri = reponse[i].nom                        
                                $('#Contributor').append('<option value="'+ id +'">'+ contri +'</option>') // remplis les données dans le select //                        

                            }
                            // function qui verifie le nombre de devis refusé //
                            $.ajax({
                                url: '?p=quotation.nbrdenyquota',
                                data: {id:id},
                                method: 'post',
                                success: function(data) {                    

                                    let ndq = data.nbrquota // nombre de quota refusé

                                    if (ndq < nbrint) {

                                        if (nbrIC.length == 0) {
                                            idcontribut = 0
                                        } else {
                                            for (var i = 0; i < nbrIC.length; i++) {
                                                idcontribut = nbrIC[i].contribut_id
                                                $('#Contributor option[value="'+idcontribut+'"]').prop('disabled', true).css('color', 'red')
                                            }
                                        }

                                    }

                                }
                                  
                            });                                        
                            
                        }
                    });

            });            

        }

        // function select Contributor pour Interv sans panne & Contrat / index = EXT ou INT //
        
        function load_SelectContriIC(index) {

            $.ajax({
                url: '?p=contributors.selectContri',
                data: {index:index},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#ContributIC option').remove();

                    let nbrint = reponse.length // nombre d'intervenant 

                    $('#ContributIC').append('<option value="0" disabled selected>Choix Intervenant</option>') // remplis les données dans le select //

                    for (var i = 0; i < nbrint; i++) {                        

                        let id = reponse[i].id
                        let contri = reponse[i].nom                        
                        $('#ContributIC').append('<option value="'+ id +'">'+ contri +'</option>') // remplis les données dans le select //                        

                    }
                }
            });
        }        

        // ADD CONTRIBUTOR //
    
        $(document).on('click', 'button[data-role=ADDContributor]', function(){           

            // efface les erreurs //
            $('.AffACPV, .AffSW, #error_contributor, #success_contributor').removeClass('display').addClass('hidden');
            $('#titleContribut').val('');
            
            let title, inte;
            let inp = $('input[name=BTN]:checked').val();

            if (inp == 1) { // INT //

                title = 'Ajout Intervenant Interne';
                $('.AffACPV, .AffSW').removeClass('display').addClass('hidden'); // efface //
                $('#Phone').attr('maxlength', '4').removeClass('form-control TEL').addClass('form-control');
                inte = 'INT';

            } else { // EXT //
                
                title = 'Ajout Intervenant Exterieur';

                $('.AffACPV, .AffSW').removeClass('hidden').addClass('display'); // affiche //
                $('#Phone').attr('maxlength', '14').removeClass('form-control').addClass('form-control TEL');
                inte = 'EXT';

                // verifie le code postal //
                $('.CDP').on('keyup',function() {
                    checkedpostal('CodePostal');
                });            

                // verifier le numéro de téléphone //
                $('.TEL').on('keyup', function() {
                    checkednum('Phone', 'add');
                });
            }

            $('#contributor').modal('show'); // ouvre la modal
            $('#titleContribut').html(title);                                      

            // verifier le nom de l'intervenant //             
            checkedContributor();

            let S = $(this).data('s');
            $('#S').val(S);            

            $('#action').val('add');            
            $('#depend').val(inte);            

        });
    
        // EDITION CONTRIBUTOR //

        // recuperation des données pour edition intervenant //

        $(document).on('click','button[data-role=EDITContributor]', function(){ 

            rowtablecontri = $(this).closest('tr');
            id = parseInt(rowtablecontri.find('td:eq(0)').text());

            $('#contributor').modal('show'); // ouvre la modal
            $('#titleContribut').html('Edition Intervenant Externe');
            
            $.post('?p=contributors.find',

              {
                  id : id 

              }, function(reponse) {          

                $('#Nom').val(reponse.data.nom);
                $('#Adresse').val(reponse.data.adresse);
                $('#CodePostal').val(reponse.data.code_postal);
                $('#Ville').val(reponse.data.ville);
                $('#Phone').val(reponse.data.num_phone);
                var phone = reponse.data.num_phone;
                $('#Siteweb').val(reponse.data.site_web);

                // verifie le code postal //
                $('.CDP').on('keyup',function() {
                    checkedpostal('CodePostal');
                });            

                // verifier le numero de téléphone //
                $('.TEL').on('keyup', function() {                
                    checkednum('Phone', 'edit', phone);
                });

                $('#action').val('edit');
                $('#depend').val('EXT');
                $('#ContriID').val(reponse.data.id);

            });           

        });

        // validation des données ajout & edition contribut //
        $('#AEContributor').validator().on('submit', function (event) {
            
            let action = $('#action').val();
            let S = $('#S').val();

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();

                if (action == "add") {

                    $.ajax({
                        url : '?p=contributors.add', 
                        method : 'POST',
                        data : $('#AEContributor').serialize(),
                        success : function(data){

                            $("#info_user")
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("L'intervenant à bien était ajouté !!!");                            

                            $('#AEContributor').trigger('reset'); // reset le formulaire
                            
                            if (S) {                            

                                load_SelectContriIC('EXT'); // recharge le select //

                            } else {

                                TableContri.ajax.reload(); // reload la TableContri /ok/ 
                            }                            

                            $('#contributor').modal('hide'); // ferme la modal
                            recupclassdiv('info_user', 7000);                            
                            
                        }                    

                    });

                } else if (action == "edit") {

                    $.ajax({
                        url : '?p=contributors.edit',
                        method : 'POST',
                        data : $('#AEContributor').serialize(),
                        success : function(data){

                            $('#AEContributor').trigger('reset'); // reset le formulaire                           
                                                        
                            $("#info_user")
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("L'intervenant à bien était modifié");

                            $('#contributor').modal('hide');

                            TableContri.ajax.reload();

                            recupclassdiv('info_user', 7000);                            
                            
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            
                            $('#error').html('<p>Erreur : ' + textStatus + ' - ' + errorThrown + '</p>');
                        }

                    });

                }                
            }

        });

        // DELETE CONTRIBUTOR //
    
        // supprime l'intervenant avec condition //
        
        $(document).on('click','button[data-role=deleteContributor]', function(){

            let rowtablecontri = $(this).closest('tr');
            let id = parseInt(rowtablecontri.find('td:eq(0)').text());            
           
            $.ajax({
                url: '?p=contributors.checkedIntervContribut',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                                        

                    // ont demande la comfirmation //
                    if(confirm("Voulez-vous vraiment supprimer l'intervenant?")) {

                        if (reponse.length == 0) {
                            // on efface si l'intervenant n'a pas fait d'intervention //
                            $.ajax({
                                url:"?p=contributors.delete", 
                                method: 'POST' ,
                                data:{id : id},                            
                                success:function(data)
                                {                                                      

                                    $("#info_user")
                                    .addClass('alert alert-success success-dismissable')
                                    .html("L'intervenant à bien était supprimé !!!"); 

                                    TableContri.ajax.reload() ; // reload la table
                                    recupclassdiv('info_user', 7000); 
                                    
                                }   
                            });

                        } else {

                            // ont ne peut pas effacer 
                            $("#info_user")
                            .addClass('alert alert-danger danger-dismissable')
                            .html("L'intervenant ne peut être éffacé !!!");

                            recupclassdiv('info_user', 7000);
                        }

                    }                                                                    
                                        
                }
                  
            }); 

        });

    // CONTRIBUTORS INTERNE //
    
        // AFF CONTRIBUTORS INTE / ALL //
        
        if($('.AffTContriInte').is(':visible') == true){
            
            if (typeU == "administrateur") {
                let btn = $(`<button class="btn btn-round btn-success" id="btn_addcontri" data-toggle="modal" data-role="ADDContributorInte"<abbr title="Ajouter un Intervenant Interne"><span class="glyphicon  glyphicon-plus"></span></abbr></button> `+ 
                            `<a class="btn btn-round btn-default" target="_blank" href="?p=contributors.viewIntPdf" <abbr title="Créer un PDF">PDF</abbr></a>`); 
                btn.appendTo($("p[id=btn_addContri]"));
            } else {
                let btn = $(`<a class="btn btn-round btn-default" target="_blank" href="?p=contributors.viewIntPdf" <abbr title="Créer un PDF">PDF</abbr></a>`); 
                btn.appendTo($("p[id=btn_addContri]"));
            }          

            $('a.item-I').attr('class', 'active');
            $('ul.item-i').attr('style', 'display:block;');
            $('li.item-lii').attr('class', 'active');

        }

        // affiche tout les intervenants Externe //  

        var TableContriInte = $('#TableContriInte').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '45vh',
            scrollX: true,
            scollCollapse: true,
            processing: true,
            paging: true,
            ajax: {
                url:'?p=contributors.allInte',
                type: "POST"
                },
                columns: [                    
                    { data: "id" },
                    { data: "nom" },
                    { data: "num_phone" },                    
                    { render : function(id) {
                        if (typeU == "administrateur") {

                            return  `<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editcontributor" data-role="EDITContributorInte"<abbr title="Edition Intervenant Interne"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+                                    
                                    `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteContributorInte"<abbr title="Supprimé l'intervenant Interne"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`

                        } else {

                            return  `<button class="btn btn-primary btn-xs disabled" <abbr title="Edition Intervenant"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+                                    
                                    `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé intervenant"><span class="glyphicon  glyphicon-trash"></span></abbr></button> `
                        }
                    }}    
                ]            

        });

         // ADD CONTRIBUTOR INTE //
    
        $(document).on('click', 'button[data-role=ADDContributorInte]', function(){           

            // efface les erreurs //
            $('#error_contributor, #success_contributor').removeClass('display').addClass('hidden');            
            $('#contributint').modal('show'); // ouvre la modal
            $('#titleContribut').html('Ajout Intervenant Interne');                            

            // verifier le nom de l'intervenant //             
            checkedContributor();           

            // verifier le numéro de téléphone //            

            $('.TELINTE').on('focusout', function() {                

                checkednumQ ('Phone', 'add');
            });

            $('#action').val('add');            
            $('#depend').val('INT');            

        });
    
        // EDITION CONTRIBUTOR INTERNE //

        // recuperation des données pour edition intervenant Interne//

        $(document).on('click','button[data-role=EDITContributorInte]', function(){ 

            rowtablecontri = $(this).closest('tr');
            id = parseInt(rowtablecontri.find('td:eq(0)').text());

            $('#contributint').modal('show'); // ouvre la modal
            $('#titleContribut').html('Edition Intervenant Interne');
            
            $.post('?p=contributors.find',

              {
                  id : id 

              }, function(reponse) {          

                $('#Nom').val(reponse.data.nom);
                $('#Phone').val(reponse.data.num_phone);
                var phone = reponse.data.num_phone;            

                // verifier le numéro de téléphone //
                $('.TELINTE').on('focusout', function() {                
                   
                    checkednumQ ('Phone','edit',phone);
                });

                $('#action').val('edit');
                $('#depend').val('INT');
                $('#ContriID').val(reponse.data.id);

            });           

        });

        // validation des données ajout & edition contribut //
        $('#AEContributint').validator().on('submit', function (event) {

            let index;
            let action = $('#action').val();
            let modal = $('#modal').val();

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();

                if (action == "add") {

                    $.ajax({
                        url : '?p=contributors.add', 
                        method : 'POST',
                        data : $('#AEContributint').serialize(),
                        success : function(data){

                            $("#info_user")
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("L'intervenant Interne à bien était ajouté !!!");                            

                            $('#AEContributor').trigger('reset'); // reset le formulaire

                            TableContriInte.ajax.reload(); // reload la table                                                 

                            $('#contributint').modal('hide'); // ferme la modal
                            recupclassdiv('info_user', 7000);                            
                            
                        }                    

                    });

                } else if (action == "edit") {

                    $.ajax({
                        url : '?p=contributors.edit',
                        method : 'POST',
                        data : $('#AEContributint').serialize(),
                        success : function(data){

                            $('#AEContributint').trigger('reset'); // reset le formulaire                           
                                                        
                            $("#info_user")
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("L'intervenant Interne à bien était modifié");

                            $('#contributint').modal('hide');

                            TableContriInte.ajax.reload();

                            recupclassdiv('info_user', 7000);                            
                            
                        }

                    });

                }                
            }

        });

        // DELETE CONTRIBUTOR INTE //
    
        // supprime l'intervenant avec condition //
        
        $(document).on('click','button[data-role=deleteContributorInte]', function(){

            let rowtablecontri = $(this).closest('tr');
            let id = parseInt(rowtablecontri.find('td:eq(0)').text());            
           
            $.ajax({
                url: '?p=contributors.checkedIntervContributInte',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                                        

                    // ont demande la comfirmation //
                    if(confirm("Voulez-vous vraiment supprimer l'intervenant?")) {

                        if (reponse.length == 0) {
                            // on efface si l'intervenant n'a pas fait d'intervention //
                            $.ajax({
                                url:"?p=contributors.delete", 
                                method: 'POST' ,
                                data:{id : id},                            
                                success:function(data)
                                {                                                      

                                    $("#info_user")
                                    .addClass('alert alert-success success-dismissable')
                                    .html("L'intervenant à bien était supprimé !!!"); 

                                    TableContriInte.ajax.reload() ; // reload la table
                                    recupclassdiv('info_user', 7000); 
                                    
                                }   
                            });

                        } else {

                            // ont ne peut pas effacer 
                            $("#info_user")
                            .addClass('alert alert-danger danger-dismissable')
                            .html("L'intervenant ne peut être éffacé !!!");

                            recupclassdiv('info_user', 7000);
                        }

                    }                                                                    
                                        
                }
                  
            }); 

        });   

    // CONTACTS //
        
        if ($('.AffTContact').is(':visible') == true) {

            $('a.item-I').attr('class', 'active');
            $('ul.item-i').attr('style', 'display:block;');
            $('li.item-lc').attr('class', 'active');
        }

        // function select Contact en function de l'intervenant / id contribut //
            
        function load_SelectContact(idc) {
            
            $('#Contact').prop('required', true); // active le champ required

            let idp = $('#IDPanne').val(); // récupére l'id panne

            // consulte la table appel pour desactiver l'intervenant déja appeler / id panne//
            $.post('?p=contacts.checkedappel',

                {
                    idp:idp, idc:idc // idp = id panne / idc = id contribut//

                }, function(data) {

                    $.ajax({
                        url: '?p=contacts.selectContact',
                        data: {id:idc}, // id contribut //
                        method: 'POST',
                        async: false,
                        success: function(reponse) {

                            let nbrcontT = reponse.length; // nombre de contact total de l'intervenant                           

                            $('#Contact option').remove();

                            $("#Contact").append('<option value="" disabled selected>Choix Contact</option>'); // remplis les données dans le select //

                            for (var i = 0; i < nbrcontT; i++) {

                                var id = reponse[i].id;
                                var contact = reponse[i].nom;
                                $("#Contact").append('<option value="'+ id +'" >'+ contact +'</option>'); // remplis les données dans le select //

                            } 

                            let ndca = data.length // nombre de contact déja appelé 

                            //if (ndca < nbrcontT) { // comparaison ( nbr contact appelé inférieur à nbr contact total) 

                            if (ndca == 0) {
                                idcontact = 0;
                            } else {
                                for (var i = 0; i < ndca; i++) {
                                    idcontact = data[i].contact_id;
                                    $('#Contact option[value="'+idcontact+'"]').prop('disabled', true).css('color', 'red');
                                }
                            }

                        }
                    });

            });

        }

        // function select Technicien en function de l'intervenant //
            
        function load_SelectTech(id) {
            
            $('#Tech').prop('required', true); // active le champ required

            $.ajax({
                url: '?p=contacts.selectTech',
                data: {id:id},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#Tech option').remove();

                    $("#Tech").append('<option value="" disabled selected>Choix Technicien</option>'); // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;

                        var tech = reponse[i].nom;                            

                        $("#Tech").append('<option value="'+ id +'" >'+ tech +'</option>'); // remplis les données dans le select //

                    }           
                }
            });

        }

        // function qui remonte les données sur l'intervenant ou tech appeler // id contact//

        function finddatacontact(id) {

            // affiche les données intervenant //
            $.ajax({
                url: '?p=contacts.finddatacontact',
                data: {id:id},
                method: 'POST',
                success:function(data){

                    let i = data.length-1;                    
                    $('#nomContribut').html(data[i].nom); 
                    $('#nomContact').html(data[i].contact + ' - ' + data[i].c_portable);
                    $('#nomTech').html(data[i].contact + ' - ' + data[i].c_portable);

                    $('#IdContribut').val(data[i].id); //ecris dans input hidden modal
                    $('#ContriContact').val(data[i].contact + '- Société:' + data[i].nom); // ecris dans input hidden modal                                     

                }

            });
        }
        
        // AFF CONTACTS ALL //            

        var TableContact = $('#TableContact').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '500px',
            scrollX: true,
            scollCollapse: true,
            processing: true,
            ajax: {
                url:'?p=contacts.all',
                type: "POST"
                },
                paging: true,
                columns: [
                    { data: "id" },
                    { data: "c_nom" },
                    { data: "c_prenom" },
                    { data: "c_fonction" },
                    { data: "societe" },
                    { data: "c_portable" },
                    { data: null, render: function ( data, type, row ) {return '<a href="mailto:'+data.c_email+'" >'+data.c_email+'</a>';}},                    
                    { render : function(id) { 

                        if (typeU == 'administrateur') {

                            return `<button class='btn btn-primary btn-xs' data-role='EditContact'<abbr title='Edition du contact'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                   `<button type='submit' class='btn btn-danger btn-xs' data-role='deleteContact'<abbr title='Supprimé le contact'><span class='glyphicon  glyphicon-trash'></span></abbr></button>`
                        } else {

                            return `<button class='btn btn-primary btn-xs'<abbr title='Edition du contact' disabled><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+ 
                                   `<button class='btn btn-danger btn-xs'<abbr title='Supprimé le contact' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>`
                        }                           

                    }}
                ]            

        });        

        function TableViewContact(id, contrib_nom) {

            // verifie si un contact existe pour l'intervenant si vrai ouvre modal (id contributor)//
            
            $.ajax({
                url: '?p=contributors.checkedContact',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    if (reponse.data[0].id === null) {

                        if (typeU === 'administrateur') {

                            // ecrire qu'il n'existe aucun contact // 
                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-info info-dismissable')
                            .html('L\'intervenant n\'a aucun contact !!! <button class="btn btn-primary" data-role="addContact" data-id='+ id +' data-nom='+ contrib_nom +'> Add Contact </button>');

                        } else {

                            // ecrire qu'il n'existe aucun contact // 
                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-info info-dismissable')
                            .html('L\'intervenant n\'a aucun contact !!! '); 
                        }

                        recupclassdiv('info_contributor', 7000);
                        
                    } else {

                        $('#viewContact').modal('show'); // ouvre la modal view contact //
                        $('#titleContact').html('Contact de l\'intervenant: ' + reponse.data[0].nom);                        

                        // reinitialise la table //
                        if ($.fn.dataTable.isDataTable('#TableViewContact')) {

                            $('#TableViewContact').DataTable().destroy();
                        }

                        if (typeU === 'administrateur') {

                            $('.btn_addContact').show(); // affiche le btn add contact

                        } else {

                            $('.btn_addContact').hide(); // efface le btn add contact                            
                        }
                        
                        $('#TableViewContact').DataTable({

                            language: {url: "../public/media/French.json"},
                            lengthMenu: [10, 15, 25, 50],
                            data: reponse.data,                           
                            paging: false,
                            searching: false,
                            columns: [
                                { data: "id" },
                                { data: "c_nom" },
                                { data: "c_prenom" },
                                { data: "c_fonction" },
                                { data: "c_portable" },
                                { data: null, render: function ( data, type, row ) {return '<a href="mailto:'+data.c_email+'" >'+data.c_email+'</a>';}},                    
                                { render : function(id) {

                                    if (typeU == "administrateur") {

                                        return "<button class='btn btn-primary btn-xs' data-role='editContact'<abbr title='Edition du contact'><span class='glyphicon glyphicon-pencil'></span></abbr></button> <button type='submit' class='btn btn-danger btn-xs' data-role='deleteContact' data-route='ModViewCont'<abbr title='Supprimé le contact'><span class='glyphicon  glyphicon-trash'></span></abbr></button>"

                                    } else {

                                        return "<button class='btn btn-primary btn-xs' data-role='editContact'<abbr title='Edition du contact' disabled><span class='glyphicon glyphicon-pencil'></span></abbr></button> <button type='submit' class='btn btn-danger btn-xs' data-role='deleteContact' data-route='ModViewCont'<abbr title='Supprimé le contact' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>"
                                    }
                                }}
                            ]            

                        });
                                             
                    }                                                         
                                        
                }
                  
            });
            
        }       

        // function qui montre les contact par rapport a l'intervenant (id=contribut)

        $(document).on('click','button[data-role=viewContact]', function(){

            var rowtablecontri = $(this).closest('tr');
            var id = parseInt(rowtablecontri.find('td:eq(0)').text()); // recupére l'id
            var contrib_nom = rowtablecontri.find('td:eq(1)').text(); // recupére le nom
            
            $('#IdContribut').val(id); // inscrit l'id dans l'input de la modal viewcontact
            $('#Contribut').val(contrib_nom); // inscrit le nom contribut dans la modal viewcontact

            TableViewContact(id,contrib_nom);// lance la function                        
            
        });

        // function qui ajoute un contact a l'intervenant (id contribut) //
        
        $(document).on('click','button[data-role=addContact]', function(){

            let id_contrib, nom_contrib

            $('#addContact').modal(); // ouvre la modal 
            
            if ($('.AffSelectEmail').is(':visible') == true) {

                id_contrib = $(this).data('id');
                nom_contrib = $(this).data('nom');

            } else {

                id_contrib = $('#IdContribut').val();
                nom_contrib = $('#Contribut').val(); 
            }                                                                   
            
            $("#titleAddContact").html('Ajouter un contact à l\'intervenant : ' + nom_contrib); // ecris dans le title            

            // verifier le numero de téléphone //
            $('.TEL').on('keyup', function() {
                checkednum('PhoneCell', 'add');
            });       
                        
            $('#idContrib').val(id_contrib); // ecris dans input
            let index = $(this).data('btn'); 

            $('#AddContact').validator().on('submit', function (event) {

                let IdContribut = $('#idContrib').val(); // récupére l'id contribut 

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();

                    $.ajax({
                        url: '?p=contacts.add',
                        data: $('#AddContact').serialize(),
                        method: 'POST',
                        success: function(reponse) {
                            
                            $("#info_user")
                            .addClass('alert alert-success success-dismissable col-lg-4')
                            .html("Le contact à bien était ajouté !!!");                            

                            $('#AddContact').trigger('reset'); // reset le formulaire
                            $('#addContact').modal('hide'); // ferme la modal
                            recupclassdiv('info_user', 7000);

                            if (index == "panne") {

                                load_SelectContact(IdContribut); //lance la function (id contribut)

                            } else if (index == "email") {

                                load_SelectEmail(IdContribut); // lance la function (id contribut)

                            } else {

                               TableViewContact(IdContribut, nom_contrib); // lance la function 
                            }                                                                                     
                                                
                        }
                          
                    });
                }
            });
        });

        // function qui edit le contact selectionner dans intervenant //
        
        $(document).on('click', 'button[data-role=editContact]', function(){

            var rowtablecont = $(this).closest('tr');            
            var id = parseInt(rowtablecont.find('td:eq(0)').text()); // id contact 
            var nom = rowtablecont.find('td:eq(1)').text();            
            var prenom = rowtablecont.find('td:eq(2)').text();            
            var fonction = rowtablecont.find('td:eq(3)').text();
            var portable = rowtablecont.find('td:eq(4)').text();
            var email = rowtablecont.find('td:eq(5)').text();

            var IdContribut = $('#IdContribut').val(); // recupére l'id contribut pour mise a jour table viewContact
            var contrib_nom = $('#Contribut').val(); // recupére le nom du contribut pour mise a jour table viewContact

            $('#editContact').modal('show'); // ouvre la modal

            $("#titleEditContact").html('Edition contact : ' + nom); // ecris dans le title

            // ecris dans les inputs //
            $('#EdNomCont').val(nom);
            $('#EdPrenomCont').val(prenom);
            $('#EdFonction').val(fonction);
            $('#EdPhoneCell').val(portable);
            $('#EdEmailCont').val(email);            

            // verifier le numero de téléphone //
            $('.TEL').on('keyup', function() {
                checkednum('EdPhoneCell', 'edit', portable);
            });

            // mise a jour des données édition contact

            $('#EditContact').validator().on('submit', function(event){

                if (event.isDefaultPrevented()) {

                    } else {

                    event.preventDefault();                  

                    $.ajax({
                        url : '?p=contacts.edit',
                        method : 'POST',
                        data : $('#EditContact').serialize() + '&IDContact=' + id,
                        success : function(data){

                            $('#EditContact').trigger('reset'); // reset le formulaire                           
                                                        
                            $("#info_user")
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("Le contact à bien était mis à jour !!!");

                            $('#editContact').modal('hide'); // ferme la modal

                            TableViewContact(IdContribut, contrib_nom);

                            recupclassdiv('info_user', 5000);                            
                            
                        }

                    });
                }

            });

        });

        // function qui edit le contact selectionner dans contacts //
        
        $(document).on('click', 'button[data-role=EditContact]', function(){

            // recupére les données de la ligne selectionner de la table contribut 

            var rowtablecont = $(this).closest('tr');            
            var id = parseInt(rowtablecont.find('td:eq(0)').text()); // id contact 
            var nom = rowtablecont.find('td:eq(1)').text();            
            var prenom = rowtablecont.find('td:eq(2)').text();            
            var fonction = rowtablecont.find('td:eq(3)').text();
            var societe = rowtablecont.find('td:eq(4)').text();
            var portable = rowtablecont.find('td:eq(5)').text();
            var email = rowtablecont.find('td:eq(6)').text();

            $('#editContact').modal('show'); // ouvre la modal

            $("#titleEditContact").html('Edition contact : ' + nom + ' ' + prenom +  '<br>' + 'Société: '+ societe); // ecris dans le title

            $('#EdNomCont').val(nom); // ecris dans l'input 
            $('#EdPrenomCont').val(prenom); // ecris dans l'input
            $('#EdFonction').val(fonction); // ecris dans l'input
            $('#EdPhoneCell').val(portable); // ecris dans l'input
            $('#EdEmailCont').val(email); // ecris dans l'input
            

            // verifier le numero de téléphone //
            $('.TEL').on('keyup', function() {
                checkednum('EdPhoneCell');
            });

            // mise a jour des données édition contact

            $('#EditContact').validator().on('submit', function(event){

                if (event.isDefaultPrevented()) {

                    } else {

                    event.preventDefault();                 

                    $.ajax({
                        url : '?p=contacts.edit',
                        method : 'POST',
                        data : $('#EditContact').serialize() + '&IDContact=' + id,
                        success : function(data){

                            $('#EditContact').trigger('reset'); // reset le formulaire                           
                                                        
                            $("#info_contact")
                            .removeClass('hidden').ad
                            dClass('alert alert-success success-dismissable col-lg-6')
                            .html("Le contact à bien était mis à jour !!!");

                            $('#editContact').modal('hide'); // ferme la modal

                            TableContact.ajax.reload(); // reload la table

                            recupclassdiv('info_contact', 5000);                           
                            
                        }

                    });
                }

            });

        });

        // function qui ajoute un technicien a l'intervenant //
        
        $(document).on('click', 'button[data-role=addTech]', function() {

            let id_contrib = $(this).data('id'); 
            let nom_contrib = $(this).data('nom');

            $('#addContact').modal(); // ouvre la modal
            $("#titleAddContact").html('Ajouter un téchnicien à l\'intervenant : ' + nom_contrib); // ecris dans le title
            $('#Fonction').val('Technicien').attr('readonly', true);
            $('#idContrib').val(id_contrib);

            // verifier le numero de téléphone //
            $('.TEL').on('keyup', function() {
                checkednum('PhoneCell', 'add');
            });  

            $('#AddContact').validator().on('submit', function (event) {

                let IdContribut = $('#idContrib').val(); // récupére l'id contribut 

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();

                    $.ajax({
                        url: '?p=contacts.add',
                        data: $('#AddContact').serialize(),
                        method: 'POST',
                        success: function(reponse) {
                            
                            $("#info_user")
                            .addClass('alert alert-success success-dismissable col-lg-4')
                            .html("Le téchnicien à bien était ajouté !!!");                            

                            $('#AddContact').trigger('reset'); // reset le formulaire
                            $('#addContact').modal('hide'); // ferme la modal
                            recupclassdiv('info_user', 7000);

                            load_SelectTech(IdContribut);                                                                                   
                                                
                        }
                          
                    });
                }
            });
        });

        // DELETE CONTACTS //
    
        // supprime le contact avec condition //
        
        $(document).on('click','button[data-role=deleteContact]', function(){

            var rowtablecont = $(this).closest('tr');
            var id = parseInt(rowtablecont.find('td:eq(0)').text()); // id du contact

            var IdContribut = $('#IdContribut').val(); // id du contribut //
            var contrib_nom = $('#Contribut').val(); // non du contributor //
            var ModViewCont = $(this).data('route'); // recupére le data-route           

            if(confirm("Voulez-vous vraiment supprimer le contact de cette intervenant ?")) {

               $.ajax({
                url:"?p=contacts.delete", 
                method: 'POST',
                data:{id : id},                            
                success:function(reponse)
                    {                      
                        
                        if (ModViewCont === 'ModViewCont') {

                            $("#info_contributor")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("L'intervenant à bien était supprimé !!!");

                            recupclassdiv('info_contributor', 7000);

                            TableViewContact(IdContribut, contrib_nom);

                        } else {

                            $("#info_contact")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("L'intervenant à bien était supprimé !!!");

                            recupclassdiv('info_contact', 7000);

                            TableContact.ajax.reload(); // reload la table 
                        }                          
                        
                    }   
                });
            }

        });

    // MATERIALS //

        if($('.AffMates').is(':visible') == true){

            if (typeU == "administrateur") {
                let btn = $(`<button class="btn btn-round btn-success" data-role="AddMaterial" <abbr title="Ajouter un Matériel"><span class="glyphicon  glyphicon-plus"></span></abbr></button>` + 
                            ` <a class="btn btn-round btn-default" target="_blank" href="?p=materials.viewAllPdf"<abbr title="Créer un PDF">PDF</abbr></a>` );

                btn.appendTo($("p[id=btn_addMate]"));
                btnsearchMate();

            } else {

                let btn = $(`<a class="btn btn-round btn-default" target="_blank" href="?p=materials.viewAllPdf"<abbr title="Créer un PDF">PDF</abbr></a>`);

                btn.appendTo($("p[id=btn_addMate]"));
                btnsearchMate();
            }  

            $(document).on('click', 'button[data-role=search]', function(){

                let search = $(this).text();
                TableMate.search(search).draw();

            });          

            checkstatut(); // verifie le statut du matériel zero panne avec le statut en panne //          

            // AFF Matérials //
            
            var TableMate = $('#TableMate').DataTable({

                language: {url: "../public/media/French.json"},
                lengthMenu: [
                    [10, 15, 25, -1],
                    [10, 15, 25, 'All']
                ],
                scrollX: true,
                scrollY: '50vh',
                scollCollapse: true,
                paging: true,
                ajax: {
                    url:'?p=materials.all',
                    type: "POST"
                },
                columns: [
                    {
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    { data: "id"},                    
                    { data: "num_inventaire" },
                    { data: "inventory" },
                    { data: "produit" },
                    { data: "marque" },
                    { data: "model" },
                    { data: "type" },
                    { data: "num_serie" },
                    { data: "statut",
                        render: function(data, type) {

                            if (type === 'display') {
                                    
                                if (data === 'En Panne' ||  data === 'HS') {

                                    return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>';

                                } else if(data === 'En Attente') {

                                    return '<a class="btn-info btn-xs btn-round" disabled>'+ data +'</a>';

                                } else if (data === 'Intervention En Cours') {

                                    return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>';                                

                                } else {

                                    return '<a class="btn-success btn-xs btn-round" disabled>'+ data +'</a>';
                                }                               
                            }                                       
                                return data;
                        }
                    },
                    { data: "mtr",
                      render: function(data, type, row) {
                            
                            if (row.mfr == null && row.mfi == null) {
                                return mtr = '0.00 €';
                            } else {
                                mfr = Number(row.mfr);
                                mfi = Number(row.mfi);
                                mtr = mfr + mfi;
                                return mtr.toFixed(2) +' €';
                            }                            
                      }
                    },
                    { data: "nbrtotalpanne" },
                    { render : function(data, type, row) { // ACTION
                            if (typeU == "administrateur") {

                                if(row.nbrtotalpanne == 0) {

                                    return '<button class="btn btn-primary btn-xs" data-role="EditMaterial" data-id="'+ row.id +'"<abbr title="Edition matériel"><span class="glyphicon  glyphicon-pencil"></span></abbr></button> '+                    
                                    '<a class="btn btn-default btn-xs disabled">PDF</a> '+                    
                                    '<button type="submit" class="btn btn-danger btn-xs" data-role="ScrapMate" data-p="M"<abbr title="Supprimé le matériel"><span class="glyphicon glyphicon-trash"></span></abbr></button>'

                                } else {

                                    return '<button class="btn btn-primary btn-xs" data-role="EditMaterial" data-id="'+ row.id +'"<abbr title="Edition matériel"><span class="glyphicon  glyphicon-pencil"></span></abbr></button> '+                    
                                    '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.viewMateSelectPdf&id=' + row.id + '"<abbr title="voir le PDF"></abbr>PDF</a> '+                    
                                    '<button type="submit" class="btn btn-danger btn-xs" data-role="ScrapMate" data-p="M"<abbr title="Supprimé le matériel"><span class="glyphicon glyphicon-trash"></span></abbr></button>'

                                } 

                            } else {

                                if(row.nbrtotalpanne == 0) {
                                    return '<a class="btn btn-default btn-xs disabled"<abbr title="PDF"></abbr>PDF</a>'
                                } else {
                                    return '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.viewMateSelectPdf&id=' + row.id + '"<abbr title="PDF"></abbr>PDF</a>'
                                }
                                
                            }
                        }
                    }
                ]      
            });

            let index = $('#index').val();

            if (index === '' ) {

                $('a.item-M').attr('class', 'active'); // rend actif le onglet menu //
                $('ul.item-m').attr('style', 'display:block;'); // maintient le sub menu ouvert
                $('li.item-lm').attr('class', 'active'); // affiche en vert le lien cliqué            

            } else if (index == "clim") { // filtre les recherche //
                TableMate.search('climatisation').draw();
            } else if (index == "volets") {
                TableMate.search('volet roulant').draw();
            }             

            // Add event listener for opening and closing details
            TableMate.on('click', 'td.dt-control', function (e) {
                let tr = e.target.closest('tr');
                let row = TableMate.row(tr);
             
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                }
                else {
                    // Open this row
                    row.child(format(row.data())).show();
                }
            });

            function format(d) {
                
                // `d` is the original data object for the row                

                if (d.lieux_install == null) {
                    return (
                        '<dl>' +
                        '<dt>Niveau:</dt>' +
                        '<dd>'+ d.niveau +'</dd>' +                        
                        '<dt>Lieu:</dt>' +
                        '<dd>'+ d.lieux +'</dd>' +
                        '<dt>Piéce:</dt>' +
                        '<dd>'+ d.piece +'</dd>' +
                        '</dl>' 
                    );
                } else {

                    return (
                        '<dl>' +                     
                        '<dt>Zone Installé:</dt>' +
                        '<dd>'+ d.lieux_install +'</dd>' +
                        '</dl>'
                    );
                }
                
            }

        }

        // function qui génére les button recherche produit //
        
        function btnsearchMate() {

            let btn = 1; // 1 = mat primary //

            $.ajax({
                url: '?p=materials.selectProduct',
                data: {fam:"0", btn:btn},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    for (var i = 0; i < reponse.length; i++) {

                        let prod = reponse[i].produit;

                        let btn = $(' <button class="btn btn-round btn-default" data-role="search">'+ prod +'</button> ' );
                        btn.appendTo($("p[id=btn_searchMate]"));
                    }                                                       
                                        
                }
                  
            });
        }

        // function btn add / view / change document technique matériel /id = id mate //
        
        function btnDocTechMat(id) {

            $('.btnAddDoc, .btnViewDoc').remove();

            $.ajax({
                url: '?p=documents.docCM',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                        

                    if ( reponse.length == 0) {

                        $('span[id=btnCTM]').after('<button class="btn btn-success btn-xs btnAddDoc" data-role="addfile" data-b="DCM" disabled><span class="fa fa-plus"></span></button>');

                    } else {
                        let id_doc = reponse[0].id;
                        let docmat = reponse[0].doc_mat;
                        let doc = docmat.split('/');

                        $('span[id=btnCTM]').after(`<a href="`+docmat+`" target="_blank" class="btn btn-warning btn-xs btnViewDoc" <abbr title="Voir Document"><i class="fa fa-eye"></i></a> `+ 
                            `<button class="btn btn-info btn-xs btnAddDoc" data-role="uploadfile" data-b="DCM" data-doc="`+doc[4]+`" data-id_doc="`+id_doc+`" disabled <abbr title="Changer de document"> <span class="fa fa-refresh"></span></button>`);
                        
                    } 

                    if (typeU == "administrateur") {

                        $('.btnAddDoc').attr('disabled', false);
                    }                                                         
                                        
                }
                  
            });            

        }

        // function qui verifie si le matériel a zero pannes avec le statut "En Panne" / NP_CREER//
        
        function checkstatut() {

            $.ajax({
                url: '?p=materials.checkedstatut',
                method: 'POST',
                success: function(reponse) {

                    if (reponse.length == 0) {

                    } else {
                        
                        for (var i = reponse.length - 1; i >= 0; i--) {

                            if (reponse[i].nbrpa == 0) {

                                $("#info_user")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable')
                                .html("Le statut du matériel(s) à bien était modifié !!!");
                            
                                recupclassdiv('info_user', 5000); 
                            }
                            
                        }                         

                    }                                                                            
                                        
                }
                  
            }); 
        }    

        // donne le dernier numero d'inventaire deb=début produit / pour add matériel //

        function AttNumInvent(deb,id){

            $('#numInvent').html('');                    

            $.ajax({
                url: '?p=materials.findnuminvent',
                data: {deb:deb},                 
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    var numinv = reponse.length;

                    if (numinv === 0) {                        

                        var num = 1;

                        var aff = deb + num;

                    } else {

                        if (numinv != '0') {
                        
                            var Num = Number(numinv)+1;

                            var aff = deb + Num;                            

                        } 
                    }
                    
                    $('#numInvent').html(aff); // affiche le num invent généré //
                    $('#NumInvent').val(aff); // ecris dans input hidden form //
                }
            });        

        }        

        // remonte le statut du matériel selectionner // id mat / index = P primaire - S selectionner //

        function affStatutMate(id, index){

            $.post('?p=materials.affStatut',

                {
                    id:id
                }, function(data) { 

                let vari;
                    
                if (index == 'P') {
                    vari = '.colorstatutP'; 
                } else {
                    vari = '.colorstatut';
                }
                  
                if (data[0].statut == 'Actif') {                    

                    $(vari).html(data[0].statut).attr('style','color: green;');

                } else {                    

                    $(vari).html(data[0].statut).attr('style','color: red;');
                }                

            });

        }

        // remonte les données du matériel selectionner /id = id mat //
        
        function affdatamateselect(id) {
            
            $.ajax({
                url: '?p=materials.affMateSelect',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    var caract, nacell, prop, familyId, btneditmat;

                    var mat_category = reponse[0].mat_category;

                    if (mat_category == "E") {

                        btneditmat = "EditMaterialLier";
                    } else {
                        btneditmat ="EditMaterial";
                    }
                    
                    $("#CateProduit").val(mat_category);
                    familyId = reponse[0].family_id;
                    $("#Family").val(familyId);                    
                    
                    $('#num_invent').html('<span style="text-decoration: underline;">Matériel - ' + reponse[0].num_inventaire + '</span><input type="hidden" name="invent" value='+ reponse[0].num_inventaire +'> <button class="btn btn-primary btn-xs btnEdit" data-role="'+btneditmat+'" data-id="'+ id +'" disabled=""><span class="fa fa-pencil"></span></button>');
                    $('#mate').html(reponse[0].mate);
                    $('#numserie').html('<p>Numéro série: ' + reponse[0].num_serie + ' - Statut: <strong class="colorstatut h4" id="statut"></strong></p>');                    
                    affStatutMate(id, 'S');                    
                    $('#datefab').html(reponse[0].datefabfr);
                    $('#dateinst').html(reponse[0].dateinstallfr);                                                     
                    $('#armdisj').html(reponse[0].armdisj);                    

                    if (reponse[0].poids_charge && reponse[0].fluide) {

                        caract = "Poids en charge:"+ reponse[0].poids_charge + "Kgrs - Fluide:" + reponse[0].fluide;
                    }

                    // verifie la catégory //
                    if (mat_category === 'P') { // MAT PRIMARY //

                        $('.AffMatP, #Za, #Pi').prop('hidden', true); // efface le champ Za Zi Pi et class //
                        $('li[role=presentation3]').attr('class', 'display'); // affiche l'onglet mat lier //

                        if (reponse[0].lieux_install == null) {

                            $('#Nli').prop('hidden', false); // affiche  niveau lieux installé //
                            $('#nli').html(reponse[0].niveau + ' - ' + reponse[0].lieux);

                            $('#Pi').prop('hidden', false); // affiche Piéce //

                        } else { // lieux_install existe //                            

                            if (reponse[0].lieux_install == "RDC - Intérieur") {

                                $('#Za').prop('hidden', true); // efface zone alimenté                                

                            } else { // lieux install différent de RDC - Interieur // 

                                $('#Za').prop('hidden', false); // affiche zone alimenté
                                $('#za').html(reponse[0].niveau +' - '+ reponse[0].lieux); // zone alimenté //
                            } 

                            $('#Nli').prop('hidden', false); // affiche  niveau lieux installé //
                            $('#nli').html(reponse[0].lieux_install);                           

                            if (reponse[0].piece != null) {
                                $('#Pi').prop('hidden', false); // affiche // 
                            } else {
                                $('#Pi').prop('hidden', true); // efface //
                            }

                        }                        

                    } else if (mat_category === 'S') { // MAT SEUL //

                        $('li[role=presentation3]').attr('class', 'hidden'); // efface l'onglet mat lier
                        $('#Za').prop('hidden', true); // efface la div Zone Alimenté //

                        if (reponse[0].lieux_install != null) { // si lieux_install existe //
                            $('#Nli').prop('hidden', false); // affiche la class //
                            $('#nli').html(reponse[0].lieux_install);
                        } else {
                            $('#Nli').prop('hidden', false); // affiche la class //
                            $('#nli').html(reponse[0].niveau + ' - ' + reponse[0].lieux);
                        }

                        if (reponse[0].pieces_id == null) {
                            $('#Pi').prop('hidden', true); // efface la class //
                        } else {
                            //$('#Nli').prop('hidden', true); // efface la class //
                            $('#Nli, #Pi').prop('hidden', false); // affiche la class //
                        }

                        $('.AffMatP').prop('hidden', true); // efface la class //
                        
                        caract = reponse[0].caract;

                    } else if (mat_category === 'E'){ // MAT ENFANT //

                        $("#IDmatep").val(reponse[0].lier_id);
                        affdatamateprimaire(reponse[0].lier_id);

                        $('#Za').prop('hidden', true); // efface les champs Za //
                        $('#nli').html(reponse[0].niveau + ' - ' + reponse[0].lieux); 
                        $('.AffMatP').removeClass('hidden').addClass('display');
                        $('#Pi').prop('hidden', false); // affiche le champ Pi               
                        $('li[role=presentation3]').attr('class', 'hidden'); // efface l'onglet mat lier
                        caract = reponse[0].caract;                      

                    } else if (mat_category === 'SN') { // matériel volets (naccelle) //

                        $('#Za').prop('hidden', true); // efface les champs Za //
                        $('#nli').html(reponse[0].niveau + ' - ' + reponse[0].lieux);            
                        $('li[role=presentation3]').attr('class', 'hidden'); // efface l'onglet mat lier

                        if (reponse[0].nacelle == 1) {

                            if (caract = " ") {
                                nacell = "Besoin nacelle";
                            } else {
                                nacell = " - Besoin nacelle";    
                            }
                            
                        } else {

                            if (caract = " ") {
                                nacell = "Pas Besoin nacelle";
                            } else {
                                nacell = " - Pas besoin de nacelle";
                            }
                        }

                        // propriété //
                        if (reponse[0].prop == 0) { // le matériel appartient a la clinique  //
                            prop = " - Propriétaire Clinique";
                        } else { // sinon il appartient au cabinet //
                            prop = " - Propriétaire Cabinet";
                        }                        

                        caract = ('<h4>' + nacell + prop + '</h4>');

                    }

                    $('#Propi').val(reponse[0].prop);

                    btnDocTechMat(id);                    

                    // desactive ou active le btn edit dans panne mate //
                    if(reponse[0].statut == "Rebus" || typeU != "administrateur") {
                        $('.btnEdit').prop('disabled', true);
                    } else {
                        $('.btnEdit, .btnAddDoc').prop('disabled', false);
                    }

                    $('#d').html(caract);                     
                    
                    $('#piece').html(reponse[0].piece);

                    // notes //
                    if (reponse[0].note) {                        

                        $('#Nte')
                        .removeClass('hidden')
                        .addClass('display')
                        .html('<h3><span style="text-decoration: underline;">Notes</span></h3><p>'+ reponse[0].note +'</p>');
                    }

                    // contrat //                   
                    
                    if (reponse[0].num_contrat) {

                        $('li[role=presentation4]').attr('class', 'display');
                        NbrIntervCM(id);
                        
                        if (reponse[0].lien_contrat != null) {

                            $('#contrat')
                            .removeClass('hidden')
                            .addClass('display')
                            .html('<h3><span style="text-decoration: underline;">N° Contrat</span></h3><a href="'+reponse[0].lien_contrat+'" target="_blank" >'+ reponse[0].num_contrat +'</a>');

                        } else {

                            $('#contrat')
                            .removeClass('hidden')
                            .addClass('display')
                            .html('<h3><span style="text-decoration: underline;">N° Contrat</span></h3><abbr title="Le document n\'existe pas !!!"><a target="_blank">'+ reponse[0].num_contrat +'</a></abbr>');                            
                             
                        }                        
                        
                    } else {

                        $('li[role=presentation4]').attr('class', 'hidden');
                    }
                    
                    affImgMate(id);// affiche l'image ou le bouton add Img / id mat //
                                        
                }
                  
            });
        }

        // function qui remonte les données du matériel Primaire lier au matériel enfant //

        function affdatamateprimaire(id) {

            $.ajax({
                url: '?p=materials.findMatePrimary',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    let id = reponse[0].id;
                    let numinv = reponse[0].num_inventaire;
                    let nums = reponse[0].num_serie;
                    let st = reponse[0].statut;                    

                    $('#num_inventP').html('<span style="text-decoration: underline;">Lier au Matériel - <a id="inventP" href="?p=pannes.mate&id='+id+'">'+ numinv +'</a></span>');
                    $('#Nums_St').html('Numéro série: '+nums+ ' - Statut: <strong class="colorstatutP h4">'+st+'</strong>');

                    affStatutMate(id, 'P');
                                        
                }
          
            });  

        }

    	// Add Matériels //
            
        $(document).on('click','button[data-role=AddMaterial]', function(){                      

            window.location.href ='?p=materials.addmat';            

        });

        // action si la page ADDMAT et visible //

        if($('.ADDMAT').is(':visible') == true){

            $('#operation').val(' '); // efface l'input hidden

            $('#numInvent, #Products, #Marques, #Models, #arm, #Levels, #Places').empty(); // vide les selects & numero inventaire

            ///$('#btnproduct, #btnmark, #btnmodel, #btntype, #btnlevel, #btnplace, #btnarm, #btngener').prop('disabled', true); // desactive les btn //

            $('#Types, #Num_serie, #DateFab, #DateInstall, #disj, #Note').val(''); // vide les inputs

            $('.CaractClim, .Affshowback .AffProp, .Nacelle, .AffStatut').removeClass('display').addClass('hidden'); // efface les class //           

            // charge les select  //
            load_SelectFamily();           

            load_SelectContract();                

            $('#DateFab').val("2008-02-01");
            $('#DateInstall').val("2008-08-01");

            $('.aca').html('Caractéristique Technique'); 

            $('#operation').val("Add");
        }                             	         

        // Edition Matériels //

        $(document).on('click','button[data-role=EditMaterial]', function(){

            var id = $(this).data('id');
            window.location.href ="?p=materials.editmat&id="+id;

        });

        // action si EDITMAT et visible //
                       
        if($('.EDITMAT').is(':visible') == true){

            $('#operation').val("Edit");// ecris dans input hidden //
            // efface les btn & les class
            $('.AffDataMate, #BtnHaut, .SBtnRadio, .AffProp, .Nacelle, .AffLieuxInstall, .AffMateNonLier, .AffMontantAchat').removeClass('display').addClass('hidden');                     

            var id = $('#id_mate').val(); //recupére la valeur de l'input hidden id mate            

            $.ajax({
                url: '?p=materials.findDataMate',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {
                    
                    $('.SAddMate').removeClass('hidden').addClass('display'); // affiche la class add mate
                    $('input[name=BTNRadio]').prop('required', false);                    
                                        
                    // num inventaire //                    
                    $('#numInvent').html(reponse[0].num_inventaire);

                    // num ancien INV //                    
                    $('#inventory').val(reponse[0].inventory);

                    // Family //
                    load_SelectFamily();
                    let familyId = reponse[0].family_id;
                    $('#family option[value="' + familyId +'"]').attr('selected', true);

                    // produit //
                    let product = reponse[0].produit; 
                    $('#Products').val(product);
                    $('#id_product').val(reponse[0].produits_id);                                       

                    // marque //
                    let IdProduct = reponse[0].produits_id;
                    load_SelectMark(IdProduct);                                                                                        
                    var MarckId = reponse[0].marques_id;
                    $('#Marques option[value="' + MarckId +'"]').attr('selected', true);                                        

                    // model //
                    load_SelectModel(MarckId,IdProduct);                    
                    var modelId = reponse[0].models_id;
                    $('#Models option[value="' + modelId +'"]').attr('selected', true);                    

                    // type //
                    var type = reponse[0].type;
                    if(type == null) {
                        $('#btntype').prop('disabled', false);
                    } else { 
                        $('#btntype').prop('disabled', true);
                    }

                    $('#Types').val(type);
                    var typeId = reponse[0].types_id;
                    $('#Types_Id').val(typeId);

                    // num serie //
                    var NumSerie = reponse[0].num_serie;
                    $('#Num_serie').val(NumSerie);                     

                    // Lieux Installer //
                    var LieuxInstal = reponse[0].lieux_install;

                    if (LieuxInstal != null ) {

                        $(".AffLieuxInstall").removeClass('hidden').addClass('display'); // affiche la class
                        load_PlaceInstalled();
                        $('#LieuxInst').prop('required', true); // met a required le select 
                        $('#LieuxInst option[value="' + LieuxInstal + '"]').attr('selected', true); 

                        if (LieuxInstal == "RDC - Intérieur") {
                            $('.za').html('Localisation:');
                            $('.Affshowback, .AffPlace, .AffPiece').removeClass('hidden').addClass('display'); 
                        }

                    } else {

                        $(".AffLieuxInstall").removeClass('display').addClass('hidden'); // efface la class
                        $('#LieuxInst').prop('required', false); // supprime le required

                        if (familyId == 6) {
                           $('.Affshowback, .AffPlace, .AffPiece').removeClass('hidden').addClass('display'); 
                        }
                    } 

                    // CATEGORIE //
                    var mat_category = reponse[0].mat_category;  
                    
                    if (mat_category == 'P') {// PRIMARY //

                        if (familyId == 1) {
                            $('.za').html('Zone Alimenté:');
                            $('.Affshowback, .AffPlace').removeClass('hidden').addClass('display'); 
                        } 
                                           
                    } else if (mat_category == 'SN') { // SEUL Avec ou sans NACELL //
                        $('.za').html('Localisation:');
                        $('.Affshowback, .AffProp, .AffPlace').removeClass('hidden').addClass('display');
                    } else {
                        $('.za').html('Localisation:');                        
                    }

                    // contrat //                    
                    load_SelectContract();

                    var contratId = reponse[0].contrat_id;                    

                    if (contratId != 0) {
                                       
                        $('#numcontrat option[value="'+ contratId +'"]').attr('selected', true);                                               
                        
                    }

                    // niveau / levels //
                    var LevelId = reponse[0].niveau_id;

                    if (LevelId != null) {
                        load_SelectLevel(); 
                        $('#Levels option[value="' + LevelId +'"]').attr('selected', true);
                    } else {

                        if ($('.AffLevels').is(':visible') == true) {
                            load_SelectLevel();
                            $('#Levels').attr('required', true); 
                        } else {
                            $('#Levels').attr('required', false);
                        }
                        
                    }                             
                    
                    // lieux / Places //
                    var placeId = reponse[0].lieux_id;

                    if (placeId != null) { 

                        load_SelectPlace(LevelId, "Places");
                        $('#Places option[value="' + placeId +'"]').attr('selected', true);                         

                    } else {

                        $('#Places').attr('required', false);
                    }                    

                    // pièce //
                    var roomId = reponse[0].pieces_id;

                    if (roomId != null) {

                        $('.AffPiece').removeClass('hidden').addClass('display');                    
                        load_SelectRoom(placeId);                        
                        $('#Rooms option[value="' + roomId +'"]').attr('selected', true);
                        $('select[id=Rooms]').prop('required', true);

                    } else {

                        $('select[id=Rooms]').prop('required', false);
                    }                   
                    
                    // nacelle //                    
                    if (LevelId == '1') { // si le niveau et RDC //

                        $('.Nacelle').removeClass('display').addClass('hidden'); // efface Nacelle //
                        $('#nacl').val('0'); // ecrit 0 dans input                        

                    } else if (reponse[0].nacelle == '1') {

                        $('.Nacelle').removeClass('hidden').addClass('display'); // affiche nacelle //

                        $('#chk').attr('checked', true); // coche le checkbox 
                        $('#nacl').val('1'); // ecrit 1 dans input

                    } else {

                        $('#nacl').val('0'); // ecrit 0 dans input
                    }

                    $('#chk').on('change', function(){

                        if ($('input[name=chk]').is(':checked') == true) {

                            $('#nacl').val('1'); // ecrit 1 dans input 
            
                        } else {
                            $('#nacl').val('0'); // ecrit 0 dans input    
                        }
                    });

                    // fin nacelle //
                    
                    // propriétaire //
                    if (reponse[0].prop == "1") {// 1 propriété cabinet //                        
                        
                        $('input[name=prop]').prop('checked', false);

                    } else { // 0 propriété clinique //

                        $('input[name=prop]').prop('checked', true);
                    }

                    // fin propriétaire //                                                                             

                    // dates fab & install //
                    if (reponse[0].date_fab == null || reponse[0].date_fab == "0000-00-00") {

                        $('#DateFab').val("2008-02-01");
                        $('#DateInstall').val("2008-08-01");

                    } else {

                        let datefab = reponse[0].date_fab;                    
                        $("#DateFab").attr('value',datefab); // affiche la date enregistrer

                        var dateinst = reponse[0].date_install;
                        $('#DateInstall').attr('value',dateinst);
                    }

                    //btn add fact Achat//
                    let idmate = reponse[0].id;
                    checkedDocFactachat(idmate); // id mate                    

                    // poids charge & fluide //
                    if (product == 'Climatisation') {  

                       $('.CaractClim').removeClass('hidden').addClass('display');
                       $('.Caract').attr('class', 'showback col-sm-6');
                       $('.aca').html('Autres Caractéristique:');
                       $('#Caract').attr('rows', 1); 
                       var PoidsCharge = reponse[0].poids_charge;
                       $('#poidscharge').val(PoidsCharge);
                       $('input[name=poidscharge]').prop('required', true); 
                       var Fluide = reponse[0].fluide;
                       $('#fluide').val(Fluide);
                       $('input[name=fluide]').prop('required', true);

                    } else {

                       $('.CaractClim').removeClass('display').addClass('hidden');
                       $('.Caract').attr('class', 'showback col-sm-12');
                       $('.aca').html('Caractéristique Technique:');
                       $('#Caract').attr('rows', 2); 
                       $('input[name=poidscharge]').prop('required', false); 
                       $('input[name=fluide]').prop('required', false); 
                    } 

                    // autres caractéristiques //                    
                    $('#Caract').val(reponse[0].caract);                   

                    // armoires //
                    load_SelectArmoire();
                    var armid = reponse[0].armid;                     
                    $('#arm option[value="' + armid + '"]').attr('selected', true);                    

                    // disjoncteur //
                    var disj = reponse[0].disjoncteur;
                    $('#disj').val(disj);                                                                                           

                    // notes //
                    var Note = reponse[0].note;
                    $('#Note').val(Note);

                    // statut //                    
                    var statut = reponse[0].statut;
                    
                    if (statut != 'HS') {
                        // efface le select et button //
                        $('.AffStatut').removeClass('display').addClass('hidden');
                    } else if (statut == 'HS') {
                        // affiche la section //
                        $('.AffStatut').removeClass('hidden').addClass('display');
                        // affiche le select et button //
                        $('#Statut').empty(); // vide le select
                        $("#Statut").append('<option value="'+ statut + '"> '+ statut + '</option>'); // ajoute une option au select
                        $("#Statut").append('<option value="Rebus">Rebus</option>'); // ajoute une option au select
                        $('#btnstatut').prop('disabled', false); // desactive le btn maj statut //

                        $('#btnstatut').on('click', function(){

                            $('#Statut').prop('disabled', false); // desactive le select statut
                        });
                    }

                    // ****************BTN precedent suivant *************//
                    var matepreced;
                    var matesuiv = Number(idmate) + 1;

                    if (idmate == 1) {
                        matepreced = 1;
                    } else {

                        matepreced = Number(idmate) - 1;
                    }

                    $('#preced').prop('href', '?p=materials.editmat&id='+ matepreced);
                    $('#suivan').prop('href', '?p=materials.editmat&id='+ matesuiv);

                }
                  
            });

        }

        // ajoute ou edit le matériel //
            
        $('#Material').validator().on('submit', function (event) {

            let op = $('#operation').val(); // récupére la valeur de op

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();

                if (op == 'Add') {                   

                    $.ajax({
                        url : '?p=materials.add', 
                        method : 'POST',
                        data : $('#Material').serialize(),
                        success : function(){

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-12')
                            .html("Le matériel à bien était ajouté !!!");

                            $('#AddMat').prop('disabled', true);

                            recupclassdiv('info_user', 3000);
                            setTimeout(function(){window.location.href ='?p=materials'}, 3000);       

                        }                   

                    });                                        
                    
                } else {                                          
                    
                    // mise a jour des données édition materiel //
                    $.ajax({
                        url : '?p=materials.edit', 
                        method : 'POST',
                        data : $('#Material').serialize(),
                        success : function(){                            

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-12')
                            .html("Le matériel à bien était modifié !!!");

                            recupclassdiv("info_user", 3000);                            
                                                        
                        }

                    });

                }

            }

        });            

        // redirection sur click vers page pannes matériel //
        
        $('.Mates').on('dblclick', 'tr', function (){

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9' }); // affiche le tr en gris //

            let rowtablemate = $(this).closest('tr');

            if (rowtablemate.prevObject[0].className != '') {                
                
                let id = parseInt(rowtablemate.find('td:eq(1)').text()); // recupére l'id du matériel //
                $(location).attr('href','?p=pannes.mate&id='+ id); // redirige vers la page //
            }                  

        });           
       
        // voir pdf du matériel all //
        
        $(document).on('click','button[data-role=ViewPdfMate]', function(){            

            window.open('?p=materials.viewPdf', '_blank');

        });
        
        // ajout d'image au matériel //
        
        $(document).on('click','button[data-role=addimgMat]', function(){
            let id = $(this).data('idmodel'); // récupére id model
            let model = $(this).data('model'); // récupére le nom du model 
            $('#addimgmodel').modal('show'); // ouvre la modal //
            $('.titremodel').html("Ajout une image au Model: " + model); // ecris le title //

            $('#IDModel').val(id); // ecris dans l'input hidden //
            let idmate = $('#IDmate').val(); // recupére l'id mate //

            // verifie si l'image ne depasse pas 1M //
            $('#fileIMGMODEL').on('change', function(){

                var image = document.getElementById("fileIMGMODEL");
                if (typeof (image.files) != "undefined") {
                    var size = parseFloat(image.files[0].size / (1024 * 1024)).toFixed(2);
                     
                    if(size > 1) {
                        alert('Le poids de l\'image ne doit pas dépasser 1 MB');
                        $('#btnIMG').attr('disabled', true);            
                    } else {
                        $('#btnIMG').attr('disabled', false); 
                    }
                } else {
                    alert("This browser does not support HTML5.");
                }
            });

            $('#ADDIMGMODEL').validator().on('submit', function (event) {

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault()

                    var form = $('#ADDIMGMODEL')[0];
                    var data = new FormData(form);                                                                                                                                                                              

                    $.ajax({
                        url : '?p=materials.addImgModel',
                        method : 'POST',
                        enctype : 'multipart/form-data',
                        data : new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success : function(data){                                                                                                      
                                
                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("L'image du model à bien était ajouté !!!");
                            
                            recupclassdiv('info_user', 7000, 'addimgmodel');                            

                            $('#addimgmodel').modal('hide'); // ferme la modal //

                            $('.AffImgMat').html('');

                            affImgMate(idmate); 

                        }                    

                    });
                }

            });
            
        });

    // MATERIAL LIER //
            
        if($('.AffMatesLierAll').is(':visible') == true){                        

            $('a.item-M').attr('class', 'active') // rend actif le onglet menu //
            $('ul.item-m').attr('style', 'display:block;') // maintient le sub menu ouvert
            $('li.item-lml').attr('class', 'active') // affiche en vert le lien cliqué        
              
            // AFF Materials lier ALL //              
            
            var TableMateLier = $('#TableMateLier').DataTable({

                language: {url: "../public/media/French.json"},
                lengthMenu: [10, 15, 25, 50],
                scrollY: '50vh',
                scrollX: true,
                scollCollapse: true,
                paging: true,
                ajax: {
                    url:'?p=materials.lierall',
                    type: "POST"
                    },
                    columns: [
                        { data: "id"},                    
                        { data: "num_inventaire" },
                        { data: "produit" },
                        { data: "marque" },                    
                        { data: "model" },
                        { data: "type" },
                        { data: "num_serie" },
                        { data: "niveau" },
                        { data: "piece"},
                        { data: "statut",
                            render: function(data, type) {

                                if (type === 'display') {
                                    
                                    if (data === 'En Panne' || data === 'En Attente' || data === 'HS') {
    
                                        return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>';
    
                                    } else if (data === 'Intervention En Cours') {
    
                                        return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>';                                
    
                                    } else {
    
                                        return '<a class="btn-success btn-xs btn-round" disabled>'+ data +'</a>';
                                    }                               
                                }                          
                                    return data;
                            }
                        },
                        { data: "mtr",
                              render: function(data, type, row) {
                                
                                if (row.mfr == null && row.mfi == null) {
                                    return mtr = '0.00 €';
                                } else {
                                    mfr = Number(row.mfr);
                                    mfi = Number(row.mfi);
                                    mtr = mfr + mfi;
                                    return mtr.toFixed(2) +' €';
                                }                               
                            }
                        },
                        { data: "nbrtotalpanne" },
                        { render : function(data, type, row) {
                            
                                if (typeU == "administrateur") {

                                    if(row.nbrtotalpanne == 0) {

                                        return '<button class="btn btn-primary btn-xs" data-role="EditMaterialLier" data-id="' + row.id + '"<abbr title="Edition matériel"><span class="glyphicon  glyphicon-pencil"></span></abbr></button> '+                    
                                        '<a class="btn btn-default btn-xs disabled">PDF</a> '+                    
                                        '<button type="submit" class="btn btn-danger btn-xs" data-role="ScrapMate" data-p="ML"<abbr title="Supprimé le matériel"><span class="glyphicon glyphicon-trash"></span></abbr></button>'

                                    } else {

                                        return '<button class="btn btn-primary btn-xs" data-role="EditMaterialLier" data-id="' + row.id + '"<abbr title="Edition matériel"><span class="glyphicon  glyphicon-pencil"></span></abbr></button> '+                    
                                        '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.viewMateSelectPdf&id=' + row.id + '"<abbr title="voir le PDF"></abbr>PDF</a> '+                    
                                        '<button type="submit" class="btn btn-danger btn-xs" data-role="ScrapMate" data-p="ML"<abbr title="Supprimé le matériel"><span class="glyphicon glyphicon-trash"></span></abbr></button>'
                                    }                                    

                                } else {

                                if(row.nbrtotalpanne == 0) {

                                    return '<a class="btn btn-default btn-xs disabled">PDF</a>'

                                } else {

                                    return '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.viewMateSelectPdf&id=' + row.id + '"<abbr title="voir le PDF"></abbr>PDF</a>'
                                }

                                    
                                }
                            }
                        }
                    ] 
            });

        }        
        
        // AFF Materiels lier  / id mate //
        function AffMateLier(id) {
            
            // affiche la div de la table matériel lier //
            $('.AffMatesLier').removeClass('hidden').addClass('display');

            // affiche la table materiel lier avec id matériel//
            $.ajax({
                url: '?p=materials.affMateLier',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success:function(data){

                    // reinitialise la table //
                    if ($.fn.dataTable.isDataTable('#TableMateLier')) {

                        $('#TableMateLier').DataTable().destroy();
                    }

                    let TableMateLier = $('#TableMateLier').DataTable({               
                        language: {url: "../public/media/French.json"},
                        lengthMenu: [10, 15, 25, 50],
                        scrollX: true,            
                        processing: true,
                        scollCollapse: true,
                        data: data,
                        columns: [                                                
                            { data: "id" },
                            { data: "num_inventaire" },
                            { data: "produit" },
                            { data: "marque" },
                            { data: "model" },
                            { data: "type" },
                            { data: "num_serie" },
                            { data: "niveau" },
                            { data: "piece"},
                            { data: "statut",
                                render: function(data, type) {

                                    if (type === 'display') {
                                        let color = 'green';
                                        if (data === 'En Panne') {
                                            color = 'red';
                                        }                            
            
                                        return '<span style="color:' + color + '">' + data + '</span>';
                                    }                           
                                        return data;
                                }
                            },
                            { data: "mtr",
                                render: function(data, type, row) {
                                    
                                   if (row.mfr == null && row.mfi == null) {
                                        return mtr = '0.00 €';
                                    } else {
                                        mfr = Number(row.mfr);
                                        mfi = Number(row.mfi);
                                        mtr = mfr + mfi;
                                        return mtr.toFixed(2) +' €';
                                    }                                
                                }
                            },
                            { data: "nbrtotalpanne" },
                            { render : function(data, row, id) {
                                
                                if (typeU == "administrateur") {

                                    if (id.statut == 'HS') {

                                        return '<button class="btn btn-primary btn-xs" data-role="EditMaterialLier" data-id="' + id.id + '"<abbr title="Edition matériel"><span class="glyphicon  glyphicon-pencil"></span></abbr></button> '+                    
                                        '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.mateLierSelectPdf&id=' + id.id + '"<abbr title="PDF"></abbr>PDF</a> '+                    
                                        '<button type="submit" class="btn btn-danger btn-xs" disabled><span class="glyphicon glyphicon-trash"></span></button>'

                                    } else if (id.statut == 'Rebus') {

                                         return '<button class="btn btn-primary btn-xs" disabled><span class="glyphicon  glyphicon-pencil"></span></button> '+                    
                                        '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.mateLierSelectPdf&id=' + id.id + '"<abbr title="PDF"></abbr>PDF</a> '+                    
                                        '<button type="submit" class="btn btn-danger btn-xs" data-role="ScrapMate" data-p="ML"<abbr title="Supprimé le matériel"><span class="glyphicon glyphicon-trash"></span></abbr></button>'

                                    }  else {

                                         return '<button class="btn btn-primary btn-xs" data-role="EditMaterialLier" data-id="' + id.id + '"<abbr title="Edition matériel"><span class="glyphicon  glyphicon-pencil"></span></abbr></button> '+                    
                                        '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.mateLierSelectPdf&id=' + id.id + '"<abbr title="PDF"></abbr>PDF</a> '+                    
                                        '<button type="submit" class="btn btn-danger btn-xs" data-role="ScrapMate" data-p="ML"<abbr title="Supprimé le matériel"><span class="glyphicon glyphicon-trash"></span></abbr></button>'

                                    }                                   

                                } else {

                                    return '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.mateLierSelectPdf&id=' + id.id + '"<abbr title="PDF"></abbr>PDF</a> '
                                }                               

                            }}                  
                        
                        ]                                                           
                    });               

                }
            });            
           
        }         

        // AFF Materiels secondaire Non lier  //
        function AffMateNonLier() {

            var matches = [];
            
            // affiche la section de la table matériel non lier admin//
            $('.AffMateNonLier').removeClass('hidden').addClass('display')                       

            // affiche la table materiel non lier //
            $.ajax({
                url: '?p=materials.affMateNonlier',
                method: 'POST',
                dataType: 'json',
                success:function(data){

                    // reinitialise la table //
                    if ($.fn.dataTable.isDataTable('#TableMateNonLier')) {

                        $('#TableMateNonLier').DataTable().destroy();

                    }                                        

                    var TableMateNonLier = $('#TableMateNonLier').DataTable({               
                        language: {url: "../public/media/French.json"},            
                        processing: true,
                        paging: false,
                        select: true,
                        data: data,
                        columns: [

                            {
                              'targets': 0,
                              'searchable': false,
                              'orderable': false,
                              'className': 'dt-body-center',
                              'render': function (data, type, full, meta){
                                return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';}
                            },                            
                            { data: "id"},                    
                            { data: "num_inventaire" },
                            { data: "produit" },
                            { data: "marque" },                    
                            { data: "model" },
                            { data: "type" },
                            { data: "num_serie" },
                            { data: "statut" }                 
                        ]                                                             
                    });

                    // afficher les bouton de validation //
                    $('.affbtns').removeClass('hidden').addClass('display')

                    // Handle click on "Select all" control
                    $('#check-select-all').on('click', function(){

                      // Get all rows with search applied
                      var rows = TableMateNonLier.rows({ 'search': 'applied' }).nodes();
                      // Check/uncheck checkboxes for all rows in the table
                      $('input[type="checkbox"]', rows).prop('checked', this.checked);

                    });            
                       
                    // Handle click on checkbox to set state of "Select all" control
                    $('#TableMateNonLier tbody').on('change', 'input[type="checkbox"]', function(){
                        
                        // If checkbox is not checked
                        if(!this.checked){
                             var el = $('#check-select-all').get(0);
                             // If "Select all" control is checked and has 'indeterminate' property
                             if(el && el.checked && ('indeterminate' in el)){
                                // Set visual state of "Select all" control
                                // as 'indeterminate'
                                el.indeterminate = true;
                            }
                        }
                    });

                    $('#TableMateNonLier tbody').on('change', function(){                        
                        matches.length = 0
                        $("input:checkbox:checked").each(function () {
                            var rowtable = $(this).closest('tr');
                            var id = parseInt(rowtable.find('td:eq(1)').text());
                            matches.push(id);
                        });

                        $('#multiselect').val(matches)

                    });
                    
                }
            });
        }

        // function qui remonte le nombre de matériel lier //
        function NbrMateLier(id){

            let nbr

            $.ajax({
                url: '?p=materials.nbrMateLier',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                
                    
                    if (reponse == false ) {                   
                        
                        nbr = 0

                    } else {                   
                        
                        nbr = reponse[0].nbrmate

                    }                    

                    // affiche le nbr de matériel lier //                    
                    $('li[role=presentation3]').html('<a href="#" data-role="VMatLier">Matériels lier ('+ nbr +')</a>')
                }
                
            });             
        } 

        // function qui enable ou disabled le BTN add Mat lier //
        
        function btnAddMatLier(statut){

            if (statut == "Rebus") {

                $('#btnAddMatLier').prop('disabled', true).attr('title', 'Matériel au Rebus !!!');
            }
        }  

        // dissocie le matériel lier du matériel a supprimé //
        
        $(document).on('click', 'button[data-role=disomate]', function() {

            let id = $(this).data('id')
            let tab = $(this).data('tab')
            let nbr = $(this).data('nbr')
            
            $.post('?p=materials.disomate',

              {
                  tab:tab, nbr:nbr 

              }, function(data) {

                recupclassdiv('info_user', 7000); // efface la notification

                $("#info_user")
                .removeClass('hidden')
                .addClass('alert alert-success success-dismissable col-lg-12')
                .html("Le matériel lier à bien était dissocier !!!");

                recupclassdiv('info_user', 7000); // efface la notification

                $("#info_user")
                .removeClass('hidden')
                .addClass('alert alert-info info-dismissable col-lg-12')
                .html('Pour mettre ce matériel au rebus !!!. cliqué sur le bouton <button data-role="scrap" data-table="Mate" data-id="'+ id +'">click</button>');
            });

        })

        // dissocie le matériel secondaire du matériel primaire //
        
        $(document).on('click', 'button[data-role=disomateprim]', function() {

            let id = $(this).data('id') // id matelier
            let idprim = $(this).data('idprim') // id mate primaire 

            $.post('?p=materials.disomateprim',

              {
                  id:id 

              }, function(data) {

                recupclassdiv('info_matelier', 7000) // efface la notification

                $("#info_matelier").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-12').html("Le matériel lier à bien était dissocier !!!")

                recupclassdiv('info_matelier', 7000) // efface la notification

                $("#info_matelier").removeClass('hidden').addClass('alert alert-info info-dismissable col-lg-12').html('Pour mettre ce matériel au rebus !!!. cliqué sur le bouton <button data-role="scrap" data-table="MateLier" data-idprim="'+idprim+'" data-id="'+ id +'">click</button>')
                
            });

        });        
        
        // verifie si le matériel a un matériel lier //
        
        $(document).on('click', 'a[data-role=VMatLier]', function() {
            
            $('li[role=presentation1]').attr('class', 'display');
            $('li[role=presentation2]').attr('class', 'display');
            $('li[role=presentation3]').attr('class', 'active');

            if ($('#contrat').prop('class') != "display") {
                $('li[role=presentation4]').attr('class', 'hidden');
            } else {
                $('li[role=presentation4]').attr('class', 'display');  
            }

            $('.AffPannes, .AffDataPanne, .AffMontant').removeClass('display').addClass('hidden');
            $('.AffMatesLier').removeClass('hidden').addClass('display');

            let id = $('#IDmate').val(); // id matériel

            if (typeU == "administrateur") {

                let fam = $('#Family').val();

                $('#btnAddMatLier').show(); // affiche le btn add mate lier //

            } else {

                $('#btnAddMatLier').hide(); // efface le btn add mate lier //
            
            }

            $('.ViewPdf').show(); // affiche le btn

            AffMateLier(id);

            // affiche la div BtnHaut //
            $('#BtnHaut').removeClass('hidden').addClass('display');                        

        });

        // Add Matériels Lier//
            
        $(document).on('click','button[data-role=AddMaterialLier]', function() {

            let id = $(this).data('id'); // récupére l'id dans le btn //                                                                  

            window.location.href ='?p=materials.addmatlier&id=' + id       

        });         

        // action si la page ADDMATLIER et visible //

        if($('.ADDMATLIER').is(':visible') == true){

            $('#btnmark, #btnmodel, #btntype, #btnlevel, #btnplace, #btnarm').prop('disabled', true); // desactive les btn

            $('#Types, #Num_serie, #DateFab, #DateInstall, #disj, #Note').val(''); // vide les inputs  

            $('.affbtns, #Success_Error, .SAddMate, .AffMateNonLier, .AffStatut').removeClass('display').addClass('hidden'); // efface les class //          

            // fait recherche si du matériel secondaire n'est pas lier //
            
            $.ajax({
                url: '?p=materials.findMateSecond',
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    let op; 

                    if (!reponse.length == 0) {

                        $('.SAddMate, .AffStatut').removeClass('display').addClass('hidden'); // efface ajout matériel
                        $('.SBtnRadio').removeClass('hidden').addClass('display'); // affiche les btn Radio                        
                        $('input:radio[name="BTNRadio"]').prop('checked', false); //  met a false les btn radio

                        $('input:radio[name="BTNRadio"]').change(function(){           

                            if ($(this).is(':checked') && $(this).val() == '1') {
                                
                                // materiel existant //
                                
                                $('.SAddMate').removeClass('display').addClass('hidden'); // efface ajout matériel 
                                $('.ctrl,.ctrl1').prop('required', false); // supprime les required des input

                                // afficher un tableau avec select pour lier le matériel //
                                AffMateNonLier(); // matériel Enfant non lier //

                                op = "AddMulti";
                                $('#operation').val(op);                           

                            } else { // BTNRadio 'non' checked //

                                // efface le tableau materiel non lier //
                                $('.AffMateNonLier, .SBtnRadio, .affbtns').removeClass('display').addClass('hidden');
                                $('input[type=radio]').prop('required', false);                            
                                $('.ctrl').prop('required', true); // mise a true de l'attribut required des input .ctrl
                                $('.SAddMate').removeClass('hidden').addClass('display'); // affiche la class SAddMate
                                $('#DateFab').val("2008-02-01");
                                $('#DateInstall').val("2008-08-01");

                                load_SelectProduct(0, 0); // charge le select produits //
                            }                            
                            
                        }) 
                         
                    } else {

                        // si il n'y a aucun matériel lier ont passe a l'ajout //
                        // materiel n'existe pas //
                        
                        //$('.AffMateNonLier').removeClass('display').addClass('hidden') // efface le tableau materiel non lier //

                        $('input[type=radio]').prop('required', false);                            
                        $('.ctrl').prop('required', true); // mise a true de l'attribut required des input .ctrl                        
                        $('.ctrl1').prop('required', false); // mise a false de l'attribut required des input .ctrl1 (class CaractClim hidden)//
                        $('.SAddMate').removeClass('hidden').addClass('display'); // affiche la class SAddMate
                        $('#DateFab').val("2008-02-01");
                        $('#DateInstall').val("2008-08-01");

                        load_SelectProduct(0, 0); // charge le select produits //

                        op = "AddLier";
                        $('#operation').val(op); // ecris dans l'input hidden                       
                          
                    }
                    
                }

            });            

        }

        // Edition Matériels Lier //

        $(document).on('click','button[data-role=EditMaterialLier]', function(){

            let id = $(this).data('id');

            window.location.href ='?p=materials.editmatlier&id='+id;
        });        

        // action si EDITMATLIER et visible //
                       
        if($('.EDITMATLIER').is(':visible') == true){

            $('#operation').val("Edit");
            // efface les btn & les class
            $('.AffDataMate, #BtnHaut, .SBtnRadio, .AffMateNonLier, .AffMontantAchat').removeClass('display').addClass('hidden'); // efface les class //                    

            let id = $('#id_mate').val(); //recupére la valeur de l'input hidden id mate

            $.ajax({
                url: '?p=materials.findDataMate',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {
                    
                    $('.SAddMate').removeClass('hidden').addClass('display'); // affiche la class add mate
                    $('input[name=BTNRadio]').prop('required', false);
                    $('#Marques, #Models, #Levels, #Places option[value="0"]').attr('selected', false);
                                        
                    // num inventaire //                    
                    $('#numInvent').html('Numéro Inventaire: ' + reponse[0].num_inventaire);

                    // family //
                    load_SelectFamily();
                    let familyId = reponse[0].family_id;
                    $('#family option[value="' + familyId +'"]').attr('selected', true);

                    // produit //
                    let product = reponse[0].produit;
                    $('#Products').val(product);
                    $('#id_product').val(reponse[0].produits_id);                                       

                    // marque //
                    let IdProduct = reponse[0].produits_id;
                    load_SelectMark(IdProduct);                                                                                        
                    var MarckId = reponse[0].marques_id;
                    $('#Marques option[value="' + MarckId +'"]').attr('selected', true);                                        

                    // model //
                    load_SelectModel(MarckId,IdProduct);                    
                    var modelId = reponse[0].models_id;
                    $('#Models option[value="0"]').attr('selected', false);
                    $('#Models option[value="' + modelId +'"]').attr('selected', true);                    

                    // type //
                    var type = reponse[0].type;
                    if(type == null) {
                        $('#btntype').prop('disabled', false);
                    } else { 
                        $('#btntype').prop('disabled', true);
                    }

                    $('#Types').val(type);
                    var typeId = reponse[0].types_id;
                    $('#Types_Id').val(typeId);

                    // num serie //
                    var NumSerie = reponse[0].num_serie;
                    $('#Num_serie').val(NumSerie);                    

                    // niveau / Levels //
                    load_SelectLevel();                                                                                
                    var LevelId = reponse[0].niveau_id;
                    $('#Levels option[value="' + LevelId +'"]').attr('selected', true);

                    // lieux  //
                    load_SelectPlace(LevelId, "Places");                                        
                    var placeId = reponse[0].lieux_id;
                    $('#Places option[value="' + placeId +'"]').attr('selected', true);

                    // pièces / Rooms  //
                    if (reponse[0].pieces_id) {

                        $('.AffPiece').removeClass('hidden').addClass('display');                    
                        load_SelectRoom(placeId);
                        let roomId = reponse[0].pieces_id;
                        $('#Rooms option[value="' + roomId +'"]').attr('selected', true);
                        $('select[id=Rooms]').prop('required', true);

                    }                                                       

                    // dates fab & install //
                    if (reponse[0].date_fab == null || reponse[0].date_fab == "0000-00-00") {

                        $('#DateFab').val("2008-02-01");
                        $('#DateInstall').val("2008-08-01");

                    } else {

                        let datefab = reponse[0].date_fab;                    
                        $("#DateFab").attr('value',datefab); // affiche la date enregistrer

                        var dateinst = reponse[0].date_install;
                        $('#DateInstall').attr('value',dateinst);
                    }

                    //btn add fact Achat//
                    let idmate = reponse[0].id;
                    checkedDocFactachat(idmate); // id mate 

                    // poids charge & fluide //
                    if (product == 'Climatisation') {                        
                       $('.CaractClim').removeClass('hidden').addClass('display');
                       var PoidsCharge = reponse[0].poids_charge;
                       $('#poidscharge').val(PoidsCharge);
                       $('input[name=poidscharge]').prop('required', true); 
                       var Fluide = reponse[0].fluide;
                       $('#fluide').val(Fluide);
                       $('input[name=fluide]').prop('required', true); 
                    } else {
                       $('.CaractClim').removeClass('display').addClass('hidden'); 
                       $('input[name=poidscharge]').prop('required', false); 
                       $('input[name=fluide]').prop('required', false); 
                    }                     

                    // armoires //
                    load_SelectArmoire();
                    var armid = reponse[0].armid;                     
                    $('#arm option[value="' + armid + '"]').attr('selected', true);                    

                    // disjoncteur //
                    var disj = reponse[0].disjoncteur;
                    $('#disj').val(disj);

                    // autres caractéristiques //                    
                    $('#Caract').val(reponse[0].caract);                                                            

                    // notes //
                    var Note = reponse[0].note;
                    $('#Note').val(Note);

                    // statut //                    
                    var statut = reponse[0].statut;
                    
                    if (statut != 'HS') {
                        // efface le select et button //
                        $('.AffStatut').removeClass('display').addClass('hidden');
                    } else if (statut == 'HS') {
                        // affiche la section //
                        $('.AffStatut').removeClass('hidden').addClass('display');
                        // affiche le select et button //
                        $('#Statut').empty(); // vide le select
                        $("#Statut").append('<option value="'+ statut + '"> '+ statut + '</option>'); // ajoute une option au select
                        $("#Statut").append('<option value="Rebus">Rebus</option>'); // ajoute une option au select
                        $('#btnstatut').prop('disabled', false); // desactive le btn maj statut //

                        $('#btnstatut').on('click', function(){

                            $('#Statut').prop('disabled', false); // desactive le select statut
                        });
                    }

                    // ****************BTN precedent suivant *************//
                    var matepreced;
                    var matesuiv = Number(idmate) + 1;

                    if (idmate == 1) {
                        matepreced = 1;
                    } else {

                        matepreced = Number(idmate) - 1;
                    }

                    $('#preced').prop('href', '?p=materials.editmat&id='+ matepreced);
                    $('#suivan').prop('href', '?p=materials.editmat&id='+ matesuiv);


                }
                  
            }); 
        }

        // ajoute ou edit le matériel lier//
            
        $('#MaterialLier').validator().on('submit', function (event) {

            let op = $('#operation').val(); // récupére la valeur de op                                    

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();

                if (op == 'AddLier' || op == 'AddMulti') {                                   

                    $.ajax({
                        url : '?p=materials.add', 
                        method : 'POST',
                        data : $('#MaterialLier').serialize(),
                        success : function(reponse){
                            
                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-12').html("Le matériel à bien était ajouté !!!");
                            recupclassdiv("info_user", 5000);
                            setTimeout(function(){window.location.href ='?p=materialslier'}, 5000);       

                        }                   

                    });
                                        
                    
                } else {                    
                    
                    // mise a jour des données édition materiel
                    $.ajax({
                        url : '?p=materials.edit', 
                        method : 'POST',
                        data : $('#MaterialLier').serialize(),
                        success : function(response){
                            
                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-12').html("Le matériel à bien était modifié !!!");                                                       
                            recupclassdiv("info_user", 5000);
                            setTimeout(function(){window.location.href ='?p=materialslier'}, 5000);                            
                                                        
                        }

                    });

                }

            }

        });    
        
        // affiche les pannes par matériel lier selectionner //
        
        $('#TableMateLier').on('dblclick', 'tr', function (){            
            
            // recupére l'id sur le tr table mate //
            let row = $(this).closest('tr');
            let id = parseInt(row.find('td:eq(0)').text()); // recupére l'id du matériel //

            $(location).attr('href','?p=pannes.mate&id='+ id);

        });        

        // voir tous les matériel lier au matériel primaire en pdf //
        
        $(document).on('click','a[data-role=ViewPdfMateLier]', function(){

            var id = $('#IDmate').val(); // id matériel

            window.open('?p=materials.mateLierPdf&id='+id, '_blank');

        });

    // MATERIALS TRASH //
    
        if($('.AffMatesRebus').is(':visible') == true){                                                                   

            $('a.item-M').attr('class', 'active') // rend actif le onglet menu //
            $('ul.item-m').attr('style', 'display:block;') // maintient le sub menu ouvert
            $('li.item-lmr').attr('class', 'active') // affiche en vert le lien cliqué 

        }        

        // AFF Materials Rebus //              
        
        var TableMateRebus = $('#TableMateRebus').DataTable({            
            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '50vh',
            scrollX: true,
            scollCollapse: true,
            paging: true,
            ajax: {
                url:'?p=materials.rebus',
                type: "POST",
                },
                columns: [

                    { data: "id"},                    
                    { data: "num_inventaire" },
                    { data: "inventory" },
                    { data: "produit" },
                    { data: "marque" },                    
                    { data: "model" },
                    { data: "type" },
                    { data: "num_serie" },
                    { data: "statut",
                       render: function(data, type) {

                        if (type === 'display') {
                            let color = 'green';
                            if (data === 'En Panne') {
                                color = 'red';
                            }                            
 
                            return '<span style="color:' + color + '">' + data + '</span>';
                        }                           
                            return data;
                       }
                    },
                    { data: "daterebusfr" },
                    { data: "mtr",
                        render: function(data, type, row) {
                            
                            if (row.mfr == null && row.mfi == null) {
                                return mtr = '0.00 €';
                            } else {
                                mfr = Number(row.mfr);
                                mfi = Number(row.mfi);
                                mtr = mfr + mfi;
                                return mtr.toFixed(2) +' €';
                            }                              
                        }
                    },
                    { data: "nbrtotalpanne" },
                    { render : function(data, type, row) {
                        
                            if (typeU == "administrateur") {

                            if(row.nbrtotalpanne == 0) {

                                return '<a class="btn btn-default btn-xs disabled"></abbr>PDF</a> '+                    
                                '<button type="submit" class="btn btn-danger btn-xs" id="'+row.id+'" data-role="DeleteMate"<abbr title="Supprimé le matériel"><span class="glyphicon glyphicon-trash"></span></abbr></button>'

                            } else {

                                return '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.viewMateSelectPdf&id=' + row.id + '"<abbr title="PDF"></abbr>PDF</a> '+                    
                                '<button type="submit" class="btn btn-danger btn-xs" id="'+row.id+'" data-role="DeleteMate"<abbr title="Supprimé le matériel"><span class="glyphicon glyphicon-trash"></span></abbr></button>'
                            }                                

                            } else {

                            if(row.nbrtotalpanne == 0) {

                                return '<a class="btn btn-default btn-xs disabled"></abbr>PDF</a>'

                            } else {

                                return '<a class="btn btn-default btn-xs" target="_blank" href="?p=materials.viewMateSelectPdf&id=' + row.id + '"<abbr title="PDF"></abbr>PDF</a>'

                            }

                            
                            }
                        }
                    }
                ] 
        });

        // affiche les pannes par matériel rebus selectionner //
        
        $('#TableMateRebus').on('dblclick', 'tr', function (){            
            
            // recupére l'id sur le tr table mate //
            let row = $(this).closest('tr');
            let id = parseInt(row.find('td:eq(0)').text()); // recupére l'id du matériel //            

            $(location).attr('href','?p=pannes.mate&id='+ id);

        });

        // voir pdf du matériel rebus //
        
        $(document).on('click','button[data-role=ViewPdfMateRebus]', function(){            

            window.open('?p=materials.viewPdfRebus', '_blank');

        });

    // MATERIALS DELETE //
     
        // effectue des verification sur le matériel avant mise au rebus //
        
        $(document).on('click','button[data-role=ScrapMate]', function(){

            let P = $(this).data('p');
            let rowtablemate, id, statut

            if (P == 'M') {

                rowtablemate = $(this).closest('tr');
                id = parseInt(rowtablemate.find('td:eq(0)').text());
                statut = rowtablemate.find('td:eq(8)').text();

            } else if(P == 'ML') {

                rowtablematelier = $(this).closest('tr');
                id = parseInt(rowtablematelier.find('td:eq(0)').text());
                statut = rowtablematelier.find('td:eq(9)').text();
            }                      

            if (statut == 'HS') {
               
                // verifie si le matériel a du matériel lier //
                
                $.post('?p=materials.checkedMateLier',

                  {id:id}, function(data) {                
                      
                    if (data == false ) {
                        
                        // mise au rebus du matériel //                            

                        $.post('?p=materials.scrap',

                            {id:id}, function(data) {

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-12')
                            .html("Le matériel à bien était mis au rebus !!!");

                            recupclassdiv('info_user', 7000);                                
                            TableMate.ajax.reload();                                 
                            
                        });                        

                    } else {

                        // récupére les data pour dissociation du matériel lier //
                        var tab = [];

                        for (var i = data.length - 1; i >= 0; i--) {                            
                            tab.push(data[i].id);                                                        
                        }

                        var nbr = data.length;                        
                        $("#info_user")
                        .removeClass('hidden')
                        .addClass('alert alert-info info-dismissable col-lg-12')
                        .html('Ce matériel à du matériel(s) lier. cliqué sur le bouton pour le dissocier <button data-role="disomate" data-id="'+ id +'" data-tab="'+ tab +'" data-nbr="'+ nbr +'">click</button>');      

                    }

                });                
                    
            } else if (statut == 'Rebus') {

                let IDmateP = $('#IDmate').val(); // récupére l'id du matériel primaire

                // disociation matériel lier //
                $.post('?p=materials.disomateprim',

                 {id:id}, function(data) {

                    $("#info_user")
                    .removeClass('hidden').addC
                    lass('alert alert-success success-dismissable col-lg-12')
                    .html("Le matériel à bien était disocié !!!");

                    recupclassdiv('info_user', 7000);
                    AffMateLier(IDmateP); // update table mate lier
                    NbrMateLier(IDmateP);

                });                
                    
            } else {

                // on ne peut pas éffacé //
                $("#info_user")
                .removeClass('hidden')
                .addClass('alert alert-danger success-dismissable col-lg-12')
                .html("Le matériel ne peut pas être supprimé il et toujours actif !!!");

                recupclassdiv('info_user', 7000);
            }

        });

        // mise au rebus du matériel //
        
        $(document).on('click', 'button[data-role=scrap]', function() {

            let id = $(this).data('id')
            let idprim = $(this).data('idprim')
            let table = $(this).data('table')
            let ancre           

            $.post('?p=materials.scrap',

                {id:id}, function(data) {                
                
                if (table == 'Mate') {

                    ancre = "info_user"
                } else {

                    ancre = "info_matelier"
                }
                
                ScrollAncre("#"+ancre+"")

                $("#"+ancre+"").removeClass('alert alert-info info-dismissable col-lg-12')
                .addClass('alert alert-info info-dismissable col-lg-12')
                .html("Le matériel à bien était mis au rebus !!!");

                recupclassdiv(ancre , 7000);

                if (table == 'Mate') {
                    // efface la div AffDataMate //
                    $('.AffDataMate').removeClass('display').addClass('hidden')
                    // modifie la hauteur de la table //
                    $('.dataTables_scrollBody').css('height','350px')
                    TableMate.ajax.reload()
                } else {
                   
                    AffMateLier(idprim)
                    NbrMateLier(idprim)
                }     
                
            });
        });
     
        // efface le matériel hors service // a voir si besoin //
        
        $(document).on('click','button[data-role=DeleteMate]', function(){

            let rowtablematerebus = $(this).closest('tr');
            let id = parseInt(rowtablematerebus.find('td:eq(0)').text());
            let statut = rowtablematerebus.find('td:eq(8)').text();

            if (statut == 'Rebus') {                

                // aucun matériel lier on peut effacé ou mettre à la corbeille
                $.post('?p=materials.delete',

                    {id : id}, function(data) { 

                    $("#info_user")
                    .removeClass('hidden')
                    .addClass('alert alert-success success-dismissable col-lg-12')
                    .html("Le matériel à bien était mis à la corbeille !!!");
                    recupclassdiv('info_user', 7000);      

                });                                   
                
            } else {

                // on ne peut pas éffacé;

                $("#info_user")
                .removeClass('hidden')
                .addClass('alert alert-danger success-dismissable col-lg-12')
                .html("Le matériel ne peut pas être supprimé il et toujours actif !!!");
                recupclassdiv('info_user', 7000);
            }

        });

        // efface le matériel hors service // a voir si besoin //
        
        $(document).on('click','button[data-role=DeleteMateLier]', function(){

            let rowtablematelier = $(this).closest('tr');
            let id = parseInt(rowtablematelier.find('td:eq(0)').text());
            let statut = rowtablematelier.find('td:eq(7)').text();            

            if (statut == 'HS') {                

                // on efface ou mettre à la corbeille
                $.post('?p=materials.delete',

                    {id : id}, function(data) {

                    $("#info_user")
                    .removeClass('hidden')
                    .addClass('alert alert-success success-dismissable col-lg-12')
                    .html("Le matériel à bien était mis à la corbeille !!!");
                    recupclassdiv('info_user', 7000);      

                });                               
                
            } else {

                // on ne peut pas éffacé;

                $("#info_user")
                .removeClass('hidden')
                .addClass('alert alert-danger success-dismissable col-lg-12')
                .html("Le matériel ne peut pas être supprimé il et toujours actif !!!");
                recupclassdiv('info_user', 7000);
            }

        });

    // FAMILLE / FAMILY //
    
        // function select famille // 

        function load_SelectFamily() {            

            $.ajax({
                url: '?p=materials.selectFamily',
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#family option').remove();

                    $("#family").append('<option value="0" selected disabled>Veuillez choisir une famille</option>'); // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {
                        
                        var id = reponse[i].id;
                        var family = reponse[i].famille;                            

                        $("#family").append('<option value="'+ id +'">'+ family +'</option>'); // remplis les données dans le select //

                    }                        
                    
                }
            }); 
        } 

        // ADD FAMILY //

        $(document).on('click','button[data-role=AddFamily]', function(){

            let family;

            $('#addfamily').modal('show'); //ouvre la modal add produit //            
            $("#affinfofamily").removeClass('display').addClass('hidden'); // efface le message //                       

            $('#familyadd').on('change', function(){                

                family = $('#familyadd').val(); // récupére la valeur de l'input 
                                 
                if (family == " ") {                   

                } else {                                             

                    $.ajax({
                        url : '?p=materials.checkedFamily',
                        method : 'POST',
                        data : { family: family},
                        dataType: 'json',
                        success : function(data){                                         

                            if (data == false ) {
                                // efface le message info //
                                $("#affinfofamily").removeClass('display').addClass('hidden');                                                                                                                                                            

                                // si la famille n'existe pas ont fait l'enregistrement //
                                $('#AddFamily').validator().on('submit', function (event) {

                                    if (event.isDefaultPrevented()) {

                                    } else {
                                    
                                        event.preventDefault();                                            
                                        
                                        $.ajax({
                                            url : '?p=materials.addFamily',
                                            method : 'POST',
                                            data : { family: family},
                                            cache: false,
                                            success : function(data){
                                               
                                                // affiche l'info dans la div de la modal //
                                                $("#affinfofamily")
                                                .removeClass('hidden')
                                                .addClass('alert alert-success success-dismissable')
                                                .html("La famille à bien était ajouté !!!");                                                             

                                                load_SelectFamily(); // charge select produit //                                                                                   

                                                $("#AddFamily")[0].reset(); // remise a zero du formulaire Ajout famille //                                                                                                 
                                                setTimeout(function(){$('#addfamily').modal('hide')},3000); // ferme la modal //
                                            }                    

                                        });
                                    }

                                });

                            } else {
                                
                                // msg d'erreur si la famille existe  //                               
                                $("#affinfofamily")
                                .removeClass('hidden')
                                .addClass('alert alert-danger danger-dismissable')
                                .html('La Famille exite déja !!!');

                                recupclassdiv('affinfofamily', 3000); // efface le message info famille
                                // remise a zero du formulaire Ajout Famille //
                                $("#AddFamily")[0].reset(); 
                            }

                        }

                    });
                }

            });                      

        });

        // function change sur famille //
    
        $('#family').on('change', function() {

            if ($('.EDITMAT, .EDITMATLIER').is(':visible') == true) {

            } else {

                $('#numInvent, #Marques, #Models, select[name=Levels], #LieuxInst, #arm, #Places, #Rooms').empty(); // efface les select  //
                $('#Types, #Num_serie').val(" "); // efface les inputs //

                let fam = $('#family option:selected').val();
                load_SelectProduct(fam, 1);
                $('#btnproduct').prop('disabled', false); // desactive le disabled //
                $('#btnmark, #btnmodel, #btngener, #btnarm').prop('disabled', true); // active la propri disabled //

                if (fam != 1) {

                    $('.AffLieuxInstall, .Affshowback, .CaractClim').removeClass('display').addClass('hidden'); // efface //
                    $('.Caract').removeClass('col-sm-6').addClass('col-sm-12');
                    $('#Caract').attr('rows', 2); // hauteur du texarea // 
                }  
            }                    

        });         

    // PRODUCT / P=PARENT E=ENFANT S=SEUL SN = SEUL & NACELL //
        
        if ($('#TableProduct').is(':visible') == true) {             

            $('a.item-M').attr('class', 'active');
            $('ul.item-m').attr('style', 'display:block;');
            $('li.item-epmmt').attr('class', 'active');
        } 

        // function select product //
        
        function load_SelectProduct(fam, btn) {

            // btn = 1 --> matériel parent - seul - seul nacell / fam = famille / btn = 0 --> matériel lier //

            $.ajax({
                url: '?p=materials.selectProduct',
                data: {fam:fam, btn:btn},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#Products option').remove();

                    $("#Products").append('<option value="0" selected disabled>Veuillez choisir un produit</option>'); // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;
                        var products = reponse[i].produit;
                        var category = reponse[i].mat_category;                            

                        $("#Products").append('<option value="'+ id +'" data-cat="'+category+'">'+ products +'</option>'); // remplis les données dans le select //

                    }                        
                    
                }
            }); 
        }
    
        // affiche la table produits //
        
        var TableProduct = $('#TableProduct').DataTable({

            language: {url: "../public/media/French.json"},
            paging: false,
            ajax: {
                url:'?p=materials.viewProduct',
                type: "POST"
                },                
                columns: [
                    { data: "id" },
                    { data: "famille" },
                    { data: "produit" },
                    { data: "mat_category" },
                    { render : function(data) { 

                            if (typeU == "administrateur") {

                                return `<button class='btn btn-primary btn-xs' data-role='editproduct'<abbr title='Edition Produit'><span class='glyphicon glyphicon-pencil'></span></abbr></button> ` + 
                                       `<button type='submit' class='btn btn-danger btn-xs btn_supM' data-role='deleteProduct'<abbr title='Supprimé le produit'><span class='glyphicon  glyphicon-trash'></span></abbr></button>`

                            } else {

                                return `<button class='btn btn-primary btn-xs' data-role='editproduct'<abbr title='Edition Produit'><span class='glyphicon glyphicon-pencil'></span></abbr></button> ` + 
                                       `<button type='submit' class='btn btn-danger btn-xs btn_supM' data-role='deleteProduct'<abbr title='Supprimé le produit' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>`
                            }

                        }

                    }
                ]            

        });

        // affiche la table marque en fonction du produit //
        
        $('#TableProduct').on('click','tr', function (){

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9' }); // affiche le tr en gris //
            
            // recupére l'id de la marque//            
            var rowtableproduct = $(this).closest('tr');
            var id = parseInt(rowtableproduct.find('td:eq(0)').text());

            $('#viewMark, #viewModel, #viewType, #viewCaract').addClass('hidden').removeClass('display');

            $('#IdProduct').val(id); // ecris la valeur dans l'input

            load_Mark(id); // id du produit        

        });           
     
        // function change sur produit //
    
        $('#Products').on('change', function() {

            let fam = $('#family option:selected').val();          

            let product = $('#Products option:selected').text();
            let deb = product.substr(0,4); // récupére les 4 premiéres lettre du produit 
            
            if (deb == "Vole") { deb = "Volet"; } 

            let cat = $('#Products option:selected').data('cat'); // récupére la valeur de la catégorie du matériel //
            $('#cat').val(cat); // ecris dans input hidden //

            $('.Affshowback, .CaractClim').removeClass('display').addClass('hidden');
            $('.Caract').removeClass('col-sm-6').addClass('col-sm-12');
            $('#Caract').attr('rows', 2); // hauteur du texarea // 

            $('#btnmark, #btnmodel, #btntype').prop('disabled', true); // desactive les bouttons add
            $('#numInvent, #Marques, #Models, select[name=Levels], #LieuxInst, #arm, #Places, #Rooms').empty(); // efface numero inventaire & les select // 
            $("input[id='Types']").val(''); // vide l'input //
            $('#Num_serie').val('').attr('disabled', true); // desactive l'input num série //                        

            if (cat == 'P') { // Matériel Parent //

                $('.Nacelle, .AffProp, .AffPiece').removeClass('display').addClass('hidden'); // efface le select nacelle & propriété & pièce //
                $('.ctrl1').prop('required', false); // mais a false le select piéce

                if (fam == 1) {
                    $('.za').html('Zone Alimenté:');
                    $('.CaractClim, .Affshowback, .AffLevels, .AffPlace, .AffLieuxInstall').removeClass('hidden').addClass('display'); // affiche les class //
                    $('.Caract').attr('class', 'showback Caract col-sm-6');
                    $('.aca').html('Autres Caractéristique:');
                    $('#Caract').attr('rows', 1); // hauteur du texarea //

                    $('.ctrl, .ctrl2, .ctrl3').prop('required', true); // mais a true le select //
                    $('#poidscharge, #fluide, #disj').val(''); // vide les inputs //
                } else if (fam == 6) {
                    $('.AffLieuxInstall').removeClass('display').addClass('hidden'); // efface
                    $('.Affshowback, .AffLevels, .AffPlace, .AffPiece').removeClass('hidden').addClass('display'); // affiche //
                    $('.ctrl, .ctrl1').prop('required', true); // mais a true les select //
                } else if (fam != 1) {

                    $('.AffLieuxInstall').removeClass('hidden').addClass('display'); // affiche les class //
                }               

            } else if (cat == 'SN') { // volet roulant //

                $('.za').html('Localisation:');
                $('.CaractClim, .AffLieuxInstall').removeClass('display').addClass('hidden'); // efface la class aff lieux installé & CaractClim //
                $('.ctrl1,.ctrl2, .ctrl3, .ctrl4').prop('required', false); // supprime le required sur certain inputs & select //
                $('.Affshowback, .AffLevels, .AffPlace, .AffPiece, .AffProp').removeClass('hidden').addClass('display'); // affiche place et piéce & le select propriété //
                $('.Caract').attr('class', 'showback Caract col-sm-12');
                $('.aca').html('Caractéristique Technique');
                $('#Caract').attr('rows', 2); // hauteur du texarea //

            } else if (cat == 'S') { // catégories SEUL //
                
                if (fam != 1) {
                    $('.za').html('Localisation:');
                    $('.CaractClim, .AffLevels, .AffPlace, .AffPiece, .Nacelle, .AffProp').removeClass('display').addClass('hidden'); // efface les class //
                    $('.ctrl, ctrl2').prop('required', false); // mais a false le select lieux
                    $('.Caract').attr('class', 'showback Caract col-sm-12');

                    if (fam == 6) {
                        $('.AffLieuxInstall').removeClass('display').addClass('hidden'); // efface
                        $('.Affshowback, .AffLevels, .AffPlace, .AffPiece').removeClass('hidden').addClass('display'); // affiche //
                        $('.ctrl, .ctrl1').prop('required', true); // mais a true les select //
                    } else {
                        $('.AffLieuxInstall').removeClass('hidden').addClass('display'); // affiche la class aff lieux installé//                        
                    }
                    
                    $('.aca').html('Caractéristique Technique');
                    $('#Caract').attr('rows', 2); // hauteur du texarea //
                } 
            }               

            AttNumInvent(deb);
            load_SelectMark(); // charge le select marque //               
            
        });                   
        
        // ADD PRODUCT //
    
        $(document).on('click','button[data-role=AddProduct]', function(){

            let btn,product;

            let familyId = $('#family option:selected').val();
            $('input[name=family]').val(familyId);

            btn = $(this).data('btn'); // récupére la valeur du data-btn 1 = primaire 0 = mat lier//
            $('#btn').val(btn);
            $('#addproduct').modal('show'); //ouvre la modal add produit //            
            $("#affinfoproduct").removeClass('display').addClass('hidden'); // efface le message //

            $('#productadd').on('change', function(){                

                product = $('#productadd').val(); // récupére la valeur de l'input 
                                 
                if (product == " ") {                   

                } else {                                             

                    $.ajax({
                        url : '?p=materials.checkedProduct',
                        method : 'POST',
                        data : { product: product},
                        dataType: 'json',
                        success : function(data){                                         

                            if (data == false ) {
                                // efface le message info //
                                $("#affinfoproduct").removeClass('display').addClass('hidden');                                                                                                                                                            

                                // si la marque n'existe pas ont fait l'enregistrement //
                                $('#AddProduct').validator().on('submit', function (event) {

                                    if (event.isDefaultPrevented()) {

                                    } else {
                                    
                                        event.preventDefault();                                            
                                        
                                        $.ajax({
                                            url : '?p=materials.addProduct',
                                            method : 'POST',
                                            data : $('#AddProduct').serialize(),
                                            cache: false,
                                            success : function(data){
                                               
                                                // affiche l'info dans la div de la modal //
                                                $("#affinfoproduct")
                                                .removeClass('hidden')
                                                .addClass('alert alert-success success-dismissable')
                                                .html("Le produit à bien était ajouté !!!");                                                

                                                $('#Products option').remove(); // efface les option dans le select modal add materiel                                                  

                                                load_SelectProduct('0', btn); // charge select produit //                                                                                   

                                                $("#AddProduct")[0].reset(); // remise a zero du formulaire Ajout Produit//                                                                                                 
                                                setTimeout(function(){$('#addproduct').modal('hide')},3000); // ferme la modal //
                                            }                    

                                        });
                                    }

                                });

                            } else {
                                
                                // msg d'erreur si le produit existe  //                               
                                $("#affinfoproduct")
                                .removeClass('hidden')
                                .addClass('alert alert-danger danger-dismissable')
                                .html('Le produit exite déja !!!');

                                recupclassdiv('affinfoproduct', 3000); // efface le message info product
                                // remise a zero du formulaire Ajout Produit//
                                $("#AddProduct")[0].reset(); 
                            }

                        }

                    });
                }

            });

            $('#parent').tooltip({'trigger':'focus', 'title': 'Cette catégorie de produit aura du matériels lier'});                        
            $('#seul').tooltip({'trigger':'focus', 'title': 'Cette catégorie de produit n\'aura pas de matériel lier'});                       
            $('#seulN').tooltip({'trigger':'focus', 'title': 'Cette catégorie de produit n\'aura pas de matériel lier & aura peut-être besoin de nacelle'});                       

        });

        // EDIT PRODUCT //
        
        $(document).on('click','button[data-role=editproduct]', function(){

            $('#editproduct').modal('show');// ouvre la modal 
            let rowtableproduct = $(this).closest('tr');
            let id = parseInt(rowtableproduct.find('td:eq(0)').text());

            $('#IDProduct').val(id);

            $('input[name=BTNRadio]').attr('checked', false);
            $('.AffCategoryProduit').prop('hidden', false);

            $.ajax({
                url: '?p=materials.findProduit',
                data: {id:id},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    let product = reponse.produit; // récupére le text marque
                    $('#product').val(product); // ecris dans l'input le text produit 

                    let family_id = reponse.famille_id;
                    load_SelectFamily();
                    $('#family option[value="' + family_id +'"]').attr('selected', true); 

                    if (reponse.mat_primary == 1) {

                        if (reponse.mat_category == "P") { // PARENT //

                            $('input[id=parent]').attr('checked', true);

                        } else if (reponse.mat_category == "S") { // SEUL //

                            $('input[id=seul]').attr('checked', true);

                        } else if (reponse.mat_category == "SN") { // SEUL avec Nacell //

                            $('input[id=seulN]').attr('checked', true);
                        }                           

                    } else {

                        // ont efface les BTNRadio //
                        $('.AffCategoryProduit').prop('hidden', true);
                        $('input[name=BTNRadio]').prop('required', false);

                    }                        

                }                

            });

            $('#parent').tooltip({'trigger':'focus', 'title': 'Cette catégorie de produit aura du matériels lier'});                        
            $('#seul').tooltip({'trigger':'focus', 'title': 'Cette catégorie de produit n\'aura pas de matériel lier'});                       
            $('#seulN').tooltip({'trigger':'focus', 'title': 'Cette catégorie de produit n\'aura pas de matériel lier & aura peut-être besoin de nacelle'});                 

            $('#EDITPRODUCT').validator().on("submit", function(event){                            

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();                                          

                    $.ajax({
                        url : '?p=materials.editProduct',
                        method : 'POST',
                        data : $('#EDITPRODUCT').serialize(),
                        success : function(response){

                            $('#editproduct').modal('hide'); // ferme la modal

                            $("#info_product")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html('Le produit à bien était modifié !!!');

                            recupclassdiv('info_product', 3000);                        

                            TableProduct.ajax.reload(); // recharge la table produit //                                                    
                            
                        }

                    });
                }
            });                        

        });

        // DELETE PRODUCT //

        $(document).on('click', 'button[data-role=deleteProduct]', function(){

            // recupére l'id de la marque //            
            let rowtableproduct = $(this).closest('tr');
            let id = parseInt(rowtableproduct.find('td:eq(0)').text()); // id mark //

            $.post('?p=materials.findDelProduct',

            {
                id : id

            }, function(data) {                
                
                if (data[0].Qtm == 0 ) {
                    
                    if(confirm("Voulez-vous vraiment supprimer le produit?"))
                        {
                           $.ajax({
                                url:"?p=materials.deleteProduct",
                                method: 'POST',
                                data:{id : id},                            
                                success: function(data) {  

                                    TableProduct.ajax.reload(); // a finir //                                        
                                
                                }
                             
                            });
                        }

                } else {

                    
                    $("#info_product")
                    .removeClass('hidden')
                    .addClass('alert alert-danger danger-dismissable col-lg-12')
                    .html("Le produit et lié à du matériel actif, il n'est pas possible de la supprimé !!!");

                    recupclassdiv('info_product', 3000);
                   
                }

            }); 
            
        });              

    // MARK //         

        // function select mark //
    
        function load_SelectMark() { 

            $('#Marques').empty(); // vide le champ marques
            $('#btnmark').prop('disabled', false);

            $.ajax({
                url: '?p=materials.selectMark', 
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#Marques').append('<option value="0" selected disabled>Veuillez choisir une marque</option>');

                    for (var i = 0; i < reponse.length; i++) {

                    var id = reponse[i].id;

                    var marks = reponse[i].marque;                            

                    $("#Marques").append('<option value="'+ id +'">'+ marks +'</option>'); // remplis les données dans un select //

                    }           
                }
            });
        }

        // function view mark forms PMMT (id produit)//
            
        function load_Mark(id) {

            // affiche la table model//
            $('#viewMark').removeClass('hidden').addClass('display');            

             // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableMark')) {

                $('#TableMark').DataTable().destroy();
            }                

            // AFF MARK select //        

            let TableMark = $('#TableMark').DataTable({

                language: {url: "../public/media/French.json"},
                paging: false,
                search: false,
                ajax: {
                    url:'?p=materials.viewMark',
                    type: "POST",
                    data: {id:id}
                    },                
                    columns: [
                        { data: "id" },
                        { data: "marque" },
                        { render : function(data) { 

                                if (typeU == "administrateur") {

                                    return `<button class='btn btn-primary btn-xs' data-role='editmark'<abbr title='Edition Marque'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                           `<button type='submit' class='btn btn-danger btn-xs btn_supM' data-role='deleteMark'<abbr title='Supprimé la marque'><span class='glyphicon  glyphicon-trash'></span></abbr></button>`

                                } else {

                                    return `<button class='btn btn-primary btn-xs' data-role='editmark'<abbr title='Edition Marque'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                           `<button type='submit' class='btn btn-danger btn-xs btn_supM' data-role='deleteMark'<abbr title='Supprimé la marque' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>`
                                }

                            }

                        }
                    ]            

            });
        }            

        // affiche la table model en fonction de la marque //
        
        $('#TableMark').on('click','tr', function (){

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9' }); // affiche le tr en gris //
            
            // recupére l'id de la marque//            
            var rowtablemark = $(this).closest('tr');
            var id = parseInt(rowtablemark.find('td:eq(0)').text());

            $('#viewModel, #viewType, #viewCaract').addClass('hidden').removeClass('display');

            let idp = $('#IdProduct').val();

            load_Model(id, idp); // id de la marque & produit        

        });

        // fonction qui charge le model en fonction de la marque //

        $('#Marques').on('change', function() {                            

            var idm = $(this).val() // on récupère l'id de la marque //
            var idp = $('#Products option:selected').val() // on récupére l'id produit //                         
        
            load_SelectModel(idm,idp) // on charge le select model

            $("input[id='Types']").val('') // on vide l'input types                                  
            
        });

        // ADD MARK //
    
        $(document).on('click','button[data-role=AddMark]', function(){

            let id_product, product, mark

            $('#addmark').modal('show'); // ouvre la maodal add marque //
            
            $("#affinfomark").removeClass('display').addClass('hidden'); // efface le message //           

            id_product = $('#Products').val(); // récupére l'id du produit        
            product = $('#Products option:selected').text(); // récupére le produit            

            if (id_product == 0) {

                $('#titremark').html("Veuillez choisir un produit !!");
                $('#divMarkAdd').addClass('hidden');
                $("#submitMarkAdd").prop('disabled', false);

            } else {         
                
                $('#titremark').html("Ajout Marque au produit : " + product);
                $('#divMarkAdd').removeClass('hidden');
                $('#Id_product').val(id_product); // inscris l'id dans un input hidden //

            }                                     

            $('#markadd').on('change', function(){                

                mark = $('#markadd').val();        
                                 
                if (mark == " ") {                   

                } else {                                             

                    $.ajax({
                    url : '?p=materials.checkedMark',
                    method : 'POST',
                    data : {mark : mark},
                    dataType: 'json',
                    success : function(data){                                         

                        if (data == false ) {
                            
                            $("#affinfomark").removeClass('display').addClass('hidden'); // efface le message erreur //                               

                            // si la marque n'existe pas ont fait l'enregistrement //                                                           

                            $('#AddMark').validator().on('submit', function (event) {

                                if (event.isDefaultPrevented()) {

                                } else {
                                
                                    event.preventDefault();

                                    $.ajax({
                                        url : '?p=materials.addMark',
                                        method : 'POST',
                                        data : {mark : mark},
                                        cache: false,
                                        success : function(data){

                                            // affiche success marque ajouté //                                   
                                            $("#affinfomark")
                                            .removeClass('hidden')
                                            .addClass('alert alert-success success-dismissable')
                                            .html("La marque à bien était ajouté !!!");                                                     

                                            load_SelectMark(); // charge le select mark                                                                                                                                                                                         

                                            $("#AddMark")[0].reset();

                                            setTimeout(function(){$('#addmark').modal('hide')},3000); // ferme la modal //                                                                                                   

                                        }                    

                                    });
                                }

                            });

                        } else { 

                            // msg d'erreur si la marque existe  //                               
                            $("#affinfomark")
                            .removeClass('hidden')
                            .addClass('alert alert-danger danger-dismissable')
                            .html('Cette marque exite déja !!!');

                            recupclassdiv('affinfomark', 3000); // efface le message error mark
                            $("#AddMark")[0].reset();
                        }

                    }

                    });
                }

            });                        

        });

        // EDIT MARK //
        
        $(document).on('click','button[data-role=editmark]', function(){

            $('#editmark').modal('show');
            let rowtablemark = $(this).closest('tr');
            let id = parseInt(rowtablemark.find('td:eq(0)').text());            
            let mark = rowtablemark.find('td:eq(1)').text(); // récupére le text marque
            $('#marque').val(mark); // ecris dans l'input le text marque
            let IdProduct = $('#IdProduct').val(); // récupére la valeur de l'id produit

            $('#EDITMARK').validator().on("submit", function(event){                            

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();                

                    var marque = $('#marque').val(); // récupére le champs input //                                          

                    $.ajax({
                        url : '?p=materials.editMark',
                        method : 'POST',
                        data : {id:id, marque:marque},
                        success : function(response){

                            $('#editmark').modal('hide'); // ferme la modal

                            $("#info_mark")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html('La marque à bien était modifié !!!');

                            recupclassdiv('info_mark', 3000);                        

                            load_Mark(IdProduct); // recharge la table marque //                                                      
                            
                        }

                    });
                }
            });                        

        });

        // DELETE MARK //

        $(document).on('click', 'button[data-role=deleteMark]', function(){

            // recupére l'id de la marque //            
            let rowtablemark = $(this).closest('tr');
            let id = parseInt(rowtablemark.find('td:eq(0)').text()); // id mark //

            $.post('?p=materials.findDelMark',

            {
                id : id

            }, function(data) {                
                
                if (data[0].Qtm == 0 ) {
                    
                    if(confirm("Voulez-vous vraiment supprimer la marque?"))
                        {
                           $.ajax({
                            url:"?p=materials.deleteMark",
                            method: 'POST',
                            data:{id : id},                            
                            success: function(data) {  

                                   load_Mark(); // a finir //
                                    
                                }
                             
                            });
                        }

                } else {

                    
                    $("#info_mark")
                    .removeClass('hidden')
                    .addClass('alert alert-danger danger-dismissable col-lg-12')
                    .html("La marque et lié à du matériel actif, il n'est pas possible de la supprimé !!!");

                    recupclassdiv('info_mark', 3000);
                   
                }

            }); 
            
        });           

    // MODEL //        
        
        // function load Models affiche les models dans le select (id mark)//
        
        function load_SelectModel(idm,idp) {

            $('#Models').empty(); // vide le select model
            $('#btnmodel').prop('disabled', false);         

            $.ajax({
                url: '?p=materials.selectModel',
                data: {idm:idm, idp:idp},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    if (reponse.length == 0) {

                        $("#Models").append('<option value="0">Pas de Model</option>'); // remplis les données dans le select //
                        $('#btntype').prop('disabled', true); // desactive le boutton add type

                    } else {

                        $('#Models').append('<option value="0" disabled selected>Veuillez choisir un model</option>');

                        for (var i = 0; i < reponse.length; i++) {

                            var id = reponse[i].id;

                            var models = reponse[i].model;                            

                            $("#Models").append('<option value="'+ id +'">'+ models +'</option>'); // remplis les données dans un select //

                        }  
                    }                                                                                     
                                        
                }
                  
            });  
        }
 
        // function view models forms PMMT (id-> marque, idp-> id produit )//
            
        function load_Model(id, idp) {

            // affiche la table model//
            $('#viewModel').removeClass('hidden').addClass('display');            

            // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableModel')) {

                $('#TableModel').DataTable().destroy();
            }

            $('#IdMark').val(id); // ecris la valeur dans l'input 

            let TableModel = $('#TableModel').DataTable({

                language: {url: "../public/media/French.json"},
                paging: false,
                search: false,
                ajax: {
                    url:'?p=materials.viewModel',
                    type: "POST",
                    data: {id:id, idp:idp}
                    },                                     
                    columns: [
                        { data: "id" },
                        { data: "model" },
                        { data: "img",
                            render: function(data, type, row) {

                                if (row.img == null) {

                                    return '<button class="btn btn-warning btn-xs" data-role="addImgModel"<abbr title="Ajouter une image au Model"></abbr>Add Img Model</button>'

                                } else {
                                    
                                    return '<img class="logoM" style="width: 70px;" src="' + row.img +'"><button class="btn btn-theme02 btn-file" data-role="addImgModel"><span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span></button>'

                                }
                          
                            }
                        }, 
                        {   render : function(data) {

                                if (typeU == "administrateur") { 
                                    return `<button class='btn btn-primary btn-xs' data-role='editmodel'<abbr title='Edition Model'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                           `<button type='submit' class='btn btn-danger btn-xs' data-role='deleteModel'<abbr title='Supprimé le model'><span class='glyphicon  glyphicon-trash'></span></abbr></button>`
                                } else {
                                    return `<button class='btn btn-primary btn-xs' data-role='editmodel'<abbr title='Edition Model'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                           `<button type='submit' class='btn btn-danger btn-xs' data-role='deleteModel'<abbr title='Supprimé le model' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>` 
                                }                          

                            }
                        }    
                    ]            

            });
             
            ScrollAncre("#viewMark");            

        }

        // function qui affiche l'image du modél du matériel / id mate //
        
        function affImgMate(id) {            

            $.ajax({
                url: '?p=materials.checkedImgModel',
                data: {id:id},
                method: 'post',
                success: function(data) {                    

                    if (data.img != null) {

                        // différent de null //
                        $('.AffImgMat').append('<img src="'+ data.img +'" style="width: 250px" alt="image materiel">');
                        $('.AffbtnImg').append('<button class="btn btn-theme02 btn-file" data-role="addimgMat" data-idmodel="'+data.models_id+'" data-model="'+data.model+'"><i class="fa fa-undo"></i> Change</button>');
                        
                    } else {

                        // null //                        
                        $('.AffbtnImg').append('<button class="btn btn-theme02 btn-file" data-role="addimgMat" data-idmodel="'+data.models_id+'" data-model="'+data.model+'">Add Img</button>');
                    }

                }
                  
            });   
            
        }

        // function qui charge le type en fonction du model //
        
        $('#Models').on('change', function() {

            var modelId = $(this).val(); // on récupére l'id du model //

            findtype(modelId);            

        });

        // affiche la table type en fonction du model pour PMMT//
        
        $(document).on('click','#TableModel tr', function (){

            $('tr td').css({ 'background-color' : '#e5e5e5'}) // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9' }) // affiche le tr en gris //
            
            // recupére l'id du model//            
            var rowtablemodel = $(this).closest('tr')
            var id = parseInt(rowtablemodel.find('td:eq(0)').text())

            $('#IdModel').val(id) // ecris l'id model dans l'input

            $('#viewType, #viewCaract').addClass('hidden').removeClass('display')

            load_Type(id) // id du model       

        });

        // ADD MODELS //
        
        $(document).on('click','button[data-role=AddModel]', function(){

            $('#addmodel').modal('show'); // ouvre la modal add model //            
                
            var id_mark = $('#Marques').val(); // récupére l'id de la marque
            var id_product = $('#Products option:selected').val(); // récupére l'id du produit        
            var marque = $('#Marques option:selected').text(); // récupére la marque                   
            
            $('#affinfomodel').removeClass('display').addClass('hidden'); // efface l'info model //

            $('#titremodel').html("Ajout Model à la marque : " + marque);            
            $('#Id_mark').val(id_mark); // inscris l'id dans un input hidden //                                   

            $('#modeladd').on('change', function(){             

                var model = $('#modeladd').val(); // récupére la valeur 

                if (model == "") {
                   
                   // on ne fait rien //

                } else {

                    $.ajax({
                        url : '?p=materials.checkedModel',
                        method : 'POST',
                        data : {model:model},
                        dataType: 'json',
                        success : function(data){                                         

                            if (data == false ) {

                                // efface le message info //
                                $("#affinfomodel").removeClass('display').addClass('hidden');                                                         

                                // si le model n'existe pas ont fait l'enregistrement //                           

                                $('#AddModel').validator().on('submit', function (event) {

                                    if (event.isDefaultPrevented()) {

                                    } else {
                                    
                                        event.preventDefault();
                                        
                                        var model = $('#modeladd').val(); // récupére le model //                                                                                                                                                           

                                        $.ajax({
                                            url : '?p=materials.addModel',
                                            method : 'POST',
                                            data : {model:model, id_mark:id_mark, id_product:id_product},
                                            success : function(data){                                                                                                      
                                                    
                                                $("#affinfomodel")
                                                .removeClass('hidden')
                                                .addClass('alert alert-success success-dismissable')
                                                .html("Le model à bien était ajouté !!!");                                                   

                                                load_SelectModel(id_mark,id_product); //charge le select model //

                                                $('#AddModel')[0].reset(); // reset le formulaire add model //

                                                setTimeout(function(){$('#addmodel').modal('hide')},3000); // ferme la modal //                                                

                                            }                    

                                        });
                                    }

                                });

                            } else { 

                                // msg d'erreur si le model existe  //

                                $("#affinfomodel")
                                .removeClass('hidden')
                                .addClass('alert alert-danger danger-dismissable')
                                .html("Le model existe déja !!!");
                                                
                                recupclassdiv('affinfomodel', 3000);

                                $('#AddModel')[0].reset();
                            }

                        }

                    });

                }

            });                        

        });      

        // EDIT MODELS //
        
        $(document).on('click','button[data-role=editmodel]', function(){

            $('#editmodel').modal('show') // ouvre la modal //            

            let rowtablemodel = $(this).closest('tr')
            let id = parseInt(rowtablemodel.find('td:eq(0)').text()) // recupére id model //            
            let model = rowtablemodel.find('td:eq(1)').text() // récupére le text model //                                

            $('#model').val(model) // ecris dans l'input

            // mise a jour des données model//

            $('#EDITMODEL').validator().on("submit", function(event){

                var idMark = $('#IdMark').val() // récupére id mark
                var model = $('#model').val() // récupére le model
                var idProduct = $('#IdProduct').val() // récupére l'id produit

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault()                                                            

                    $.ajax({
                        url : '?p=materials.editModel',
                        method : 'POST',
                        data : {id:id, model:model},
                        success : function(response){

                            $('#editmodel').modal('hide') // ferme la modal

                            $("#info_model").removeClass('hidden').addClass('alert alert-success success-dismissable').html("Le model à bien était modifié !!!")
                            
                            recupclassdiv('info_model', 3000)                      

                            load_Model(idMark,idProduct) // recharge la table model en function de l'id mark & produit//                            
                            
                        }

                    });
                } 
            });
        });    

        // DELETE MODELS //

        $(document).on('click', 'button[data-role=deleteModel]', function(){

            // recupére l'id du model//            
            let rowtablemodel = $(this).closest('tr');
            let id = parseInt(rowtablemodel.find('td:eq(0)').text()); // id model //

            $.post('?p=materials.findDelModel',

            {
                id : id

            }, function(data) {                
                
                if (data[0].Qtm == 0) {
                    
                    if(confirm("Voulez-vous vraiment supprimer le model?"))
                        {
                           $.ajax({
                            url:"?p=materials.deleteModel",
                            method: 'POST',
                            data:{id : id},                            
                            success: function(data) {  

                                   load_Model(); //  a finir //
                                    
                                }
                             
                            });
                        }

                } else {

                    
                    $("#info_model")
                    .removeClass('hidden')
                    .addClass('alert alert-danger danger-dismissable col-lg-12')
                    .html("Le model et lié à du matériel actif, il n'est pas possible de le supprimé !!!");

                    recupclassdiv('info_model', 3000);
                   
                }

            }); 
            
        });

        // add IMG MODELS //
        
        $(document).on('click', 'button[data-role=addImgModel]', function() {

            // recupére l'id du model//            
            let rowtablemodel = $(this).closest('tr');
            let id = parseInt(rowtablemodel.find('td:eq(0)').text());
            let model = rowtablemodel.find('td:eq(1)').text();

            $('#addimgmodel').modal('show'); // ouvre la modal //
            $('.titremodel').html("Ajout une image au Model: " + model); // ecris le title //

            $('#IDModel').val(id); // ecris dans l'input hidden //

            $('#ADDIMGMODEL').validator().on('submit', function (event) {

                let idm = $('#IdMark').val();
                let idp = $('#IdProduct').val();

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault()

                    var form = $('#ADDIMGMODEL')[0];
                    var data = new FormData(form);                                                                                                                                                                              

                    $.ajax({
                        url : '?p=materials.addImgModel',
                        method : 'POST',
                        enctype : 'multipart/form-data',
                        data : new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success : function(data){                                                                                                      
                                
                            $("#info_model")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("L'image du model à bien était ajouté !!!");
                            
                            recupclassdiv('info_model', 7000, 'addimgmodel')                            

                            $('#addimgmodel').modal('hide'); // ferme la modal //

                            load_Model(idm,idp); // id mark & id produit

                        }                    

                    });
                }

            });

        });            

    // TYPE MATERIEL //
     
        // function charge les types dans le select par rapport a ça marque (id )//
        
        function load_SelectType(id) {

            $('#typeadd').empty(); 

            $.ajax({
                url: '?p=materials.selectType',
                data: {id:id},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $("#typeadd").append('<option value="0" disabled selected>Veuillez choisir un type</option>');                    

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;
                        var types = reponse[i].type;
                        
                        $("#typeadd").append('<option value="'+ id +'">'+ types +'</option>'); // remplis les données dans le select //
                        
                    }                                                                                       
                    
                    $("#typeadd").append('<option value="0">Autre</option>');                   
                }
                  
            });  

        }
    
        // function charge le type form markmodeltype (id model)//
            
        function load_Type(id) {

            // affiche la table type//
            $('#viewType').removeClass('hidden').addClass('display');            

            // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableType')) {

                $('#TableType').DataTable().destroy();
            }

            let TableType = $('#TableType').DataTable({

            language: {url: "../public/media/French.json"},
            paging: false,
            search: false,
            ajax: {
                url:'?p=materials.viewType',
                type: "POST",
                data: {id:id}
                },                
                columns: [
                    { data: "id" },
                    { data: "type" },
                    { render : function(data) { 

                            if (typeU == "administrateur") { 

                                return `<button class='btn btn-primary btn-xs' data-role='edittype'<abbr title='Edition Type'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                       `<button type='submit' class='btn btn-danger btn-xs' data-role='deleteType'<abbr title='Supprimé le type'><span class='glyphicon  glyphicon-trash'></span></abbr></button>`
                            } else {

                                return `<button class='btn btn-primary btn-xs' data-role='edittype'<abbr title='Edition Type'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                       `<button type='submit' class='btn btn-danger btn-xs' data-role='deleteType'<abbr title='Supprimé le type' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>`

                            }
                        }
                    }
                ]            

            })      

        }

        // function de recherche type en fonction du model //
        
        function findtype(modelId) {

            $.ajax({
                url: '?p=materials.findtype',
                data: {modelId:modelId},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                   if (reponse.length == 0) { // type n'existe pas  //

                        $("input[id='Types']").val('Pas de Type'); // remplis un text dans l'input //
                        $('#btntype').prop('disabled', false); // active le boutton add type 

                    } else { // le type existe //

                        $("input[id='Types']").val(reponse[0].type); // remplis les données dans l'input //
                        $('#btntype').prop('disabled', true); // desactive le boutton add type
                        $('#Types_Id').val(reponse[0].id); // ecris l'id type pour l'edition
                        $('#Num_serie').attr('disabled', false); // active l'input num série //   
                    }

                    $('#btngener').prop('disabled', false); // active le boutton generer num serie //                                                            
                                        
                }
                  
            });  
        }              

        // ADD TYPE //
        
        $(document).on('click','button[data-role=AddType]', function(){

            $('#addtype').modal('show'); //ouvre la modal add type //                
            $("#error_type").removeClass('display').addClass('hidden');// efface les messages //                       
                
            let Id_model = $('#Models').val(); // récupére l'id du model        
            let model = $('#Models option:selected').text(); // récupére le model
            let id_mark = $('#Marques').val(); // récupére l'id de la marque 

            load_SelectType(id_mark);            
                
            $('#Titretype').html("Ajout type au model : " + model);
            
            $('#Id_model').val(Id_model); // inscris l'id dans un input hidden //
            $('#selecttype').show(); //affiche le select
            $('#inputtype').hide(); // efface la div avec l'input

            $('input[id=othertypeadd]').prop('required', false); // supprime l'attribut required sur l'input            
            // si typeadd change //
            $('#typeadd').on('change', function(){

                let typeadd = $('#typeadd option:selected').text(); // récupére le text du select typeadd                   

                if (typeadd !== 'Autre') {

                    // enregistre le type selectionner //                    
                    
                    var id_type = $('#typeadd').val(); // récupére l'id type //                    
                    $('#direct').val('update');

                } else if (typeadd === 'Autre') {

                    // enregistre un nouveau type matériel //
                    
                    $('#selecttype').hide(); // efface la div
                    $('select[id=typeadd]').attr('required', false);// supprime l'attribut required sur le select //
                    $('#inputtype').show(); //affiche la div
                    $('input[id=othertypeadd]').prop('required', true); // ajoute l'attribut required sur l'input
                    $('#direct').val('add');

                    // faire verification si le type existe //
                    $('#othertypeadd').on('change', function(){               

                        let type = $('#othertypeadd').val();                        

                        // requête ajax verif type  //
                        $.ajax({
                            url : '?p=materials.checkedType',
                            method : 'POST',
                            data : {type:type},
                            dataType: 'json',
                            success : function(data){                                                                             

                                if (data == false ) {

                                // ont ne fait rien //                                                                          

                                } else {
                                    
                                    // on affiche si le type existe //                                       
                                    $("#error_type")
                                    .removeClass('hidden')
                                    .addClass('alert alert-danger danger-dismissable')
                                    .html("Ce type existe déja !!!");

                                    recupclassdiv('error_type', 7000, 'ModalInfoMate');
                                    $('input[name=othertypeadd]').val(''); // vide le champ input

                                }
                            }                        

                        });                     
                        
                    });                    

                }

                $('#AddType').validator().on('submit', function (event) {                    

                    if (event.isDefaultPrevented()) {

                    } else {
                    
                        event.preventDefault();

                        // récupére la valeur des champ input //
                        let type = $('input[name=othertypeadd]').val(); 
                        let direct = $('input[name=direct]').val();
                        let id_model = $('#Id_model').val();                                                                                                                                    

                        $.ajax({
                            url : '?p=materials.addType',
                            method : 'POST',
                            data : {id_type:id_type, id_model:id_model, type:type, direct:direct},
                            success : function(data){ 

                                // efface le message erreur //
                                $("#error_type").removeClass('display').addClass('hidden');

                                //ouvre la modal //
                                $("#ModalInfoMate").modal('show');

                                $("#affInfoMate")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable')
                                .html("Le type à bien était ajouté !!!");

                                recupclassdiv('affInfoMate', 7000, 'ModalInfoMate');

                                $('#Types').empty(); // vide le champ type //
                                $('#AddType')[0].reset(); // reset le formulaire add type //                                
                                $('#addtype').modal('hide'); // ferme la modal add type //
                                // mise a jour données type//
                                findtype(id_model);
                            }                    

                        });
                    }

                }); 
                          
            });            

        });

        // EDIT TYPE //
        
        $(document).on('click','button[data-role=edittype]', function(){

            $('#edittype').modal('show') // ouvre la modal //         

            let rowtabletype = $(this).closest('tr')
            let id = parseInt(rowtabletype.find('td:eq(0)').text()) // récupére l'id
            let type = rowtabletype.find('td:eq(1)').text() // récupére le text type//                                

            $('#type').val(type) // ecris dans l'input //               

            // mise a jour des données type//

            $('#EDITTYPE').validator().on("submit", function(event){ 

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault()
                    
                    let idModel = $('#IdModel').val() // récupére l'id model //
                    let type = $('#type').val() // récupére le type dans l'input //                      

                    $.ajax({
                        url : '?p=materials.editType',
                        method : 'POST',
                        data : {id:id, type:type},
                        success : function(response){                            

                            $('#edittype').modal('hide')

                            $("#info_type").removeClass('hidden').addClass('alert alert-success success-dismissable').html("Le type à bien était modifié !!!")
                            recupclassdiv('info_type', 3000)                            
                            
                            load_Type(idModel)                                 
                            
                        }

                    })
                }
            })
        });

        // DELETE TYPES //

        $(document).on('click', 'button[data-role=deleteType]', function(){

            // recupére l'id du model//            
            let rowtabletype = $(this).closest('tr');
            let id = parseInt(rowtabletype.find('td:eq(0)').text()); // id model //

            $.post('?p=materials.findDelType',

            {
                id : id

            }, function(data) {                
                
                if (data[0].Qtm == 0) {
                    
                    if(confirm("Voulez-vous vraiment supprimer le type?"))
                        {
                           $.ajax({
                            url:"?p=materials.deleteType",
                            method: 'POST',
                            data:{id : id},                            
                            success: function(data) {  

                                   load_Type(); //  a finir //
                                    
                                }
                             
                            });
                        }

                } else {

                    
                    $("#info_type")
                    .removeClass('hidden')
                    .addClass('alert alert-danger danger-dismissable col-lg-12')
                    .html("Le type et lié à du matériel actif, il n'est pas possible de le supprimé !!!");

                    recupclassdiv('info_type', 3000);
                   
                }

            }); 
            
        });

    // NUM SERIE //
     
        // verifie si le numero de serie existe déja //
        
        function checkNumSerie(NumSerie){

            $.ajax({
                url: '?p=materials.findnumserie',
                data: {NumSerie : NumSerie}, 
                method: 'POST',
                dataType: 'json',
                success: function(response) {                
                    
                    if (response == false) {

                       // le numserie n'existe pas //                     

                        $("#Success_Error_NumSerie")
                        .removeClass('hidden')
                        .addClass('alert-success')
                        .html("<h5>Ce numéro et valide !!!</h5>");

                        recupclassdiv('Success_Error_NumSerie', 3000);

                    } else {

                        // le numserie existe //
                        $("#Success_Error_NumSerie")
                        .removeClass('hidden')
                        .addClass('alert-danger')
                        .html("<h5>Ce numéro existe déja !!!</h5>");

                        $('#Num_serie').val('');
                        recupclassdiv('Success_Error_NumSerie', 3000);
                    }
                }
            });        

        }
        
        // function qui verifie si le numero série existe ou pas et charge le selectLevel pour ADD  //           

        $('#Num_serie').on('change', function() {

            var NumSerie = $(this).val();

            checkNumSerie(NumSerie);

            if ($('.EDITMAT').is(':visible') == true) {

            } else {

                if ($('.ADDMATLIER').is(':visible') == true) {

                    let idmate = $('#id_mate').val();

                    load_SelectLevelMateLier(idmate);

                } else {

                    load_SelectLevel();                
                }

                load_SelectContract();
                load_PlaceInstalled();            
                load_SelectArmoire();                           
            }
        });  
        
        // function qui génére un numéro de série //
        
        $(document).on('click', 'button[data-role=GeneNumSerie]', function(){
            
            $.ajax({
                url: '?p=materials.findseriegener',
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    let nbrs = reponse.length+1; // nbr de numero de serie ayant le format ####1 //

                    var nombreStr = reponse[0].nserie;

                    for (var i = 0; i < nbrs; i++) {
                
                        $.post('?p=materials.findnumserie',

                            {NumSerie : nombreStr}, function(data) {                              
                              
                            if (data == false ) { // numserie n'existe pas //          
                                 
                                $('#Num_serie').val('00001');     

                            } else { // numserie existe //

                                $('#Num_serie').val("");

                                let nombreInt = parseInt(nombreStr, 10); // Convertir en entier
                                nombreInt++; // Incrémenter
                                let nbrIncremente = nombreInt.toString().padStart(nombreStr.length, '0'); // Reconvertir en chaîne avec zéros initiaux //
                                  
                                $('#Num_serie').val(nbrIncremente);
                                 
                            }                                

                        });

                        if ($('.EDITMAT').is(':visible') == true) {

                            // on ne fait rien //

                        } else {

                            if ($('.ADDMATLIER').is(':visible') == true) {

                                let idmate = $('#id_mate').val();

                                load_SelectLevelMateLier(idmate);

                            } else {

                                load_SelectLevel();               
                            }

                            load_PlaceInstalled();
                            load_SelectArmoire();
                        }
                        
                    }                                                        
                                        
                }
                  
            });

        });

    // PLACE INSTALLED //
    
        // function charge le lieux Installé //
        
        function load_PlaceInstalled() {

            $('#LieuxInst').empty(); // vide le select //

            let cat = $('#cat').val();
            let fam = $('#family option:selected').val();

            if (fam == 1) {

                $('#LieuxInst').append('<option value="0" selected disabled>Choisir un lieux </option>');
                $('#LieuxInst').append('<option value="RDC - Ext">RDC - Extérieur</option>');
                $('#LieuxInst').append('<option value="R+1 - Toit Terrasse">R+1 - Toit Terrasse</option>');
                $('#LieuxInst').append('<option value="R+2 - Toit Terrasse">R+2 - Toit Terrasse</option>');
                $('#LieuxInst').append('<option value="R+3 - Toit Terrasse Nord">R+3 - Toit Terrasse Nord</option>');
                $('#LieuxInst').append('<option value="R+3 - Toit Terrasse Sud">R+3 - Toit Terrasse Sud</option>');

            } else if (fam == 4) {

                $('#LieuxInst').append('<option value="0" selected disabled>Choisir un lieux </option>');
                $('#LieuxInst').append('<option value="RDC - Ext">RDC - Extérieur</option>');

            } else if (fam == 5) {

                $('#LieuxInst').append('<option value="0" selected disabled>Choisir un lieux </option>');
                $('#LieuxInst').append('<option value="R+1 - Toit Terrasse">R+1 - Toit Terrasse</option>');
                $('#LieuxInst').append('<option value="R+2 - Toit Terrasse">R+2 - Toit Terrasse</option>');
                $('#LieuxInst').append('<option value="R+3 - Toit Terrasse Nord">R+3 - Toit Terrasse Nord</option>');
                $('#LieuxInst').append('<option value="R+3 - Toit Terrasse Sud">R+3 - Toit Terrasse Sud</option>');

            } else if (fam == 6) {

                $('#LieuxInst').append('<option value="0" selected disabled>Choisir un lieux </option>');
                $('#LieuxInst').append('<option value="RDC">RDC</option>');
                $('#LieuxInst').append('<option value="R+1">R+1 </option>');
                $('#LieuxInst').append('<option value="R+2">R+2 </option>');            

            } else {

                $('#LieuxInst').append('<option value="0" selected disabled>Choisir un lieux </option>');
                $('#LieuxInst').append('<option value="RDC - Ext">RDC - Extérieur</option>');
                $('#LieuxInst').append('<option value="RDC - Intérieur">RDC - Intérieur</option>');
                $('#LieuxInst').append('<option value="R+1 - Toit Terrasse">R+1 - Toit Terrasse</option>');
                $('#LieuxInst').append('<option value="R+2 - Toit Terrasse">R+2 - Toit Terrasse</option>');
                $('#LieuxInst').append('<option value="R+3 - Toit Terrasse Nord">R+3 - Toit Terrasse Nord</option>');
                $('#LieuxInst').append('<option value="R+3 - Toit Terrasse Sud">R+3 - Toit Terrasse Sud</option>');            
            
            }
            
        }

        // function sur lieux installé change //
        
        $('#LieuxInst').on('change', function() {
            
            let selec = $('#LieuxInst option:selected').val();
            let fam = $('#family option:selected').val();            

            if (selec === "RDC - Intérieur") {
                $('.za').html('Localisation:');
                $('.Affshowback, .AffLevels, .AffPlace, .AffPiece').removeClass('hidden').addClass('display'); // affiche //
                $('.ctrl, .ctrl1').prop('required', true); // mais a true les select //

            } else if(selec === "RDC - Ext") {

                $('.Affshowback, .AffLevels, .AffPlace, .AffPiece').removeClass('display').addClass('hidden'); // efface //
                $('.ctrl, .ctrl1').prop('required', false); // mais a false les select //

            } else if (selec != "RDC - Ext") {

                if (fam == 1) {
                    $('.Affshowback, .AffLevels, .AffPlace').removeClass('hidden').addClass('display'); // affiche //
                    $('.ctrl').prop('required', true); // mais a true les select //
                } else if (fam == 1) {
                    $('.Affshowback, .AffLevels, .AffPlace').removeClass('hidden').addClass('display'); // affiche //
                    $('.ctrl').prop('required', true); // mais a true les select //
                } else if (fam == 3) {
                    $('.Affshowback, .AffLevels, .AffPlace, .AffPiece').removeClass('display').addClass('hidden'); // efface //
                    $('.ctrl, .ctrl1').prop('required', false); // mais a false les select //
                }
                
            } 

        });                           

    // NIVEAU/LEVEL //       

        if ($('#TableLevel').is(':visible') == true) {

            $('a.item-M').attr('class', 'active')
            $('ul.item-m').attr('style', 'display:block;')
            $('li.item-enl').attr('class', 'active')
        
        }

        // function charge le niveau dans le select //
        
        function load_SelectLevel() {            

            $('select[name=Levels]').empty(); // vide le select level

            $.ajax({
                url: '?p=levels.selectLevel',
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('select[name=Levels]').append('<option value="0" disabled selected>Choisir un niveau</option>');

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;

                        var levels = reponse[i].niveau;                            

                        $('select[name=Levels]').append('<option value="'+ id +'">'+ levels +'</option>'); // remplis les données dans le select //

                        if (typeU != "administrateur") {

                            if (levels == "R+2") {

                                $('#btnlevel').prop('disabled', true); // desactive le bouton add 

                            } else {

                                $('#btnlevel').prop('disabled', false); // active le bouton add
                            }

                        } else {

                            $('#btnlevel').prop('disabled', false); // active le bouton add
                        }                        

                    }                                                                   
                                        
                }
                  
            });  

        }

        // function charge le niveau dans le select pour mate_lier //
        
        function load_SelectLevelMateLier(id) {

            $('#Levels').empty(); // vide le select level 
            $('#btnlevel').prop('disabled', true); // active le bouton add

            $.ajax({
                url: '?p=levels.selectLevelMateLier',
                method: 'POST',
                data: {id:id},
                async: false,
                success: function(reponse) {                    

                    var id = reponse[0].id;
                    var levels = reponse[0].niveau;                            

                    $("#Levels").append('<option value="'+ id +'" selected>'+ levels +'</option>'); // remplis les données dans le select //

                    if (levels == "R+2") {

                        $('#btnlevel').prop('disabled', true); // desactive le bouton add 

                    } else {

                        $('#btnlevel').prop('disabled', false); // active le bouton add
                    }                                                                                      
                                        
                }
                  
            });

            load_SelectPlaceMateLier(id);

        }

        // AFF NIVEAU/LEVEL ALL / EDITION NIVEAU LIEUX //         

        let TableLevel = $('#TableLevel').DataTable({

            language: {url: "../public/media/French.json"},
            paging: false,
            ajax: {
                url:'?p=levels.viewLevel',
                type: "POST"
                },                
                columns: [
                    { data: "id" },
                    { data: "niveau" },
                    { render : function(data) { 

                            if (typeU == "administrateur") {

                                return `<button class='btn btn-primary btn-xs' data-role='EditLevel'<abbr title='Edition niveau'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+ 
                                       `<button type='submit' class='btn btn-danger btn-xs' data-role='deleteLevel'<abbr title='Supprimé le niveau'><span class='glyphicon  glyphicon-trash'></span></abbr></button>`
                            } else {

                                return `<button class='btn btn-primary btn-xs' data-role='EditLevel'<abbr title='Edition niveau'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+ 
                                       `<button type='submit' class='btn btn-danger btn-xs'<abbr title='Supprimé le niveau' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>`

                            }
                        }
                    }
                ]            

        });               

        // affiche la table lieux en fonction du niveau selectionner //
        
        $('#TableLevel').on('click','tr', function (){

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9' }); // affiche le tr en gris //

            $('#IdPlace, #NPlace').val(''); // efface les inputs hidden //
            
            // recupére l'id de la marque//            
            var rowtablelevel = $(this).closest('tr');
            var id = parseInt(rowtablelevel.find('td:eq(0)').text()); // id level //
            var nlevel = rowtablelevel.find('td:eq(1)').text();

            $('input[name=Level]').val(nlevel); // input hidden pour page Edition niveau lieux piéces //

            $('#viewPlace, #viewRoom').addClass('hidden').removeClass('display');

            load_Place(id, nlevel); // id du niveau et name level      

        });

        // ADD LEVEL //
        
        $(document).on('click', 'button[data-role=AddLevel]', function(){

            $('#addlevel').modal('show'); // ouvre la modal add niveau //

            $('#leveladd').on('change', function() {

                var levels = $('#leveladd').val();

                if (levels === "") {                   

                } else { 

                    $.ajax({
                        url: '?p=levels.checkedLevel', 
                        data: {levels:levels},
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {

                            if (data == false ) {                                                                                         

                                // si le niveau n'existe pas ont fait l'enregistrement //                                                           

                                $('#AddLevel').validator().on('submit', function (event) {

                                    if (event.isDefaultPrevented()) {

                                    } else {
                                    
                                        event.preventDefault();

                                        var level = $('#leveladd').val();

                                        $.ajax({
                                            url : '?p=levels.addLevel',
                                            method : 'POST',
                                            data : {level:level},
                                            success : function(data){

                                                // affiche success niveau ajouté // 
                                                $("#ModalInfoMate").modal('show');                                                   
                                                
                                                $("#affInfoMate")
                                                .removeClass('hidden')
                                                .addClass('alert alert-success success-dismissable')
                                                .html("Le niveau à bien était ajouté !!!");
                                            
                                                recupclassdiv('affInfoMate', 7000, 'ModalInfoMate');                                                                                      

                                                load_SelectLevel();                                                                                   

                                                $("#AddLevel")[0].reset();
                                                $('#addlevel').modal('hide'); // ferme la maodal add niveau //                                                                                                   

                                            }                    

                                        });
                                    }

                                });

                            } else { 

                                // msg d'erreur si le niveau existe  //         
                                 
                                $("#ModalInfoMate").modal('show');
                                $("#affInfoMate")
                                .removeClass('hidden')
                                .addClass('alert alert-danger danger-dismissable')
                                .html("Le niveau existe déja !!!");

                                recupclassdiv('affInfoMate', 7000, 'ModalInfoMate');

                                $("#AddLevel")[0].reset();
                            }                                                        
                                                
                        }
                          
                    });
                }  
            });
            
        });

        // EDIT LEVEL //
        
        $(document).on('click', 'button[data-role=EditLevel]', function(){

            $('#editlevel').modal('show'); // ouvre la modal edit niveau //

            let rowtablelevel = $(this).closest('tr');
            let id = parseInt(rowtablelevel.find('td:eq(0)').text()); // recupére id niveau //            
            let level = rowtablelevel.find('td:eq(1)').text(); // récupére le text niveau //

            $('#level').val(level); // ecris dans l'input
            $('#levelId').val(id); // ecris dans input hidden //

            $('#EDITLEVEL').validator().on("submit", function(event){                

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();                                                            

                    $.ajax({
                        url : '?p=levels.editLevel',
                        method : 'POST',
                        data : $('#EDITLEVEL').serialize(),
                        success : function(response){

                            $('#editlevel').modal('hide'); // ferme la modal

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("Le niveau à bien était mis a jour !!!");

                            recupclassdiv('info_user', 3000);                        

                            TableLevel.ajax.reload(); //régénére la table                            
                            
                        }

                    });
                } 
            });

        });

        // function qui affiche la liste lieux en fonction du niveau //
        
        $('select[name=Levels]').on('change', function() {

            var id_level = $(this).val(); // on récupère l'id du niveau //
            var cat = $('#cat').val(); // récupére la catégorie du matériel //

            if (id_level != 1 && cat == 'SN') { // si level et différent de RDC // 

                $('.Nacelle').removeClass('hidden').addClass('display'); // affiche Nacelle //
                $('#nacl').val('1'); // ecris 1 dans input hidden nacelle //                

            } else {

                $('.Nacelle').removeClass('display').addClass('hidden'); // efface Nacelle //
                $('#nacl').val('0'); // ecris 0 dans input hidden nacelle //
            }
            
            load_SelectPlace(id_level, "Places"); // charge le select lieux //            
            
            $('#Rooms').empty(); // efface le select piéce //           
            
        });

    // LIEUX/PLACE //

        // function load Place affiche les lieux dans le select / inp = ref input //
        
        function load_SelectPlace(id_level, inp) {

            $('#'+inp).empty(); // vide le select lieux
            $('#btnplace').prop('disabled', false);            

            $.ajax({
                url: '?p=places.selectPlace',
                data: {id_level:id_level},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#'+inp).append('<option value="0" disabled selected>Choisir un lieux</option>');

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;

                        var places = reponse[i].lieux;                            

                        $("#"+inp).append('<option value="'+ id +'">'+ places +'</option>'); // remplis les données dans un select //

                    }                                                                   
                                        
                }
              
            });            
            
        }

        // function load place affiche le lieux dans le select en fonction du materiel primaire/ id mate // 

        function load_SelectPlaceMateLier(id) {

            $('#Places').empty(); // vide le select lieux
            $('#btnplace').prop('disabled', true);            

            $.ajax({
                url: '?p=places.selectPlaceMateLier',
                data: {id:id},
                method: 'POST',
                async: false,
                success: function(reponse) {                   

                    var id_place = reponse[0].id;

                    var places = reponse[0].lieux;                            

                    $("#Places").append('<option value="'+ id_place +'" selected>'+ places +'</option>'); // remplis les données dans un select //

                    load_SelectRoom(id_place);

                    load_SelectArmoire();                                                                                       
                                        
                }
              
            });

        }              

        // function charge le lieux form LevelPlace (id level + name level) //
            
        function load_Place(id, nlevel) {

            // affiche la table place//
            $('#viewPlace').removeClass('hidden').addClass('display');

             // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TablePlace')) {

                $('#TablePlace').DataTable().destroy();
            }

            $('#IdLevel').val(id); // ecris id level dans l'input //
            $('#NLevel').val(nlevel); // ecris name level dans l'input //

            let TablePlace = $('#TablePlace').DataTable({

            language: {url: "../public/media/French.json"},
            paging: false,
            search: false,            
            scrollY: '300px',
            ajax: {
                url:'?p=places.viewPlace',
                type: "POST",
                data: {id:id}
                },                
                columns: [
                    { data: "id" },
                    { data: "lieux" },
                    { render : function(data) { 

                            if (typeU == "administrateur") {

                                return `<button class='btn btn-primary btn-xs' data-role='EditPlace'<abbr title='Edition lieu'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                       `<button class='btn btn-warning btn-xs' data-role='DisplacePlace'<abbr title='Déplacement lieu'><span class='fa fa-refresh'></span></abbr></button> `+
                                       `<button type='submit' class='btn btn-danger btn-xs' data-role='deletePlace'<abbr title='Supprimé le lieu'><span class='glyphicon  glyphicon-trash'></span></abbr></button>`

                            } else {

                                return `<button class='btn btn-primary btn-xs' data-role='EditPlace'<abbr title='Edition lieu'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                       `<button class='btn btn-warning btn-xs' <abbr title='Déplacement lieu' disabled><span class='fa fa-refresh'></span></abbr></button> `+ 
                                       `<button type='submit' class='btn btn-danger btn-xs'<abbr title='Supprimé le lieu' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>`

                            }
                        }
                    }
                ]            

            });      

        }        

        // efface le fichier pdf enreg en pdf pour vmc /****???******/

        function deleteFilevmc(doc) {

            $.ajax({
                url: '?p=documents.deletefilevmc',
                data: {doc},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {
                                                                              
                    // affiche si le fichier a bien était effacé //
                                        
                }
                  
            });

        }     

        // function charge armoire si lieux change et si div CaractClim et visible //

        $('#Places').on('change', function() {

            var id_place = $(this).val(); // on récupère l'id du lieux //
            load_SelectRoom(id_place); // charge le select pièce

        });  

        // ADD PLACE //
        
        $(document).on('click', 'button[data-role=AddPlace]', function(){

            $('#addplace').modal('show'); // ouvre la modal add lieux //

            var id_level, level;            

            if ($('.AffLevelPlaceRoom').is(':visible') == true) {

                id_level = $('input[name=IdLevel]').val();
                level = $('input[name=NLevel]').val();

            } else {

                id_level = $('#Levels').val(); // récupére l'id du niveau        
                level = $('#Levels option:selected').text(); // récupére le niveau   
            } 

            if (id_level == 0) {

                $('#titrePlace').html("Veuillez choisir un niveau !!");
                $('#divPlaceAdd').addClass('hidden');
                $("#submitPlaceAdd").prop('disabled', true);

            } else {         
                
                $('#titrePlace').html("Ajout Lieu au niveau : " + level);
                $('#divPlaceAdd').removeClass('hidden');
                $('#Id_level').val(id_level); // inscris l'id dans un input hidden modal//
                $("#submitPlaceAdd").prop('disabled', false);
            }             

            $('#placeadd').on('change', function(){ 

                $("#success_place").removeClass('display').addClass('hidden');
                $("#error_place").removeClass('display').addClass('hidden');                 

                var place = $('#placeadd').val();

                if (place == "") {                   

                } else {

                    $.ajax({
                        url : '?p=places.checkedPlace',
                        method : 'POST',
                        data : {place:place, id_level:id_level},
                        dataType: 'json',
                        success : function(data){                                         

                            if (data == false ) {                                                    

                                // si le lieu n'existe pas ont fait l'enregistrement //                           

                                $('#AddPlace').validator().on('submit', function(event) {

                                    if (event.isDefaultPrevented()) {

                                    } else {
                                    
                                        event.preventDefault();
                                        
                                        var place = $('#placeadd').val(); // récupére le lieu //
                                        var id_level = $('#Id_level').val(); // récupére l'id du niveau                                                                                                               

                                        $.ajax({
                                            url : '?p=places.addPlace',
                                            method : 'POST',
                                            data : {place:place, id_level:id_level},
                                            success : function(data){

                                                // affiche success lieux ajouté // 
                                                $("#ModalInfoMate").modal('show');
                                                $("#affInfoMate")
                                                .removeClass('hidden')
                                                .addClass('alert alert-success success-dismissable')
                                                .html("Le lieu à bien était ajouté !!!");

                                                recupclassdiv('affInfoMate', 7000, 'ModalInfoMate');

                                                if ($('.AffLevelPlaceRoom').is(':visible') == true) {

                                                    load_Place(id_level); // id du niveau et name level

                                                } else {

                                                    load_SelectPlace(id_level, "Places");
                                                }                                                

                                                $('#AddPlace')[0].reset();
                                                $('#addplace').modal('hide');                                               

                                            }                    

                                        });
                                    }

                                });

                            } else { 

                                // msg d'erreur si le lieux existe  //         
                                 
                                $("#ModalInfoMate").modal('show');
                                $("#affInfoMate")
                                .removeClass('hidden')
                                .addClass('alert alert-danger danger-dismissable')
                                .html("Le lieux existe déja !!!");

                                recupclassdiv('affInfoMate', 7000, 'ModalInfoMate');
                                
                                $('#AddPlace')[0].reset();
                            }

                        }

                    });

                }

            });                        

        });

        // EDIT PLACE //
        
        $(document).on('click', 'button[data-role=EditPlace]', function(){

            $('#editplace').modal('show');

            let rowtableplace = $(this).closest('tr');
            let id = parseInt(rowtableplace.find('td:eq(0)').text()); // recupére id lieu /place//            
            let place = rowtableplace.find('td:eq(1)').text(); // récupére le text lieu //

            $('#place').val(place); // ecris dans l'input
            $('#placeId').val(id); // ecris dans l'input

            $('#EDITPLACE').validator().on("submit", function(event){

                let place = $('#place').val(); // récupére le lieu modifier
                let Idlevel = $('#IdLevel').val(); // récupére l'id niveau
                let Idplace = $('#placeId').val(); // récupére l'id lieux
                
                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();                                                             
                    
                    $.ajax({
                        url : '?p=places.editPlace',
                        method : 'POST',
                        data : {id:Idplace, place:place},
                        success : function(response){

                            $('#editplace').modal('hide'); // ferme la modal

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("Le lieu à bien était mis a jour !!!");

                            recupclassdiv('info_user', 3000);                                              

                            load_Place(Idlevel);
                            
                        }

                    });
                }
            });

        });

        // DISPLACE LIEUX/PLACE //
        
        $(document).on('click', 'button[data-role=DisplacePlace]', function(){

            $('#displaceplace').modal('show');
            var rowtableplace = $(this).closest('tr');
            var id = parseInt(rowtableplace.find('td:eq(0)').text()); // recupére id lieu /place//            
            var place = rowtableplace.find('td:eq(1)').text(); // récupére le text lieu //
            var NLevel = $('#NLevel').val(); // récupére le name niveau //
            var id_level = $('#IdLevel').val(); // récupére l'id niveau //

            $('.AffSelectPlace, .AffSelectLevel, .AffinfoDeplace').removeClass('display').addClass('hidden');
            $('#Place').html('Lieu --> Niveau actuel: '+ place + ' --> '+ NLevel);

            $('#action').on('change', function(){

                var action = $(this).val(); 

                if ( action == 1 ) { // 1 = lieux vers un autre lieux //

                    $('.AffSelectPlace').removeClass('hidden').addClass('display');
                    $('.AffSelectLevel').removeClass('display').addClass('hidden');                    
                    load_SelectPlace(id_level, "Places"); // charge le select lieux //
                    $('#Places option[value="'+id+'"]').prop('disabled', true).css('color', 'red');
                    $('#Levels').attr('required', false);
                    $('input[name=name]').val(place);

                    // faire une recherche pour voir si il existe une piéce attaché au lieux / id = id lieux //
                    
                    $.post('?p=rooms.checkedRoomBind',

                    {id : id}, function(data) {
                        
                        if (data.length != 0) {                  
                            
                            $('.AffinfoDeplace')
                            .addClass('alert alert-danger display')
                            .removeClass('hidden')
                            .html('<strong>Attention!</strong> Ce lieux à des piéces renseigner. Veuillez tout d\'abord déplacé celles-ci !!!');

                            $('#Places').attr('disabled', true);

                        } else {

                            $('.AffinfoDeplace').removeClass('display').addClass('hidden');
                            $('#Places').attr('disabled', false);
                        }

                    }); 
                    
                } else if (action == 2) { // 2 = du lieux vers un autre niveau //

                    $('.AffSelectLevel').removeClass('hidden').addClass('display');
                    $('.AffSelectPlace, .AffinfoDeplace').removeClass('display').addClass('hidden');
                    load_SelectLevel(); // charge le select niveau //
                    $('#Levels option[value="'+id_level+'"]').prop('disabled', true).css('color', 'red');
                    $('#Places').attr('required', false);
                } 

            });            

            $('#Levels').change(function(){
                var idl = $('#Levels option:selected').val();                
                $('input[name=idl]').val(idl);
            });

            $('#Places').change(function(){
                var idl = $('#Places option:selected').val();
                $('input[name=idl]').val(idl);
            });

            $('input[name=id]').val(id);

            $('#DISPLACEPLACE').validator().on("submit", function(event){ 

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault(); 

                    $.ajax({
                        url : '?p=places.DisplacePlace',
                        method : 'POST',
                        data : $('#DISPLACEPLACE').serialize(),
                        success : function(response){

                            $('#displaceplace').modal('hide'); // ferme la modal

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("Le lieu à bien était déplacé !!!");

                            recupclassdiv('info_user', 3000);

                            $('#DISPLACEPLACE')[0].reset();
                            
                            $('#viewRoom').removeClass('display').addClass('hidden');
                            // id_level = id lieux / NLevel = nom du lieux /
                            load_Place(id_level, NLevel);                                             
    
                        }

                    });
                }
            });

        });

        // affiche la table pièce en fonction du lieux selectionner //
        
        $('#TablePlace').on('click','tr', function (){

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9' }); // affiche le tr en gris //
            
            // recupére l'id du lieux//            
            let rowtableplace = $(this).closest('tr');
            let id = parseInt(rowtableplace.find('td:eq(0)').text());
            let place = rowtableplace.find('td:eq(1)').text();

            $('#viewRoom').addClass('hidden').removeClass('display');

            load_Room(id,place); // charge la table piéces (id du lieux) //       

        }); 

        // ouvre la modal add doc img pour vmc /**********??**********/
        
        $(document).on('click', 'button[data-role=addDocPlace]', function(){

            // recupére l'id sur le tr table vmc  //
            let rowtablevmc = $(this).closest('tr');
            let id = parseInt(rowtablevmc.find('td:eq(0)').text()); // recupére l'id du matériel //

            $('#MateID').val(id); // ecris l'id vmc dans input hidden //

            $('#ModalAddDoc').modal('show'); // ouvre la modal //
            $('.modal-title').html('Téléchargement de la zone VMC'); // ecris le title

            // affiche un btn voir le fichier télécharger //

            $('#file').on('change', function() {

                $('.ViewerPdf').removeClass('display').addClass('hidden');
                $('.AffbtnViewer').removeClass('hidden').addClass('display');

                $('.AffbtnViewer').on('click', function() {

                    $('.ViewerPdf').removeClass('hidden').addClass('display');

                });

                var size = document.getElementById('file').files[0].size;

            });

            $('#op').val('addF');
            $('#IndexUp').val('VMC');

        });

        // upload fichier doc img_vmc pdf  /*********???***********/
        
        $(document).on('click', 'button[data-role=uploadDocPlace]', function(){

            // recupére l'id sur le tr table vmc  //
            let rowtablevmc = $(this).closest('tr');
            let id = parseInt(rowtablevmc.find('td:eq(0)').text()); // recupére l'id du matériel //

            $('#MateID').val(id); // ecris l'id vmc dans input hidden //        

            $('#ModalAddDoc').modal('show'); // ouvre la modal                 
            $('.modal-title').html('Changement Zone VMC'); // ecris le title                                           

            // affiche un btn voir le fichier télécharger //

            $('#file').on('change', function() {

                $('.ViewerPdf').removeClass('display').addClass('hidden');
                $('.AffbtnViewer').removeClass('hidden').addClass('display');

                $('.AffbtnViewer').on('click', function() {

                    $('.ViewerPdf').removeClass('hidden').addClass('display');

                });

            });            

            $('input[name=op]').val('upF');
            $('#IndexUp').val('VMC');

            let doc = $(this).data('lien');
            $('#docenreg').val(doc);            

        });

        // validation du formulaire upload Place //
            
        $('#ValidateUploadPlace').validator().on("submit", function(event){                              

            if (event.isDefaultPrevented()) {

            } else {

                event.preventDefault();

                let op = $('#op').val(); // récupére addF ou upF
                let IndexUp = $('#IndexUp').val(); // récupére l'indexUp

                if (op == 'addF') {

                    // add files //                    

                    if (file) { // si files existe //

                        var form = $('#ValidateUploadPlace')[0];
                        var data = new FormData(form);

                        $.ajax({
                            url : '?p=documents.addfile', 
                            type : 'POST',
                            enctype : 'multipart/form-data',
                            data : new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false,
                            success : function(data){

                                $('#ModalAddDoc').modal('hide'); // ferme la modal 

                                $('#ValidateUploadPlace').trigger('reset'); // reset le formulaire

                                TableVmc.ajax.reload();                    
                            }
                        });    

                    }

                } else {

                    // update files //
                    
                    let deldoc = $('#docenreg').val();

                    if (file) { // si files existe //

                        var form = $('#ValidateUploadPlace')[0];
                        var data = new FormData(form);

                        $.ajax({
                            url : '?p=documents.upload', 
                            type : 'POST',
                            enctype : 'multipart/form-data',
                            data : new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false,
                            success : function(data){

                                $('#ModalAddDoc').modal('hide'); // ferme la modal                            

                                $('#ValidateUploadPlace').trigger('reset'); // reset le formulaire

                                TableVmc.ajax.reload();

                                deleteFilevmc(deldoc); 

                            }
                        });    

                    }
                }
            }
        });    

    // ROOM/PIECE //
        
       // function load room affiche les pièces dans le select/ id_place = lieux //
        
        function load_SelectRoom(id_place) {

            $('#Rooms').empty(); // vide le select pièce
            $('#btnroom').prop('disabled', false); // désactive le bouton add            

            $.ajax({
                url: '?p=rooms.selectRoom',
                data: {id_place:id_place},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#Rooms').append('<option value="0" disabled selected>Choisir une pièce</option>');

                    for (let i = 0; i < reponse.length; i++) {

                        let id = reponse[i].id;

                        let room = reponse[i].piece;                            

                        $("#Rooms").append('<option value="'+ id +'">'+ room +'</option>'); // remplis les données dans un select //

                    }                                                                   
                                        
                }
              
            });            
            
        }

        // function charge la pièce form LevelPlace (id place) & place = pour ecrire dans input hidden //
            
        function load_Room(id,place) {

            // affiche la table place//
            $('#viewRoom').removeClass('hidden').addClass('display');

             // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableRoom')) {

                $('#TableRoom').DataTable().destroy();
            }

            $('#IdPlace').val(id); // ecris id place dans l'input //
            $('#NPlace').val(place); // ecris le nom place dans l'input //

            let TableRoom = $('#TableRoom').DataTable({

            language: {url: "../public/media/French.json"},
            paging: false,
            search: false,
            ajax: {
                url:'?p=rooms.viewRoom',
                type: "POST",
                data: {id:id}
                },                
                columns: [
                    { data: "id" },
                    { data: "piece" },
                    { render : function(id, type, row) { 

                            if (typeU == "administrateur") {

                                return `<button class='btn btn-primary btn-xs' data-role='EditRoom'<abbr title='Edition pièce'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                       `<button class='btn btn-warning btn-xs' data-role='DisplaceRoom'<abbr title='Déplacement Piéce'><span class='fa fa-refresh'></span></abbr></button> `+
                                       `<button type='submit' class='btn btn-danger btn-xs' data-role='deleteRoom' data-id="`+ row.id +`"<abbr title='Supprimé la pièce'><span class='glyphicon  glyphicon-trash'></span></abbr></button>`

                            } else {

                                return `<button class='btn btn-primary btn-xs' data-role='EditRoom'<abbr title='Edition pièce'><span class='glyphicon glyphicon-pencil'></span></abbr></button> `+
                                       `<button class='btn btn-warning btn-xs'<abbr title='Déplacement Piéce' disabled><span class='fa fa-refresh'></span></abbr></button> `+ 
                                       `<button type='submit' class='btn btn-danger btn-xs'<abbr title='Supprimé la pièce' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>`

                            }
                        }
                    }
                ]            

            });      

        } 

        // ADD ROOM //
        
        $(document).on('click', 'button[data-role=AddRoom]', function(){

            $('#addroom').modal('show'); // ouvre la modal add pièce //

            var id_place, place; 

            if ($('.AffLevelPlaceRoom').is(':visible') == true) {

                id_place = $('#IdPlace').val();
                place = $('#NPlace').val();

            } else {

                id_place = $('#Places').val(); // récupére l'id du lieux        
                place = $('#Places option:selected').text(); // récupére le lieux  
            }                       
                
            $('#titreRoom').html("Ajout une pièce au Lieu: " + place);                
            $('#Id_place').val(id_place); // inscris l'id dans un input hidden //                                         

            $('#roomadd').on('change', function(){                 

                let room = $('#roomadd').val(); // récupére la valeur de l'input

                if (room == "") {                   

                } else {

                    $.ajax({
                        url : '?p=rooms.checkedRoom',
                        method : 'POST',
                        data : {id_place:id_place, room:room},
                        dataType: 'json',
                        success : function(data){                                     

                            if (data == false ) { 

                                $('#AddRoom').validator().on('submit', function(event) {

                                    if (event.isDefaultPrevented()) {

                                    } else {
                                    
                                        event.preventDefault();
                                        
                                        let room = $('#roomadd').val(); // récupére le lieu //
                                        var id_place = $('#Id_place').val(); // récupére l'id du lieux                                                                                                               

                                        $.ajax({
                                            url : '?p=rooms.addRoom',
                                            method : 'POST',
                                            data : {room:room, id_place:id_place},
                                            success : function(data){

                                                // affiche success pièce ajouté // 
                                                                                                
                                                $("#affinforoom")
                                                .removeClass('hidden')
                                                .addClass('alert alert-success success-dismissable')
                                                .html("La pièce à bien était ajouté !!!");                                                                         

                                                $('#AddRoom')[0].reset(); // reset le formulaire
                                                recupclassdiv('affinforoom', 3000, 'addroom');

                                                if ($('.AffLevelPlaceRoom').is(':visible') == true) {
                                                    load_Room(id_place, place); // charge la table piéces (id du lieux) //     
                                                } else {
                                                    load_SelectRoom(id_place);
                                                }

                                            }                    

                                        });
                                    }

                                });                        

                            } else { 

                                // msg d'erreur si la piéce existe //                                  
                                
                                $("#affinforoom")
                                .removeClass('hidden')
                                .addClass('alert alert-danger danger-dismissable')
                                .html("La piéce existe déja !!!");

                                recupclassdiv('affinforoom', 5000);
                                
                                $('#AddRoom')[0].reset();
                            }

                        }                

                    });                        
                }

            });

        });

        // EDIT ROOM //
        
        $(document).on('click', 'button[data-role=EditRoom]', function(){                

            $('#editroom').modal('show');

            var id_place = $('#IdPlace').val();
            var place = $('#NPlace').val();
            $('.Afftitle_room').html('Edition de la pièce du lieux ' + place );

            var rowtableroom = $(this).closest('tr');
            var id = parseInt(rowtableroom.find('td:eq(0)').text()); // recupére id room //            
            var room = rowtableroom.find('td:eq(1)').text(); // récupére le text pièce //

            $('#room').val(room); // ecris dans l'input
            $('#roomId').val(id); // ecris dans l'input

            $('#EDITROOM').validator().on("submit", function(event){

                var room = $('#room').val(); // récupére la pièce modifier                     
                var Idroom = $('#roomId').val(); // récupére l'id room
                
                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();                                                             
                    
                    $.ajax({
                        url : '?p=rooms.editRoom',
                        method : 'POST',
                        data : {id:Idroom, room:room},
                        success : function(response){

                            $('#editroom').modal('hide'); // ferme la modal

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("La pièce à bien était mis a jour !!!");

                            recupclassdiv('info_user', 3000);                                              

                            load_Room(id_place);
                            
                        }

                    });
                }
            });

        });

        // DISPLACE ROOM //
        
        $(document).on('click', 'button[data-role=DisplaceRoom]', function(){

            $('#displaceroom').modal('show'); // ouvre la modal //
            var rowtableroom = $(this).closest('tr');
            var id = parseInt(rowtableroom.find('td:eq(0)').text()); // recupére id piéce /room//            
            var room = rowtableroom.find('td:eq(1)').text(); // récupére le text piéce //
            var NPlace = $('#NPlace').val(); // récupére le name lieux //

            $('#Room').html('Piéce --> Lieux actuel: '+ room + ' --> '+ NPlace);

            var id_level = $('#IdLevel').val(); // récupére l'id niveau //
            var idp = $('input[name=IdPlace]').val(); // récupére id place selectionner //

            load_SelectPlace(id_level, "PlacesR"); // charge le select lieux //
            $('#PlacesR option[value="'+idp+'"]').prop('disabled', true).css('color', 'red');

            $('#PlacesR').change(function(){
                var idpdr = $('#PlacesR option:selected').val();
                $('input[name=idp]').val(idpdr);
            });

            $('input[name=id]').val(id); // ecris id piéce dans input hidden //

            $('#DISPLACEROOM').validator().on("submit", function(event){ 

                var idpdr = $('input[name=idp]').val(); // récupére id place pour déplacement //               

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault(); 

                    // id = id piéce /idpdr = id lieux displace room //                                                             
                    
                    $.ajax({
                        url : '?p=rooms.DisplaceRoom',
                        method : 'POST',
                        data : {id:id, idpdr:idpdr},
                        success : function(response){

                            $('#displaceroom').modal('hide'); // ferme la modal

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("La piéce à bien était déplacé !!!");

                            recupclassdiv('info_user', 3000);     

                            $('#DISPLACEROOM')[0].reset();                                       

                            load_Room(idp);
                            
                        }

                    });
                }
            });

        });

        // DELETE ROOM //
        
        $(document).on('click', 'button[data-role=deleteRoom]', function(){

            var id = $(this).data('id'); // id = id room //
            var id_place = $('#IdPlace').val(); // id_place //

            if(confirm("Voulez-vous vraiment supprimer la piéce ?"))
                {
                   $.ajax({
                        url:"?p=rooms.deleteRoom",
                        method: 'POST',
                        data:{id : id},                            
                        success: function(data) {

                            load_Room(id, id_place); // reset la table room //                                                       
                            
                        }
                     
                    });
                }

        });       

    // FLUIDE //
        
        // function qui rempli le select armoire //
        
        $('#fluide').on('change', function() {

            let op = $('#operation').val();

            if (op != 'Edit') {

                load_SelectArmoire();
            }

        });

    // ARMOIRE //
         
        if ($('#TableArmoire').is(':visible') == true) {                

            $('a.item-M').attr('class', 'active');
            $('ul.item-m').attr('style', 'display:block;');
            $('li.item-ea').attr('class', 'active');               
    
            // affiche la table armoire //
            
            var TableArmoire = $('#TableArmoire').DataTable({

                language: {url: "../public/media/French.json"},
                lengthMenu: [10, 15, 25, 50],
                paging: true,
                ajax: {
                    url:'?p=armoires.viewArmoire',
                    type: 'POST',
                    dataType: 'json'
                },                
                columns: [
                    { data: "id" },
                    { data: "nom_arm" },
                    { data: "type" },
                    { data: "niveau" },
                    { data: "lieux" },
                    { render: function(data) { 

                            if (typeU == "administrateur") {

                                return `<button class='btn btn-primary btn-xs' data-role='EditArm'<abbr title='Edition Armoire'><span class='glyphicon glyphicon-pencil'></span></abbr></button> ` +
                                       `<button type='submit' class='btn btn-danger btn-xs btn_supA' data-role='deleteArm'<abbr title='Supprimé l'armoire><span class='glyphicon  glyphicon-trash'></span></abbr></button>`

                            } else {

                                return `<button class='btn btn-primary btn-xs' data-role='EditArm'<abbr title='Edition Armoire'><span class='glyphicon glyphicon-pencil'></span></abbr></button> ` + 
                                       `<button type='submit' class='btn btn-danger btn-xs btn_supA' data-role='deleteArm'<abbr title='Supprimé l'armoire disabled=''><span class='glyphicon  glyphicon-trash'></span></abbr></button>`
                            }

                        }

                    }
                ]            

            });
        }
    
        // function select armoire / type = ELEC par défault ou INFO //
        
        function load_SelectArmoire(type) {

            var type = typeof type !== "undefined" ? type : "ELEC";

            $('#btnarm').prop('disabled', false); // active le btn armoire

            $.ajax({
                url: '?p=armoires.selectArmoire',
                method: 'POST',
                data: {type,type},
                async: false,
                success: function(reponse) {

                    $('#arm option').remove();

                    $("#arm").append('<option value=" " selected disabled>Veuillez choisir une armoire</option>'); // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;
                        var nomarm = reponse[i].nom_arm;
                        var nivelid = reponse[i].niveau;                            

                        $("#arm").append('<option value="'+ id +'">'+ nomarm + ' - '+ nivelid +'</option>'); // remplis les données dans le select //

                    }           
                }
            }); 
        }


        // function qui charge l'armoire divisionnaire en fonction du bandeau /********AC**AT*****/
        
        function load_arm(nomslc) {
           
            $.post('?p=armoires.checkedArm',

            {arm : nomslc}, function(data) { 

                if (data.length == 0) {

                    $('#Armoir').val('Aucune armoire pour ce bandeau');

                } else {

                    $('#Armoir').val(data[0].nom_arm);
                    $('#Niv').val(data[0].niveau);
                }                    

            }); 

        }

        // ADD ARM //
        
        $(document).on('click','button[data-role=AddArm]', function() {

            var type = $(this).data('type');
            $('#type').val(type);

            $('#addarm').modal('show'); //ouvre la modal add armoire //

            // efface les messages //
            $("#error_arm").removeClass('display').addClass('hidden');

            $('#Titrearm').html("Ajout Armoire"); // ecris dans le title //

            load_SelectLevel();

            $('#n_arm').on('change', function(){

                let arm = $('#n_arm').val();
                
                if (arm == " ") {
                   
                   // on ne fait rien //

                } else {

                    $.ajax({
                        url : '?p=armoires.checkedArm',
                        method : 'POST',
                        data : {arm:arm},
                        dataType: 'json',
                        success : function(data){                                         

                            if (data.length == 0 ) {
                                // efface le message erreur //
                                $("#error_arm").removeClass('display').addClass('hidden');                                                         

                                // si l'armoire n'existe pas ont fait l'enregistrement //                           

                                $('#AddArm').validator().on('submit', function (event) {

                                    if (event.isDefaultPrevented()) {

                                    } else {
                                    
                                        event.preventDefault();                                                                                                                                                           

                                        $.ajax({
                                            url : '?p=armoires.addArm',
                                            method : 'POST',
                                            data : $('#AddArm').serialize(),
                                            success : function(data){ 

                                                // affiche success armoire ajouté //                                                  

                                                $('#n_arm').empty(); // vide le champ nom_arm //
                                                $('#AddArm')[0].reset(); // reset le formulaire add armoire //
                                                $('#addarm').modal('hide'); // ferme la modal //                                                   

                                                if (type == "INFO") {
                                                    var Type = type;
                                                }

                                                load_SelectArmoire(Type); //charge le select armoire //                                                                                               

                                            }                    

                                        });                                           
                                    }

                                });

                            } else { 

                                // msg d'erreur si l'armoire  existe  //                                             
                                
                                $("#error_arm")
                                .removeClass('hidden')
                                .addClass('alert alert-danger danger-dismissable')
                                .html("L'armoire existe déja !!!");
                                                
                                recupclassdiv('error_arm', 3000);

                                $('#AddArm')[0].reset();
                            }

                        }

                    });

                } 
            });

        });

        // EDIT ARM //
        
        $(document).on('click', 'button[data-role=EditArm]', function() {

            $('#editarm').modal('show');
            var rowtablearm = $(this).closest('tr');
            var id = parseInt(rowtablearm.find('td:eq(0)').text());

            $.post('?p=armoires.findArmoire',

                {id : id}, function(data) {                
                    
                // ecris dans les inputs
                $('#arm').val(data[0].nom_arm);
                $('#type').val(data[0].type);
                load_SelectLevel(); 
                var LevelId = data[0].niveau_id;
                $('#Levels option[value="' + LevelId +'"]').attr('selected', true); 
                $('#lieux').val(data[0].lieux); 
                $('#armId').val(id);   

            });           

            $('#EDITARM').validator().on("submit", function(event){                            

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();                                                                 

                    $.ajax({
                        url : '?p=armoires.editArm',
                        method : 'POST',
                        data : $('#EDITARM').serialize(),
                        success : function(response){

                            $('#editarm').modal('hide'); // ferme la modal
                            $("#info_arm")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html('L\'armoire à bien était modifié !!!');

                            recupclassdiv('info_arm', 3000);
                            TableArmoire.ajax.reload(); //régénére la table                                                                                                                  
                            
                        }

                    });
                }
            });     
            
        });

        // function qui affiche les boutons validation & suppr //
        
        $('#arm').on('change', function() {

            $('.affbtns').removeClass('hidden').addClass('display');

        });                 

    // PANNES //
        
        if ($('#TablePanne').is(':visible') == true) {

            $('a.item-P').attr('class', 'active');
            $('ul.item-p').attr('style', 'display:block;');
            $('li.item-lp').attr('class', 'active');
        }

        // AFF Pannes ALL //        

        $('#TablePanne').DataTable({

            language: {url: "../public/media/French.json"},
            scrollY: '50vh',
            scrollX: true,
            scollCollapse: true,
            paging: true,
            order: [[0, 'desc']],
            ajax: {
                url:'?p=pannes.all',
                type: "POST"
                },               
                columnDefs: [

                    {
                        render: function(data, type, row) {                            
                                
                            return '<a href="?p=pannes.mate&id='+ row.idmate +'">' + data + '</a>';
                                                       
                        },

                        targets: [5]
                    },
                    { targets: [4], 
                      visible: false,
                      searchable: false
                    },
                    {
                      targets: [3],
                      Width : '5px'
                    }
                ],
                columns: [                       
                    { data: "id" },
                    { data: "datepannefr" },
                    { data: "heurepannefr" },
                    { data: "designation" },
                    { data: "idmate" },
                    { data: "num_inventaire" },
                    { data: "mate" },
                    { data: "mtr",
                      render: function(data, type, row) {
                                
                        if (row.mfr == null && row.mfi == null) {
                            return mtr = '0.00 €';
                        } else {
                            mfr = Number(row.mfr);
                            mfi = Number(row.mfi);
                            mtr = mfr + mfi;
                            return mtr.toFixed(2) +' €';
                        }                           
                      }                    
                    },
                    { data: "etat_panne",

                        render: function(data, type) {

                            if(data === 'Attente Intervention Interne') {
                               
                                return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Attente Appel Intervenant') {

                                return '<a class="btn-theme03 btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Attente Intervention') {

                                return '<a class="btn-theme04 btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Non Réparé') {

                                return '<a class="btn-info btn-xs btn-round" disabled>'+  data +'</a>'

                            } else if (data === 'Attente Réparation') {

                                return '<a class="btn-theme btn-xs btn-round" disabled>' + data +'</a>'

                            } else if (data === 'Attente diagnostique') {

                                return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Attente Devis') {

                                return '<a class="btn-primary btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Réparation en cours') {

                                return '<a class="btn-success btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Réparation non terminé') {

                                return '<a class="btn-theme02 btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if(data === 'Terminé') {
                               
                                return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>'

                            } else {

                                return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>'
                            }                      

                            return data
                        }
                    }                    
                    
                ] 
        });

        // AFF Pannes en attente //        

        $('#TablePanneAttRep').DataTable({

            language: {url: "../public/media/French.json"},
            scrollY: '50vh',
            scrollX: true,
            scollCollapse: true,
            paging: true,
            ajax: {
                url:'?p=pannes.attenterep',
                type: "POST"
                },               
                columnDefs: [

                    {
                        render: function(data, type, row) {                            
                                
                            return '<a href="?p=pannes.mate&id='+ row.idmate +'">' + data + '</a>';
                                                        
                        },

                        targets: [5]
                    },

                    { targets: [4], 
                      visible: false,
                      searchable: false
                    }
                ],
                columns: [                       
                    { data: "id" },
                    { data: "datepannefr" },
                    { data: "heurepannefr" },
                    { data: "designation" },
                    { data: "idmate" },
                    { data: "num_inventaire" },
                    { data: "mate" },
                    { data: "mtr",
                      render: function(data, type, row) {
                                
                        if (row.mfr == null && row.mfi == null) {
                            return mtr = '0.00 €';
                        } else {
                            mfr = Number(row.mfr);
                            mfi = Number(row.mfi);
                            mtr = mfr + mfi;
                            return mtr.toFixed(2) +' €';
                        }                           
                      }                    
                    },
                    { data: "etat_panne",

                        render: function(data, type) {

                            if(data === 'Attente Intervention Interne') {
                               
                                return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Attente Appel Intervenant') {

                                return '<a class="btn-theme03 btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Attente Intervention') {

                                return '<a class="btn-theme04 btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Non Réparé') {

                                return '<a class="btn-info btn-xs btn-round" disabled>'+  data +'</a>'

                            } else if (data === 'Attente Réparation') {

                                return '<a class="btn-theme btn-xs btn-round" disabled>' + data +'</a>'

                            } else if (data === 'Attente diagnostique') {

                                return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Attente Devis') {

                                return '<a class="btn-primary btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Réparation en cours') {

                                return '<a class="btn-success btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Réparation non terminé') {

                                return '<a class="btn-theme02 btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if(data === 'Terminé') {
                               
                                return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>'

                            } else {

                                return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>'
                            }                      

                            return data
                        }
                    }                    
                    
                ] 
        });

        // AFF Pannes volets en attente de Réparation //        

        $('#TablePanneAttRepVolet').DataTable({

            language: {url: "../public/media/French.json"},
            scrollY: '50vh',
            scrollX: true,
            scollCollapse: true,
            paging: true,
            ajax: {
                url:'?p=pannes.attenterepvolet',
                type: "POST"
                },               
                columnDefs: [

                    {
                        render: function(data, type, row) {                            
                                
                            return '<a href="?p=pannes.mate&id='+ row.idmate +'">' + data + '</a>';
                                                        
                        },

                        targets: [5]
                    },

                    { targets: [4], 
                      visible: false,
                      searchable: false
                    }
                ],
                columns: [                       
                    { data: "id" },
                    { data: "datepannefr" },
                    { data: "heurepannefr" },
                    { data: "designation" },
                    { data: "idmate" },
                    { data: "num_inventaire" },
                    { data: "mate" },
                    { data: "lieux" },
                    { data: "piece" },
                    { data: "mtr",
                      render: function(data, type, row) {
                                
                        if (row.mfr == null && row.mfi == null) {
                            return mtr = '0.00 €';
                        } else {
                            mfr = Number(row.mfr);
                            mfi = Number(row.mfi);
                            mtr = mfr + mfi;
                            return mtr.toFixed(2) +' €';
                        }                           
                      }                    
                    },
                    { data: "etat_panne",

                        render: function(data, type) {

                            if(data === 'Attente Intervention Interne') {
                               
                                return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Attente Appel Intervenant') {

                                return '<a class="btn-theme03 btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Attente Intervention') {

                                return '<a class="btn-theme04 btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Non Réparé') {

                                return '<a class="btn-info btn-xs btn-round" disabled>'+  data +'</a>'

                            } else if (data === 'Attente Réparation') {

                                return '<a class="btn-theme btn-xs btn-round" disabled>' + data +'</a>'

                            } else if (data === 'Attente diagnostique') {

                                return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Attente Devis') {

                                return '<a class="btn-primary btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Réparation en cours') {

                                return '<a class="btn-success btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if (data === 'Réparation non terminé') {

                                return '<a class="btn-theme02 btn-xs btn-round" disabled>'+ data +'</a>'

                            } else if(data === 'Terminé') {
                               
                                return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>'

                            } else {

                                return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>'
                            }                      

                            return data
                        }
                    }                    
                    
                ] 
        });

        // AFF Pannes par matériel dans page materials /id = idmate si index = All -- sinon id = idpanne si index = Select //
        function affPanneMate(id, index) {
            
            // affiche la div de la table panne //
            $('.AffPannes').removeClass('hidden').addClass('display');            

            if (index == 'Select') {

                $('.AffMontant').removeClass('hidden').addClass('display'); // affiche //

            } else {

                $('.AffMontant').removeClass('display').addClass('hidden'); // efface //
            }           

            // affiche la table panne //
            $.ajax({
                url: '?p=pannes.affPanne',
                data: {id:id, index:index},
                method: 'post',
                success: function(data) {

                   $('#TablePanneMate').html(data);

                }
                  
            });                       
           
        }

        // function qui remonte le nombre de panne matériel // id matériel //
        function nbrPannesMate(id){

            let nbr;

            $.ajax({
                url: '?p=pannes.nbrPannesMate',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                
                    
                    if (reponse == false ) {                   
                        
                        nbr = 0;

                    } else {                   
                        
                        nbr = reponse[0].nbrpannes;

                    }                    

                    // affiche le nbr de matériel lier //                    
                    $('li[role=presentation1]').html('<a href="#" data-role="VPannesMat">Pannes du matériel ('+ nbr +')</a>');
                }
                
            });             
        }

        // function qui verifie l'etat de la derniére panne // id matériel //
        function CheckedPanne(id){

            // verification de panne et intervention active ou non //
            $.ajax({
                url: '?p=pannes.checkedPanne',
                data: {id:id},
                method: 'POST',
                success: function(reponse) {                  
                
                    let i = reponse.length -1; // récupére le nombre d'objet //
                    let etatpanne = reponse[i].etat_panne;
                    let etatinterv = reponse[i].etat_interv;
                    let statut = reponse[0].statut;                     

                    $('.h2Panne')
                    .html('Panne ')
                    .append('<button class="btn btn-round btn-warning" id="btnAddPanne" data-role="ADDPanne"<abbr title="Ajouter une panne"><span class="glyphicon glyphicon-plus"></span></abbr></button>');            

                    if (statut == "Rebus") {

                        $('#btnAddPanne').prop('disabled', true).attr('title', 'Matériel au Rebus !!!');

                    } else {

                        if (etatinterv == null || etatinterv == 'Terminé') {

                            // pas d'interv en cours //

                            if (etatpanne == null || etatpanne == 'Terminé') {                                             

                                // panne null ou terminé //
                                $('#btnAddPanne').prop('disabled', false);                                                                                                       

                            } else if(etatpanne !== 'Terminé') {                           

                                // panne en cours //
                                $('#btnAddPanne').prop('disabled', true).attr('title', 'Panne en cours !!!');                                 

                            } 

                        } else if (etatinterv == 'En Cours') {

                            // interv en cours //
                            $('#btnAddPanne').prop('disabled', true).attr('title', 'Intervention en cours !!!');
                            
                        } 
                    }

                    btnAddEvent(etatpanne, statut); // verifie si il faut enable ou disabled le btn add event //
                    btnAddMatLier(statut);                                                                             
                                                    
                }
                  
            }); 
        }           

        // affiche les pannes par matériel selectionner //

        if ($('.AffDataMate').is(':visible') == true || $('.AffDataMateLier').is(':visible') == true) {

            let id = $('#IDmate').val(); // id = matériel
            affdatamateselect(id);                                                  

            // efface l'info mate, les class panne , matelier, evenement , intervenant //
            $('#info_mate, .AffMatP, .AffPannes, .AffMatesLier, .AffEvents, .AffContribu, .AffMontant').removeClass('display').addClass('hidden');
            
            // affiche les données Montant Devis/ interv /total Réparations //id mat//                    
            CountQuotat(id);
            countIntervt(id);
            countRepairt(id);            
            countIntervCM(id);

            // affiche les btn add fact achat et prix achat //
            checkedDocFactachat(id);

            // aff le nbrs pannes //id mate//
            nbrPannesMate(id);
            // aff le nbrs d'interv sans panne //id mate //
            nbrIntervSansPanne(id);
            // find nbrs material lier //                    
            NbrMateLier(id);                

            // verifie le statut du matériel //            
            $.post('?p=materials.affStatut',
                {id:id},

                function(data) {

                    let statut = data[0].statut;

                    if (statut == "En Panne" || statut == "Actif") {

                        $('li[role=presentation1]').attr('class', 'active'); // actif par défaut //
                        // affiche la table panne en fonction du matériél selectionner //                        
                        affPanneMate(id, 'All'); // id matériel //

                    } else if(statut != "Actif") {

                        $.post('?p=intervs.checkedStatutInterv',

                        {id : id}, function(data) {                
                            
                            if(data[0].category_int == "SP") {

                                $('li[role=presentation2]').attr('class', 'active'); // actif par défaut //
                                AffIntervSP(id, "All");
                                btnAddIntervSP(statut);
                                $('.AffDataPanne').removeClass('hidden').addClass('display'); // affiche la class 

                            } else { // CM //

                                $('li[role=presentation4]').attr('class', 'active'); // actif par défaut //
                                AffIntervCM(id);
                                btnAddIntervCM(statut);
                            }

                      });

                    }                             
              
            });            
            
            // verifie l'état de la panne //
            CheckedPanne(id); // verifie l'etat de la panne et active ou désactive les btn // id matériel //

            // affiche BTNhaut //
            $('#BtnHaut').removeClass('hidden').addClass('display');
        
        }  

        // affiche onglet pannes du matériel & matériel lier si catégorie produit = P //
        
        $(document).on('click', 'a[data-role=VPannesMat]', function() {

            $('li[role=presentation1]').attr('class', 'active');
            $('li[role=presentation2]').attr('class', 'display');                      

            if ($("#CateProduit").val() === 'P') {

                $('li[role=presentation3]').attr('class', 'display');

            } else {
                
                $('li[role=presentation3]').attr('class', 'hidden');
            }

            if ($('#contrat').prop('class') != "display") {
                $('li[role=presentation4]').attr('class', 'hidden');
            } else {
                $('li[role=presentation4]').attr('class', 'display');  
            }
                      

            $('.AffPannes').removeClass('hidden').addClass('display'); // affiche la class  Aff pannes
            $('.AffDataPanne, .AffMatesLier, .AffBtnFACT, .AffBtnCERT').removeClass('display').addClass('hidden'); // efface la class AffdataMate & Materiels lier

            let id = $('#IDmate').val(); // id matériel

            affPanneMate(id, 'All'); // id mate - index All //

        });                                      
        
        // Add Panne //
            
        $(document).on('click','button[data-role=ADDPanne]', function(){

            $('.AffDataPanne, .AffMontant').removeClass('display').addClass('hidden'); // efface les class  //
            var id = $('#IDmate').val();// récupére l'id mate du DOM //
            let mate = $('#mate').text(); // récupére le nom du matériel du DOM //
            
            $('#panne').modal('show'); // ouvre la modal //
            $('.modal-title').html('Ajout de Panne');
            // donne l'heure //
            let t = heurebd();
            $('#HeurePanne').val(t);

            $('#Designation').val(" "); // efface le champ textarea

            $('input[name=Mate]').val(mate); // ecris dans input hidden //                        
            $('#MateId').val(id); // ecris id mat dans l'input hidden

            let catprod = $('#CateProduit').val(); // récupére la catégorie produit //
            $('input[name=CatProd]').val(catprod); // ecris dans input hidden //

            $('#IndexP').val('add'); // ecris dans input hidden                                      

        }); 

        // edition panne //
        
        $(document).on('click', 'button[data-role=EditPanne]', function(){         

            var rowtablepanne = $(this).closest('tr');
            var id = parseInt(rowtablepanne.find('td:eq(0)').text()); // récupére l'id de la panne //
            var etat = rowtablepanne.find('td:eq(5)').text(); // récupére l'id de la panne //

            if (typeU != "administrateur" && etat == "Terminé") {

                $("#info_panne")
                .removeClass('hidden')
                .addClass('alert alert-danger danger-dismissable col-sm-8')
                .html("Panne terminé impossible de l'éditer !!!");
                
                recupclassdiv('info_panne', 7000);

            } else {               

                $('#panne').modal('show');  // ouvre la modal panne pour edition //
                $('.modal-title').html('Edition de la Panne n°:' + id); // ecris le title //

                var datepanne = rowtablepanne.find('td:eq(2)').text(); // récupére la date //
                var heurepanne = rowtablepanne.find('td:eq(3)').text(); //recupére l'heure //

                // retourne la date //
                var parts = datepanne.split(/-/);
                parts.reverse();
                var datereverse = (parts.join('-'));
                $("#DatePanne").val(datereverse); // affiche la date enregistrer
                $('#HeurePanne').val(heurepanne); // affiche l'heure enregister
                
                var designation = rowtablepanne.find('td:eq(4)').text();
                $('#Designation').val(designation);                        

                $('#Idpanne').val(id);// insert l'id panne dans l'input //
                $('#IndexP').val('edit');// insert l'index dans l'input //
            }
            
        });

        // validation add & edition panne //
        
        $('#PANNE').validator().on('submit', function (event) {
            
            let id;
            let action = $('#IndexP').val();  // index add ou edit //
            let mate = $('input[name=Mate]').val(); // récupére le nom du matériel//

            if ($('.AffEvents').is(':visible') == true){ // affichage d'une seul panne //
                id = $('#IDPanne').val(); // récupére id panne sur le DOM //
            } else {
                id = $('#IDmate').val(); // récupére l'id mate du DOM //
            }

            let invent = $('input[name=invent]').val(); // récupére le numéro d'inventaire sur le DOM // 

            var datep = $(this).find('input[name=DatePanne]').val();
            var d = getCurrentDate();           

            if (event.isDefaultPrevented()) {

            } else {

                event.preventDefault();

                if (action == 'add') {

                    var tab = [$('#DatePanne').val(), $('#HeurePanne').val(), mate, $('#Designation').val(), id, invent];

                    $.ajax({
                        url : '?p=pannes.add', 
                        method : 'POST',
                        data : $('#PANNE').serialize(),
                        success : function(data){

                            $("#info_panne")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("La panne à bien était ajouté !!!");

                            $('#PANNE').trigger('reset'); // reset le formulaire                                  
                            $('#panne').modal('hide'); // ferme la modal //                     
                            affStatutMate(id);// affiche le statut du materiel //  
                            affPanneMate(id, 'All'); // id matériel //                                                                 
                            recupclassdiv('info_panne', 7000);
                            nbrPannesMate(id); // id materiel //

                            // verifie l'état de la panne //
                            CheckedPanne(id); // id matériel //

                            // envoi un email a la technique / etat = add / tab / Etat //
                            
                            if(confirm("Voulez-vous envoyer le mail?")) {
                                sendmail_Tech('add',tab);
                            }                           
                            
                            notif();
                        }                    

                    });

                } else if (action == 'edit') {

                    $.ajax({
                        url : '?p=pannes.edit', 
                        method : 'POST',
                        data : $('#PANNE').serialize(),
                        success : function(reponse){

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-sm-6')
                            .html("La panne à bien était mis à jour !!!");

                            $('#PANNE').trigger('reset'); // reset le formulaire                           
                            $('#panne').modal('hide');

                            // reinitialise la table panne //
                            if ($('.AffEvents').is(':visible') == true){ // affichage d'une seul panne //

                                affPanneMate(id, 'Select');// id panne //
                            }  else {
                                
                                affPanneMate(id, 'All');// id matériel //
                            }                                                  
                            
                            recupclassdiv('info_user', 7000);
                        }                    

                    }); 
                }

            }
        });

        // affiche evenements panne si des événements existe  //
        
        $('#TablePanneMate').on('click','tr td', function(){

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9'}); // affiche le tr en gris //

            $('.AffDataPanne, .AffQuota, .AffContribu, .AffIntervs, .AffSendMail').removeClass('display').addClass('hidden'); //efface les class //
            // recupére l'id de la panne & etat panne//            
            let rowtablepanne = $(this).closest('tr');
            let id = parseInt(rowtablepanne.find('td:eq(0)').text()); // id panne             
            let etatpanne = rowtablepanne.find('td:eq(5)').text();

            $('#IDPanne').val(id); // ecris dans l'input
            $('.AffDataPanne, .AffNavs2').removeClass('hidden').addClass('display'); // affiche les class

            affPanneMate(id, 'Select');

            NbrInterv(id); // id panne           

            // remonte la somme des montant devis, interv,repair //id panne//            
            $('.showbackmd, .showbackmr').attr('hidden', false); //efface l'attribut hidden 
            $('.showbackmi').removeClass('col-sm-12').addClass('col-sm-4'); // reduit la largeur de la div

            CountQuota(id);
            countInterv(id);
            countRepair(id);

            if (etatpanne == 'Attente Devis' || etatpanne == 'Devis En Attente' || etatpanne == 'Attente Devis Réactualisé' || etatpanne == 'Devis Reçu') { 

                $(".AffEvents").removeClass('display').addClass('hidden'); // efface la class //

                AffQuota(id); // affiche la table devis //
                NbrQuota(id,'1'); // id panne /presentation7 - 1 = active //

            } else {

                NbrQuota(id,'2'); // id panne /presentation7 - 2 = display //
                checkedEventPanne(id, 'mate'); 
            }                 
            
        });                        

    // INTERVENTIONS //
     
        if ($('#TableIntervs').is(':visible') == true) {

            $('a.item-In').attr('class', 'active');
            $('ul.item-in').attr('style', 'display:block;');
            $('li.item-lin').attr('class', 'active');

        }

        // reinitialise la table interv avec panne //
        if ($.fn.dataTable.isDataTable('#TableIntervs')) {

            $('#TableIntervs').DataTable().destroy();

        } else {

            // AFF Interv des Pannes //        

            let TableIntervs = $('#TableIntervs').DataTable({

                language: {url: "../public/media/French.json"},
                lengthMenu: [
                    [10, 15, 25, -1],
                    [10, 15, 25, 'All']
                ],            
                processing: true,
                scrollY: '50vh',
                scrollX: true,
                scollCollapse: true,
                paging: true,
                order: [[0, 'desc']],
                ajax: {
                    url:'?p=intervs.all',
                    type: "POST"
                    },               
                    
                    columnDefs: [                    

                        {
                        render: function(data, type, row) {

                            if(row.mat_lier === '1') {

                                return '<a href="?p=pannes.pmatelier&id='+ row.idmate +'">' + data + '</a>';

                            } else {
                                
                                return '<a href="?p=pannes.mate&id='+ row.idmate +'">' + data + '</a>';
                            }                            
                        },

                        targets: [6]
                        },

                        { targets: [5], 
                          visible: false,
                          searchable: false
                        }
                    ],
                    columns: [                       
                        { data: "id" },
                        { data: "dateintervfr" },
                        { data: "heureintervfr" },
                        { data: "pannes_id"},
                        { data: "type_interv" },
                        { data: "idmate" },
                        { data: "num_inventaire" },
                        { data: "mate" },
                        { data: "nom" },
                        { data: "mfi",
                            render: function(data, type, row) {
                                    
                                if (row.mfi == null) {
                                    return mfi = '0.00 €';
                                } else {                              
                                    
                                    return Number(row.mfi).toFixed(2) +' €';
                                }                            
                            }
                        },
                        { data: "etat_interv",

                            render: function(data, type) {

                                if (data === 'En Cours') {

                                    return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>';                                

                                } else if(data === 'Terminé') {
                                   
                                    return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>';

                                } else {

                                    return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>';
                                }
                                
                            }
                        }                    
                        
                    ] 
            });
            
        }        

        // reinitialise la table interv en cours //
        if ($.fn.dataTable.isDataTable('#TableIntervsEnCours')) {

            $('#TableIntervsEnCours').DataTable().destroy();

        } else {

            $('#TableIntervsEnCours').DataTable({

                language: {url: "../public/media/French.json"},            
                processing: true,
                scrollX: true,
                scrollY: '50vh',
                scollCollapse: true,
                paging: true,
                ajax: {
                    url:'?p=intervs.affintervsencours',
                    type: "POST"
                    },
                    columnDefs: [                    

                        {
                        render: function(data, type, row) {

                            if(row.mat_lier === '1') {

                                return '<a href="?p=pannes.pmatelier&id='+ row.idmate +'">' + data + '</a>';

                            } else {
                                
                                return '<a href="?p=pannes.mate&id='+ row.idmate +'">' + data + '</a>';
                            }                            
                        },

                        targets: [6]
                        },

                        { targets: [5], 
                          visible: false,
                          searchable: false
                        }
                    ],
                    columns: [                       
                        { data: "id" },
                        { data: "dateintervfr" },
                        { data: "heureintervfr" },
                        { data: "pannes_id"},
                        { data: "type_interv" },
                        { data: "idmate" },
                        { data: "num_inventaire" },
                        { data: "mate" },
                        { data: "nom" },
                        { data: "mfi",
                            render: function(data, type, row) {
                                    
                                if (row.mfi == null) {
                                    return mfi = '0.00 €';
                                } else {                              
                                    
                                    return Number(row.mfi).toFixed(2) +' €';
                                }                            
                            }
                        },
                        { data: "etat_interv",

                            render: function(data, type) {

                                if (data === 'En Cours') {

                                    return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>';                                

                                } else if(data === 'Terminé') {
                                   
                                    return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>';

                                } else {

                                    return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>';
                                }                      

                            }
                        }                    
                        
                    ] 
            });
        }
        
        // AFF interventions des pannes / id mate , index = All ou Select, type = admin ou utilisateur //
        
        function AffIntervPanne(id, index, type) {

            // affiche la div de la table intervention // id panne //
            $('.AffIntervs').removeClass('hidden').addClass('display');
            // efface la div tableIntervMate //
            $('#TableIntervMate').removeClass('display').addClass('hidden');

            if (index == 'Select') {

                $('.AffIntervs').removeClass('col-lg-12').addClass('col-lg-9'); // reduit la largeur de la table
            }            
            
            // affiche la table intervention //
            $.ajax({
                url: '?p=intervs.affIntervsPanne',
                data: {id:id, index:index, type:type},
                method: 'POST',
                success:function(data){

                    $('#TableIntervPanne').html(data);

                }
            });

        }              

        // REMONTE LE NBR D'INTERV LIER AUX PANNES (id panne)//
        
        function NbrInterv(id) {

            let nbr

            $.ajax({
                url: '?p=intervs.NbrIntervs',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {
                    
                    if (reponse[0].nbrinterv == '0' ) {                      
                       
                        result = '<a>Interventions Panne (0)</a>';

                    } else {

                        nbr = reponse[0].nbrinterv;
                        result = '<a href="#" data-id="'+ id +'" data-role="VIntervPanne">Interventions Panne ('+ nbr +')</a>';

                    }

                    // affiche les deux onglets //
                    $('li[role=presentation6]').attr('class', 'display').html(result);
                }
                
            });

        }         

        // function qui calcul le montant des interventions total // id matériel //
        function countIntervt(id) {
            
            $.ajax({
                url: '?p=intervs.countintervst',
                data: {id:id},
                method: 'post',
                success: function(data) {

                    if (data[0].mti != null) {

                        $('#mti').html('<h4><span style="text-decoration: underline;">Montant Total Interventions</span></h4><p class="h4">'+ data[0].mti + '€<P>');
                    } else {

                        $('#mti').html('<h4><span style="text-decoration: underline;">Montant Total Interventions</span></h4><p class="h4"> 0.00 €<P>');

                    }

                }
                  
            });   

        }

        // function qui calcul le montant des interventions de la panne// id panne //
        function countInterv(id) {
            
            $.ajax({
                url: '?p=intervs.countintervs',
                data: {id:id},
                method: 'post',
                success: function(data) {

                    if (data[0].mi != null) {

                        $('#mi').html('<h4 class="text-center">Montant Interventions: '+ data[0].mi + '€</h4>')
                    } else {

                        $('#mi').html('<h4 class="text-center">Montant Interventions: 0.00 €<h4>')

                    }

                }
                  
            });   

        }        
        
        // affiche l'intervention selectionner / l'intervenant et les boutons  //
        
        $('#TableIntervPanne').on('click','tr', function(){

            let rowtableinterv = $(this).closest('tr'); // recupére l'id de l'intervention// 
            let id = parseInt(rowtableinterv.find('td:eq(0)').text()); // id de l'intervention //
            let idpanne = $('#IDPanne').val(); // récupére l'id panne

            if (id) {   // si id existe //

                $('#h3Interv').html('Interventions n°:' + id + ' / ' + 'Panne n°:' + idpanne);

                $('#IDinterv').val(id); // ecris dans l input hidden 

                // efface la class .AffInterv //                        
                $('.AffIntervs').removeClass('display').addClass('hidden');           
                
                // affiche les données sur l'intervenant / id interv //                        
                affContribuInterv(id);
                // verifie les documents present ou non//
                checkedDocInterv(id, 'PANN'); // id interv / PANN //               
                // affiche la table interv selectionner //            
                AffIntervPanne(id, 'Select', typeU);
                
                let ancre = "#Ancre3";
                ScrollAncre(ancre);

            }                            

        });

        // verifie si la panne à une intervention / id panne //
        
        $(document).on('click', 'a[data-role=VIntervPanne]', function() {

            $('li[role=presentation5]').attr('class', 'display');
            $('li[role=presentation6]').attr('class', 'active');
            $('li[role=presentation7]').attr('class', 'display');

            let id = $(this).data('id'); // récupére l'id panne
            $('#IDinterv, #intervID').val(''); // efface l'input

            $('#h3Interv').html('Interventions Panne n°:' + id);           

            $('#TableIntervSP, #TableIntervCM, #info_interv, .AffQuota, .AffEvents, .AffEventsSP, .AffContribu, .AffBtnFACT, .AffBtnCERT')
            .removeClass('display')
            .addClass('hidden'); // efface les classe //

            $('#TableIntervPanne').removeClass('hidden').addClass('display'); // affiche la table interv panne
            $('.AffIntervs').removeClass('col-lg-9').addClass('col-lg-12'); // agrandi la table //             

            $.ajax({
                url: '?p=intervs.checkedInterv',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                    
                        
                    // interv existe //                        
                    AffIntervPanne(id, 'All', typeU);             

                    let ancre = "#Ancre3";
                    ScrollAncre(ancre);                    
                                        
                }
                  
            });
            
        });

    // INTERVENTIONS SANS PANNE //
    
        if ($('#TableIntervsSansPanne').is(':visible') == true) {

            $('a.item-In').attr('class', 'active');
            $('ul.item-in').attr('style', 'display:block;');
            $('li.item-lisp').attr('class', 'active');
        }
    
        // reinitialise la table interv sans panne //
        if ($.fn.dataTable.isDataTable('#TableIntervsSansPanne')) {

            $('#TableIntervsSansPanne').DataTable().destroy();

        } else {

            // AFF Interv sans Pannes //        

            let TableIntervsSansPanne = $('#TableIntervsSansPanne').DataTable({
                language: {url: "../public/media/French.json"},
                lengthMenu: [
                    [10, 15, 25, -1],
                    [10, 15, 25, 'All']
                ],             
                processing: true,
                scrollY: '50vh',
                scrollX: true,
                scollCollapse: true,
                paging: true,
                order: [[0, 'desc']],
                ajax: {
                    url:'?p=intervs.allSansPanne',
                    type: "POST"
                    },                   
                    columnDefs: [                    
                        {
                        render: function(data, type, row) {

                            if(row.mat_lier === "1") {

                                return '<a href="?p=pannes.pmatelier&id='+ row.idmate +'">' + data + '</a>';

                            } else {
                                
                                return '<a href="?p=pannes.mate&id='+ row.idmate +'">' + data + '</a>';
                            }                            
                        },

                        targets: [5]
                        },
                        { targets: [4], 
                          visible: false,
                          searchable: false
                        }
                    ],
                    columns: [                       
                        { data: "id" },
                        { data: "dateintervfr" },
                        { data: "heureintervfr" },
                        { data: "design_interv" },
                        { data: "idmate" },
                        { data: "num_inventaire" },
                        { data: "mate" },
                        { data: "nom" },
                        { data: "mfi",
                            render: function(data, type, row) {
                                    
                                if (row.mfi == null) {
                                    return mfi = '0.00 €';
                                } else {                              
                                    
                                    return Number(row.mfi).toFixed(2) +' €';
                                }                            
                            }
                        },
                        { data: "etat_interv",

                            render: function(data, type) { // à revoir //

                                if (data === 'En Cours') {

                                    return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>';                                

                                } else if(data === 'Terminé') {
                                   
                                    return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>';

                                } else {

                                    return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>';
                                }
                                
                            }
                        }                    
                        
                    ] 
            });

        } 

        // AFF interventions du materiel sans panne // id mate / {index = Select ou All}  //
        
        function AffIntervSP(id, index) {

            // efface la table events intervention sans panne //
            $('.AffEventsSP').removeClass('display').addClass('hidden');

            // affiche la div de la table intervention // id panne //
            $('.AffIntervs, #TableIntervSP').removeClass('hidden').addClass('display');
            
            // affiche la table intervention //
            $.ajax({
                url: '?p=intervs.affIntervsSP',
                data: {id:id, index:index},
                method: 'POST',
                success:function(data){

                    $('#TableIntervSP').html(data);

                }
            });
        } 
        
        // remonte le nbr d'interv sans panne lier au matériel // id mate //
        
        function nbrIntervSansPanne(id) {
            
            let nbr

            $.ajax({
                url: '?p=intervs.NbrIntervSansPanne',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {
                    
                    if (reponse == false ) {                   
                        
                        nbr = 0;

                    } else {                   
                        
                        nbr = reponse[0].nbrintervsanspanne;

                    }                    

                    // affiche le nbr de matériel lier //                    
                    $('li[role=presentation2]').html('<a href="#" data-role="VIntervsSansPanne">Interventions Sans Panne ('+ nbr +')</a>');
                    
                }
                
            });
        }

        // function qui remonte le montant de l'interv selectionner // id interv //        
        function countIntervSansPanne(id) {

            $.ajax({
                url: '?p=intervs.countintervssanspanne',
                data: {id:id},
                method: 'post',
                success: function(data) {

                    if(data.length == 0) {

                        $('#mi').html('<h4 class="text-center">Montant Interventions: 0.00 €<h4>');

                    } else {

                        if (data[0].mi != null) {

                            $('#mi').html('<h4 class="text-center">Montant Interventions: '+ data[0].mi + '€</h4>');

                        } else {

                            $('#mi').html('<h4 class="text-center">Montant Interventions: 0.00 €<h4>');

                        }
                    } 

                    $('.showbackmd, .showbackmr').attr('hidden', true);
                    $('.showbackmi').removeClass('col-sm-4').addClass('col-sm-12'); // agrandi la largeur de la div

                }
                  
            });   
        } 

        // enable ou disabled le btnAddInterv sans panne/ statut //
        function btnAddIntervSP(statut) {

            $('#h3Interv')
            .html('Interventions Sans Panne ')
            .append('<button class="btn btn-round btn-success" id="btnAddIntervSP" data-role="ADDIntervSP"<abbr title="Ajouter une intervention"><span class="glyphicon glyphicon-plus"></span></abbr></button>');

            if (statut == "Rebus") {

                $('#btnAddIntervSP').prop('disabled', true).attr('title', 'Matériel au Rebus !!!'); // active la prop disabled //

            } else if(statut == "Intervention En Cours") {

                $('#btnAddIntervSP, #btnAddIntervCM').prop('disabled', true).attr('title', 'Intervention en cours !!!'); // active la prop disabled //

            } else if(statut == "En Panne") {

                $('#btnAddIntervSP, #btnAddIntervCM').prop('disabled', true).attr('title', 'Panne en cours !!!'); // active la prop disabled //

            } else if(statut == "Actif") {

                $('#btnAddIntervSP, #btnAddIntervCM').prop('disabled', false); // desactive la prop disabled //
            }           

        }

        // charge le select type intervention / index = INT ou EXT //
        function load_SelectTypes(index) {

            $('#typeinterv').prop('required', true) // active le champ required
            $('#typeinterv option').remove();

            if (index == 'INT') {

                $('#typeinterv').append('<option value="0" disabled selected>Choix du Type</option>');
                $('#typeinterv').append('<option value="Curatif">Curatif</option>');
                $('#typeinterv').append('<option value="Préventive">Préventive</option>');

            } else { // index = EXT //

                $('#typeinterv').append('<option value="0" disabled selected>Choix du Type</option>');
                $('#typeinterv').append('<option value="Curatif">Curatif</option>');
                $('#typeinterv').append('<option value="Préventive">Préventive</option>');
            }                                 

        }

        // verifie si des intervention sans panne existe / id mate //
        
        $(document).on('click', 'a[data-role=VIntervsSansPanne]', function() {

            $('li[role=presentation1]').attr('class', 'display');
            $('li[role=presentation2]').attr('class', 'active');

            if ($("#CateProduit").val() === 'P') {

                $('li[role=presentation3]').attr('class', 'display'); // affiche 

            } else {
                
                $('li[role=presentation3]').attr('class', 'hidden'); // efface
            }

            if ($('#contrat').prop('class') != "display") {
                $('li[role=presentation4]').attr('class', 'hidden');
            } else {
                $('li[role=presentation4]').attr('class', 'display');  
            }

            let id = $('#IDmate').val(); // récupére l'id mate                                     

            // efface les class //
            $('#TableIntervPanne, #TableIntervCM, .AffMatesLier, .AffPannes, .AffQuota, .AffEvents, .AffEventsSP, .AffContribu, .AffNavs2, .AffMontant, .AffBtnFACT, .AffBtnCERT').removeClass('display').addClass('hidden');  
            $('.AffDataPanne').removeClass('hidden').addClass('display'); // affiche les class  dans pannesmate//          

            $('.AffIntervs').removeClass('col-lg-9').addClass('col-lg-12'); // agrandi la table //                               
            
            // affiche la table interv SP //                        
            AffIntervSP(id, "All");

            let statut = $('#statut').text(); //
            btnAddIntervSP(statut);            

            let ancre = "#Ancre3";
            ScrollAncre(ancre);

            CheckedPanne(id); // verifie si une panne et active pour ce matériel et active ou desactive les btn / id materiel//
            
        });    

        // Add Intervention sans panne //
            
        $(document).on('click','button[data-role=ADDIntervSP]', function(){
            
            var index;
            let id = $('#IDmate').val(); // récupére l'id du matériel //                   

            $('.AffInfoUser, .AffSelectContribut, .AffSelectType').removeClass('display').addClass('hidden'); // efface les class//
            $('#ModalAddIntervSP').modal('show'); // ouvre la modal //

            $('.modal-title').html('Ajout d\'intervention sans panne');// ecris le title

            // donne l'heure //
            let t = heurebd();
            $('#HeureInterv').val(t);

            $('.AffInfoUser').removeClass('hidden').addClass('display'); // affiche la class //

            $('input[name=BTNI]').prop('checked', false);

            $('input[name=BTNI]').on('click', function(){

                $('.AffSelectContribut, .AffSelectType').addClass('display').removeClass('hidden') // affiche la class select contribut & select type//                

                let inp = $('input[name=BTNI]:checked').val();

                if (inp == 1) { // INTERNE //

                    index = "INT";
                    load_SelectContriIC(index); // charge les intervenant Interne
                    load_SelectTypes(index);                  

                } else { // EXTERNE //

                    index = "EXT";
                    load_SelectContriIC(index); // charge les intervenant Externe
                    load_SelectTypes(index);                 
                }

                $('#dependI').val(index); // ecris EXT ou INT dans l'input
            });            

            $('#DesignInterv').val(""); // efface le champ textarea
            
            $('#MateId_Interv').val(id); // ecris id mat dans l'input
            $('#cateInt').val("SP"); // ecris dans l'input //

            $('#ADDIntervSP').validator().on("submit", function(event){

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();                                

                    $.ajax({
                        url : '?p=intervs.add', 
                        method : 'POST',
                        data : $('#ADDIntervSP').serialize(),
                        success : function(data){

                            $("#info_interv")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-8')
                            .html("L'intervention à bien était ajouté !!!");

                            $('#ModalAddIntervSP').modal('hide'); // ferme la modal //
                            affStatutMate(id);// affiche le statut du materiel //
                            AffIntervSP(id, "All"); // affiche la table interv matériel / id matériel //                                                                                             
                            recupclassdiv('info_interv', 7000);

                            nbrIntervSansPanne(id); // id materiel //
                            CheckedPanne(id); // verifie l'etat de la panne et active ou désactive les btn //id matériel //
                            
                        }                    

                    });    
                }
            });                  

        }); 

        // edition interv panne & sans panne //
        
        $(document).on('click', 'button[data-role=EditInterv]', function(){ 

            let index = $(this).data('index');
            let rowtableinterv = $(this).closest('tr');
            let id = parseInt(rowtableinterv.find('td:eq(0)').text());
            let dateinterv = rowtableinterv.find('td:eq(1)').text();
            let heureinterv = rowtableinterv.find('td:eq(2)').text();
            let typeinterv = rowtableinterv.find('td:eq(3)').text();
            let etatinterv = rowtableinterv.find('td:eq(6)').text(); // ??? ///
            let contribut;

            $('#ModalEditInterv').modal('show');// ouvre la modal //
            $('.modal-title').html('Edition Intervention'); // ecris dans le title

            // retourne la date //
            let parts = dateinterv.split(/-/);
            parts.reverse();
            let datereverse = (parts.join('-'));

            $("#dateinterv").val(datereverse); // affiche la date enregistrer
            $('#heureinterv').val(heureinterv);
            $('#Tinterv').html(typeinterv);

            if (index == "panne") { // interv avec panne //

                contribut = rowtableinterv.find('td:eq(4)').text();
                $('#contriInterv').html(contribut);
                $('.AffDesign').removeClass('display').addClass('hidden'); // efface design //               

            } else { // interv sans panne //

                contribut = rowtableinterv.find('td:eq(4)').text();
                $('#contriInterv').html(contribut);

                let design = rowtableinterv.find('td:eq(5)').text();
                $('.AffDesign').removeClass('hidden').addClass('display'); // affiche design //
                $('#designInterv').val(design);
            }                        

            $('#IDInterv').val(id); // ecris l'id interv dans un input hidden         

            // validation edition interv panne & sans panne //

            $('#EditInterv').validator().on("submit", function(event){  

                let IDinterv = $('#IDInterv').val();
                let IDmate = $('#IDmate').val();

                if (event.isDefaultPrevented()) {

                    } else {

                        event.preventDefault()
                     
                    $.ajax({
                        url : '?p=intervs.editInterv', 
                        method : 'POST',
                        data : $('#EditInterv').serialize(),
                        success : function(reponse){                        
                            
                            $("#info_interv")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("L'intervention à bien était modifié !!!");

                            $('#ModalEditInterv').modal('hide'); // ferme la modal //
                            $("#EditInterv")[0].reset();

                            if (index == 'panne') {
                                // reinitialise la table interv panne //
                                AffIntervPanne(IDinterv, "Select", typeU);
                            } else {
                                // reinitialise la table intervention SP//
                                AffIntervSP(IDmate, "All");
                            }
                                                        
                            let statut = $('#statut').text(); //
                            btnAddIntervSP(statut); 
                            recupclassdiv('info_interv', 7000);   
                        }                    

                    });

                }   
            });
            
        });

        // affiche les événements de l'intervention  //
        
        $('#TableIntervSP').on('click','tr', function(){

            let rowtableinterv = $(this).closest('tr'); // recupére l'id de l'intervention// 
            let id = parseInt(rowtableinterv.find('td:eq(0)').text()); // id de l'intervention //
            let etat = rowtableinterv.find('td:eq(7)').text(); // etat //

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9'}); // affiche le tr en gris // 

            AffIntervSP(id, "Select"); // n'affiche que la ligne selectionner //
            affEventIntervSP(id, etat, 'Interv'); // id = interv / etat = etat interv / Interv ou // 

            $('#IDinterv').val(id); // ecris l'id interv dans un input hidden 

        });           

        // change l'etat de l'intervention sans panne /***********M**************/
        
        $(document).on('click', 'a[data-role=ChangeEtatSP]', function() {

            let rowtableinterv = $(this).closest('tr'); // recupére l'id de l'intervention//
            let idInterv = parseInt(rowtableinterv.find('td:eq(0)').text()); // id de l'intervention //
            let etat = rowtableinterv.find('td:eq(7)').text(); // etat de l'interv

            if (etat != "Terminé") {

                $('#id_interv').val(idInterv); // ecris dans input hiddden

                if (etat == 'En Cours') {

                    $('#etats option[value=1]').attr('selected', true);
                }

                $('#etats').on('change', function(){

                   let index = $('#etats').val(); // récupére la valeur de l'option selected

                   if(index == 2) {

                        $('#etats option[value=1]').attr('selected', false);
                        $('#etats option[value=2]').attr('selected', true);

                   } else if (index == 1) {

                        $('#etats option[value=1]').attr('selected', true);
                        $('#etats option[value=2]').attr('selected', false);

                   }

                })

                $('#ModalEtat').modal('show');// ouvre la modal //
                $('.modal-title').html('Changer l\'état de l\'interv n°: ' + idInterv); // ecris dans le title

                // modifie l'etat de l'intervention sans panne /****************M**********/
                
                $('#ChangeStatesInterv').validator().on("submit", function(event){

                    let idmate = $('#IDmate').val(); // récupére l'id du matériel
                    let etat = $('#etats option:selected').text();
                    let idinterv = $('#id_interv').val(); // récupére l'id interv 

                    if (event.isDefaultPrevented()) {

                    } else {

                        event.preventDefault();                                

                        $.ajax({
                            url : '?p=intervs.stateinterv', 
                            method : 'POST',
                            data : {idmate:idmate, idinterv:idinterv, etat:etat},
                            success : function(data){

                                $("#info_interv")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-8')
                                .html("L'intervention à bien était modifié !!!");

                                $('#ModalEtat').modal('hide'); // ferme la modal //

                                affStatutMate(idmate); // affiche le statut du materiel / id mate//

                                AffIntervSP(idmate, "All"); // id matériel //

                                CheckedPanne(idmate); // verifie l'etat de la panne et active ou désactive les btn // id matériel //

                                checkedDocInterv(idinterv, 'MAT'); // verifie les documents a affiché
                                                                                                 
                                recupclassdiv('info_interv', 7000);
                                
                            }                    

                        });    
                    }
                });

            } else {

                $("#info_interv")
                .removeClass('hidden')
                .addClass('alert alert-info info-dismissable col-lg-8')
                .html("L'intervention et terminé impossible de modifié le statut !!!");

                recupclassdiv('info_interv', 4000);
            }      

        });

    // INTERVENTIONS CONTRAT MAINTENANCE //

        if ($('#TableIntervsCm').is(':visible') == true) {

            $('a.item-In').attr('class', 'active');
            $('ul.item-in').attr('style', 'display:block;');
            $('li.item-licm').attr('class', 'active');
        }

        // reinitialise la table interv contrat de maintenance //
        if ($.fn.dataTable.isDataTable('#TableIntervsCm')) {

            $('#TableIntervsCm').DataTable().destroy();

        } else {

            // AFF Interv des interv contrat de maintenance  //        

            let TableIntervsCm = $('#TableIntervsCm').DataTable({
                language: {url: "../public/media/French.json"},
                lengthMenu: [
                    [10, 15, 25, -1],
                    [10, 15, 25, 'All']
                ],             
                processing: true,
                scrollY: '50vh',
                scrollX: true,
                scollCollapse: true,
                paging: true,
                order: [[0, 'desc']],
                ajax: {
                    url:'?p=intervs.allcm',
                    type: "POST"
                    },                   
                    columnDefs: [
                        { targets: [3], 
                          visible: false,
                          searchable: false
                        },                    
                        {
                        render: function(data, type, row) {

                            if(row.mat_lier === "1") {

                                return '<a href="?p=pannes.pmatelier&id='+ row.idmate +'">' + data + '</a>';

                            } else {
                                
                                return '<a href="?p=pannes.mate&id='+ row.idmate +'">' + data + '</a>';
                            }                            
                        },

                        targets: [4]
                        }
                        
                    ],
                    columns: [                       
                        { data: "id" },
                        { data: "dateintervfr" },
                        { data: "design_interv" },
                        { data: "idmate" },
                        { data: "num_inventaire" },
                        { data: "mate" },
                        { data: "nom" },
                        { data: "etat_interv",

                            render: function(data, type) { // à revoir //

                                if (data === 'En Cours') {

                                    return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>';                                

                                } else if(data === 'Terminé') {
                                   
                                    return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>';

                                } else {

                                    return '<a class="btn-default btn-xs btn-round" disabled>'+ data +'</a>';
                                }
                                
                            }
                        }                    
                        
                    ] 
            });
        }
     
        // remonte le nbrs d'interv lier aux contrat de maintenance //
        
        function NbrIntervCM(id) {

           let nbr;

            $.ajax({
                url: '?p=intervs.NbrIntervsCM',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                         

                    if (reponse[0].nbrinterv == '0' ) {                      
                   
                        result = '<a href="#" data-id="'+ id +'" data-role="VIntervsCM">Interventions Contrat Maintenance (0)</a>';

                    } else {

                        nbr = reponse[0].nbrinterv;
                        result = '<a href="#" data-id="'+ id +'" data-role="VIntervsCM">Interventions Contrat Maintenance ('+ nbr +')</a>';

                    }

                    // affiche l'onglets //
                    $('li[role=presentation4]').attr('class', 'display').html(result);                                      
                    
                }
                
            }); 
        }

        // AFF Interventions contrat Maintenance / id mate  //
        function AffIntervCM(id) {
            
            // affiche la div de la table interventions //
            $('.AffDataPanne, .AffIntervs, #TableIntervCM').removeClass('hidden').addClass('display'); 


            // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableInterv')) {

                $('#TableInterv').DataTable().destroy();
            }           

            $('#TableInterv').DataTable({

                language: {url: "../public/media/French.json"},
                lengthMenu: [10, 15, 25, 50],
                scrollY: '20vh',
                scrollX: true,
                scollCollapse: true,
                paging: true,
                searching: false,
                ajax: {
                  url: '?p=intervs.affIntervcm',
                  type: "POST",
                  data: {id,id},
                  dataSrc: "",
                  dataType: "json"
                },          
                columns: [                    
                    { data: "id" },
                    { data: "dateintervfr" },
                    { data: "heureintervfr" },
                    { data: "type_interv" },
                    { data: "nom" },                                    
                    { data: "design_interv" },                                    
                    { data: "user" },
                    { data: "etat_interv",

                        render : function(data, type, row) {
                            if(row.etat_interv == 'En Cours') {
                                 
                                btn = 'btn btn-warning btn-xs btn-round';

                                } else if (row.etat_interv == 'Terminé') {

                                    btn = 'btn btn-danger btn-xs btn-round';

                                }
                            return `<a class="`+btn+`" data-role="ChangeEtatCM"<abbr title="Cliqué sur le bouton pour changer l\'état">`+row.etat_interv+`</abbr></a>`
                        }
                        

                    },                                    
                    { render : function(id, type, row) {

                        if (row.lien_icm == null) {

                            return `<button class="btn btn-primary btn-xs" data-role="EditIntervCM"<abbr title="Edition de l\'intervention"><span class="glyphicon  glyphicon-pencil"></span></abbr></button> `+
                                    `<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalAddDoc" data-role="addfile" data-b="ICM"<abbr title="ajouter un PDF"><span class="fa fa-plus"></span></abbr></button>`
                       } else {

                            return '<button class="btn btn-primary btn-xs" data-role="EditIntervCM"<abbr title="Edition de l\'intervention"><span class="glyphicon  glyphicon-pencil"></span></abbr></button> '+
                                   '<a href="'+ row.lien_icm +'" target="_blank" class="btn btn-info btn-xs"<abbr title="Voir le bon d\'intervention"><span class="fa fa-eye"></span></abbr></a> '+
                                   '<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalAddDoc" data-role="uploadfile" data-b="ICM" data-doc="'+row.lien_icm+'"<abbr title="changer le PDF"><span class="fa fa-refresh"></span></abbr></button> '
                       }          
                        
                      
                    }}    
                ]            

            });            
           
        } 

        // enable ou disabled le btnAddIntervCM /  etatpanne, statut //
        function btnAddIntervCM(statut) {

            $('#h3Interv')
            .html('Interventions Contrat de Maintenance ')
            .append('<button class="btn btn-round btn-success" id="btnAddIntervCM" data-role="ADDIntervCM"<abbr title="Ajouter une intervention"><span class="glyphicon glyphicon-plus"></span></abbr></button>');

            if (statut == "Rebus") {

                $('#btnAddIntervCM').prop('disabled', true).attr('title', 'Matériel au Rebus !!!'); // active la prop disabled //

            } else if(statut == "Intervention En Cours") {

                $('#btnAddIntervCM').prop('disabled', true).attr('title', 'Intervention en cours !!!'); // active la prop disabled //

            } else if(statut == "En Panne") {

                $('#btnAddIntervCM').prop('disabled', true).attr('title', 'Panne en cours !!!'); // active la prop disabled //

            } else if(statut == "Actif") {

                $('#btnAddIntervCM').prop('disabled', false); // desactive la prop disabled //
            }           

        }

        // function qui calcul le montant des interventions contrat de maintenance // id matériel //
        function countIntervCM(id) {
            
            $.ajax({
                url: '?p=intervs.countintervcm',
                data: {id:id},
                method: 'post',
                success: function(data) {

                    if (data[0].mti != null) {

                        $('#mtm').html('<h4><span style="text-decoration: underline;">Montant Total Contrat Maintenance</span></h4><p class="h4">'+ data[0].mtm + '€<P>');
                    } else {

                        $('#mtm').html('<h4><span style="text-decoration: underline;">Montant Total Contrat Maintenance</span></h4><p class="h4"> 0.00 €<P>');

                    }

                }
                  
            });   

        }    
    
        // verifie si des intervention contrat maintenance existe / id mate //
        
        $(document).on('click', 'a[data-role=VIntervsCM]', function() {

            $('li[role=presentation1]').attr('class', 'display');
            $('li[role=presentation2]').attr('class', 'display');

            if ($("#CateProduit").val() === 'P') {

                $('li[role=presentation3]').attr('class', 'display');

            } else {
                
                $('li[role=presentation3]').attr('class', 'hidden');
            }

            $('li[role=presentation4]').attr('class', 'active');                       

            let id = $('#IDmate').val(); // récupére l'id mate                                     

            // efface les class //
            $('#TableIntervPanne, #TableIntervSP, .AffMatesLier, .AffPannes, .AffQuota, .AffEvents, .AffContribu, .AffNavs2, .AffMontant, .AffBtnFACT, .AffBtnCERT, .AffEventsSP').removeClass('display').addClass('hidden');  
            
            let statut = $('#statut').text(); 
            btnAddIntervCM(statut);

            AffIntervCM(id);            

            CheckedPanne(id); // verifie si une panne et active pour ce matériel et active ou desactive les btn / id materiel//                       

            let ancre = "#Ancre3";
            ScrollAncre(ancre);           
            
        });

        // Add Intervention Contrat de Maintenance //
            
        $(document).on('click','button[data-role=ADDIntervCM]', function(){
            
            var index;
            let id = $('#IDmate').val(); // récupére l'id du matériel //          

            $('.AffInfoUser').removeClass('display').addClass('hidden'); // efface la class info user//
            $('.AffSelectContribut, .AffSelectType').removeClass('hidden').addClass('display'); // affiche les class //
            $('#ModalAddInterv').modal('show'); // ouvre la modal //

            $('.modal-title').html('Ajout d\'intervention Contrat Maintenance');// ecris le title

            // donne l'heure //
            let t = heurebd();
            $('#HeureInterv').val(t);                
            
            index = "EXT";
            load_SelectContriIC(index); // charge les intervenant Externe
            load_SelectTypes(index);         
             
            $('#DesignInterv').val(""); // efface le champ textarea
            
            $('#MateId_Interv').val(id); // ecris id mat dans l'input 
            $('#dependI').val(index); // ecris EXT dans input //
            $('#cateInt').val("CM"); // ecris CM //                           

            $('#ADDInterv').validator().on("submit", function(event){

                if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();                                

                    $.ajax({
                        url : '?p=intervs.add', 
                        method : 'POST',
                        data : $('#ADDInterv').serialize(),
                        success : function(data){

                            $("#info_interv")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-8')
                            .html("L'intervention à bien était ajouté !!!");                                    
                            $('#ModalAddInterv').modal('hide'); // ferme la modal //

                            affStatutMate(id);// affiche le statut du materiel //
                            AffIntervCM(id); // affiche la table interv matériel / id matériel //                                                                                             
                            recupclassdiv('info_interv', 7000);
                            nbrIntervSansPanne(id); // id materiel //

                            let statut = $('#statut').text();
                            btnAddIntervCM(statut); // verifie l'etat de la panne et active ou désactive les btn //id matériel // 
                            
                        }                    

                    });    
                }
            });                  

        }); 

        // edition interv Contrat de Maintenance  /*********A-C***********/
        
        $(document).on('click', 'button[data-role=EditIntervCM]', function(){ 

            let index = $(this).data('index');
            let rowtableinterv = $(this).closest('tr');
            let id = parseInt(rowtableinterv.find('td:eq(0)').text());
            let dateinterv = rowtableinterv.find('td:eq(1)').text();
            let heureinterv = rowtableinterv.find('td:eq(2)').text();
            let typeinterv = rowtableinterv.find('td:eq(3)').text();
            let etatinterv = rowtableinterv.find('td:eq(6)').text(); //***********pas lu ******//
            let contribut;

            $('#ModalEditInterv').modal('show');// ouvre la modal //
            $('.modal-title').html('Edition Intervention'); // ecris dans le title

            // retourne la date //
            let parts = dateinterv.split(/-/);
            parts.reverse();
            let datereverse = (parts.join('-'));
            $("#dateinterv").val(datereverse); // affiche la date enregistrer

            $('#heureinterv').val(heureinterv);

            $('#Tinterv').html(typeinterv);

            if (index == "panne") { // interv avec panne //

                contribut = rowtableinterv.find('td:eq(4)').text();
                $('#contriInterv').html(contribut);
                $('.AffDesign').removeClass('display').addClass('hidden'); // efface design //               

            } else { // interv sans panne //

                contribut = rowtableinterv.find('td:eq(4)').text();
                $('#contriInterv').html(contribut);

                let design = rowtableinterv.find('td:eq(5)').text();
                $('.AffDesign').removeClass('hidden').addClass('display'); // affiche design //
                $('#designInterv').val(design);
            }                        

            $('#IDInterv').val(id); // ecris l'id interv dans un input hidden         

            // validation edition evenement panne //

            $('#EditInterv').validator().on("submit", function(event){  

                let idmate = $('#IDmate').val(); // id matériel                                   

                if (event.isDefaultPrevented()) {

                    } else {

                        event.preventDefault()
                     
                    $.ajax({
                        url : '?p=intervs.editInterv', 
                        method : 'POST',
                        data : $('#EditInterv').serialize(),
                        success : function(reponse){                        
                            
                            $("#info_interv")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("L'intervention à bien était modifié !!!");

                            $('#ModalEditInterv').modal('hide'); // ferme la modal //
                            $("#EditInterv")[0].reset();
                            // reinitialise la table intervention 
                            AffIntervCM(idmate); 

                            let statut = $('#statut').text(); 
                            btnAddIntervSP(statut);

                            recupclassdiv('info_interv', 7000);   
                        }                    

                    });

                }   
            });
            
        });

        // change l'etat de l'intervention CM //
        
        $(document).on('click', 'a[data-role=ChangeEtatCM]', function() {

            let rowtableinterv = $(this).closest('tr'); // recupére l'id de l'intervention//
            let idInterv = parseInt(rowtableinterv.find('td:eq(0)').text()); // id de l'intervention //
            let etat = rowtableinterv.find('td:eq(7)').text(); // etat de l'interv

            if (etat != "Terminé") {

                $('#id_interv').val(idInterv); // ecris dans input hiddden

                if (etat == 'En Cours') {

                    $('#etats option[value=1]').attr('selected', true);
                }

                $('#etats').on('change', function(){

                   let index = $('#etats').val(); // récupére la valeur de l'option selected

                   if(index == 2) {

                        $('#etats option[value=1]').attr('selected', false);
                        $('#etats option[value=2]').attr('selected', true);

                   } else if (index == 1) {

                        $('#etats option[value=1]').attr('selected', true);
                        $('#etats option[value=2]').attr('selected', false);

                   }

                });

                $('#ModalEtat').modal('show');// ouvre la modal //
                $('.modal-title').html('Changer l\'état de l\'interv n°: '+ idInterv); // ecris dans le title

                // modifie l'etat de l'intervention sans panne & interv CM //
                
                $('#ChangeStatesInterv').validator().on("submit", function(event){

                    let idmate = $('#IDmate').val(); // récupére l'id du matériel
                    let etat = $('#etats option:selected').text();
                    let idinterv = $('#id_interv').val(); // récupére l'id interv 

                    if (event.isDefaultPrevented()) {

                    } else {

                        event.preventDefault();                                

                        $.ajax({
                            url : '?p=intervs.stateinterv', 
                            method : 'POST',
                            data : {idmate:idmate, idinterv:idinterv, etat:etat},
                            success : function(data){

                                $("#info_interv")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-8')
                                .html("L'intervention à bien était modifié !!!");

                                $('#ModalEtat').modal('hide'); // ferme la modal //

                                affStatutMate(idmate); // affiche le statut du materiel / id mate//

                                AffIntervCM(idmate); // id matériel //

                                CheckedPanne(idmate); // verifie l'etat de la panne et active ou désactive les btn // id matériel //

                                checkedDocInterv(idinterv, 'MAT'); // verifie les documents a affiché
                                                                                                 
                                recupclassdiv('info_interv', 7000);
                                
                            }                    

                        });    
                    }
                });

            } else {

                $("#info_interv")
                .removeClass('hidden')
                .addClass('alert alert-info info-dismissable col-lg-8')
                .html("L'intervention et terminé impossible de modifié le statut !!!");

                recupclassdiv('info_interv', 4000);
            }      

        });        

    // DEVIS //
    
        if ($('#TableQuotation').is(':visible') == true) { 

            $('a.item-D').attr('class', 'active');
            $('ul.item-d').attr('style', 'display:block;');
            $('li.item-tld').attr('class', 'active');

        }

        // function qui affiche tous les devis //
                
        var TableQuotation = $('#TableQuotation').DataTable({

            language: {url: "../public/media/French.json"},
            scrollY: '50vh',
            scrollX: true,
            scrollCollapse: true,                                           
            paging: true,
            searching: true,
            order: [[0, 'desc']],
            ajax: {
                url: '?p=quotation.all',
                type: "POST"
            },
            columns: [
                { data: "id" },
                { data: "daterequestfr" },
                { data: "datequotafr" },
                { data: "nom" },
                { data: null,
                    render: function(data, type, row) { // numéro de panne //

                        return `<a href="?p=pannes.mate&id=`+ row.materiel_id+`"> `+ row.pannes_id+` </a>`                        
                    } 
                },
                { data: "num_devis" },
                { data: "datevaliquotafr" },
                { data: "daterefusquotafr" },                    
                { data: "montantDE",

                    render: function(data, type, row) {
                        
                        if (row.montantDE == null) {
                            return montantDE = '0.00 €';
                        } else {

                            mde = Number(row.montantDE);                                
                            return mde.toFixed(2) +' €';
                        }                            
                    }
                },
                { data: null }, // etat devis //                                       
                { render : function(data, type, row) { // Actions //

                        if (row.etat_devis == "Devis Refusé") {

                            if (row.lien_devis == null) {
                                return `
                                <button class="btn btn-primary btn-xs" data-role="EditQuota"><span class="glyphicon glyphicon-pencil"></span></button>
                                <button type="button" class="btn btn-success btn-xs" data-role="addfilequota" data-b="DE"<abbr title="Ajouter un PDF">add Devis</abbr></button>`

                            } else {

                                return `
                                <button class="btn btn-primary btn-xs" data-role="EditQuota"><span class="glyphicon glyphicon-pencil"></span></button> 
                                <a href="../public/documents/devis/`+ row.lien_devis +`" target="_blank" class="btn btn-danger btn-xs">View Devis</a> 
                                <button type="button" class="btn btn-theme btn-xs" data-doc="`+ row.lien_devis +`" data-role="replacequota"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>`

                            } 

                        }  else {

                            if (row.lien_devis == null) { // si lien_devis et null //
                                // si num_devis et null //
                                if (row.num_devis == null) { // bouton edit disabled / add devis disabled //

                                    return `
                                    <button class="btn btn-primary btn-xs" disabled><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button type="button" class="btn btn-success btn-xs" disabled>add Devis</button>`

                                } else { // bouton edit activer / add devis //

                                    return `
                                    <button class="btn btn-primary btn-xs" data-role="EditQuota"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button>
                                    <button type="button" class="btn btn-success btn-xs" data-role="addfilequota" data-b="DE"<abbr title="Ajouter un Devis">add Devis</abbr></button>`

                                }
                            } else { // bouton edit activer / view devis / replace devis//

                                return `
                                <button class="btn btn-primary btn-xs" data-role="EditQuota"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button> 
                                <a href="../public/documents/devis/`+ row.lien_devis +`" target="_blank" class="btn btn-danger btn-xs">View Devis</a> 
                                <button type="button" class="btn btn-theme btn-xs" data-doc="`+ row.lien_devis +`" data-role="replacequota"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>`

                            } 
                        }                              
                        
                    }
                }    
            ],
            columnDefs: [
                {
                    targets: 9,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {  // Etat Devis //                          
                        
                        if (row.etat_devis == 'Attente Devis') {                            

                            return `
                            <div>
                                <button class="btn-primary btn-round" disabled>Attente Devis</button>                                 
                            </div>
                            `                                                   
                              
                        } else if (row.etat_devis == 'Devis En Attente') {                            

                            return `
                            <div>
                                <button class="btn-warning btn-round" disabled>Devis En Attente</button>                                 
                            </div>
                            `                                                   
                              
                        } else if (row.etat_devis == 'Devis En Attente de Réactualisation') {                            

                            return `
                            <div>
                                <button class="btn-warning btn-round" disabled>Devis En Attente de Réactualisation</button>                                 
                            </div>
                            `                                                  
                              
                        } else if (row.etat_devis == 'Devis Accepté') {
                            
                            return `
                            <div>
                                <button class="btn-success btn-round" disabled>Devis Accepté</button>                                 
                            </div>
                            `
                            
                        } else if (row.etat_devis == 'Devis Refusé') {
                            
                            return `
                            <div>
                                <button class="btn-danger btn-round" disabled>Devis Refusé</button>                                 
                            </div>
                            `                                
                        } 
                        
                    }
                }

            ]            

        });

        // function qui affiche les devis en attente //
        
        var TablePendingQuote = $('#TablePendingQuote').DataTable({

            language: {url: "../public/media/French.json"},
            scrollY: '50vh',
            scrollX: true,
            scrollCollapse: true,                                           
            paging: false,
            searching: false,
            ajax: {
                url: '?p=quotation.pendingquote',
                type: "POST"
            },
            columns: [
                { data: "id" },
                { data: "daterequestfr" },
                { data: "datequotafr" },
                { data: "nom" },
                { data: null,
                    render: function(data, type, row) {

                        return `<a href="?p=pannes.mate&id=`+ row.materiel_id+`"> `+ row.pannes_id+` </a>`                        
                    } 
                },
                { data: "num_devis" },
                { data: "datevaliquotafr" },
                { data: "daterefusquotafr" },                    
                { data: "montantDE",

                    render: function(data, type, row) {
                        
                        if (row.montantDE == null) {
                            return montantDE = '0.00 €';
                        } else {

                            mde = Number(row.montantDE);                                
                            return mde.toFixed(2) +' €';
                        }                            
                    }
                },
                { data: null },                                        
                { render : function(data, type, row) { // Actions //

                        if (row.etat_devis == "Devis Refusé") {

                            if (row.lien_devis == null) {
                                return `
                                <button class="btn btn-primary btn-xs" data-role="EditQuota"><span class="glyphicon glyphicon-pencil"></span></button>
                                <button type="button" class="btn btn-success btn-xs" data-role="addfilequota" data-b="DE"<abbr title="Ajouter un PDF">add Devis</abbr></button>`

                            } else {

                                return `
                                <button class="btn btn-primary btn-xs" data-role="EditQuota"><span class="glyphicon glyphicon-pencil"></span></button> 
                                <a href="../public/documents/devis/`+ row.lien_devis +`" target="_blank" class="btn btn-danger btn-xs">View Devis</a> 
                                <button type="button" class="btn btn-theme btn-xs" data-doc="`+ row.lien_devis +`" data-role="replacequota"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>`

                            } 

                        }  else {

                            if (row.lien_devis == null) { // si lien_devis et null //
                                // si num_devis et null //
                                if (row.num_devis == null) { // bouton edit disabled / add devis disabled //

                                    return `
                                    <button class="btn btn-primary btn-xs" disabled><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button type="button" class="btn btn-success btn-xs" disabled>add Devis</button>`

                                } else { // bouton edit activer / add devis //

                                    return `
                                    <button class="btn btn-primary btn-xs" data-role="EditQuota"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button>
                                    <button type="button" class="btn btn-success btn-xs" data-role="addfilequota" data-b="DE"<abbr title="Ajouter un Devis">add Devis</abbr></button>`

                                }
                            } else { // bouton edit activer / view devis / replace devis//

                                return `
                                <button class="btn btn-primary btn-xs" data-role="EditQuota"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button> 
                                <a href="../public/documents/devis/`+ row.lien_devis +`" target="_blank" class="btn btn-danger btn-xs">View Devis</a> 
                                <button type="button" class="btn btn-theme btn-xs" data-doc="`+ row.lien_devis +`" data-role="replacequota"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>`

                            } 
                        }                              
                        
                    }
                }   
            ],
            columnDefs: [
                {
                    targets: 9,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {   // Etat Devis //                         
                        
                        if (row.etat_devis == 'Attente Devis') {                            

                            return `
                            <div>
                                <button class="btn-primary btn-round" disabled>Attente Devis</button>                                 
                            </div>
                            `                                                         
                              
                        } else if (row.etat_devis == 'Devis En Attente') {                            

                            return `
                            <div>
                                <button class="btn-warning btn-round" disabled>Devis En Attente</button>                                 
                            </div>
                            `                                                   
                              
                        } else if (row.etat_devis == 'Devis En Attente de Réactualisation') {                            

                            return `
                            <div>
                                <button class="btn-warning btn-round" disabled>Devis En Attente de Réactualisation</button>                                 
                            </div>
                            `                                                  
                              
                        } else if (row.etat_devis == 'Devis Accepté') {
                            
                            return `
                            <div>
                                <button class="btn-success btn-round" disabled>Devis Accepté</button>                                 
                            </div>
                            `
                            
                        } else if (row.etat_devis == 'Devis Refusé') {
                            
                            return `
                            <div>
                                <button class="btn-danger btn-round" disabled>Devis Refusé</button>                                 
                            </div>
                            `                                
                        } 
                        
                    }
                }

            ]            

        });   
    
        // REMONTE LE NBR DE DEVIS LIER AUX PANNES / id = id panne - index = 1 active - 2 display //
        
        function NbrQuota(id, index) {

            let nbr;

            $.ajax({
                url: '?p=quotation.NbrQuota',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {
                    
                    if (reponse[0].nbrquota == '0') {                      
                       
                        result = '<a>Devis Panne (0)</a>'; 

                    } else {

                        nbr = reponse[0].nbrquota;
                        result = '<a href="#" data-id="'+ id +'" data-role="VQuotaPanne">Devis Panne ('+ nbr +')</a>';

                    }

                    let val;

                    if (index == '1') {
                        val = 'active'; // ajoute a la class le paramétre active //
                    } else {
                        val = 'display'; // ajoute a la class le paramétre display //
                    }

                    // affiche le nbr de devis dans onglets //
                    $('li[role=presentation7]').attr('class', val).html(result);
                }
                
            });

        }
    
        // function qui calcul le montant des devis total // id matériel //
        
        function CountQuotat(id) {
            
            $.ajax({
                url: '?p=quotation.countquotat',
                data: {id:id},
                method: 'post',
                success: function(data) {

                    if (data[0].mtd != null) {

                        $('#mtd').html('<h4><span style="text-decoration: underline;">Montant Total Devis</span></h4><p class="h4">'+ data[0].mtd+ '€<P>');

                    } else {

                        $('#mtd').html('<h4><span style="text-decoration: underline;">Montant Total Devis</span></h4><p class="h4"> 0.00 €<P>');
                    }

                }
                  
            });   

        }

        // function qui calcul le montant des devis de la panne selectionner// id panne//
        
        function CountQuota(id) {
            
            $.ajax({
                url: '?p=quotation.countquota',
                data: {id:id},
                method: 'post',
                success: function(data) {

                    if (data[0].md != null) {

                        $('#md').html('<h4 class="text-center">Montant Devis: <span>'+ data[0].md+ '€</span></h4>');

                    } else {

                        $('#md').html('<h4 class="text-center">Montant Devis: 0.00 €</h4>');
                    }

                }
                  
            });  

        }        

        // function qui remonte le(s) devis par panne // id panne /*************AR**************/        
        
        function AffQuota(id) {

            // affiche la div de la table devis // id panne //
            $('.AffQuota').removeClass('hidden').addClass('display');

            $('li[role=presentation5]').attr('class', 'display');
            $('li[role=presentation6]').attr('class', 'display');

            // affiche le titre //
            $('#h3Quota').html('Devis Panne n°: ' + id);                        
            
            // affiche la table devis //
            
            // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableQuota')) {

                $('#TableQuota').DataTable().destroy();
            }
            
            $('#TableQuota').DataTable({

                language: {url: "../public/media/French.json"},                                           
                paging: false,
                searching: false,
                ajax: {
                    url: '?p=quotation.affquota',
                    data: {id:id},
                    type: "POST"
                },
                columns: [
                    { data: "id" },
                    { data: "datequotafr" },
                    { data: "nom"},
                    { data: "num_devis" },
                    { data: "datevaliquotafr" },
                    { data: "daterefusquotafr" },                    
                    { data: "montantDE",

                        render: function(data, type, row) {
                            
                            if (row.montantDE == null) {
                                return montantDE = '0.00 €';
                            } else {

                                mde = Number(row.montantDE);                                
                                return mde.toFixed(2) +' €';
                            }                            
                        }
                    },
                    { data: null },                                        
                    { render : function(data, type, row) { // action / etat_devis = table panne /******** AR******/                        

                            if (row.etat_devis == "Devis Refusé") { // si etat_devis = Devis Refusé //

                                if (typeU == "administrateur") { // si utilisateur = adminsitrateur //

                                    if (row.lien_devis == null) { // si lien_devis isnull //
                                        return `
                                        <button class="btn btn-primary btn-xs" data-role="EditQuota" data-id="`+ row.idcontribut+`"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button>
                                        <button type="button" class="btn btn-success btn-xs" data-role="addfilequota" data-b="DE"<abbr title="Ajouter un PDF">add Devis</abbr></button>`

                                    } else { // sinon //

                                        return `
                                        <button class="btn btn-primary btn-xs" data-role="EditQuota" data-id="`+ row.idcontribut+`"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button> 
                                        <a href="../public/documents/devis/`+ row.lien_devis +`" target="_blank" class="btn btn-danger btn-xs">View Devis</a> 
                                        <button type="button" class="btn btn-theme btn-xs" data-doc="`+ row.lien_devis +`" data-role="replacequota"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>`

                                    }

                                } else { // si utilisateur différent d' administrateur //

                                    if (row.lien_devis == null) { // si lien_devis isnull //
                                        return `
                                        <button class="btn btn-primary btn-xs" disabled><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button type="button" class="btn btn-success btn-xs" data-role="addfilequota" data-b="DE"<abbr title="Ajouter un PDF">add Devis</abbr></button>`

                                    } else { // sinon //

                                        return `
                                        <button class="btn btn-primary btn-xs" data-role="EditQuota" data-id="`+ row.idcontribut+`"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button>
                                        <a href="../public/documents/devis/`+ row.lien_devis +`" target="_blank" class="btn btn-danger btn-xs">View Devis</a> 
                                        <button type="button" class="btn btn-theme btn-xs" data-doc="`+ row.lien_devis +`" data-role="replacequota"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>`

                                    }
                                }                                

                            } else if (row.etat_devis == "Devis En Attente de Réactualisation") {

                                if (typeU == "administrateur") { // si utilisateur = adminsitrateur //

                                    if (row.lien_devis == null) { // si lien_devis isnull //
                                        return `
                                        <button class="btn btn-primary btn-xs" data-role="EditQuota" data-id="`+ row.idcontribut+`"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button>
                                        <button type="button" class="btn btn-success btn-xs" data-role="addfilequota" data-b="DE"<abbr title="Ajouter un PDF">add Devis</abbr></button>`

                                    } else { // sinon //

                                        return `
                                        <button class="btn btn-primary btn-xs" data-role="EditQuota" data-id="`+ row.idcontribut+`"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button> 
                                        <a href="../public/documents/devis/`+ row.lien_devis +`" target="_blank" class="btn btn-danger btn-xs">View Devis</a> 
                                        <button type="button" class="btn btn-theme btn-xs" data-doc="`+ row.lien_devis +`" data-role="replacequota"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>`

                                    }

                                } else { // si utilisateur différent d'administrateur //

                                    if (row.lien_devis == null) { // si lien_devis isnull //
                                        return `
                                        <button class="btn btn-primary btn-xs" disabled><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button type="button" class="btn btn-success btn-xs" data-role="addfilequota" data-b="DE"<abbr title="Ajouter un PDF">add Devis</abbr></button>`

                                    } else { // sinon //

                                        return `
                                        <button class="btn btn-primary btn-xs" disabled><span class="glyphicon glyphicon-pencil"></span></button> 
                                        <a href="../public/documents/devis/`+ row.lien_devis +`" target="_blank" class="btn btn-danger btn-xs">View Devis</a> 
                                        <button type="button" class="btn btn-theme btn-xs" data-doc="`+ row.lien_devis +`" data-role="replacequota"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>`

                                    } 
                                }                             

                            }  else { // si etat_devis is diférent de Devis Refusé ou Devis En Attente de Réactualisation //

                                if (row.lien_devis == null) { // si lien_devis isnull //

                                    if (row.num_devis == null) { // si num_devis et null & num_devis et null //

                                        return `
                                        <button class="btn btn-primary btn-xs" disabled><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button type="button" class="btn btn-success btn-xs" disabled>add Devis</button>`

                                    } else { // si lien_devis et null & num_devis existe //

                                        return `
                                        <button class="btn btn-primary btn-xs" data-role="EditQuota" data-id="`+ row.idcontribut+`"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button>
                                        <button type="button" class="btn btn-success btn-xs" data-role="addfilequota" data-b="DE"<abbr title="Ajouter un PDF">add Devis</abbr></button>`

                                    }

                                } else { // edit ok / lien devis ok / replacequota ok //

                                    return `
                                    <button class="btn btn-primary btn-xs" data-role="EditQuota" data-id="`+ row.idcontribut+`"<abbr title="Edition Devis"><span class="glyphicon glyphicon-pencil"></span></abbr></button> 
                                    <a href="../public/documents/devis/`+ row.lien_devis +`" target="_blank" class="btn btn-danger btn-xs">View Devis</a> 
                                    <button type="button" class="btn btn-theme btn-xs" data-doc="`+ row.lien_devis +`" data-role="replacequota"<abbr title="Changer de document"><i class="fa fa-refresh"></i></abbr></button>`

                                } 
                            }                                                                              
                            
                        }
                    }      
                ],
                columnDefs: [
                    {
                        targets: 7,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {

                            if (row.etat_devis == 'Devis Accepté') {
                                
                                return `
                                <div>
                                    <button class="btn-success btn-round" disabled>Devis Accepté</button>                                 
                                </div>
                                `
                                
                            } else if (row.etat_devis == 'Devis Refusé') {
                                
                                return `
                                <div>
                                    <button class="btn-danger btn-round" disabled>Devis Refusé</button>                                 
                                </div>
                                `
                                                                
                            } else if (row.etat_devis == 'Attente Devis') {  // etats devis dans table devis //                              

                                return `
                                <div>
                                    <select class="btn-primary btn-round" id="etatquota" data-role="etatquota">
                                        <option selected disabled>Attente Devis</option>
                                        <option value="1">Devis Reçu</option>
                                    </select>                                 
                                </div>                            
                                `                               

                            } else if (row.etat_devis == 'Devis En Attente') {      

                                if (row.etatquota == 1) { // etat_devis --> table panne = attente devis /demande devis comparatif //

                                    return `
                                    <div>
                                        <select class="btn-warning btn-round" id="etatquota" data-role="etatquota" disabled>
                                            <option selected >Devis En Attente</option>
                                        </select>                                 
                                    </div>
                                    `
                                } else if (row.etatquota == 2) { 
                                
                                    return `
                                    <div>
                                        <select class="btn-warning btn-round" id="etatquota" data-role="etatquota">
                                            <option selected  disabled>Devis En Attente</option>
                                            <option value="2">Devis Accepté</option>
                                            <option value="3">Devis Refusé</option>
                                        </select>                                 
                                    </div>
                                    ` 
                               
                                } else {

                                    return `
                                    <div>
                                        <button class="btn-warning btn-round" disabled>Devis En Attente</button>                                 
                                    </div>
                                    `
                                } 

                            } else if (row.etat_devis == 'Devis En Attente de Réactualisation') {

                                if (row.etatquota == 6) {

                                    return `
                                    <div>
                                        <select class="btn-warning btn-round" id="etatquota" data-role="etatquota">
                                            <option selected  disabled>Devis En Attente de Réactualisation</option>
                                            <option value="4">Devis Reçu</option> 
                                        </select>
                                                                             
                                    </div>
                                    `    

                                } else {                                    

                                    return `
                                    <div>
                                        <button class="btn-warning btn-round" disabled>Devis En Attente de Réactualisation</button>
                                                                             
                                    </div>
                                    `                                
                                }                         
                                  
                            }
                            
                        }
                    }

                ]            

            });

            let ancre = "#Ancre3";
            ScrollAncre(ancre); 

        }

        // function qui vérifie si le fichier télécharger n'est pas trop volumineux //
        function checkedfile(file) {

            var maxfile = $('input[name=MAX_FILE_SIZE').val();

            if (file > maxfile) { // valeur supérieur //

                alert('Le fichier ne doit pas être supérieur à 1M');
                $('#fileQuota').val('');

            } else {

                $('.ViewerPdf').removeClass('display').addClass('hidden');
                $('.AffbtnViewer').removeClass('hidden').addClass('display');

                $('.AffbtnViewer').on('click', function() {

                    $('.ViewerPdf').removeClass('hidden').addClass('display');

                });
            }                
        }

        // Affiche les devis de la panne / id panne //        
        $(document).on('click', 'a[data-role=VQuotaPanne]', function() {

            $('li[role=presentation5]').attr('class', 'display');
            $('li[role=presentation6]').attr('class', 'display');
            $('li[role=presentation7]').attr('class', 'active');

            let id = $(this).data('id'); // récupére l'id panne                       

            $('#TableIntervMate, #info_interv, .AffIntervs, .AffEvents, .AffContribu, .AffBtnFACT, .AffBtnCERT')
            .removeClass('display')
            .addClass('hidden'); // efface les classe // 
            
            AffQuota(id); // affiche les devis / id panne // 

            let ancre = "#Ancre3";
            ScrollAncre(ancre);             
            
        });       
        
        // function qui modifie l'etatquota et enregistre des données du devis //
        $(document).on('change', 'select[data-role=etatquota]', function() {

            $('.AffdateR, .AffdateV').removeClass('display').addClass('hidden'); // efface les class //
            $('input[name=dater], input[name=datev]').attr('required', false); // mise a false les required //

            var rowtablequota = $(this).closest('tr');
            var id = parseInt(rowtablequota.find('td:eq(0)').text()); // récupére l'id du devis //

            var valslc = $(this).children('option:selected').val();
            $('input[name=valslc]').val(valslc);

            // récupére les données sur le devis //
            $.post('?p=quotation.findDataQuota',

                {id : id}, function(data) {             

                let contribut = rowtablequota.find('td:eq(2)').text(); // récupére le nom de la société intervenante //

                let numquota = data[0].num_devis;
                $('input[name=numquota]').val(numquota); // ecris le numéro de devis //

                var idpanne = data[0].pannes_id;
                $('input[name=IDP_ED_Quota]').val(idpanne); // ecris id panne dans la modal //

                $('input[name=ID_CONTRIB]').val(data[0].contribut_id); // ecris l'id contribut //
                var idmate = $('#IDmate').val();  // récupére l'id mate de la page //
                $('input[name=IDQuota]').val(id);// insert l'id quota dans l'input hidden // 
                $('input[name=contribut]').val(contribut); // ecris le nom de l'intervenant dans la modal // 
                        
                if (valslc == 1) { // Devis reçu / envoi email //

                    $('#ModalEtatQuota').modal('show'); // ouvre la modal //
                    $('.modal-title').html('Réception devis Panne n°:' + idpanne); // ecris le title // 

                    $('.AffdateQ, .AffNumQ, .AffMontantQ').removeClass('hidden').addClass('display');

                    $('input[name=datequota]').on('change', function() {

                        var datequota = $('input[name=datequota]').val();
                        
                    });                     

                    // transforme la valeur avec une virgule en point //
                    $('.Montant').on('click', function() {
                        let inp = $(this).attr("name");
                        $('#'+inp).on('change', function() {
                            let val = $('#'+inp).val();
                            montant(inp, val);
                        });                        
                    });                                        

                    $('#EtatQuota').validator().on('submit', function (event) { 

                        let IdPanne = $('input[name=IDP_ED_Quota]').val(); // récupére l'id panne
                        let mate = $('#num_invent').text(); // récupére le text input page panne_mate //                    

                        if (event.isDefaultPrevented()) {

                        } else {
                        
                            event.preventDefault();

                            $.ajax({
                                url : '?p=quotation.etatquota', 
                                method : 'POST',
                                data : $('#EtatQuota').serialize(),
                                success : function(reponse){                                     

                                    // table quota page panne //                                
                                    AffQuota(IdPanne);
                                    // mise a jour de la table panne 
                                    affPanneMate(IdPanne, "Select");

                                    $('#EtatQuota').trigger('reset'); // reset le formulaire
                                    $('#ModalEtatQuota').modal('hide'); // ferme la modal

                                    $("#info_quota")
                                    .removeClass('hidden')
                                    .addClass('alert alert-success success-dismissable col-lg-8')
                                    .html("Le devis à bien était mis à jour !!!");

                                    recupclassdiv('info_quota', 7000);

                                    var tab = [valslc, mate, IdPanne, "Devis Reçu", datequota]; //manque datequota /***************AREV**********/ 
                                    sendmail_Tech("quota", tab); // envoi email 

                                    AffQuota(IdPanne); // affiche la table devis
                                    affPanneMate(IdPanne, 'Select'); // refresh la table panne (Select) //

                                }         

                            });                     
                        }  
                    });

                } else if (valslc == 2) { // devis accépté //

                    //ouvrir une modal pour ajouté la date de validation //
                    $('#ModalEtatQuota').modal('show');  // ouvre la modal editquota pour edition //
                    $('.modal-dialog').removeClass('modal-dialog modal-lg').addClass('modal-dialog'); // reduit la largeur de la modal // 
                    $('.modal-title').html('Ajout date validation au devis n°: ' + numquota); // ecris le title //

                    $('.AffdateQ, .AffNumQ').addClass('hidden').attr('required', false); // efface les class & desactive les required//                                        
                    $('.AffdateV').removeClass('hidden').addClass('display').attr('required', true); // affiche la date de validation & active le required //
                    $('.AffMontantQ').addClass('hidden').attr('required', false); // efface le montant quota et desactive le required //

                    // validation formulaire //
                    $('#EtatQuota').validator().on('submit', function (event) { 

                        let IdPanne = $('input[name=IDP_ED_Quota]').val(); // récupére l'id panne
                        let IDmate = $('#IDmate').val(); // récupére l'id matériel sur page panne_mate //                     

                        if (event.isDefaultPrevented()) {

                        } else {
                        
                            event.preventDefault();

                            $.ajax({
                                url : '?p=quotation.etatquota', 
                                method : 'POST',
                                data : $('#EtatQuota').serialize(),
                                success : function(reponse){                                

                                    // table quota page panne //                                
                                    AffQuota(IdPanne);
                                    // mise a jour de la table panne 
                                    affPanneMate(IdPanne, "Select");

                                    $('#EtatQuota').trigger('reset'); // reset le formulaire
                                    $('#ModalEtatQuota').modal('hide'); // ferme la modal

                                    $("#info_quota")
                                    .removeClass('hidden')
                                    .addClass('alert alert-success success-dismissable col-lg-8')
                                    .html("Le devis à bien était mis à jour !!!");

                                    recupclassdiv('info_quota', 7000);

                                    CountQuota(IdPanne); // affiche la valeur du devis accépté //
                                    CountQuotat(IDmate); // calcul la somme total des devis accépté //

                                    AffQuota(IdPanne); // affiche la table devis
                                    affPanneMate(IdPanne, 'Select'); // refresh la table panne (Select) // 

                                }         

                            });                     
                        }  
                    });

                } else if (valslc == 3) { // Devis refusé //

                    //ouvrir une modal pour ajouté la date de refus //
                    $('#ModalEtatQuota').modal('show');  // ouvre la modal editquota pour edition //
                    $('.modal-dialog').removeClass('modal-dialog modal-lg').addClass('modal-dialog'); // reduit la largeur de la modal // 
                    $('.modal-title').html('Ajout date refus au devis n°: ' + numquota); // ecris le title //

                    $('.AffdateQ, .AffNumQ').addClass('hidden').attr('required', false); // efface les class & desactive les required//                                        
                    $('.AffdateR').removeClass('hidden').addClass('display').attr('required', true); // affiche la date de refus & active le required //
                    $('.AffMontantQ').addClass('hidden').attr('required', false); // efface le montant quota et desactive le required //

                    // validation formulaire //
                    $('#EtatQuota').validator().on('submit', function (event) { 

                        let IdPanne = $('input[name=IDP_ED_Quota]').val(); // récupére l'id panne
                        let IDmate = $('#IDmate').val(); // récupére l'id matériel                      

                        if (event.isDefaultPrevented()) {

                        } else {
                        
                            event.preventDefault();

                            $.ajax({
                                url : '?p=quotation.etatquota', 
                                method : 'POST',
                                data : $('#EtatQuota').serialize(),
                                success : function(reponse){                                

                                    // table quota page panne //                                
                                    AffQuota(IdPanne);
                                    // mise a jour de la table panne 
                                    affPanneMate(IdPanne, "Select");

                                    $('#EtatQuota').trigger('reset'); // reset le formulaire
                                    $('#ModalEtatQuota').modal('hide'); // ferme la modal

                                    $("#info_quota")
                                    .removeClass('hidden')
                                    .addClass('alert alert-success success-dismissable col-lg-8')
                                    .html("Le devis à bien était mis à jour !!!");

                                    recupclassdiv('info_quota', 7000);

                                    CountQuota(IdPanne); // affiche la valeur du devis accépté //
                                    CountQuotat(IDmate); // calcul la somme total des devis accépté //

                                    AffQuota(IdPanne); // affiche la table devis
                                    affPanneMate(IdPanne, 'Select'); // refresh la table panne (Select) // 

                                }         

                            });                     
                        }  
                    });

                } else if (valslc == 4) { // Devis réactualisé reçu /**********A TESTER***********/

                    $('#ModalEtatQuota').modal('show'); // ouvre la modal //
                    $('.modal-title').html('Réception devis Réactualisé:'); // ecris le title //

                    // transforme la valeur avec une virgule en point //
                    $('.Montant').on('click', function() {
                        let inp = $(this).attr("name");
                        $('#'+inp).on('change', function() {
                            let val = $('#'+inp).val();
                            montant(inp, val);
                        });                        
                    });

                    $('#EtatQuota').validator().on('submit', function (event) { 

                        let IdPanne = $('input[name=IDP_ED_Quota]').val(); // récupére l'id panne                                          

                        if (event.isDefaultPrevented()) {

                        } else {
                        
                            event.preventDefault();

                            $.ajax({
                                url : '?p=quotation.etatquota', 
                                method : 'POST',
                                data : $('#EtatQuota').serialize(),
                                success : function(reponse){

                                    $('#EtatQuota').trigger('reset'); // reset le formulaire
                                    $('#ModalEtatQuota').modal('hide'); // ferme la modal                                   

                                    $("#info_quota")
                                    .removeClass('hidden')
                                    .addClass('alert alert-success success-dismissable col-lg-8')
                                    .html("Le devis à bien était mis à jour !!!");

                                    recupclassdiv('info_quota', 7000);

                                    // table quota page panne //                                
                                    AffQuota(IdPanne);
                                    // mise a jour de la table panne 
                                    affPanneMate(IdPanne, "Select");
                                    
                                }         

                            });                     
                        }  
                    });

                }

                // close modal on clicking close button //
                $('.modal-content').find('.close, .Close').on('click',function(){

                    AffQuota(idpanne);
                });
                
            });            

        });

        // function qui edit le devis //        
        $(document).on('click', 'button[data-role=EditQuota]', function(){

            $('#EditQuota')[0].reset();
            $('#datev, #dater').val("");

            let TableQuotaAll = $('#TableQuotation').is(':visible'); // verifie si la page devis all et affiché //
            let TablePendingQuote = $('#TablePendingQuote').is(':visible'); // verifie si la page devis en attente et affiché //

            let rowtablequota = $(this).closest('tr');
            let id = parseInt(rowtablequota.find('td:eq(0)').text()); // récupére l'id du devis //            

            let montantquota, numquota, statutquota, datev, dater, daterequest;

            $('#ModalEditQuota').modal('show'); // ouvre la modal editquota pour edition //
            $('.modal-dialog').removeClass('modal-dialog modal-lg').addClass('modal-dialog'); // reduit la largeur de la modal // 
            $('.modal-title').html('Edition du devis n°: ' + numquota); // ecris le title //

            $('.AffdateQ, .AffNumQ, .AffMontantQ')
            .removeClass('hidden')
            .addClass('display')
            .attr('required', false); // affiche les class & active les required//

            if (TableQuotaAll == true || TablePendingQuote == true) { 

                daterequest = rowtablequota.find('td:eq(1)').text(); // récupére la date de demande devis //            
                datequota = rowtablequota.find('td:eq(2)').text(); // récupére la date //
                numquota = rowtablequota.find('td:eq(5)').text(); // récupére le numéro de devis //                
                montantquota = rowtablequota.find('td:eq(8)').text(); // récupére le montant //
                statutquota = rowtablequota.find('td:eq(9) option:selected').text(); // récupére le statut devis //
                datev = rowtablequota.find('td:eq(6)').text(); // récupére la date de validation // 
                dater = rowtablequota.find('td:eq(7)').text(); // récupére la date de refus // 

                // retourne la date devis demander //
                let part = daterequest.split(/-/);
                part.reverse();
                let daterevers = (part.join('-'));
                $("#daterequest").val(daterevers); // affiche la date enregistrer 

            } else {         
            
                datequota = rowtablequota.find('td:eq(1)').text(); // récupére la date //
                numquota = rowtablequota.find('td:eq(3)').text(); // récupére le numéro de devis //
                montantquota = rowtablequota.find('td:eq(6)').text(); // récupére le montant //
                statutquota = rowtablequota.find('td:eq(7) option:selected').text(); // récupére le statut devis //
                datev = rowtablequota.find('td:eq(4)').text(); // récupére la date de validation  
                dater = rowtablequota.find('td:eq(5)').text(); // récupére la date de refus   
            }            

            let mtquota = montantquota.slice(0, -1); // supprime le caractére euro //                             

            // retourne la date du devis//
            let parts = datequota.split(/-/);
            parts.reverse();
            let datereverse = (parts.join('-'));
            $("#datequota").val(datereverse); // affiche la date enregistrer

            // ecris le numéro de devis //
            $('#numQuota').val(numquota);

            if (datev) { // date validation 

                $('.AffdateV').removeClass('hidden').addClass('display');
                $('.AffdateR').removeClass('display').addClass('hidden');
                $('#datev').attr('required', true);
                $('#dater').attr('required', false);

                // retourne la date valid //
                let parts = datev.split(/-/);
                parts.reverse();
                let datevr = (parts.join('-'));
                $("#datev").val(datevr); // affiche la date enregistrer

            } else if (dater) { // date refus 

                $('.AffdateR').removeClass('hidden').addClass('display');
                $('.AffdateV').removeClass('display').addClass('hidden');
                $('#dater').attr('required', true);
                $('#datev').attr('required', false);

                // retourne la date refus //
                let parts = dater.split(/-/);
                parts.reverse();
                let daterr = (parts.join('-'));
                $("#dater").val(daterr); // affiche la date enregistrer

            } else {

                $('.AffdateV').removeClass('display').addClass('hidden');
                $('#datev').attr('required', false);
                $('.AffdateR').removeClass('display').addClass('hidden');
                $('#dater').attr('required', false);
            }

            let idpanne = $('#IDPanne').val(); // récupére l'id panne //
            $('#IDP_ED_Quota').val(idpanne);

            $('#inp').val(''); // efface inp //

            $('#datev, #dater').on('change', function() {

                var inp = $(this).prop("name");

                $('#inp').val(inp);

            });

            $('#montantQuota').val(mtquota); // affiche le montant devis //
            
            // transforme la valeur avec une virgule en point //            
            $('.Montant').on('click', function() {
                let inp = $(this).attr("name");
                $('#'+inp).on('change', function() {
                    let val = $('#'+inp).val();
                    montant(inp, val);
                });                        
            });        

            $('#IDQuota').val(id);// insert l'id quota dans l'input hidden //

            $('#ID_CONTRIB').val($(this).data('id')); // ecris l'id contribut dand inp hidden //                                           

            $('#EditQuota').validator().on('submit', function (event) { 

                let IdPanne = $('#IDP_ED_Quota').val();
                let mateID = $('#IDmate').val(); // récupére l'id matériel                                           

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();

                    $.ajax({
                        url : '?p=quotation.edit', 
                        method : 'POST',
                        data : $('#EditQuota').serialize(),
                        success : function(reponse){                            
                            
                            if (TableQuotaAll == true) {

                                $("#info_user")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-8')
                                .html("Le devis à bien était mis à jour !!!");

                                recupclassdiv('info_user', 7000);
                                TableQuotation.ajax.reload(); //régénére la table devis

                            } else if (TablePendingQuote == true) {

                                $("#info_user")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-8')
                                .html("Le devis à bien était mis à jour !!!");

                                recupclassdiv('info_user', 7000);
                                TablePendingQuote.ajax.reload(); //régénére la table devis

                            } else {

                                $("#info_quota")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-8')
                                .html("Le devis à bien était mis à jour !!!");

                                recupclassdiv('info_quota', 7000);

                                CountQuota(IdPanne);
                                CountQuotat(mateID);

                                // table quota page panne //                                
                                AffQuota(IdPanne);
                                // mise a jour de la table panne 
                                affPanneMate(IdPanne, "Select");

                            } 

                            $('#ModalEditQuota').modal('hide'); // ferme la modal
                        }         

                    });                     
                }  
            });
        });        

        // add fichier DEVIS //        
        $(document).on('click', 'button[data-role=addfilequota]', function(){

            // recupére l'id sur le tr table quota //
            let rowtablequota = $(this).closest('tr');
            let idquota = parseInt(rowtablequota.find('td:eq(0)').text()); // recupére l'id du devis //
            let idpanne, numquota            

            if ($('#TableQuotation').is(':visible') == true) {

                idpanne = rowtablequota.find('td:eq(3)').text(); // récupére le numéro de la panne sur la table //            
                numquota = rowtablequota.find('td:eq(4)').text(); // récupére le numéro de devis //
            } else {

                idpanne = $('#IDPanne').val();  // récupére l'id panne sur la page //         
                numquota = rowtablequota.find('td:eq(3)').text(); // récupére le numéro de devis //
            }          
            
            $('#ModalQuota').modal('show'); // ouvre la modal
            $('.modal-title').html('Téléchargement du devis'); // ecris le title  
            $('.AffNMD, .AffInfoDoc, .AffdocEnreg, .AffbtnViewer, .ViewerPdf').removeClass('display').addClass('hidden'); // efface les classes //
            $('#MateID, #IDquota, #NumQuota, #PanneID, #IndexUp, #op').val(' '); // efface les champ input                        

            let mateID = $('#IDmate').val(); //récupére l'id matériel sur la page matériels //            
            $('input[name=MateID]').val(mateID);// ecris dans l'input hidden // 
            
            $('#IDquota').val(idquota); // ecris l'id dans l'input hidden //
            $('#NumQuota').val(numquota); // ecris dans l'input le num quota// 
                     
            $('input[name=PanneID]').val(idpanne); // ecris dans input hidden //
            $('input[name=IndexUp]').val('DE'); // ecris l'index dans l'input hidden //                                                                              

            // affiche un btn voir le fichier télécharger //

            $('#fileQuota').on('change', function() {

                var file = this.files[0].size;
                checkedfile(file);

            });      

            $('input[name=op]').val('addF');

        }); 

        // remplace fichier DEVIS //        
        $(document).on('click', 'button[data-role=replacequota]', function(){ 

            // recupére l'id sur le tr table quota //
            let rowtablequota = $(this).closest('tr');
            let idquota = parseInt(rowtablequota.find('td:eq(0)').text()); // recupére l'id du devis //
            let idpanne = $('#IDPanne').val(); // récupére l'id panne                   
            
            $('#ModalQuota').modal('show'); // ouvre la modal 
            $('.modal-title').html('Changement du devis'); // ecris le title  

            $('.AffInfoDoc, .AffdocEnreg, .AffbtnViewer, .ViewerPdf').removeClass('display').addClass('hidden'); // efface les classes //
            $('.AffNMD').removeClass('hidden').addClass('display'); // affiche la class //
            $('input[name=MateID], #NumQuota, #PanneID, #IndexUp, #docenreg').val(' '); // efface les champ input
            $('#NumQuot, #montantQuot').prop('required', false); // active le required //                        

            let mateID = $('#IDmate').val(); //récupére l'id matériel sur la page matériels //            
            $('input[name=MateID]').val(mateID);// ecris dans l'input hidden //            
            
            $('#IDquota').val(idquota); // ecris l'id dans l'input hidden //
            
            let docenreg = $(this).data('doc'); // récupére le numero du fichier existant //
            $('input[name=PanneID]').val(idpanne); // ecris dans input hidden //
            $('input[name=IndexUp]').val('DE'); // ecris l'index dans l'input hidden //

            $('input[name=docenreg]').val(docenreg); // ecris dans l'input //
            $('.AffdocEnreg')
            .removeClass('hidden')
            .addClass('display')
            .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer du devis n°:"+ " " + docenreg + " " + "sera effacé si vous le modifié !!");                                    
             
            // affiche un btn voir le fichier télécharger //
            $('#fileQuota').on('change', function() {

                var file = this.files[0].size;
                checkedfile(file);

            });            
            
            // transforme la valeur avec une virgule en point //            
            $('.Montant').on('click', function() {
                let inp = $(this).attr("name");
                $('#'+inp).on('change', function() {
                    let val = $('#'+inp).val();
                    montant(inp, val);
                });                        
            });      

            $('input[name=op]').val('upF');            

        }); 

        // validation du formulaire FileQuota//
            
        $('#FileQuota').validator().on("submit", function(event){ 

            var TableQuotaAll = $('#TableQuotation').is(':visible'); // verifie si la page devis all et affiché //
            var op = $('input[name=op]').val(); 
            var mateID = $('input[name=MateID]').val();
            var idpanne = $('#PanneID').val(); // récupére l'id panne                            

            if (event.isDefaultPrevented()) {

            } else {

                event.preventDefault();               

                if (op == 'addF') { // si op = add files //

                    var form = $('#FileQuota')[0];
                    var data = new FormData(form);

                    $.ajax({
                        url : '?p=documents.addfile', 
                        type : 'POST',
                        enctype : 'multipart/form-data',
                        data : new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success : function(data){

                            $('#ModalQuota').modal('hide'); // ferme la modal                                                             
                            
                            if (TableQuotaAll == false) { // si ont et dans pannemate
                                CountQuota(idpanne);
                                CountQuotat(mateID);
                                AffQuota(idpanne); //régénére la table
                            } else {

                                TableQuotation.ajax.reload(); //régénére la table
                            }                               

                            $('#FileQuota').trigger('reset'); // reset le formulaire                    
                        }
                    });    

                } else { // sinon op = add upload //

                    var form = $('#FileQuota')[0];
                    var data = new FormData(form);

                    $.ajax({
                        url : '?p=documents.upload', 
                        type : 'POST',
                        enctype : 'multipart/form-data',
                        data : new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success : function(data){

                            $('#ModalQuota').modal('hide'); // ferme la modal //                                                             
                            
                            if (TableQuotaAll == false) {
                                CountQuota(idpanne);
                                CountQuotat(mateID);
                                AffQuota(idpanne); //régénére la table
                            } else {

                                TableQuotation.ajax.reload(); //régénére la table
                            }                               

                            $('#FileQuota').trigger('reset'); // reset le formulaire                    
                        }
                    });
                }
            }
        }); 

    // EVENT //
        
        // EVENT PANNES MAT & MAT LIER //

        // AFF evenement panne par l'id panne //
        function affEventPanne(id, etatpanne) {

            $('li[role=presentation5]').attr('class', 'active');            

            // affiche la div de la table evenements //
            $('.AffEvents').removeClass('hidden').addClass('display');            
            // affiche le title event //
            $('#title_event').html('Evénements de la panne: '+ id + '  ' + '<button class="btn btn-round btn-warning" id="btnAddEvent" data-role="AddEvent" data-id="'+id+'"<abbr title="Ajouter un évenement à la panne"><span class="glyphicon  glyphicon-plus"></span></abbr></button>');

            btnAddEvent(etatpanne); // verifie si il faut enable ou disabled le btn add event //

            // affiche la table event //
            
            // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableEvent')) {

                $('#TableEvent').DataTable().destroy()
            }
            
            $('#TableEvent').DataTable({

                language: {url: "../public/media/French.json"},                                           
                paging: false,
                searching: false,
                scrollY: '40vh',
                scollCollapse: true,
                ajax: {
                    url: '?p=events.affEvent',
                    data: {id:id},
                    type: "POST",
                    dataType: 'json'
                },
                columns: [
                    { data: "id" },
                    { data: "dateeventfr" },
                    { data: "heureeventfr"},
                    { data: "event" },
                    { data: "designation" },
                    { data: "user" },                                       
                    { render : function(data, type, row) {

                          return `<button class="btn btn-primary btn-xs" data-role="EditEvent" data-id="`+row.pannes_id+`"<abbr title="Edition de l\'évenement"><span class="glyphicon  glyphicon-pencil"></span></abbr></button>
                                <button type="submit" class="btn btn-danger btn-xs hidden"<abbr title="Supprimé l\'évenement"><span class="glyphicon glyphicon-trash"></span></abbr></button>`  
                        }                           
                        
                    }   
                ]            

            });           
           
        }

        // enable ou disabled le btnAddEvent //
        function btnAddEvent(etatpanne, statut) {

            if (statut == "Rebus") {
                $('#btnAddEvent').prop('disabled', true).attr('title', 'Matériel au Rebus impossible d\'ajouter un événement !!!'); 
            } else {

                if (etatpanne == "Terminé") {

                    $('#btnAddEvent').prop('disabled', true).attr('title', 'Panne Terminé impossible d\'ajouter un événement !!!');                

                } else if (etatpanne == "Non Réparé") {

                    $('#btnAddEvent').prop('disabled', true);

                } else if (etatpanne == 'Attente Devis' || etatpanne == 'Attente Devis Réactualisé') {

                    $('#btnAddEvent').prop('disabled', true);
                    
                } else {

                    $('#btnAddEvent').prop('disabled', false);
                }
            }

        }

        // charge le select statut Appel contact //
        function loadSelect_statutAppel(index) {

            $('#StatutAppel').prop('required', true); // active le champ required
            $('#StatutAppel option').remove();

            if (index == 'AI') { // AI == Appel Intervenant //

                $("#StatutAppel").append('<option value="0" selected="" disabled >Choisir un statut</option>');
                $("#StatutAppel").append('<option value="1">Intervenant Contacter</option>'); // ajoute une option dans le select //                                                                
                $("#StatutAppel").append('<option value="2">L\'Intervenant me fait rappeler par un tech</option>'); // ajoute une option dans le select //                                                                
                $("#StatutAppel").append('<option value="3">Laisser Message sur répondeur</option>'); // ajoute une option dans le select //

            } if (index == 'RAI') { // RAI == Rappel Intervenant //

                $("#StatutAppel").append('<option value="0" selected="" disabled >Choisir un statut</option>');
                $("#StatutAppel").append('<option value="1">Intervenant Contacter</option>'); // ajoute une option dans le select //                                                                
                $("#StatutAppel").append('<option value="2">L\'Intervenant me fait rappeler par un tech</option>'); // ajoute une option dans le select //                                                                
                $("#StatutAppel").append('<option value="3">Laisser Message sur répondeur</option>'); // ajoute une option dans le select //
                $("#StatutAppel").append('<option value="4">Appeler un autre contact</option>'); // ajoute une option dans le select //

            } else if(index == 'AIR') { // Appel Intervenant Réactualisation devis //

                $("#StatutAppel").append('<option value="0" selected="" disabled >Choisir un statut</option>');
                $("#StatutAppel").append('<option value="1">Intervenant Contacter</option>'); // ajoute une option dans le select //                                                               
                $("#StatutAppel").append('<option value="3">Laisser Message sur répondeur</option>'); // ajoute une option dans le select //
            }            

        }

        // charge le select statut rappel contact //        
        function loadSelect_statutRappel() {

            $('#StatutRappel').prop('required', true); // active le champ required
            $('#StatutRappel option').remove();

            $("#StatutRappel").append('<option value="0" selected="" disabled >Choisir un statut</option>');
            $("#StatutRappel").append('<option value="1">Intervenant Contacter</option>'); // ajoute une option dans le select //                                                                
            $("#StatutRappel").append('<option value="2">L\'Intervenant me fait rappeler par un tech</option>'); // ajoute une option dans le select //                                                                
            $("#StatutRappel").append('<option value="3">Laisser Message sur répondeur</option>'); // ajoute une option dans le select //
        }

        // charge le select statut tech //
        function loadSelect_statutTech() {

            $('#StatutAppel').prop('required', true) // active le champ required
            $('#StatutAppel option').remove()
            $("#StatutAppel").append('<option value="0" selected="" disabled >Choisir un statut</option>')
            $("#StatutAppel").append('<option value="4">Technicien Contacter</option>') // ajoute une option dans le select //
            $("#StatutAppel").append('<option value="5">Laisser Message sur répondeur</option>') // ajoute une option dans le select //

        }

        // verifie si il existe des evenements pour la panne et les affichent //
        function checkedEventPanne(id, page) {
            
            // verifie si la panne a un ou plusieurs événement / id panne //
            $.ajax({
                url: '?p=events.checkedEvent',
                data: {id:id, page:page},
                method: 'POST',
                success: function(reponse) {                    

                    // action si des evenements existe //

                    $('.AffDataPanne, .AffNavs2').removeClass('hidden').addClass('display'); // affiche les class //
                    //*****************//
                    let etatpanne = reponse[0].etat_panne;
                    // un ou plusieurs événement existe //                   
                    affEventPanne(id, etatpanne); // affiche les events / id panne //                    

                    // verifie si des documents existe// id panne //
                    checkedDocFact(id); 
                    checkedDocCE(id);                           

                    let ancre = "#BtnHaut";
                    ScrollAncre(ancre);

                }
                  
            });
        }

        // function qui affiche les événements des pannes //
        
        $(document).on('click', 'a[data-role=VEventsPanne]', function(){

            $('li[role=presentation5]').attr('class', 'active');
            $('li[role=presentation6]').attr('class', 'display');
            $('li[role=presentation7]').attr('class', 'display');

            $('.AffContribu, .AffIntervs, .AffQuota').removeClass('display').addClass('hidden'); // efface //
            $('.AffEvents, .AffBtnFACT, .AffBtnCERT').removeClass('hidden').addClass('display'); // affiche

            let IDpanne = $('#IDPanne').val();
            // verifie si des documents existe
            checkedDocFact(IDpanne);
            checkedDocCE(IDpanne);

            //affEventPanne(IDpanne) //
            checkedEventPanne(IDpanne, 'mate');

            let ancre = "#BtnHaut";
            ScrollAncre(ancre); 
             
        });      

        // add event panne //
    
        $(document).on('click', 'button[data-role=AddEvent]', function (){
           
            var id = $('#IDPanne').val(); // id panne            
            $('#IdPanne').val(id); // ecris dans input IdPanne modal add event //

            var idMate = $('#IDmate').val(); // récupére l'id materiel //            
            $('#IdMate').val(idMate); // ecris dans l'input modal add event //

            let t = heurebd(); // function qui donne l'heure

            $('.ctrl').prop('required', false); // desactive la propriété required de la class ctrl//
            $('textarea[id=Commentaire]').prop('required', true); // active la propiété required Commentaire par défaut//
            $('#InpHidden').empty(); // efface la div inp hidden

            // remonte les données sur la panne //
            $.ajax({
                url: '?p=pannes.findDataPanne',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    let i = reponse.length -1;
                    let etatpanne = reponse[0].etat_panne;
                    let etatquota = reponse[0].etat_devis;

                    let IdInterv = reponse[i].interv_id; // la derniére intervention 
                    let sg = reponse[0].sous_garanti;                    
                    
                    // valeur par defaut //
                    $('input[id=DemDevis]').attr('disabled', true); // desactive le btn radio demande devis    
                    // efface les class //
                    $('.AffContriAlreadyContact, .AffAppelContribut, .AffContriContact, .AffSelectContact, .AffSelectEmail, .AffAppelTech, .AffStatutAppel, .AffStatutRappel, .AffStatutPanne, .AffAddEvent, .AffInfoDiag, .AffInfoNoMaterial, .AffInfoBascule, .AffComment, .AffCheckBox0, .AffCheckBox1, .AffCheckBox1_1, .AffCheckBox2, .AffCheckBox3, .AffQuotaPanne').removeClass('display').addClass('hidden');
                    // reduit la largeur de la modal //
                    $('#ModalAddEvent').removeClass('modal fade bs-example-modal-lg').addClass('modal fade');
                    $('.modal-dialog').removeClass('modal-dialog modal-lg').addClass('modal-dialog');

                    if (etatpanne == "Attente Intervention Interne") { // ETAT 1 //
                        
                        $('#ModalAddEvent').modal('show');// ouvre la modal //
                        $('.modal-title').html('Intervention Interne panne n°: ' +id); // affiche le title //
                        $('.AffLabel').html('Date Intervention'); // ecris le label date //

                        $('#HeureEvent').val(t) // affiche l'heure //                                              
                        $('input[name=BTNRadio]:visible').prop('required', true); // active le champ obligatoire
                        $('.AffComment, .AffCheckBox2').removeClass('hidden').addClass('display'); // affiche la class

                        if (reponse[0].mat_category == "SN") {

                            $('input[id=DemDevis]').attr('disabled', false); // active le btn radio                            
                            
                        }

                        $('#Etat').val('1'); // ecris etat dans l'input

                    } else if (etatpanne == "Attente Appel Intervenant") { // ETAT 2 //
                        
                        $('#ModalAddEvent').modal('show'); // ouvre la modal //                                                
                        $('#titleAddEvent').html('Appel intervenant !!'); // affiche le title //
                        $('.AffLabel').html('Date Evénement'); // ecris le label date //                                                
                        $('#HeureEvent').val(t); // affiche l'heure //

                        $('select[id=Event], #Commentaire, input[name=BTNRadio]').prop('required', false); // retire le champ obligatoire                                               
                        load_SelectContri(id); // charge le select /id = id panne / EXT //
                        $('.AffComment, .AffAppelContribut').removeClass('hidden').addClass('display');// affiche affiche appel contribut & commentaire//                                                
                        
                        $('#Contributor').change(function(){

                            $('#Contribut').remove(); // efface l'input créer avec jquery

                            let IdContribut = $('#Contributor').val(); // récupére la valeur de l'option choisi
                            let nom = $('#Contributor option:selected').text(); // récupére le nom du contributor

                            $('#IdContribut').val(IdContribut); // ecris dans l'input hidden//
                            $('#InpHidden').append('<input type="hidden" id="Contribut" name="Contribut" value="'+ nom +'">'); // crer un input dans la div//
                            
                            $('.AffSelectContact').removeClass('hidden').addClass('display'); // affiche le select contact
                            $(".AffStatutAppel").removeClass('display').addClass('hidden'); // efface la div 
                                                                                    
                            load_SelectContact(IdContribut);                                                     

                            $('#Contact').change(function() {

                                let contact = $('#Contact option:selected').text();
                                let cc = contact + ' ' + 'société' + ' ' + nom;                                
                                $('#ContriContact').val(cc);
                                $('.AffStatutAppel').removeClass('hidden').addClass('display');// affiche statut appel//
                                loadSelect_statutAppel('AI'); // charge le select / AI = Appel Intervenant //                                                                                               

                            });
                        });
                                             
                        $('#Etat').val('2'); // ecris etat dans l'input 

                    } else if (etatpanne == "Attente Envoi email") { 

                        $("#SelectVolets")[0].reset();
                        $('#validateVolet').attr('disabled', true); // desactive le btn envoi //                        

                        // consulte la base de donnée pour savoir si il y a un ou plusieur volets en panne //
                        $.ajax({
                            url: '?p=materials.shutterfailure',
                            method: 'POST',
                            dataType: 'json',
                            success: function(reponse) {
                                
                                if (reponse.length == 1) { // un volet en panne //
                                    
                                    load_sendmail(id, 'Un');
                                    $('.AffPieceJointe').removeClass('display').addClass('hidden');

                                } else {

                                    $('#selectvolets').modal('show'); // ouvre la modal //
                                    $('.AffTableVolet').removeClass('display').addClass('hidden'); // efface la div //
                                    $('.AffInfo').removeClass('hidden').addClass('display'); // affiche la div //
                                    $('#title_selectvolets').html('Information !!!'); // affiche le title //

                                    $('#request').html('Il y à ' +reponse.length+ ' matériels en panne, voulez-vous les selectionner pour envoi par email!!!');
                                    // plusieurs volets en panne //
                                    $('input[name=BTN]').on('click', function(){

                                        let btn = $("input[name='BTN']:checked").val();

                                        if (btn == 1){ // oui
                                             
                                            $('#title_selectvolets').html('Liste des volets en panne !!'); // affiche le title //
                                            $('#nom_modal').removeClass('modal fade').addClass('modal fade bs-modal-lg');
                                            $('.modal-dialog').removeClass('modal-dialog').addClass('modal-dialog modal-lg');
                                            $('.AffInfo').removeClass('display').addClass('hidden'); // efface la class //                                                                                       

                                            // dataTables volets en panne //
                                            $('.AffTableVolet, .AffPieceJointe').removeClass('hidden').addClass('display');

                                            // reinitialise la table //
                                            if ($.fn.dataTable.isDataTable('#TableVoletSelect')) { 

                                                $('#TableVoletSelect').DataTable().destroy(); 

                                            }                                                

                                            let TableVoletSelect = $('#TableVoletSelect').DataTable({               
                                                language: {url: "../public/media/French.json"},
                                                paging: false,
                                                searching: false,
                                                scollCollapse: true,
                                                data: reponse,                                
                                                columns: [
                                                                                                    
                                                    { data: "id" },
                                                    { data: "idpanne" },
                                                    { data: "num_inventaire" },
                                                    { data: "produit" },
                                                    { data: "marque" },
                                                    { data: "model" },
                                                    { data: "type" },
                                                    { data: "num_serie" },
                                                    { data: "niveau" },
                                                    { data: "piece"},
                                                    { data: "statut",
                                                        render: function(data, type) {

                                                            if (type === 'display') {
                                                                let color = 'green';
                                                                if (data === 'En Panne') {
                                                                    color = 'red';
                                                                }                            
                                    
                                                                return '<span style="color:' + color + '">' + data + '</span>';
                                                            }                           
                                                                return data;
                                                        }
                                                    }                
                                                
                                                ],
                                                columnDefs: [
                                                    {
                                                        target: 1,
                                                        visible: false,
                                                        searchable: false
                                                    }
                                                ]                                                           
                                            });                               

                                            $('#TableVoletSelect tbody').on('click', 'tr', function () {

                                                $(this).toggleClass('selected');

                                                if ($('tr').hasClass('selected') == true) {

                                                    $('#validateVolet').attr('disabled', false); 

                                                } else if($('tr').hasClass('selected') == false) {

                                                    $('#validateVolet').attr('disabled', true); // desactive le btn envoi //
                                                } 

                                                    let tabM = [];
                                                    let tabP = [];

                                                    let nbr = TableVoletSelect.rows('.selected').data();

                                                    for(let i = 0; i < nbr.length; i++) {

                                                        tabM.push(nbr[i].id);
                                                        tabP.push(nbr[i].idpanne);
                                                    }

                                                    // création de num file pdf //
                                                    let d = new Date();
                                                    let date = d.getDate()+''+(d.getMonth()+1)+''+d.getFullYear();
                                                    let numfile = date+'_'+tabM.join('');
                                                    $('#numfile').val(numfile);

                                                    $('#tabM').val(tabM);
                                                    $('#tabP').val(tabP);
                                                    let key = tabM.length;
                                                    $('#key').val(key);                                                                                                      

                                            });

                                            $('#SelectVolets').validator().on('submit', function(event) {

                                                let numfile = $('#numfile').val();
                                                let tabidpanne = $('#tabP').val();

                                                if (event.isDefaultPrevented()) {

                                                } else {
                                                
                                                    event.preventDefault();                                        

                                                    // création du pdf //
                                                    $.ajax({
                                                        url: '?p=events.attachementpdf',
                                                        data: $('#SelectVolets').serialize(),
                                                        method: 'POST',
                                                        success: function(reponse) {                                                                                                          
                                                                                
                                                        }
                                                          
                                                    });  
                                                    // affichage de send mail //                                        
                                                    load_sendmail(id, 'Multi', numfile, tabidpanne);                                        
                                                    
                                                }

                                            });

                                        } else { // non

                                            load_sendmail(id, 'Un');
                                            $('.AffPieceJointe').removeClass('display').addClass('hidden');                                                                     

                                        }                            

                                    });
                                    
                                }                                                       
                                                    
                            }
                              
                        });

                    } else {

                        // si reponse et true ont ouvre modal addevent pour ajouter un évenement //
                        $('#ModalAddEvent').modal('show'); // ouvre la modal //
                        $('.modal-title').html('Ajouter un événement à la panne n°: ' +id); // affiche le title //
                        $('.AffLabel').html('Date Evenement'); // ecris le label date //                                               
                        $('#HeureEvent').val(t); // affiche l'heure //

                        $('.AffAddEvent').removeClass('hidden').addClass('display'); // affiche la div addevent
                        $('#Event').prop('required', true); // applique la propriété required

                        $('.AffSelectContact').removeClass('display').addClass('hidden'); //efface la div select contact
                        $('input[name=BTNRadio]').prop('required', false); // retire le champ obligatoire                        
                        $('#Event').empty(); // efface le select //
                       
                        // ecris dans le select les option en fonction de l'etat panne //
                        if (etatpanne == 'Attente Rappel Intervenant') {

                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>');
                            $('#Event').append('<option value=1> Rappel intervenant </option>');                            
                            $('#Event').append('<option value=1.1> Rappel de l\'intervenant </option>');                            

                        } else if (etatpanne == "Attente Appel Technicien") {

                            if (reponse[i].tech_id == null) {
                            
                                $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>');
                                $('#Event').append('<option value=1> Rappel intervenant </option>'); 
                                $('#Event').append('<option value=1.7> Appel du Technicien </option>');

                            } else {

                                $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>');
                                $('#Event').append('<option value=1> Rappel intervenant </option>'); 
                                $('#Event').append('<option value=1.4> Rappel Technicien </option>');                            
                                $('#Event').append('<option value=1.3> Rappel du technicien</option>');

                            }

                        } else if (etatpanne == "Attente Rappel Technicien") {

                            $('#Event').append('<option value=0 disabled selected> Choisir l\'évenement !! </option>');
                            $('#Event').append('<option value=1> Rappel intervenant </option>'); 
                            $('#Event').append('<option value=1.4> Rappel Technicien </option>');                            
                            $('#Event').append('<option value=1.3> Rappel du technicien</option>');                            

                        } else if (etatpanne == 'Attente Intervention') {

                            if (reponse[i].tech_id == null) {

                                $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>');
                                $('#Event').append('<option value=1> Rappel intervenant </option>'); // OK //
                                $('#Event').append('<option value=1.1> Rappel de l\'intervenant </option>');
                                $('#Event').append('<option value=2> Intervention </option>');

                            } else {

                                $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>')
                                $('#Event').append('<option value=1.4> Rappel Technicien </option>')
                                $('#Event').append('<option value=2> Intervention </option>')

                            }                            

                        } else if (etatpanne == 'Attente diagnostique') { 
                            
                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>');
                            $('#Event').append('<option selected> Diagnostique </option>');

                            $('#IdInterv').val(IdInterv); // ecris dans l'input id intervention //
                            $('#IdContribut').val(reponse[i].contribut_id); // ecris l'Id contribut dans l'input hidden //
                            // ecris l'id contact dans l'input hidden //
                            $('#InpHidden').append('<input type="hidden" id="IdContact" name="IdContact" value="'+ reponse[i].contact_id +'">');                             

                            if (reponse[0].mat_category == "P") { 

                                $('.AffInfoDiag').removeClass('hidden').addClass('display'); // affiche la class //

                                $('input[name=BTN]').on('click', function(){

                                    let btn = $("input[name='BTN']:checked").val();

                                    if (btn == 2){ // non

                                        $('.AffComment, .AffCheckBox0, .AffCheckBox1').removeClass('hidden').addClass('display');// affiche interv sous garantie & attente devis ou réparation en cours //
                                        $('input[name=BTNRadio]:visible').prop('required', true); // applique la propriété required
                                        $('.AffInfoNoMaterial').removeClass('display').addClass('hidden'); // efface la class //

                                    } else { // oui

                                        $('.AffComment, .AffCheckBox0, .AffCheckBox1').removeClass('display').addClass('hidden'); // efface

                                        let idmatep = $('#IDmate').val();
                                        let idpanne = $('#IDPanne').val();

                                        // verifie si du matériel lier exsite pour ce matériel // 

                                        $.ajax({
                                            url: '?p=materials.checkedMateLier',
                                            data: {id:idmatep},
                                            method: 'POST',
                                            dataType: 'json',
                                            success: function(reponse) {

                                                if (reponse.length == '0') {

                                                    // matériel lier n'existe pas // 

                                                    $('.AffInfoNoMaterial').removeClass('hidden').addClass('display') // affiche la class //

                                                } else {
                                                    // efface les valeurs dans les inputs hidden //
                                                    $('#IDMateL, #IDMMateL, #IDP').val(' ')
                                                    // materiel lier existe //
                                                    $('#selectmatlier').modal('show') // ouvre la modal
                                                    $('#title_selectmatlier').html('Matériel(s) lier à selectionner') // ecris le title

                                                    // augmente la largeur de la modal
                                                    $('#selectmatlier').removeClass('modal fade').addClass('modal fade bs-modal-lg')
                                                    $('.tableMateLier').removeClass('modal-dialog').addClass('modal-dialog modal-lg')

                                                    // affiche la table materiel lier avec id matériel//
                                                    $.ajax({
                                                        url: '?p=materials.affMateLier',
                                                        data: {id:idmatep},
                                                        method: 'POST',
                                                        dataType: 'json',
                                                        success:function(data){

                                                            // reinitialise la table //
                                                            if ($.fn.dataTable.isDataTable('#TMateLier')) {

                                                                $('#TMateLier').DataTable().destroy();
                                                            }                                                

                                                            let TMateLier = $('#TMateLier').DataTable({               
                                                                language: {url: "../public/media/French.json"},
                                                                paging: false,
                                                                searching: false,
                                                                scollCollapse: true,
                                                                data: data,
                                                                columns: [
                                                                                                                    
                                                                    { data: "id" },
                                                                    { data: "num_inventaire" },
                                                                    { data: "produit" },
                                                                    { data: "marque" },
                                                                    { data: "model" },
                                                                    { data: "type" },
                                                                    { data: "num_serie" },
                                                                    { data: "niveau" },
                                                                    { data: "piece"},
                                                                    { data: "statut",
                                                                        render: function(data, type) {

                                                                            if (type === 'display') {
                                                                                let color = 'green';
                                                                                if (data === 'En Panne') {
                                                                                    color = 'red';
                                                                                }                            
                                                    
                                                                                return '<span style="color:' + color + '">' + data + '</span>';
                                                                            }                           
                                                                                return data;
                                                                        }
                                                                    }                
                                                                
                                                                ]                                                           
                                                            })

                                                            $('#TMateLier tbody').on('click', 'tr', function () {
                                                                
                                                                $('tr td').css({ 'background-color' : '#e5e5e5'}) // affiche le tr en vert //
                                                                $('td', this).css({ 'background-color' : '#c1f1c9' }) // affiche le tr en gris //
                                                                var rowTMatLier = $(this).closest('tr')
                                                                var idml = parseInt(rowTMatLier.find('td:eq(0)').text())
                                                                var st = rowTMatLier.find('td:eq(8)').text()

                                                                if (st == 'En Panne') {

                                                                    $('#info_selectmat').removeClass('hidden').addClass('alert alert-info info-dismissable col-lg-12').html('Impossible d\'attribuer cette panne à ce matériel car il et déjà en panne !!')
                                                                    $('button[type=submit]').attr('disabled', true)

                                                                }
                                                                // ecris les valeur dans les inputs //                                                        
                                                                $('#IDMateL').val(idml)
                                                                $('#IDMateP').val(idmatep)
                                                                $('#IDP').val(idpanne) 
                                                                
                                                            })                                                           

                                                        }
                                                    })

                                                    $('#SelectMatLier').validator().on('submit', function(event){                                           

                                                        if (event.isDefaultPrevented()) {

                                                        } else {

                                                            event.preventDefault()

                                                            let idmatelier = $('#IDMateL').val() // récupére l'id mate lier //
                                                             
                                                            $.ajax({
                                                                url : '?p=pannes.changeMate', 
                                                                method : 'post',
                                                                data : $('#SelectMatLier').serialize(),
                                                                success : function(data){
                                                                   
                                                                    $('#ModalAddEvent').modal('hide') // ferme la modal // 
                                                                    $('#selectmatlier').modal('hide') // ferme la modal //
                                                                    $(location).attr('href','?p=pannes.pmatelier&id='+ idmatelier)                                                                                    
                                                                    
                                                                }                    

                                                            })

                                                        }

                                                    })        

                                                }                                                      
                                                                    
                                            }
                                              
                                        });                                                                            

                                    }

                                });

                            } else if(reponse[0].mat_category == "E") {

                                $('.AffInfoDiag').removeClass('hidden').addClass('display'); // affiche la class //
                                var invent = $('#inventP').text();

                                $('input[name=BTN]').on('click', function(){

                                    let btn = $("input[name='BTN']:checked").val();

                                    if (btn == 1){ // oui
                                        // récupére valeur dans input hidden //
                                        let idmatel = $('#IDmate').val();
                                        let idpanne = $('#IDPanne').val();
                                        let idmatep = $('#IDmatep').val();                                                                                        

                                        // change l' id matériel sur la panne//
                                        $.ajax({
                                            url: '?p=pannes.changeMate',
                                            data: {idmatel:idmatel, idpanne:idpanne, idmatep:idmatep, index:"P"},
                                            method: 'POST',
                                            success:function(data){

                                                // ecris dans input hidden //
                                                $('#Bascule').val('B');
                                                $('#IdMateB').val(idmatep);

                                                // efface la modal affdiag et affiche un text de success bascule //
                                                $('.AffInfoDiag').removeClass('display').addClass('hidden'); // affiche la class //

                                                $('.AffInfoBascule')
                                                .removeClass('hidden')
                                                .addClass('display')
                                                .html('<p class="alert alert-success">La panne a bien était transférer vers ' + invent + ' !!!</p>');                                                         

                                            }
                                        });

                                    } else { // non                           

                                        // efface la class affdiag //
                                        $('.AffInfoDiag').removeClass('display').addClass('hidden') // affiche la class //                                     

                                    }

                                    $('.AffComment, .AffCheckBox0, .AffCheckBox1').removeClass('hidden').addClass('display')// affiche interv sous garantie & attente devis ou réparation en cours //
                                    $('input[name=BTNRadio]:visible').prop('required', true) // applique la propriété required

                                });

                            } else if(reponse[0].mat_category == "S") { 

                                $('.AffComment, .AffCheckBox0, .AffCheckBox1').removeClass('hidden').addClass('display');// affiche interv sous garantie & attente devis ou réparation en cours //

                            } else if(reponse[0].mat_category == "SN") { 

                                $('.AffComment, .AffCheckBox0, .AffCheckBox1').removeClass('hidden').addClass('display');// affiche interv sous garantie & attente devis ou réparation en cours // 
                            }                                   

                            $('#Etat').val('5');

                        } else if (etatpanne == 'Attente Réparation') {

                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>');
                            $('#Event').append('<option value=1.8> Appel de l\'intervenant </option>');
                            $('#Event').append('<option value=5> Rappel intervenant </option>');

                            if (etatquota == 3) { // devis accépté sans réactualisation //
                            
                                $('#Event').append('<option value=6.1> Réparation </option>');

                            } else if (etatquota == 7) { // devis accépté avec réactualisation //
                                
                                $('#Event').append('<option value=6.2> Réparation </option>');

                            } else if (etatquota == 0) { // sans devis // 
                                
                                $('#Event').append('<option value=6> Réparation </option>')

                            }

                        } else if (etatpanne == 'Attente Décision') { // a revoir ne vient jamais //

                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>')                            
                            $('#Event').append('<option value=12> Demande Devis comparatif </option>')
                            $('#Event').append('<option value=13> Réparation pas envisager </option>')
                            $('#Event').append('<option value=14> Demande Réactualisation Devis </option>')

                        } else if (etatpanne == 'Devis Reçu') { 
                        
                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>')                            
                            $('#Event').append('<option value=12> Demande Devis comparatif </option>')
                            $('#Event').append('<option value=13> Réparation pas envisager </option>')                      

                        } else if (etatpanne == 'Réparation en cours') {

                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>')
                            $('#Event').append('<option value=7> Réparation non terminé</option>')
                            $('#Event').append('<option value=8> Fin de réparation </option>')

                        } else if (etatpanne == 'Réparation non terminé') {

                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>')
                            $('#Event').append('<option value=5> Rappel intervenant </option>')
                            $('#Event').append('<option value=4> Attente Devis </option>')
                            $('#Event').append('<option value=2> Intervention </option>')                        
                            
                        } else if (etatpanne == 'Non Réparable') {

                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>')
                            $('#Event').append('<option value=11> Mise au rebus matériel </option>')

                        } else if (etatpanne == 'Réparation pas Envisager') { 

                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>')
                            $('#Event').append('<option value=14> Demande Réactualisation Devis </option>')
                            $('#Event').append('<option value=11> Mise au rebus matériel </option>')

                        } else if (etatpanne == 'Attente Réactualisation Devis') {

                            $('#Event').append('<option value=0 disabled selected>Choisir l\'évenement !! </option>')
                            $('#Event').append('<option value=1.5> Demande par Téléphone</option>')
                            $('#Event').append('<option value=1.6> Demande par email</option>')

                        }

                        // select evenement //

                        $('#Event').change(function(){                            

                            if ($('#Event').val() == 1 ) { // rappel Intervenant // ETAT 3 ou 8.1 //

                                $('.AffContriContact, .AffSelectContact, .AffAppelContribut, .AffStatutPanne, .AffnomTech, .AffAppelTech, .AffCheckBox0, .AffCheckBox3').removeClass('display').addClass('hidden'); // efface les class
                                $('#Contributor, #Contact').prop('required', false); // supprime la propriété required a l'input
                                $('.AffComment, .AffContriContact, .AffnomContact, .AffStatutAppel').removeClass('hidden').addClass('display'); // affiche les class                               
                                $('#IdAppel').val(reponse[i].IdAppel); // ecris dans input

                                finddatacontact(reponse[i].contact_id); // récupére les données sur le contribut et contact appeler / id appel //
                                
                                loadSelect_statutAppel('RAI'); // charge le select statut appel / RAI = Rappel Intervenant //

                                $('#Commentaire').val(' '); // efface commentaire

                                $('#StatutAppel').change(function(){

                                    if ($('#StatutAppel').val() == 1) { // intervenant contacter //                                        
                                        
                                        if (etatpanne == 'Attente Réparation') {
                                            $('#Etat').val('8.1');
                                        } else {
                                            $('#Etat').val('3');
                                        }

                                    } else  if ($('#StatutAppel').val() == 2) { // l'intervenant me fait rappeler par un tech // 

                                        if (reponse[i].tech_id == null) {
                                            $('#Etat').val('3.8');
                                        } else {
                                            $('#Etat').val('3.5');
                                        }                                                                                   

                                    } else  if ($('#StatutAppel').val() == 4) { // j'appel un autre contact de cette intervenant //

                                        $('.AffStatutAppel, .AffnomContact').removeClass('display').addClass('hidden'); // efface la class
                                        $('.AffContriContact, .AffSelectContact').removeClass('hidden').addClass('display'); // affiche la class
                                        let IdContribut = $('#IdContribut').val();
                                        load_SelectContact(IdContribut); 

                                        $('#Contact').change(function() {

                                            let contact = $('#Contact option:selected').text();
                                            let nom = $('#nomContribut').text();
                                            let cc = contact + ' ' + 'société' + ' ' + nom                                
                                            $('#ContriContact').val(cc);
                                            $('.AffStatutRappel').removeClass('hidden').addClass('display');// affiche statut appel//
                                            loadSelect_statutRappel(); // charge le select Rappel Intervenant//

                                        })

                                        $('#Etat').val('3.7');                                           

                                    } else { // laisser message sur répondeur intervenant //

                                        $('#Etat').val('3.6');
                                    }
                                });                                                              

                            } else if ($('#Event').val() == 1.1) { // Rappel de l'intervenant // ETAT 3.1 //                              
                                
                                $('#IdAppel').val(reponse[i].IdAppel); // ecris dans input
                                $('.AffContriContact, .AffSelectContact, .AffStatutRappel, .AffStatutAppel').removeClass('display').addClass('hidden'); // efface class
                                $('#StatutAppel').prop('required', false); // supprime la propriété required
                                $('.AffComment').removeClass('hidden').addClass('display'); // affiche class

                                $('#Etat').val('3.1');                            

                            } else if ($('#Event').val() == 1.2) { // appel le Technicien // ETAT 3.2 //

                                $('#IdAppel').val(reponse[i].IdAppel); // ecris dans input
                                $('.AffStatutAppel, .AffContriContact').removeClass('display').addClass('hidden'); // efface class
                                $('.AffAppelTech, .AffComment').removeClass('hidden').addClass('display'); // affiche les class

                                load_SelectTech(reponse[i].contribut_id); // id contribut

                                $('#Tech').change(function(){

                                    let tech = $('#Tech option:selected').text()                                
                                    $('#ContriContact').val(tech)

                                    $('.AffStatutAppel').removeClass('hidden').addClass('display')// affiche statut appel//
                                    loadSelect_statutTech()
                                });

                                $('#Commentaire').val(' '); // efface commentaire

                                $('#StatutAppel').change(function(){

                                    if ($('#StatutAppel').val() == 5) { // laisse message sur repondeur

                                        $('#Commentaire').val(' ') // efface commentaire
                                        $('.AffStatutPanne').removeClass('display').addClass('hidden') // efface la class

                                        $('#Commentaire').keypress(function(){

                                            $('.AffStatutPanne').removeClass('display').addClass('hidden') // efface la class
                                            $('#StatutPanne').prop('required', false) // desactive la propriété required

                                        })

                                    } else {

                                        $('#Commentaire').val(' ') // efface commentaire

                                        $('#Commentaire').keypress(function(){

                                            $('.AffStatutPanne').removeClass('hidden').addClass('display')// affiche statut panne//

                                            $('#StatutPanne').prop('required', true) // active le champ required
                                            $('#StatutPanne option').remove()
                                            $("#StatutPanne").append('<option selected="" disabled >Choisir un statut</option>')
                                            $("#StatutPanne").append('<option value="1">Attente Rappel Technicien</option>') // ajoute une option dans le select //
                                            $("#StatutPanne").append('<option value="2">Attente Intervention</option>') // ajoute une option dans le select //

                                        })

                                    }
                                });                             

                                $('#Etat').val('3.2');  

                            } else if ($('#Event').val() == 1.3) { // le Technicien Rappel // ETAT 3.3 //

                                $('#IdAppel').val(reponse[i].IdAppel) // ecris dans input
                                $('.AffComment').removeClass('hidden').addClass('display') // affiche class
                                $('.AffContriContact, .AffAppelTech, .AffStatutAppel').removeClass('display').addClass('hidden') //efface class                                

                                $('#Commentaire').val(' ') // efface commentaire 

                                $('#Commentaire').keypress(function(){

                                    $('.AffStatutPanne').removeClass('hidden').addClass('display')// affiche statut panne//

                                    $('#StatutPanne').prop('required', true) // active la propriété required
                                    $('#StatutPanne option').remove()
                                    $("#StatutPanne").append('<option selected="" disabled >Choisir un statut</option>')
                                    $("#StatutPanne").append('<option value="1">Attente Rappel Technicien</option>') // ajoute une option dans le select //
                                    $("#StatutPanne").append('<option value="2">Attente Intervention</option>') // ajoute une option dans le select //

                                })

                                $('#StatutAppel').prop('required', false) // desactive la propriété required

                                $('#Etat').val('3.3')  

                            } else if ($('#Event').val() == 1.4) { // Je rappel le Technicien // ETAT 3.4 //

                                $('#IdAppel').val(reponse[i].IdAppel) // ecris dans input

                                $('.AffComment, .AffContriContact, .AffnomTech').removeClass('hidden').addClass('display') // affiche class
                                $('.AffnomContact').removeClass('display').addClass('hidden') //efface class

                                finddatacontact(reponse[i].tech_id) // contact id

                                $('.AffStatutAppel').removeClass('hidden').addClass('display')// affiche statut appel //

                                loadSelect_statutTech()

                                $('#Commentaire').val(' ') // efface commentaire

                                $('#StatutAppel').change(function(){

                                    if ($('#StatutAppel').val() == 5) { // laisse message sur repondeur

                                        $('#Commentaire').val(' '); // efface commentaire
                                        $('.AffStatutPanne').removeClass('display').addClass('hidden'); // efface la class

                                        $('#Commentaire').keypress(function(){

                                            $('.AffStatutPanne').removeClass('display').addClass('hidden'); // efface la class
                                            $('#StatutPanne').prop('required', false); // desactive la propriété required

                                        });

                                    } else {

                                        $('#Commentaire').val(' ') // efface commentaire

                                        $('#Commentaire').keypress(function(){

                                            $('.AffStatutPanne').removeClass('hidden').addClass('display')// affiche statut panne//

                                            $('#StatutPanne').prop('required', true) // active le champ required
                                            $('#StatutPanne option').remove()
                                            $("#StatutPanne").append('<option selected="" disabled >Choisir un statut</option>')
                                            $("#StatutPanne").append('<option value="1">Attente Rappel Technicien</option>') // ajoute une option dans le select //
                                            $("#StatutPanne").append('<option value="2">Attente Intervention</option>') // ajoute une option dans le select //

                                        })

                                    }
                                }) 

                                $('#Etat').val('3.4');  

                            } else if ($('#Event').val() == 1.5) { // J'appel l'intervenant par téléphone pour réactualisation devis // ETAT 3.4 //

                                $('.AffComment, .AffContriContact').removeClass('hidden').addClass('display') // affiche class

                                $('.AffnomTech').removeClass('display').addClass('hidden') //efface class affiche nom tech //

                                // récupére le contact_id de l'intervenant du devis selectionner pour réactualisation/ id panne //
                                
                                $.post('?p=contributors.findCCQuota',

                                    {
                                        id : id 

                                    }, function(reponse) {     
                                    // charge le nom et contact de l'intervenant a recontacter pour devis //
                                    
                                    finddatacontact(reponse[0].contact_id) // récupére les données sur le contribut et contact appeler / id contact // 
                                    $('#IdContact').val(reponse[0].contact_id) // ecris dans input hidden                                     

                                });                                

                                loadSelect_statutAppel('AIR') // charge le select / Appel Intervenant Reactu //                               

                                $('.AffStatutAppel').removeClass('hidden').addClass('display')// affiche statut appel //                                

                                $('#Commentaire').val(' ') // efface commentaire
                                
                                $('#Etat').val('16.1')

                            } else if ($('#Event').val() == 1.6) { // envoi de mail pour réactualisation devis //

                                $('.AffContriContact, .AffStatutAppel, .AffComment').removeClass('display').addClass('hidden')

                                $('#ModalAddEvent').modal('hide') // efface la modal add event

                                $('.AffSendMail').removeClass('hidden').addClass('display')

                                $('.AffSelectContribut').removeClass('display').addClass('hidden')
                                $('#Contributors').attr('required', false)

                                $('.AffSelectEmail').removeClass('hidden').addClass('display')

                                // récupére le contact_id de l'intervenant du devis selectionner pour réactualisation / id = pannes //
                                
                                $.post('?p=contributors.findCCQuotaReactu',

                                    {
                                        id : id 

                                    }, function(reponse) {     
                                    
                                    let nbrcont = reponse.length // nombre de contact

                                    $('#to').append('<option value="" disabled selected>Choix Contact</option>') // remplis les données dans le select //

                                    for (var i = 0; i < nbrcont; i++) {                        

                                        let id = reponse[i].id
                                        let email = reponse[i].c_email
                                        let contact = reponse[i].contact                        
                                        $('#to').append('<option value="'+ id +'">'+ email + "[" + contact + "]"+'</option>') // remplis les données dans le select //                        

                                    }

                                    $('#IdContribu').val() //ecris dans input hidden modal // 

                                });

                                $('#subject').val('Demande de réacualisation devis');

                            } else if ($('#Event').val() == 1.7) { // Le technicien appel // ETAT 3.8 //

                                $('#IdAppel').val(reponse[i].IdAppel); // ecris dans input
                                $('.AddTech').attr('data-id', reponse[i].contribut_id).attr('data-nom', reponse[i].nom);
                                $('.AffStatutAppel, .AffContriContact').removeClass('display').addClass('hidden'); // efface class
                                $('.AffAppelTech, .AffComment').removeClass('hidden').addClass('display'); // affiche les class

                                load_SelectTech(reponse[i].contribut_id); // id contribut

                                $('#Tech').change(function(){

                                    let tech = $('#Tech option:selected').text();                                
                                    $('#ContriContact').val(tech);
                                    
                                });

                                $('#Commentaire').val(' '); // efface commentaire                                                            

                                $('#Etat').val('3.9');

                            } else if ($('#Event').val() == 1.8) { // l'intervenant m'appel // ETAT 3.10 // 

                                $('.AffStatutAppel, .AffContriContact').removeClass('display').addClass('hidden'); // efface class
                                $('.AffComment').removeClass('hidden').addClass('display'); // affiche la class

                                $('#Etat').val('3.10');

                            } else if ($('#Event').val() == 2) { // Intervention // ETAT 4 //

                                $('.AffContriContact, .AffSelectContact, .AffStatutAppel, .AffStatutRappel, .AffStatutPanne').removeClass('display').addClass('hidden') // efface class
                                $('#Contact,#StatutRappel, #StatutAppel').prop('required', false) // supprime la propriété required a l'input
                                $('#Commentaire').val(' ') // efface commentaire
                                $('#Commentaire').keypress(function(){

                                    $('.AffStatutPanne').removeClass('display').addClass('hidden') // efface la class
                                    $('#StatutPanne').prop('required', false) // desactive la propriété required
                                })

                                $('.AffComment').removeClass('hidden').addClass('display')                                
                                $('#IdContribut').val(reponse[i].contribut_id) // ecris l'Id contribut dans l'input hidden //
                                $('#IdAppel').val(reponse[i].IdAppel) // ecris l'id appel dans l'input hidden /********voir si besoin **********/

                                $('#Etat').val('4')                                

                            } else if ($('#Event').val() == 4) { // Attente devis //

                                $('.AffComment').removeClass('hidden').addClass('display');

                                // récupére le contact_id de l'intervenant du devis validé / id = pannes //
                                
                                $.post('?p=quotation.findDataQuotaValidate',

                                    {
                                        id : id 

                                    }, function(reponse) {     
                                    
                                    $('#IdContribut').val(reponse[0].contribut_id); // ecris l'Id contribut dans l'input hidden //
                                    $('#IdContact').val(reponse[0].contact_id); // ecris l'Id contact dans l'input hidden //

                                });                                

                                $('#Etat').val('9.1');

                            } else if ($('#Event').val() == 5 ) { // rappel Intervenant apres devis validé //

                                $('.AffAppelContribut, .AffSelectContact, .AffStatutPanne, .AffnomTech, .AffAppelTech, .AffCheckBox0, .AffCheckBox3').removeClass('display').addClass('hidden'); // efface les class
                                $('#Contributor, #Contact').prop('required', false); // supprime la propriété required a l'input
                                $('.AffComment, .AffContriContact, .AffnomContact, .AffStatutAppel').removeClass('hidden').addClass('display'); // affiche les class

                                let url;
                                if (etatquota == 3) { // si un devis et validé //
                                    url = '?p=quotation.findDataQuotaValidate';
                                } else if (etatquota == 0) { // si le devis n'existe pas //
                                    url = '?p=call.findCallPanne';
                                }
                                // récupére l'id appel & contact_id / id = pannes id// 
                                $.ajax({
                                    url: url,
                                    data: {id:id},
                                    method: 'POST',
                                    dataType: 'json',
                                    success: function(reponse) {
                                                                                                  
                                        $('#IdAppel').val(reponse[0].id); // ecris dans input id appel /
                                        finddatacontact(reponse[0].contact_id); // récupére les données sur le contribut et contact appeler / id contact//                   
                                    }
                                      
                                })                                
                                
                                loadSelect_statutAppel('RAI'); // charge le select / Appel Intervenant //

                                $('#Commentaire').val(' '); // efface commentaire

                                $('#StatutAppel').change(function(){

                                    if ($('#StatutAppel').val() == 1) { // intervenant contacter //                                        
                                        
                                        if (etatpanne == 'Attente Réparation') {
                                            $('#Etat').val('8.1');
                                        } else {
                                            $('#Etat').val('3');
                                        }

                                    } else if ($('#StatutAppel').val() == 2) { // l'intervenant me fait rappeler par un tech // 

                                        $('#Etat').val('3.5');                                           

                                    } else  if ($('#StatutAppel').val() == 4) { // j'appel un autre contact de cette intervenant //

                                        $('.AffStatutAppel, .AffnomContact').removeClass('display').addClass('hidden'); // efface la class
                                        $('.AffContriContact, .AffSelectContact').removeClass('hidden').addClass('display'); // affiche la class
                                        let IdContribut = $('#IdContribut').val();
                                        load_SelectContact(IdContribut) 

                                        $('#Contact').change(function() {

                                            let contact = $('#Contact option:selected').text();
                                            let nom = $('#nomContribut').text();
                                            let cc = contact + ' ' + 'société' + ' ' + nom;                               
                                            $('#ContriContact').val(cc); 
                                            $('.AffStatutRappel').removeClass('hidden').addClass('display');// affiche statut appel//
                                            loadSelect_statutRappel(); // charge le select Rappel Intervenant//
                                        })

                                        $('#Etat').val('3.7');                                           

                                    } else { // laisser message sur répondeur //

                                        $('#Etat').val('3.6');
                                    }
                                })

                            } else if ($('#Event').val() == 6) { // réparation en cours sans devis / ETAT 8 // 

                                $('.AffComment').removeClass('hidden').addClass('display') // affiche le commentaire
                                $('.AffContriContact, .AffStatutAppel').removeClass('display').addClass('hidden') // efface les class //                                
                                $('#StatutAppel, input[id=date_validation]').prop('required', false)
                                $('#IdContribut').val(reponse[i].contribut_id) // ecris l'id contribu dans l'input //
                                $('#Etat').val('8')

                            } else if ($('#Event').val() == 6.1 ) { // réparation en cours apres devis validé // ETAT 8 //

                                $('.AffComment').removeClass('hidden').addClass('display') // affiche le commentaire
                                $('.AffContriContact, .AffSelectContact, .AffStatutAppel').removeClass('display').addClass('hidden') // efface les class //                                
                                $('#Contact, #StatutAppel, input[id=date_validation]').prop('required', false)

                                // récupére les données sur le contact et intervenant devis validé / id = pannes id// 
                                $.ajax({
                                    url: '?p=quotation.findDataQuotaValidate',
                                    data: {id:id},
                                    method: 'POST',
                                    dataType: 'json',
                                    success: function(reponse) {
                                    
                                        finddatacontact(reponse[0].contact_id) // récupére les données sur le contribut et contact appeler / id contact//
                                        $('#IdContribut').val(reponse[0].contribut_id) // ecris l'id contribu dans l'input //                   
                                    }
                                      
                                })                                

                                $('#Etat').val('8')

                            } else if ($('#Event').val() == 6.2 ) { // réparation en cours apres devis réactualisé validé // ETAT 8 //

                                $('.AffComment').removeClass('hidden').addClass('display') // affiche le commentaire
                                $('.AffContriContact, .AffStatutAppel').removeClass('display').addClass('hidden') // efface les class //                                
                                $('#StatutAppel, input[id=date_validation]').prop('required', false)

                                // récupére les données sur le contact et intervenant devis validé / id = pannes id// 
                                $.ajax({
                                    url: '?p=quotation.findDataQuotaValidate',
                                    data: {id:id},
                                    method: 'POST',
                                    dataType: 'json',
                                    success: function(reponse) {
                                    
                                        finddatacontact(reponse[0].contact_id) // récupére les données sur le contribut et contact appeler / id contact//
                                        $('#IdContribut').val(reponse[0].contribut_id) // ecris l'id contribu dans l'input //                   
                                    }
                                      
                                })                                

                                $('#Etat').val('8')

                            } else if ($('#Event').val() == 7) { // Réparation non terminé // ETAT 9 //                                

                                // récupére les données sur le contact et intervenant devis validé / id = pannes id/ besoin si BTNRadio = 1/ 
                                $.ajax({
                                    url: '?p=quotation.findDataQuotaValidate',
                                    data: {id:id},
                                    method: 'POST',
                                    dataType: 'json',
                                    success: function(reponse) {

                                        if (reponse.length == 0){
                                            $('#AffOthquote').html("Attente Devis");
                                        } else {
                                            $('#AffOthquote').html("Attente autre Devis");
                                            finddatacontact(reponse[0].contact_id) // récupére les données sur le contribut et contact appeler / id contact//                                             
                                        }                                    
                                                        
                                    }
                                      
                                });

                                $('#IdContribut').val(reponse[0].contribut_id) // ecris l'id contribu dans l'input // 
                                $('#IdContact').val(reponse[0].contact_id); 

                                $('.AffCheckBox3').removeClass('display').addClass('hidden') // efface le BTN_Radio recup fluide                              
                                $('.AffComment, .AffCheckBox1_1').removeClass('hidden').addClass('display')// affiche checkbox attente devis ou réparation en cours //
                                $('input[name=BTNRadio]:visible').prop('required', true) // active le champ obligatoire 
                                $('#IdInterv').val(IdInterv);
                                
                                $('#Etat').val('9');

                            } else if ($('#Event').val() == 8) { // réparation terminé / ETAT 10 //
                                
                                $('.AffCheckBox1, .AffCheckBox1_1').removeClass('display').addClass('hidden');// efface checkbox attente devis ou réparation en cours //
                                $('.AffComment').removeClass('hidden').addClass('display'); // affiche le commentaire
                                $('input[name=BTNRadio]:hidden').prop('required', false); // desactive les champ obligatoire //

                                if (reponse[0].produit == 'Climatisation') {
                                     
                                    if (reponse[i].b_cce === 1) { //  a revoir car b_cce n'existe pas //
                                        $('.AffCheckBox3').removeClass('display').addClass('hidden'); // efface le BTN_Radio recup fluide
                                    } else {
                                        $('.AffCheckBox3').removeClass('hidden').addClass('display'); // affiche le BTN_Radio recup fluide
                                    }
                                } 

                                $('#IdInterv').val(IdInterv); // ecris dans input hidden
                                $('#TypeAppel').val(reponse[i].type_appel); // ecris dans input hidden
                                $('#Etat').val('10'); // ecris dans input hidden
                                
                            } else if ($('#Event').val() == 9) { // rappel Intervenant aprés interv non fini // ETAT 11 //

                                $('#Etat').val('11');                            

                            } else if ($('#Event').val() == 11) { // mise au rebus matériel // ETAT 13

                                // reduit la largeur de la modal //
                                $('#ModalAddEvent').removeClass('modal fade bs-example-modal-lg').addClass('modal fade')
                                $('.modal-dialog').removeClass('modal-dialog modal-lg').addClass('modal-dialog')

                                $('.AffQuotaPanne').removeClass('display').addClass('hidden') // efface la table quota
                                $('.AffComment').removeClass('hidden').addClass('display')// affiche commentaire//
                                $('#date_validation').prop('required', false) // desactive le champ obligatoire //
                                $('#Etat').val('13')

                            } else if ($('#Event').val() == 12) { // demande de devis comparatif // ETAT 15 //

                                $('.AffComment').removeClass('hidden').addClass('display')// affiche commentaire//
                                $('.Affdatevalidquota, .AffQuotaPanne').removeClass('display').addClass('hidden') // efface la class //
                                $('#date_validation').prop('required', false) // desactive le champ obligatoire //

                                if (reponse[0].produit == "Volet Roulant") {

                                    $('#Etat').val('15.1');

                                } else {

                                    $('#Etat').val('15');
                                }      

                            } else if ($('#Event').val() == 13) { // réparation pas envisager // ETAT 12 //

                                $('.AffQuotaPanne').removeClass('display').addClass('hidden') // efface la class //
                                $('.AffComment').removeClass('hidden').addClass('display')// affiche commentaire//
                                $('#date_validation').prop('required', false) // desactive le champ obligatoire //
                                $('#Etat').val('12')

                            } else if ($('#Event').val() == 14) { // demande de réactualisation devis // ETAT 16 //
                                
                                // augmente la largeur de la modal //
                                $('#ModalAddEvent').removeClass('modal fade').addClass('modal fade bs-example-modal-lg')
                                $('.modal-dialog').removeClass('modal-dialog').addClass('modal-dialog modal-lg')

                                $('.AffQuotaPanne').removeClass('hidden').addClass('display')// affiche la table//
                                $('.AffComment').removeClass('hidden').addClass('display')// affiche commentaire//
                                $('#date_validation').prop('required', false) // desactive le champ obligatoire //                                                                

                                // reinitialise la table //                              

                                if ($.fn.DataTable.isDataTable('#Tablequota')) {

                                    $('#Tablequota').DataTable().destroy();

                                } 

                                let Tablequota = $('#Tablequota').DataTable({

                                    language: {url: "../public/media/French.json"},                                           
                                    paging: false,
                                    searching: false,
                                    bDestroy: true,
                                    ajax: {
                                        url: '?p=quotation.affquota',
                                        data: {id:id},
                                        type: "POST"
                                    },
                                    columns: [                                        
                                        { data: "id" },
                                        { data: "datequotafr" },
                                        { data: "nom" },
                                        { data: "num_devis" },
                                        { data: "datevaliquotafr" },
                                        { data: "daterefusquotafr" },                    
                                        { data: "montantDE",

                                            render: function(data, type, row) {
                                                
                                                if (row.montantDE == null) {
                                                    return montantDE = '0.00 €';
                                                } else {

                                                    mde = Number(row.montantDE);                                
                                                    return mde.toFixed(2) +' €';
                                                }                            
                                            }
                                        },
                                        { data: "etat_devis"}                                        
                                           
                                    ]           

                                });

                                $('#Tablequota tbody').on('click', 'tr', function () { 
                                                              
                                    $('tr td').css({ 'background-color' : '#e5e5e5'});// affiche le tr en vert //
                                    $('td', this).css({ 'background-color' : '#c1f1c9'}); // affiche le tr en gris //                                        
                                    var rowtablequota = $(this).closest('tr');
                                    var id = parseInt(rowtablequota.find('td:eq(0)').text());

                                    $('#IdQuota').empty(); // vide la div
                                    $('#InpHidden').append('<input type="hidden" id="IdQuota" name="IdQuota" value="'+ id +'">');// ecris un input
                                    
                                    
                                });

                                $('#Etat').val('16');                                
                                
                            }

                        });

                    }
                                       
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert("Erreur dans la requête !!!"); 
                }                

            });            

            // validation AddEvent //
        
            $('#AddEvent').validator().on("submit", function(event){

                let IdPanne = $('#IdPanne').val(); // récupére l'id de la panne //                
                let IdMate = $('#IdMate').val(); // récupére l'id Matériel affiché //
                let IdMateP = $('#IdMateB').val(); // récupére l'id matériel a basculé //
                let Etat = $('#Etat').val(); // récupére la valeur de l'état
                let Bascule = $('#Bascule').val(); // récupére la valeur pour changer de fenêtre //
                
                var tab = [];  

                switch (Etat) {

                    case '2':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#Contributor option:selected').text(), $('#Contact option:selected').text(), $('#StatutAppel option:selected').text(), $('#Commentaire').val(), IdPanne, IdMate];
                    break;

                    case '3':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#ContriContact').val(), $('#StatutAppel option:selected').text(), $('#Commentaire').val(), IdPanne, IdMate];
                    break; 

                    case '3.1':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#Event option:selected').text(), $('#Commentaire').val(), IdPanne, IdMate];
                    break;

                    case '3.5':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#ContriContact').val(), $('#StatutAppel option:selected').text(), $('#Commentaire').val(), IdPanne, IdMate];
                    break;

                    case '3.6':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#ContriContact').val(), $('#StatutAppel option:selected').text(), $('#Commentaire').val(), IdPanne, IdMate];
                    break;

                    case '3.7':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#ContriContact').val(), $('#StatutRappel option:selected').text(), $('#Commentaire').val(), IdPanne, IdMate];
                    break;

                    case '4':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#Commentaire').val(), IdPanne, IdMate];
                    break;

                    case '5':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('input[name=BTNRadio]:checked').val(), $('#Commentaire').val(), IdPanne, IdMate];
                    break;

                    case '8':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#Commentaire').val(), IdPanne, IdMate]; // intervention réparation //
                    break;

                    case '9':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#Commentaire').val(), $('input[name=BTNRadio]:checked').val(), IdPanne, IdMate]; // réparation non terminé //
                    break;

                    case '10':
                    tab = [$('#DateEvent').val(), $('#HeureEvent').val(), $('#Commentaire').val(), IdPanne, IdMate];
                    break;

                    default:
                    tab = false;
                }
               
                if (event.isDefaultPrevented()) {

                    } else {

                        event.preventDefault();
                     
                    $.ajax({
                        url : '?p=events.addEvent', 
                        method : 'POST',
                        data : $('#AddEvent').serialize(),
                        success : function(data){
                            
                            $("#info_event").removeClass('hidden').addClass('alert alert-success success-dismissable').html("L'événement à bien était ajouter !!!");
                            
                            $('#ModalAddEvent').modal('hide'); // ferme la modal //
                            $("#AddEvent")[0].reset();

                            if (Bascule == "B") { 

                                // redirige la page vers le matériel basculer //
                                window.location.href = "?p=pannes.mate&id="+ IdMateP

                            } else {

                                affPanneMate(IdPanne, 'Select'); // affichage de la pannes du matériel par id panne //                                                       

                                NbrInterv(IdPanne); // affiche le nbr d'interv qui existe
                                NbrQuota(IdPanne, '0'); // affiche le nbr de devis qui existe //                          

                                // efface les info //
                                recupclassdiv('info_event', 7000);

                                // reinitialise la table event //
                                affEventPanne(IdPanne, 'Actif');

                                if (Etat == '1' || Etat == '5') {

                                    affStatutMate(IdMate);// affiche le statut du matériel //

                                } else if (Etat == '10') { // 

                                    affStatutMate(IdMate);// affiche le statut du matériel //
                                    // ont verifie les documents pour la panne a afficher (id panne)
                                    checkedDocFact(IdPanne); 
                                    checkedDocCE(IdPanne);                                    
                                }

                                CheckedPanne(IdMate); // verifie l'etat de la panne et active ou désactive les btn  //
                                
                                if (tab != false) { // si tab et diff de false ont envoi le mail //

                                    if(confirm("Voulez-vous envoyer le mail?")) {
                                        sendmail_Tech('events', tab, Etat);
                                    }

                                    
                                }

                            }

                            notif();
                            
                        }                    

                    });

                }   
            });

        });        

        // edition event panne //
        
        $(document).on('click', 'button[data-role=EditEvent]', function(){

            $('#ModalEditEvent').modal('show')// ouvre la modal //
            $('.modal-title').html('Edition Evénement') // ecris dans le title
            var rowtableevent = $(this).closest('tr')
            var id = parseInt(rowtableevent.find('td:eq(0)').text())
            var dateevent = rowtableevent.find('td:eq(1)').text()
            var heureevent = rowtableevent.find('td:eq(2)').text()
            // retourne la date //
            var parts = dateevent.split(/-/)
            parts.reverse()
            var datereverse = (parts.join('-'))
            $("#dateevent").val(datereverse) // affiche la date enregistrer
            $('#heureevent').val(heureevent)

            var event = rowtableevent.find('td:eq(3)').text()
            var design = rowtableevent.find('td:eq(4)').text()

            $('#event').html(event)
            $('#commentaire').html(design)
            $('#IdEvent').val(id) // ecris l'id evenement dans un input hidden
            var idpanne = $(this).data('id') // récupére l'id panne 
            $('#IdpanneEd').val(idpanne) // ecris l'id panne dans un input hidden

            // validation edition evenement panne//

            $('#EditEvent').validator().on("submit", function(event){  

                var IDpanne = $('#IdpanneEd').val()
                var etatpanne = 'edition'                      

                if (event.isDefaultPrevented()) {

                    } else {

                        event.preventDefault();
                     
                    $.ajax({
                        url : '?p=events.editEvent', 
                        method : 'POST',
                        data : $('#EditEvent').serialize(),
                        success : function(reponse){                        
                            
                            $("#info_event")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("L'événement à bien était modifié !!!");

                            $('#ModalEditEvent').modal('hide'); // ferme la modal //
                            $("#EditEvent")[0].reset();
                            // reinitialise la table evenement 
                            affEventPanne(IDpanne, etatpanne);
                            recupclassdiv('info_event', 7000);   
                        }                    

                    });

                }   
            });

        });       

    // EVENT SANS PANNE //
    
        // AFF evenement intervention par l'id interv //
        function affEventIntervSP(id, etat) {                        

            // affiche le tableau evenements sans panne //
            $('.AffEventsSP').removeClass('hidden').addClass('display');            
            // affiche le title event //
            $('#title_eventsp').html('Evénements de l\'intervention: '+ id + '  ' + '<button class="btn btn-round btn-warning" id="btnAddEventSP" data-role="AddEventSP" data-id="'+id+'"<abbr title="Ajouter un évenement à la panne"><span class="glyphicon  glyphicon-plus"></span></abbr></button>');

            btnAddEventSP(etat); // verifie si il faut enable ou disabled le btn add event SP//

            // affiche la table event //
            
            // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableEventSP')) {

                $('#TableEventSP').DataTable().destroy()
            }
            
            $('#TableEventSP').DataTable({

                language: {url: "../public/media/French.json"},                                           
                paging: false,
                searching: false,
                scrollY: '40vh',
                scrollX: true,
                scollCollapse: true,
                ajax: {
                    url: '?p=events.affEventSP',
                    data: {id:id},
                    type: "POST",
                    dataType: 'json'
                },
                columns: [
                    { data: "id" },
                    { data: "dateeventfr" },
                    { data: "heureeventfr"},
                    { data: "event" },
                    { data: "designation" },
                    { data: "user" },                                       
                    { render : function(data, type, row) {

                          return `<button class="btn btn-primary btn-xs" data-role="EditEventSP"<abbr title="Edition de l\'évenement"><span class="glyphicon  glyphicon-pencil"></span></abbr></button>
                                  <button type="submit" class="btn btn-danger btn-xs hidden"<abbr title="Supprimé l\'évenement"><span class="glyphicon glyphicon-trash"></span></abbr></button>`  
                        }                           
                        
                    }   
                ]            

            });           
        }

        // enable ou disabled le btnAddEventSP //
        function btnAddEventSP(etat) {          

            if (etat == "Terminé") {

                $('#btnAddEventSP').prop('disabled', true).attr('title', 'Intervention Terminé impossible d\'ajouter un événement !!!');            
                
            } else {

                $('#btnAddEventSP').prop('disabled', false);
            }            

        }

        // add event sans panne //
    
        $(document).on('click', 'button[data-role=AddEventSP]', function (){

            let id = $('#IDinterv').val(); // id interv sp 
            let t = heurebd(); // function qui donne l'heure

            $('#ModalEventSP').modal('show');// ouvre la modal //titleAddEventSP
            $('#titleEventSP').html('Ajouter un événement à l\'intervention n°: ' +id); // affiche le title //
            $('.AffLabel').html('Date Evénement'); // ecris le label date //                                                
            $('#HeureEvSP').val(t); // affiche l'heure //

            $('input[name=IdInterv]').val(id);
            $('input[name=index]').val('Add');
            
        });

        // edit event sans panne //
        
        $(document).on('click', 'button[data-role=EditEventSP]', function(){            

            var rowtableevent = $(this).closest('tr');
            var id = parseInt(rowtableevent.find('td:eq(0)').text());
            var dateevent = rowtableevent.find('td:eq(1)').text();
            var heureevent = rowtableevent.find('td:eq(2)').text();
            var event = rowtableevent.find('td:eq(3)').text();
            var design = rowtableevent.find('td:eq(4)').text();

            $('#ModalEventSP').modal('show');// ouvre la modal //
            $('#titleEventSP').html('Edition Evénement n°: ' +id); // ecris dans le title
            
            // retourne la date //
            var parts = dateevent.split(/-/);
            parts.reverse();
            var datereverse = (parts.join('-'));
            $('.AffLabel').html('Date Evénement'); // ecris le label date //
            $("#DateEvSP").val(datereverse); // affiche la date enregistrer

            $('#HeureEvSP').val(heureevent);

            $('#EventSP').val(event);
            $("#CommentSP").val(design);

            $('input[name=index]').val('Edit');
            $('input[name=IdEvents]').val(id);        

        });

        // validation AddEvent & EditEvent sans panne //
    
        $('#AE_EventSP').validator().on("submit", function(event){

            var id = $('#IDinterv').val();
            $('input[name=IdInterv]').val(id);

            if ($('#btnAddEventSP').is(':disabled')) {
                var etat = "Terminé";
            } else {
                var etat = "En Cours";
            }            
                           
            if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();
                 
                $.ajax({
                    url : '?p=events.AE_EventSP', 
                    method : 'POST',
                    data : $('#AE_EventSP').serialize(),
                    success : function(data){
                        
                        $("#info_event")
                        .removeClass('hidden')
                        .addClass('alert alert-success success-dismissable')
                        .html("L'événement à bien était ajouter !!!"); 

                        $('#ModalEventSP').modal('hide'); // ferme la modal //
                        $("#AE_EventSP")[0].reset();                        

                        affEventIntervSP(id, etat);  // recharge la table events interv / id interv  //                         

                        // efface les info //
                        recupclassdiv('info_event', 7000);                                
                        
                    }                    

                });

            }   
        });

    // EVENT WORKS //

        // AFF evenement work par l'id work //
        function affEventsWork(id, statut) {

            // affiche la div de la table work //
            $('.AffEventsWork').removeClass('hidden').addClass('display');
                        
            // affiche la table work //
            $.ajax({
                url: '?p=events.affEventWork',
                data: {id:id, statut:statut},
                method: 'POST',
                success:function(data){

                    $('#TableEventWork').html(data);

                }
            });
           
        }  

        // add event work //
    
        $(document).on('click', 'button[data-role=ADDEventWork]', function (){

            let id = $('#IDWork').val();
            
            $('#Event, #Commentaire').empty();
            $('#EventWork').modal('show'); // ouvre la modal //                
            $('.modal-title').html('Ajouter un événement'); // ecris le title
            $('#IdWork').val(id);                
            $("input[id='str']").val('ADD');                       

        });      

        // edition event travail //
        
        $(document).on('click', 'button[data-role=EditEventWork]', function(){

            $('#EventWork').modal('show');// ouvre la modal //
            $('.modal-title').html('Edition Evénement'); // ecris dans le title
            var rowtableevent = $(this).closest('tr');
            var id = parseInt(rowtableevent.find('td:eq(0)').text());
            var dateevent = rowtableevent.find('td:eq(1)').text();
            var heureevent = rowtableevent.find('td:eq(2)').text();
            // retourne la date //
            var parts = dateevent.split(/-/);
            parts.reverse();
            var datereverse = (parts.join('-'));
            $("#DateEvent").val(datereverse); // affiche la date enregistrer
            $('#HeureEvent').val(heureevent);

            var event = rowtableevent.find('td:eq(3)').text();
            var design = rowtableevent.find('td:eq(4)').text();

            $('#Event').html(event);
            $('#Commentaire').html(design);
            $('#IdEvent').val(id); // ecris l'id evenement dans un input hidden
            var idwork = $(this).data('id'); // récupére l'id work 
            $('#IdWork').val(idwork); // ecris l'id work dans un input hidden 
            
            $("input[id='str']").val('EDIT');           

        });

        // ajoute ou edit l'événement des travaux //
        
        $('#Eventwork').validator().on("submit", function(event){

            let IdWork = $('#IdWork').val(); // récupére l'id du travail //
            let Statut = $('#Statut').val(); // récupére l'etat //
            let str = $('#str').val(); // récupére ADD ou EDIT
           
            if (event.isDefaultPrevented()) {

                } else {

                    event.preventDefault();

                    if (str === 'ADD') {

                        $.ajax({
                            url : '?p=events.addEventWork', 
                            method : 'POST',
                            data : $('#Eventwork').serialize(),
                            success : function(data){
                                
                                $("#info_work")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-8')
                                .html("L'événement à bien était ajouter !!!");

                                recupclassdiv('info_work', 5000);
                                $('#EventWork').modal('hide'); // ferme la modal //
                                $("#Eventwork")[0].reset();
                                
                                // reinitialise la table dailyWork pour changer etat //
                                affEventsWork(IdWork, Statut); // affiche la table travaux / id work //                                

                                TableDailyworks.ajax.reload(); // recharge le table matériels //

                            }                    

                        });

                    } else {

                        $.ajax({
                            url : '?p=events.editEventWork', 
                            method : 'POST',
                            data : $('#Eventwork').serialize(),
                            success : function(reponse){                        
                                
                                $("#info_work")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-sm-12')
                                .html("L'événement à bien était modifié !!!");

                                $('#EventWork').modal('hide'); // ferme la modal //
                                $("#Eventwork")[0].reset();                                
                                // reinitialise la table evenement work
                                affEventsWork(IdWork, Statut);
                                recupclassdiv('info_work', 5000);   
                            }                    

                        });
                    }                    

            }

        });

    // REPAIR //
    
        // function qui calcul le montant total des réparations pour panne.mate // id matériel //
        function countRepairt(id) {
            
            $.ajax({
                url: '?p=repairs.countrepairst',
                data: {id:id},
                method: 'post',
                success: function(data) {

                    let mtr = Number(data[0].mfi) + Number(data[0].mfr);

                    if (mtr != 0.00) {

                        $('#mtr').html('<h4><span style="text-decoration: underline;">Montant Total Réparations</span></h4><p class="h4">'+ mtr.toFixed(2) + '€<P>');
                    } else {

                        $('#mtr').html('<h4><span style="text-decoration: underline;">Montant Total Réparations</span></h4><p class="h4"> 0.00 €<P>');

                    }                   

                }
                  
            });   

        }

        // function qui calcul le montant de la réparation de la panne selectionner // id panne //
        function countRepair(id) {
            
            $.ajax({
                url: '?p=repairs.countrepairs',
                data: {id:id},
                method: 'post',
                success: function(data) {

                    if (data[0].mr) {

                        $('#mr').html('<h4 class="text-center">Montant Réparations: '+ data[0].mr + '€</h4>');
                    } else {

                        $('#mr').html('<h4 class="text-center">Montant Réparations:  0.00 €</h4>');

                    }                   

                }
                  
            });   

        }                      

    // DOCUMENT //
    
        // table documents all /*************AC**********& A_C****************/
        var TableDocuments = $('#TableDocuments').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '50vh',
            scrollX: true,
            scollCollapse: true,
            processing: true,
            paging: true,
            ajax: {
                url:'?p=documents.afftable',
                type: "POST",
                dataSrc: ""
                },          
                columns: [ 
                    { data: ""},                     
                    { data: null,
                        render: function(data, type, row) { // fichier certificat étanchéité //

                            if (row.num_cert_etanch != null) {
                                return `<a href="../public/documents/certif/`+ row.num_cert_etanch +`" target="_blank">`+ row.num_cert_etanch+`</a>`
                            } else {
                                return ` `
                            }
                                                    
                        } 
                    },
                    { data: "pannes_id"}      
               ]            

        });
    
        // function qui verifie si des documents existe et affiche les boutons / id interv & tab = MAT ou PANN //
    
        function checkedDocInterv(id, tab) {            
            // efface les btn //
            $('.AffAddDE, .AffAddBI, .AffViewBI, .AffAddFI, .AffViewFI, .AffAddMI').hide();
            $('#changeBI').attr('data-doc', " "); 

            // verifie si le BI & le devis (id interv) //
                       
            $.ajax({
                url: '?p=factureinterv.checkeddocinterv',
                data: {id:id, tab:tab},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                                      
                    
                   if (reponse.length == 0){

                        // pas de documents ont ne fait rien //

                    } else {

                         // AFFICHE ADD BI ET VIEW BI //

                        if (reponse[0].num_bi == null) {

                            // affiche btn add BI et attribue le data-id du document//
                            $('.AffAddBI').show();

                        } else {

                            // EFF ADD BI//
                            $('.AffAddBI').hide();

                            // AFFICHAGE View BI //                            
                            $('.AffViewBI').show(); // attribut data-id view BI //

                            var array = ["../public/documents/bonintervs/", reponse[0].num_bi]; // créer le href                       
                            var href = array.join("");  
                            $('#viewPdfBI').attr('href', href);// insert l'href
                            $('#changeBI').attr("data-doc",reponse[0].num_bi); // attribut data-doc au btn change
                            
                        }

                        // AFFICHE ADD OU VIEW FACT INTERV / ETAT TERMINER //                    

                        if (reponse[0].etat_interv == 'Terminé') {

                            if (reponse[0].sous_garanti == '0') {

                                if (reponse[0].type_interv == 'Diagnostique' || reponse[0].type_interv == 'Diagnostique & Réparation' || reponse[0].type_interv == null) {

                                    // AFFICHE ADD FI && VIEW FI //                                

                                    if (reponse[0].lien_fac_interv == null) {
                                        
                                        // affiche le btn add FI //
                                        $('.AffAddFI').show().attr("data-year",reponse[0].annee); 

                                    } else if (reponse[0].lien_fac_interv) {

                                        $('.AffAddFI').hide(); // efface add FI //
                                        $('.AffViewFI').show(); // affiche btn view BI //
                                        var array = ["../public/documents/factures/intervs/", reponse[0].lien_fac_interv]; // créer le href                       
                                        var href = array.join("");  
                                        $('#viewPdfFI').attr('href', href); // insert l'href
                                        $('#changeFI').attr("data-id",reponse[0].idfacinte).attr("data-doc",reponse[0].lien_fac_interv).attr("data-year",reponse[0].annee); // attribut data-id & data-doc & data-year au btn change

                                    }    

                                } else if (reponse[0].type_interv == 'Maintenance Préventive') {

                                    $('.AffAddBI, .AffAddFI').hide(); // efface les deux class //
                                    $('.AffAddMI').show(); // affiche btn add montant interv //
                                }                                                                                           

                            }
                        }                                                                           
                        
                    }       
                }   

            });
        }

        // function qui verifie si des documents existe pour interv / id panne //
    
        function checkedDocFact(id) {
            // efface la div .AffBtnFACT //
            $('.AffBtnFACT').removeClass('display').addClass('hidden');            
            // efface les btn //
            $('.AffAddFR, .AffViewFR').hide();

            // verifie si le document intervention existe (id panne) //
                       
            $.ajax({
                url: '?p=facturerep.checkeddocfactrep',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    if (reponse.length == 0) {

                    } else {                                  
                
                        if (reponse[0].etat_panne != 'Terminé') {

                            $('.AffBtnFACT').removeClass('display').addClass('hidden'); // efface le btn

                        } else {

                            $('.AffBtnFACT').removeClass('hidden').addClass('display');                                                                 

                            // AFFICHE ADD FACT REP ET VIEW FACT REP //                             

                            if (reponse[0].sous_garanti == 0) {                                
                            
                                if (reponse[0].num_fac_rep == null) {
                                    
                                    $('.AffAddFR').show().attr("data-year", reponse[0].annee); // affiche btn add FR et attribue le data-id document//

                                } else if(reponse[0].num_fac_rep) { 
                                    
                                    $('.AffAddFR').hide(); // efface Add FR
                                    $('.AffViewFR').show(); // affiche btn view FR

                                    var array2 = ["../public/documents/factures/repair/", reponse[0].lien_fac_rep]; // créer le href                       
                                    var href = array2.join("");  
                                    $('#viewPdfFR').attr('href', href); // insert l'href

                                    $('#changeFR').attr("data-doc",reponse[0].lien_fac_rep).attr("data-id", reponse[0].idfacrep); // attribut data-doc & data-id fac rep au btn change

                                }

                            }
                                                                                              
                        }
                    }        
                }   

            });
        }

        // function qui verifie si une facture et présente ou pas /id mat //
        
        function checkedDocFactachat(id) {

            // efface les class .AffAddFA & AffViewFA//
            $('.AffAddFA, .AffViewFA').removeClass('display').addClass('hidden');          

            // verifie si le document fact achat existe (id mate) //
                       
            $.ajax({
                url: '?p=documents.checkeddocfactachat',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                                                                                         

                    // AFFICHE ADD FACT Achat //
                    
                    if (reponse[0].num_factAchat == null) {
                        
                        $('.AffAddFA').removeClass('hidden').addClass('display').attr("data-id",id); // affiche btn add FA et attribue le data-id mate//

                    } else if(reponse[0].num_factAchat) {

                        // affiche view fact achat // 
                        
                        $('.AffAddFA').removeClass('display').addClass('hidden'); // efface Add FA
                        $('.AffViewFA').removeClass('hidden').addClass('display').attr("data-id",reponse[0].id); // affiche btn view FA
                        var array2 = ["../public/documents/factures/achat/", reponse[0].num_factAchat]; // créer le href                       
                        var href = array2.join("");  
                        $('#viewPdfFA').attr('href', href); // insert l'href
                        $('#changeFA').attr("data-doc",reponse[0].num_factAchat).attr("data-id",id); // attribut data-doc & id au btn change

                        $('.AffMontantAchat').removeClass('hidden').addClass('display');
                        $('#MontantAchat').html('Montant Achat: '+ reponse[0].montantAchat+ '€');

                    }                       
                          
                }   

            });

        }  

        // function qui verifie si le bouton ADD CE & VIEW CE doit apparaitre ou non / id panne//
        
        function checkedDocCE(id) {
            // efface la div .AffBtnCE //
            $('.AffBtnCE').removeClass('display').addClass('hidden')            
            // efface les btn //
            $('.AffAddCE, .AffViewCE').hide();

            // verifie si le document CE existe(id panne) //                       
            $.ajax({
                url: '?p=documents.checkeddocCe',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    let i = reponse.length -1                    
                    
                    if (reponse.length == 0){

                    // pas de documents ont ne fait rien //

                    } else {

                        if (reponse[i].etat_panne != 'Terminé') {

                            $('.AffBtnCERT').removeClass('display').addClass('hidden')

                        } else {

                            $('.AffBtnCERT').removeClass('hidden').addClass('display')                                                                 

                            // AFFICHE ADD CE ET VIEW CE //

                            if (reponse[i].num_cert_etanch == null && reponse[i].b_cce == 1) {

                                // AFFICHAGE ADD CE //
                                $('.AffAddCE').show().attr("data-id_doc",reponse[i].id) // affiche btn add CE et attribue le data-id du document//

                            } else if (reponse[i].num_cert_etanch) {

                                $('.AffAddCE').hide() // efface Add CE
                                $('.AffViewCE').show() // affiche btn view CE
                                var array2 = ["../public/documents/certif/", reponse[i].num_cert_etanch] // créer le href                       
                                var href = array2.join("");  
                                $('#viewPdfCE').attr('href', href) // insert l'href
                                $('#changeCE').attr("data-doc",reponse[i].num_cert_etanch) // attribut data-doc au btn change

                            }
                                                                                 
                        }
                    }       
                }   

            });

        }        

        // ADD fichier BI FACT INTERV FACT REP CE CO CON DCM//
        
        $(document).on('click', 'button[data-role=addfile]', function(){           

            $('#ModalAddDoc').modal('show'); // ouvre la modal 
            $('.AffdocEnreg, .AffNDOC, .AffMTTC, .AffNMD, .AffbtnViewer, .ViewerPdf').removeClass('display').addClass('hidden'); // efface les classes /**M**/
            $('#NumBi, #NumFact, #montantTTC').attr('required', false).val(''); // desactive le required & efface la value
            $('input[name="BTN"]').prop('checked', false); // desactive les input type radio
            $('#NumBi, #IDdoc, #PanneID, #IndexUp, #docenreg').val(' '); // efface les champ input
             
            var idinterv = $('#IDinterv').val(); // récupére l'id interv /BI/            
            $('#intervID').val(idinterv); // ecris dans input hidden /BI//

            var mateID = $('#IDmate').val(); //récupére l'id matériel sur la page /FA//            
            $('#MateID').val(mateID);// ecris dans l'input hidden /FA//            

            // pour add doc CE //
            var iddoc = $(this).data('id_doc'); // récupére l'id document /CE/
            $('#IDdoc').val(iddoc); // ecris l'id dans l'input hidden /CE/  

            var idpanne = $('#IDPanne').val(); // récupére l'id panne //
            $('#PanneID').val(idpanne); // ecris dans input hidden //

            var year = $(this).data('year'); // récupére l'année //
            $('#year').val(year); // ecris dans l'input hidden //

            var propi = $('#Propi').val(); // récupére la valeur de propriétaire //
            $('#propi').val(propi); // ecris dans input hidden //

            var BTN = $(this).data('b');
            $('#IndexUp').val(BTN); // ecris l'index dans l'input hidden //

            if (BTN == 'BI') { 

                $('.modal-title').html('Téléchargement du bon d\'intervention'); // ecris le title 
                $('.AffNDOC').removeClass('hidden').addClass('display');

                $('.AffLabelNDC').html('Numéro de document:');
                $('input[name=NumDoc]').attr('required', true); // active le required

            } else if (BTN == 'FI') { 
                
                $('.modal-title').html('Téléchargement de la facture d\'intervention'); // ecris le title 
                $('.AffNDOC, .AffMTTC').removeClass('hidden').addClass('display'); // affiche la div input numéro fact & montant ttc // 

                $('.AffLabelNDC').html('Numéro de document:'); 
                $('input[name=NumDoc]').attr('required', true);

                $('.AffLabelMTTC').html('Montant TTC Facture Intervention:'); // affiche le label                
                $('#montantTTC').attr('required', true); // active le required                               

            } else if (BTN == 'FR') {
                
                $('.modal-title').html('Téléchargement de la facture de réparation'); // ecris le title
                $('.AffNDOC, .AffMTTC').removeClass('hidden').addClass('display'); // affiche la div input numéro fact & montant ttc //

                $('.AffLabelNDC').html('Numéro de document:'); 
                $('input[name=NumDoc]').attr('required', true);

                $('.AffLabelMTTC').html('Montant TTC Facture:'); // affiche le label
                $('#montantTTC').attr('required', true); 

            } else if (BTN == 'CE') {
                
                $('.modal-title').html('Téléchargement du certificat'); // ecris le title                

            } else if (BTN == 'FA') {                

                $('.modal-title').html('Téléchargement de la facture d\'achat'); // ecris le title
                $('.AffNDOC, .AffMTTC').removeClass('hidden').addClass('display'); // affiche la div input numéro fact & montant ttc //

                $('.AffLabelNDC').html('Numéro de document:'); 
                $('input[name=NumDoc]').attr('required', true);

                $('.AffLabelMTTC').html('Montant TTC Facture D\'achat:'); // affiche le label
                $('#montantTTC').attr('required', true);                

                mateID = $(this).data('id'); // récupére l'id mate 
                $('#MateID').val(mateID); // ecris l'id mate dans input hidden 
                
            } else if (BTN == 'CO') { // CONTRAT //

                rowtable = $(this).closest('tr');
                id = parseInt(rowtable.find('td:eq(0)').text());
                numcontrat = rowtable.find('td:eq(1)').text();

                $('.modal-title').html('Téléchargement du Contrat'); // ecris le title

                $('input[name=ContractID]').val(id); 
                $('input[name=NumContract]').val(numcontrat); 

            } else if (BTN == 'CON') { // CONTROL //

                rowtablecont = $(this).closest('tr');
                id = parseInt(rowtablecont.find('td:eq(0)').text());

                $('.modal-title').html('Téléchargement du Contrôle'); // ecris le title

                $('input[name=ControlID]').val(id);

            } else if (BTN == 'ICM') { 

                rowtable = $(this).closest('tr');
                id = parseInt(rowtable.find('td:eq(0)').text());

                $('.modal-title').html('Téléchargement BI Contrat de Maintenance'); // ecris le title

                $('#intervID').val(id);

            } else if (BTN == 'DCM') {

                $('.modal-title').html('Téléchargement Document Matériel'); // ecris le title
            }                                                  

            // affiche un btn voir le fichier télécharger /******** a continuer ******** /

            $('#file').on('change', function() {

                $('.ViewerPdf').removeClass('display').addClass('hidden');
                $('.AffbtnViewer').removeClass('hidden').addClass('display');

                $('.AffbtnViewer').on('click', function() {

                    $('.ViewerPdf').removeClass('hidden').addClass('display');

                })

                var size = document.getElementById('file').files[0].size;

            });

            // transforme la valeur avec une virgule en point //
            
            $('.Montant').on('click', function() {
                let inp = $(this).attr("name");
                $('#'+inp).on('change', function() {
                    let val = $('#'+inp).val();
                    montant(inp, val);
                });                        
            });

            $('input[name=op]').val('addF');            

        });     

        // remplace le fichier BI FACT INTERV FACT REP CE CO CON //
        
        $(document).on('click', 'button[data-role=uploadfile]', function(){           

            $('#ModalAddDoc').modal('show'); // ouvre la modal 
            $('.AffdocEnreg, .AffNDOC, .AffMTTC, .AffNMD, .AffbtnViewer, .ViewerPdf').removeClass('display').addClass('hidden'); // efface les classes //
            $('#montantTTC').attr('required', false).val(''); // desactive le required & efface les value
            $('input[name="BTN"]').prop('checked', false); // desactive les input type radio
            $('#facID, #MateID, #IDdoc, #PanneID, #IndexUp, #docenreg').val(''); // efface les champ input 
             
            var idinterv = $('#IDinterv').val(); // récupére l'id interv //            
            $('#intervID').val(idinterv); // ecris dans input hidden //

            var facID = $(this).data('id'); // récupére l'id de la facture //
            $('#facID').val(facID); // ecris dans l'input hidden //

            var mateID = $('#IDmate').val(); //récupére l'id matériel sur la page //            
            $('#MateID').val(mateID);// ecris dans l'input hidden //

            // pour add doc CE //
            var iddoc = $(this).data('id_doc'); // récupére l'id document //
            $('#IDdoc').val(iddoc); // ecris l'id dans l'input hidden //            
            
            var docenreg = $(this).data('doc'); // récupére le numero du fichier existant // 

            var idpanne = $('#IDPanne').val(); // récupére l'id panne //
            $('#PanneID').val(idpanne); // ecris dans input hidden //

            var year = $(this).data('year'); // récupére l'année 
            $('#year').val(year) // ecris dans l'input hidden //

            var propi = $('#Propi').val(); // récupére la valeur de propriétaire //
            $('#propi').val(propi); // ecris dans input hidden //

            var BTN = $(this).data('b');
            $('#IndexUp').val(BTN) // ecris l'index dans l'input hidden //                             

            if (BTN == 'BI') { 
                
                $('.modal-title').html('Changement du bon d\'intervention'); // ecris le title 
                $('#docenreg').val(docenreg); // ecris dans l'input // 
                $('.AffdocEnreg')
                .removeClass('hidden')
                .addClass('alert alert-danger')
                .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer "+ " " + docenreg + " " + "sera effacé si vous le modifié !!");

                $('input[name=NumDoc]').attr('required', true);                
                $('.AffNDOC').removeClass('hidden').addClass('display');
                $('.AffLabelNDC').html('N° Bon d\'intervention:');

            } else if (BTN == 'FI') {               

                $('.modal-title').html('Changement de la facture d\'intervention'); // ecris le title
                $('#docenreg').val(docenreg); // ecris dans l'input //
                $('.AffdocEnreg')
                .removeClass('hidden')
                .addClass('alert alert-danger')
                .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer "+ " " + docenreg + " " + "sera effacé si vous le modifié !!");

                $('.AffNDOC, .AffMTTC').removeClass('hidden').addClass('display'); // affiche la div                
                $('.AffLabelNDC').html('N° Facture d\'intervention:');
                $('input[name=NumDoc]').attr('required', true);

                $('.AffLabelMTTC').html('Montant TTC Facture D\'intervention:'); // affiche le label
                $('#montantTTC').attr('required', true);                                           

            } else if (BTN == 'FR') {               

                $('.modal-title').html('Changement de la facture de réparation'); // ecris le title
                $('#docenreg').val(docenreg); // ecris dans l'input //
                $('.AffdocEnreg')
                .removeClass('hidden')
                .addClass('alert alert-danger')
                .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer "+ " " + docenreg + " " + "sera effacé si vous le modifié !!");

                $('.AffNDOC, .AffMTTC').removeClass('hidden').addClass('display'); // affiche les div
                $('.AffLabelNDC').html('N° Facture:');                         
                $('input[name=NumDoc]').attr('required', true);

                $('.AffLabelMTTC').html('Montant TTC Facture:'); // affiche le label
                $('#montantTTC').attr('required', true);                                                      

            } else if (BTN == 'CE') {
                
                $('.modal-title').html('Changement du certificat'); // ecris le title                    
                $('#docenreg').val(docenreg); // ecris dans l'input //
                $('.AffdocEnreg')
                .removeClass('hidden')
                .addClass('alert alert-danger')
                .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer "+ " " + docenreg + " " + "sera effacé si vous le modifié !!");                

            } else if (BTN == 'FA') {
                
                $('.modal-title').html('Changement de la facture d\'achat'); // ecris le title                    
                $('#docenreg').val(docenreg); // ecris dans l'input hidden //

                $('.AffdocEnreg')
                .removeClass('hidden')
                .addClass('alert alert-danger')
                .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer "+ " " + docenreg + " " + "sera effacé si vous le modifié !!");

                $('.AffNDOC, .AffMTTC').removeClass('hidden').addClass('display');  // affiche la div
                $('.AffLabelNDC').html('N° Facture d\'achat:');

                $('input[name=NumDoc]').attr('required', true);

                $('.AffLabelMTTC').html('Montant TTC Facture D\'achat:'); // affiche le label
                $('#montantTTC').attr('required', true);                           

                mateID = $(this).data('id'); // récupére l'id mate 
                $('#MateID').val(mateID); // ecris l'id mate dans input hidden 
                
            } else if (BTN == 'CO') { // CONTRAT //

                rowtablecont = $(this).closest('tr');
                id = parseInt(rowtablecont.find('td:eq(0)').text());
                numcontrat = rowtablecont.find('td:eq(1)').text();

                $('.modal-title').html('Changement du Contrat'); // ecris le title

                let doc = docenreg.split("../public/documents/contrats/");

                $('#docenreg').val(doc[1]); // ecris dans l'input hidden //

                $('.AffdocEnreg')
                .removeClass('hidden')
                .addClass('alert alert-danger')
                .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer " + doc[1] + " sera effacé si vous le modifié !!");

                $('input[name=ContractID]').val(id); 
                $('input[name=NumContract]').val(numcontrat); 

            } else if (BTN == 'CON') { // CONTROL /***********AJ**********/

                rowtablecont = $(this).closest('tr');
                id = parseInt(rowtablecont.find('td:eq(0)').text());

                $('.modal-title').html('Changement du Contrat'); // ecris le title

                let doc = docenreg.split("../public/documents/controls/");

                $('#docenreg').val(doc[1]); // ecris dans l'input hidden //

                $('.AffdocEnreg')
                .removeClass('hidden')
                .addClass('alert alert-danger')
                .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer " + doc[1] + " sera effacé si vous le modifié !!");

                $('input[name=ControlID]').val(id); 

            } else if (BTN == 'ICM') { // *********AC************//

                rowtable = $(this).closest('tr');
                id = parseInt(rowtable.find('td:eq(0)').text()); // id interv //

                $('.modal-title').html('Changement du Bon d\'intervention'); // ecris le title

                let doc = docenreg.split("../public/documents/bonintervs/");

                $('#docenreg').val(doc[1]); // ecris dans l'input hidden //

                $('.AffdocEnreg')
                .removeClass('hidden')
                .addClass('alert alert-danger')
                .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer " + doc[1] + " sera effacé si vous le modifié !!");

                $('input[name=intervID]').val(id);

            } else if (BTN == 'DCM') { // **************AC**********//

                $('.modal-title').html('Changement du Document Matériel'); // ecris le title //
                let docenreg = $(this).data('doc');

                $('.AffdocEnreg')
                .removeClass('hidden')
                .addClass('alert alert-danger')
                .html("<span class='glyphicon glyphicon-warning-sign'></span> Le document enregistrer " + docenreg + " sera effacé si vous le modifié !!");
 
                $('#docenreg').val(docenreg);
            }                             

            // affiche un btn voir le fichier télécharger //

            $('#file').on('change', function() {

                $('.ViewerPdf').removeClass('display').addClass('hidden');
                $('.AffbtnViewer').removeClass('hidden').addClass('display');

                $('.AffbtnViewer').on('click', function() {

                    $('.ViewerPdf').removeClass('hidden').addClass('display');

                });

            });

            // transforme la valeur avec une virgule en point //
            
            $('.Montant').on('click', function() {
                let inp = $(this).attr("name");
                $('#'+inp).on('change', function() {
                    let val = $('#'+inp).val();
                    montant(inp, val);
                });                        
            });

            $('input[name=op]').val('upF');            

        });

        // validation du formulaire upload //
            
        $('#ValidateUpload').validator().on("submit", function(event){                              

            if (event.isDefaultPrevented()) {

            } else {

                event.preventDefault();

                let op = $('input[name=op]').val(); // récupére addF ou upF

                if (op == 'addF') {

                    // add files //
                    let idinterv = $('#intervID').val(); // récupére l'id interv
                    let idpanne = $('#PanneID').val(); // récupére l'id panne                    
                    let BTN = $('#IndexUp').val(); // récupére l'index BTN
                    let file = $('#file').val(); // récupére le valeur de l'input files //
                    let mateID = $('#MateID').val(); // récupére l' id matériel
                    let year = $('#year').val(); // récupére l'année

                    if (file) { // si files existe //

                        var form = $('#ValidateUpload')[0];
                        var data = new FormData(form);

                        $.ajax({
                            url : '?p=documents.addfile', 
                            type : 'POST',
                            enctype : 'multipart/form-data',
                            data : new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false,
                            success : function(data){

                                $('#ModalAddDoc').modal('hide'); // ferme la modal                                                        
                                
                                if ($('#TableIntervPanne').is(':visible') == true ) {

                                    // verification de documents pour interv panne //                                   
                                    
                                    checkedDocInterv(idinterv, 'PANN');    

                                } else if ($('#TableIntervMate').is(':visible') == true ){

                                    // verification de documents pour interv sans panne //
                                    
                                    checkedDocInterv(idinterv, 'MAT');
                                    countIntervSansPanne(idinterv);
                                    countIntervt(mateID); //id mate

                                } else if ($('.AffEvents').is(':visible') == true) {

                                    checkedDocFact(idpanne); // verifie la facture de la panne 
                                    checkedDocCE(idpanne); // verifie le doc ce

                                    // modifie le montant de la réparation //
                                    countRepair(idpanne); // id panne                                                                     

                                } 

                                if (BTN === 'FA') {

                                    checkedDocFactachat(mateID)

                                } else if (BTN === 'FI') {

                                    countInterv(idpanne); //id panne
                                    countIntervt(mateID); //id mate

                                } else if(BTN === 'CO') { // Contrat //

                                   TableContracts.ajax.reload();

                                } else if(BTN === 'CON') { // Contrôle //

                                    TableControls.ajax.reload();

                                } else if (BTN === 'DCM') { // Document carctéristique matériel /********AC********/

                                    btnDocTechMat(mateID);

                                }                                

                                countRepairt(mateID); // mise a jour du montant total réparation dans panne.mate / id mate //
                                CountPriceTotalRepair(year); // mise a jour table chart_panne pour réparation total //
                                CountPTRV(year); // mise a jour table chart_panne pour volets //

                                $('#ValidateUpload').trigger('reset'); // reset le formulaire                    
                            }
                        });    

                    }

                } else {

                    // update files //
                    let deldoc = $('#docenreg').val(); // récupére le doc enregistrer
                    let idinterv = $('#intervID').val() // récupére l'id interv
                    let idpanne = $('#PanneID').val() // récupére l'id panne                    
                    let BTN = $('#IndexUp').val() // récupére l'index BTN
                    let file = $('#file').val() // récupére la valeur de l'input files //
                    let mateID = $('#MateID').val() // récupére l' id matériel
                    let year = $('#year').val(); // récupére l'année

                    if (file) { // si files existe //

                        var form = $('#ValidateUpload')[0];
                        var data = new FormData(form);

                        $.ajax({
                            url : '?p=documents.upload', 
                            type : 'POST',
                            enctype : 'multipart/form-data',
                            data : new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false,
                            success : function(data){

                                $('#ModalAddDoc').modal('hide'); // ferme la modal                                                           
                                
                                if ($('#TableIntervPanne').is(':visible') == true ) {

                                    // verification de documents pour interv panne //                                    
                                    checkedDocInterv(idinterv, 'PANN');                                  

                                } else if ($('#TableIntervMate').is(':visible') == true ){

                                    // verification de documents pour interv sans panne //                                    
                                    checkedDocInterv(idinterv, 'MAT');
                                    countIntervSansPanne(idinterv);
                                    countIntervt(mateID); //id mate

                                } else if ($('.AffEvents').is(':visible') == true) {

                                    checkedDocFact(idpanne); // verifie la facture de la panne 
                                    checkedDocCE(idpanne); // verifie le doc ce                                   
                                    countRepair(idpanne); // compte le nbr de reparation                                 

                                } 

                                if (BTN === 'FA') {

                                    checkedDocFactachat(mateID);

                                } else if (BTN === 'FI') {

                                    countInterv(idpanne); //id panne
                                    countIntervt(mateID); //id mate

                                } else if(BTN === 'CO') { // Contrat //

                                   TableContracts.ajax.reload();

                                } else if(BTN === 'CON') { // Contrôle //

                                    TableControls.ajax.reload();

                                } else if (BTN === 'DCM') { // Document carctéristique matériel /********AC********/

                                    btnDocTechMat(mateID);

                                }                                 

                                countRepairt(mateID); // id mate
                                CountPriceTotalRepair(year); // mise a jour table chart_panne pour réparation total //
                                CountPTRV(year); // mise a jour table chart_panne pour volets //

                                $('#ValidateUpload').trigger('reset'); // reset le formulaire 

                            }
                        });    

                    }
                }
            }
        });
    
    // CATEGORIES //
    
        // function select categories //
        
        function load_SelectCategories() {

            $('#categorie').empty(); // efface le select           

            $.ajax({
                url: '?p=categories.Select',
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#categorie option').remove();

                    $("#categorie").append('<option value="0" selected disabled>Veuillez choisir une catégorie</option>'); // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;

                        var categories = reponse[i].categorie;                            

                        $("#categorie").append('<option value="'+ id +'">'+ categories +'</option>'); // remplis les données dans le select //

                    }           
                }
            }); 
        }

        $('#categorie').change(function(){

            $('#btn-addcategorie').removeClass('display').addClass('hidden');

        });

    // DAILY WORKS / TRAVAUX JOURNALIER //
    
        // AFF DAILYWORKS ALL //
        
        if($('.AffDailyWork').is(':visible') == true){
            
            if (typeU == "administrateur") {

                let btn = $(`<button class="btn btn-round btn-success" id="btn_adddailywork" data-role="ADDDailywork" <abbr title="Ajouter un travail réalisé"><span class="glyphicon  glyphicon-plus"></span></abbr></button> ` + 
                            `<a class="btn btn-round btn-default" target="_blank" href="?p=dailyWorks.viewPdf" <abbr title="Créer un PDF">PDF</abbr></a>`);
                btn.appendTo($("p[id=btn_addDailyWork]")); // affiche les btn //
            } else {
                let btn = $(`<a class="btn btn-round btn-default" target="_blank" href="?p=dailyWorks.viewPdf" <abbr title="Créer un PDF">PDF</abbr></a>`);
                btn.appendTo($("p[id=btn_addDailyWork]")); // affiche le btn PDF //
            }

            $('a.item-TJ').attr('class', 'active');
            $('ul.item-tj').attr('style', 'display:block;');
            $('li.item-lt').attr('class', 'active');
        }     

        var TableDailyworks = $('#TableDailyworks').DataTable({

            language: {url: "../public/media/French.json"},
            scrollY: '30vh',
            scrollX: true,
            scollCollapse: true,
            paging: false,
            ajax: {
                url:'?p=dailyWorks.all',
                type: "POST"
                },
                columns: [
                    { data: "id" },
                    { data: "user" },
                    { data: "datedailyfr" },
                    { data: "categorie" },
                    { data: "designation" },
                    { data: "commentaire" },
                    { data: null },
                    { render : function(data, type, row) {
                            if (row.statut === "Actif") { // travail actif pas possible de suppr //

                                return `<button class="btn btn-primary btn-xs" data-role="EditDailywork" <abbr title="Edition travail"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                       `<button type="submit" class="btn btn-danger btn-xs" disabled=""<abbr title="Supprimé le travail réalisé"><span class="glyphicon  glyphicon-trash"></span></abbr></button>` 

                            } else { // sinon Terminé possible si admin //

                                if (typeU === 'administrateur') {
                                    return  `<button class="btn btn-primary btn-xs" data-role="EditDailywork" <abbr title="Edition travail"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                            `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteDaily"<abbr title="Supprimé le travail réalisé""><span class="glyphicon  glyphicon-trash"></span></abbr></button>` 
                                } else {

                                    return `<button class="btn btn-primary btn-xs" data-role="EditDailywork" <abbr title="Edition travail"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                           `<button type="submit" class="btn btn-danger btn-xs" disabled=""<abbr title="Supprimé le travail réalisé"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`  
                                }
                            }                                                     

                        }
                    }
                ],            
                columnDefs: [
                    {
                        targets: 6,
                        data: null,
                        orderable: true,
                        className: 'text-end',
                        render: function (data, type, row) {  // Statut//

                            if(row.statut === 'Terminé') {
                               
                                return `<span class="btn-danger btn-xs btn-round">`+ row.statut +`</span>`

                            } else if (row.statut === 'Actif') {

                                return '<span class="btn-theme03 btn-xs btn-round">'+ row.statut +'</span>'

                            }

                        }

                    }
                ]
        });        

        // affiche les évenements des travaux selectionner //
        
        $('#TableDailyworks').on('dblclick', 'tr', function (){

            // efface la div de la table work //
            $('.AffEventsWork, #info_work').removeClass('display').addClass('hidden');                        
            
            // recupére l'id sur le tr table mate //
            let rowtabledaily = $(this).closest('tr');
            let id = parseInt(rowtabledaily.find('td:eq(0)').text()); // recupére l'id du travail //            
            let design = rowtabledaily.find('td:eq(4)').text();
            let statut = rowtabledaily.find('td:eq(6)').text(); // recupére le statut du travail //

            if (isNaN(id)) {

            } else {

                // colorie le tr td en vert //
                $('tr td').css({'background-color' : '#e5e5e5'}); // gris //
                $('td', this).css({'background-color' : '#c1f1c9'}); //vert//                

                // modifie la hauteur des tables //
                $('.dataTables_scrollBody').css('height','250px');

                if (statut == 'Terminé') {

                    $('.btn_eventDailyWork').attr('disabled', true).prop('title', 'il n\'est plus possible d\'ajouter un événement');

                } else {

                    $('.btn_eventDailyWork').attr('disabled', false).prop('title', 'Ajouter un événement');
                }

                // affichage du travail selectionner //
                $('#AffEventsDaily').removeClass('hidden').addClass('col-sm-12');
                $('#affDailywork').html('Travail N°:'+ ' ' + id + ' ' + ' / '+ design);
                $('#IDWork').val(id); // ecris dans l'input hidden //
                
                // verifie si le travail a un ou plusieurs événement / id work //
                $.ajax({
                    url: '?p=events.checkedEvent',
                    data: {id:id, page:'work'},
                    method: 'POST',
                    success: function(reponse) {
                        
                        if (id) {

                            if (reponse.length == 0) {                                                      
                                
                                // message info //
                                $("#info_work")
                                .removeClass('hidden')
                                .addClass('alert alert-info info-dismissable col-sm-12')
                                .html('il n\'y a pas d\'événements pour ce travail !!');

                                recupclassdiv('info_work', 5000);

                            } else {
                                
                                // un ou plusieurs événement existe //
                                affEventsWork(id,statut); // id work //
                                $('.AffEventsWork').removeClass('col-lg-9').addClass('col-lg-12');

                                // affiche le btn //
                                $('#BtnHaut').removeClass('hidden').addClass('display');
                                let ancre = "#Ancre3";
                                ScrollAncre(ancre);                            
                            }

                        } else {

                            $('.AffEventsWork').addClass('hidden').removeClass('display');                                                       
                        }                     
                    }
                      
                });
                
            }              

        });

        // ADD DAILYWORKS //
        
        $(document).on('click','button[data-role=ADDDailywork]', function(){

            $('#AffEventsDaily, #btn-addcategorie').removeClass('display').addClass('hidden'); // efface la div aff evenement & btn addcatégorie //  

            let str = $(this).data('role').substr(0, 3); // récupére le data-role
            $('input[name=str]').val(str); // ecris dans l'input //

            $('#dailyworks').modal('show'); // ouvre la modal
            $('.modal-title').html('Ajouter un travail'); // ecris le title
            $('#btn-AddCategorie').removeClass('hidden').addClass('display'); // affiche le bouton add catégorie

            load_SelectCategories(); 

            $('button[data-role=Addcategorie]').click(function() {
                
                $('#btn-addcategorie').removeClass('hidden').addClass('display');
                load_SelectCategories(); 

                $('#addcategorie').change(function(){                

                    var cat = $('input[id=addcategorie]').val();

                    $('#AddCategorie').click(function(){

                        $.ajax({
                            url : '?p=categories.add', 
                            method : 'POST',
                            data : {cat:cat},
                            success : function(data){

                                $("#succaddcate")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable')
                                .html("La catégorie à bien était ajouté !!!")
                                .slideUp(5000);                                
                                                                                 
                                $('#btn-addcategorie').removeClass('display').addClass('hidden');

                                load_SelectCategories(); 

                            }                    

                        });

                    });

                });

            });

        });        

        // EDIT DAILYWORKS //

        $(document).on('click', 'button[data-role=EditDailywork]', function(){

            $('#Dailyworks')[0].reset(); // efface le form 
            $('#dailyworks').modal('show'); // ouvre la modal            
            var str = $(this).data('role').substr(0, 3); // récupére le data-role
            $('input[name=str]').val(str); // ecris dans l'input //
           
            $('.modal-title').html('Editer le travail'); // ecris le title
            $('#btn-addcategorie').removeClass('display').addClass('hidden'); // efface le bouton add catégorie            

            var rowtabledaily = $(this).closest('tr');
            var id = parseInt(rowtabledaily.find('td:eq(0)').text()); // récupére l'id du  travail //

            load_SelectCategories();
            
            $.ajax({
                url: '?p=dailyWorks.findDataDaily',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {                    

                    let categorie = reponse[0].categorie_id;
                    $("#datedaily").val(reponse[0].date_travaux); // affiche la date enregistrer                  

                    $('#categorie option[value="0"]').attr('selected', false);
                    $('#categorie option[value="'+categorie+'"]').attr('selected', true); 

                    $('#design').val(reponse[0].designation);
                    $('#comment').val(reponse[0].commentaire);
                    $('#id').val(id);                                                        
                                        
                }
                  
            });            

        });

        // ajoute ou edit le travail journalier //
            
        $('#Dailyworks').validator().on('submit', function(event) {

            let str = $('#str').val(); // recupére le str add ou edi               

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();                

                if (str === 'ADD') {

                    var url = '?p=dailyWorks.addDailyWorks';
                    var title = 'Le travail à bien était ajouté !!!';                    

                } else if (str === 'Edi') {

                    var url = '?p=dailyWorks.editDailyWorks'
                    var title = 'Le travail à bien était mis à jour !!!';
                }

                $.ajax({
                    url : url, 
                    method : 'POST',
                    data : $('#Dailyworks').serialize(),
                    success : function(data){

                        $("#info_user")
                        .removeClass('hidden')
                        .addClass('alert alert-success success-dismissable col-lg-6')
                        .html(title);

                        $('#dailyworks').modal('hide'); // ferme la modal 
                        $("#Dailyworks")[0].reset();  // reset le form //                      
                        recupclassdiv('info_user', 5000);                        
                        TableDailyworks.ajax.reload();                                                  

                    }                    

                });                                                            

            }

        });

        // delete le travail journalier //
        
        $(document).on('click', 'button[data-role=deleteDaily]', function(){

            var rowtable = $(this).closest('tr');
            var id = parseInt(rowtable.find('td:eq(0)').text()); // id de le travail journalier

            if(confirm("Voulez-vous vraiment supprimer ce travail journalier ?")) {

               $.ajax({
                url:"?p=dailyWorks.delete", 
                method: 'POST',
                data:{id : id},                            
                success:function(reponse)
                    {              
                        $("#info_user")
                        .removeClass('hidden')
                        .addClass('alert alert-success success-dismissable')
                        .html("Le travail journalier à bien était supprimé !!!");

                        recupclassdiv('info_user', 7000);

                        TableDailyworks.ajax.reload();
                        $('#AffEventsDaily').removeClass('display').addClass('hidden');                                             
                        
                    }   
                });
            }
        });        

        /////////////// DAILY EVENTS ///////////////////////////////////

        if($('.AffDailyEvents').is(':visible') == true){
            
            if (typeU == "administrateur") {

                let btn = $(`<button class="btn btn-round btn-success" id="btn_adddailyEvent" data-role="ADDDailyEvent" <abbr title="Ajouter un événement journalier"><span class="glyphicon  glyphicon-plus"></span></abbr></button> ` + 
                            `<a class="btn btn-round btn-default" target="_blank" href="?p=dailyEvents.viewPdf" <abbr title="Créer un PDF">PDF</abbr></a>`);
                btn.appendTo($("p[id=btn_addDailyEvent]")); // affiche les btn //
            } else {
                let btn = $(`<a class="btn btn-round btn-default" target="_blank" href="?p=dailyEvents.viewPdf" <abbr title="Créer un PDF">PDF</abbr></a>`);
                btn.appendTo($("p[id=btn_addDailyEvent]")); // affiche le btn PDF //
            }

            $('a.item-TJ').attr('class', 'active');
            $('ul.item-tj').attr('style', 'display:block;');
            $('li.item-ej').attr('class', 'active');
        } 

        var TableDailyEvents = $('#TableDailyEvents').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [
                [10, 15, 25, -1],
                [10, 15, 25, 'All']
            ],
            paging: true,
            order: [[0, 'desc']],
            ajax: {
                url:'?p=dailyEvents.all',
                type: "POST"
                },
                columns: [
                    { data: "id" },
                    { data: "user" },
                    { data: "dateeventfr" },
                    { data: "designation" },
                    { data: "commentaire" },
                    { render : function(id) { 
                            if (typeU === 'administrateur') {
                               return `<button class="btn btn-primary btn-xs" data-role="EditDailyEvent" <abbr title="Edition Evénement"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                      `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteDailyEvent"<abbr title="Supprimé L'événement"><span class="glyphicon  glyphicon-trash"></span></abbr></button>` 
                            } else {
                               return `<button class="btn btn-primary btn-xs" data-role="EditDailyEvent" <abbr title="Edition Evénement"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                      `<button type="submit" class="btn btn-danger btn-xs" disabled=""<abbr title="Supprimé l'événement"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`  
                            }                        

                        }
                    }
                ]
        });        

        // ADD DAILYEVENTS //
        
        $(document).on('click','button[data-role=ADDDailyEvent]', function(){
            
            let str = $(this).data('role').substr(0, 3); // récupére le data-role
            $('#str').val(str); // ecris dans l'input

            $('#dailyevent').modal('show'); // ouvre la modal
            $('.modal-title').html('Ajouter un événement'); // ecris le title             

        });

        // EDIT DAILYEVENTS //

        $(document).on('click', 'button[data-role=EditDailyEvent]', function(){

            $('#Dailyevents')[0].reset();
            $('#dailyevent').modal('show'); // ouvre la modal            
            var str = $(this).data('role').substr(0, 3); // récupére le data-role
            $('#str').val(str); // ecris dans l'input
           
            $('.modal-title').html('Editer l\'événement'); // ecris le title           

            var rowtabledaily = $(this).closest('tr');
            var id = parseInt(rowtabledaily.find('td:eq(0)').text()); // récupére l'id de lévénement //
            var date = rowtabledaily.find('td:eq(2)').text();           
            var design = rowtabledaily.find('td:eq(3)').text();
            var comment = rowtabledaily.find('td:eq(4)').text();

            // retourne la date //
            var parts = date.split(/-/);
            parts.reverse();
            var datereverse = (parts.join('-'));
            $("#datedailyE").val(datereverse);// affiche la date enregistrer                                     

            $('#designE').val(design);
            $('#commentE').val(comment);
            $('#id').val(id);

        });

        // ajoute ou edit l'événement journalier //
            
        $('#Dailyevents').validator().on('submit', function(event) {

            let str = $('#str').val(); // recupére le str add ou edi               

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();                

                if (str === 'ADD') {

                    var url = '?p=dailyEvents.add';
                    var title = 'L\'événement à bien était ajouté !!!';                    

                } else if (str === 'Edi') {

                    var url = '?p=dailyEvents.edit'
                    var title = 'L\'événement à bien était mis à jour !!!';
                }

                $.ajax({
                    url : url, 
                    method : 'POST',
                    data : $('#Dailyevents').serialize(),
                    success : function(data){

                        $("#info_user")
                        .removeClass('hidden')
                        .addClass('alert alert-success success-dismissable col-lg-6')
                        .html(title);

                        $('#dailyevent').modal('hide'); // ferme la modal
                        $("#Dailyevents")[0].reset();                        
                        recupclassdiv('info_user', 5000);                        
                        TableDailyEvents.ajax.reload();                                                  

                    }                    

                });                                                            

            }

        });

        // delete l'evenement journalier //
        
        $(document).on('click', 'button[data-role=deleteDailyEvent]', function(){

            var rowtable = $(this).closest('tr');
            var id = parseInt(rowtable.find('td:eq(0)').text()); // id de l'event journalier

            if(confirm("Voulez-vous vraiment supprimer cette événement ?")) {

               $.ajax({
                url:"?p=dailyEvents.delete", 
                method: 'POST',
                data:{id : id},                            
                success:function(reponse)
                    {              
                        $("#info_user")
                        .removeClass('hidden')
                        .addClass('alert alert-success success-dismissable')
                        .html("L'événement à bien était supprimé !!!");

                        recupclassdiv('info_user', 7000);

                        TableDailyEvents.ajax.reload();                                             
                        
                    }   
                });
            }
        });

    // LINKS //
    
        // Affiche le table des liens de l'IPBX vers les prises //
        
        if ($('.AffTLinks').is(':visible') == true){            

            $('a.item-T').attr('class', 'active');
            $('ul.item-t').attr('style', 'display:block;');
            $('li.item-c').attr('class', 'active');

        }  

        // Table links pour liaisons ipbx et prise //
        var TableLinks = $('#TableLinks').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '50vh',
            scrollX: true,
            scollCollapse: true,
            paging: false,
            ajax: {
                url:'?p=links.alllink',
                type: "POST"
                },
                columns: [                
                    { data: "id" },
                    { data: "num_tel" },
                    { data: "nom_tel" },
                    { data: "empl_ipbx" },
                    { data: "nom_bandeau" },
                    { data: "port_rg" },
                    { data: "nom_arm" },
                    { data: "port_arm" },
                    { data: "niveau_arm" },                    
                    { data: "num_pbureau" },                    
                    { data: "lieux_bureau" },
                    { render : function(id) { 

                        if (typeU == "administrateur") {
                            return "<button class='btn btn-primary btn-xs' data-role='EditLink'<abbr title='Edition Lien'><span class='glyphicon glyphicon-pencil'></span></abbr></button> <button type='submit' class='btn btn-danger btn-xs' data-role='deleteLink'<abbr title='Supprimé le lien'><span class='glyphicon  glyphicon-trash'></span></abbr></button>"
                        } else {
                            return "<button class='btn btn-primary btn-xs' data-role='EditLink'<abbr title='Edition Lien' disabled><span class='glyphicon glyphicon-pencil'></span></abbr></button> <button type='submit' class='btn btn-danger btn-xs' data-role='deleteLink'<abbr title='Supprimé le lien' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>"
                        }
                    }}                    
                    
                ]            

        });

        TableLinks.on('xhr', function(e, settings, json) {

            if(json.data.length == "0") {
                $('.VPDF')
                .css('cursor', 'default')
                .css('text-decoration', 'none');
             
                $('.VPDF').on("click", function(e) {
                    e.preventDefault();
                });
            }

        });

        // affiche Table Phone pour liaisons ipbx et prise selectionner avec id annuaire//
        function viewlinkselect(id) {
            
            // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableLinkSelect')) {

                $('#TableLinkSelect').DataTable().destroy()

            } 

            $('#TableLinkSelect').DataTable({

                language: {url: "../public/media/French.json"},
                lengthMenu: [10, 15, 25, 50],
                scrollY: '50vh',
                scollCollapse: true,
                paging: false,
                searching: false,
                ajax: {
                    url:'?p=links.selectlink',
                    type: "POST",
                    data: {id:id}
                    },
                    columns: [                
                        { data: "id" },
                        { data: "num_tel" },
                        { data: "nom_tel" },
                        { data: "empl_ipbx" },
                        { data: "nom_bandeau" },
                        { data: "port_rg" },
                        { data: "nom_arm" },
                        { data: "port_arm" },
                        { data: "niveau_arm" },                    
                        { data: "num_pbureau" },                    
                        { data: "lieux_bureau" },
                        { render : function(id) { 

                            if (typeU == "administrateur") {
                                return "<button class='btn btn-primary btn-xs' data-role='EditLink'<abbr title='Edition Lien'><span class='glyphicon glyphicon-pencil'></span></abbr></button> <button type='submit' class='btn btn-danger btn-xs' data-role='deleteLink'<abbr title='Supprimé le lien'><span class='glyphicon  glyphicon-trash'></span></abbr></button>"
                            } else {
                                return "<button class='btn btn-primary btn-xs'<abbr title='Edition Lien' disabled><span class='glyphicon glyphicon-pencil'></span></abbr></button> <button type='submit' class='btn btn-danger btn-xs'<abbr title='Supprimé le lien' disabled><span class='glyphicon  glyphicon-trash'></span></abbr></button>"
                            }
                        }}                    
                        
                    ]            

            })

        }

        // affiche la table liaison selectionner id annuaire //
        
        if ($('.AffTLinkSelect').is(':visible') == true) {

            let id = $('input[name=id]').val()
            viewlinkselect(id)
        }               

        // verifie link //

        function checkedLink(tab) {

            $(document).click(function(){                

                var obj = $(this); 

                var nomInp = obj[0].activeElement.id;  // recupére le non de l'id de l'input //              

                if (nomInp) {

                // verification //
                    switch(nomInp) {

                        case 'Num':
                        var fieldB = 'num_tel';
                        var i = 0;
                        break;

                        case 'NomU':
                        var fieldB = 'nom_tel';
                        var i = 1;
                        break;

                        case 'Empla':
                        var fieldB = 'empl_ipbx';
                        var i = 2;
                        break;                        

                        case 'Port_rg':
                        var fieldA = 'nom_band';
                        var fieldB = 'port_rg';
                        var i = 3;
                        break;                                                

                        case 'Port_arm':
                        var fieldA = 'nom_arm';
                        var fieldB = 'port_arm';
                        var i = 4;
                        break;

                        case 'NumP':
                        var fieldB = 'num_pbureau';
                        var i = 5;
                        break;

                        default:
                        var fieldB = '';
                        var i = false;                                       

                    }

                    // function si input change //
                    $('#'+ nomInp).change(function(){

                        var field = $('#'+ nomInp).val(); // récupére le contenu de l'input apres changement // 

                        if(field && fieldB) {

                            if (field === tab[i] || nomInp === "Bandeau") {

                                // fait pas de verification //                                                    

                            } else {

                                if (nomInp === "Port_rg" || nomInp === "Port_arm") {
                                     
                                    var band = $('#Slcheadband').val(); // recupére la valeur id du bandeau //                              

                                    $.ajax({
                                        url: '?p=phones.checkedPorts',
                                        data: {band:band, field:field, fieldA:fieldA, fieldB:fieldB},
                                        method: 'POST',
                                        dataType: 'json',
                                        success: function(reponse) {

                                            if (reponse.length == 0) {

                                                // id n'existe pas //
                                                
                                            } else {

                                                // id existe ont dis que la valeur n'est pas bonne
                                                switch (nomInp) {

                                                    case 'Port_rg':
                                                    $('#aff_portrg')
                                                    .removeClass('hidden')
                                                    .addClass('alert alert-danger danger-dismissable')
                                                    .html("Ce port et déja utilisé !!!");

                                                    $('#Port_rg').val(tab[3]);                                                    
                                                    recupclassdiv('aff_portrg', 3000);
                                                    break;

                                                    case 'Port_arm':
                                                    $('#aff_portarm')
                                                    .removeClass('hidden')
                                                    .addClass('alert alert-danger danger-dismissable')
                                                    .html("Ce port et déja utilisé !!!");

                                                    $('#Port_arm').val(tab[4]);                                                    
                                                    recupclassdiv('aff_portarm', 3000);                                                
                                                    break;
                                                }

                                            }                                                    
                                                                
                                        }
                                          
                                    }); 

                                } else {

                                    // faire une verification dans la base si la valeur existe ou pas //
                                    $.ajax({
                                        url: '?p=phones.checkedFields',
                                        data: {field:field, fieldB:fieldB},
                                        method: 'POST',
                                        dataType: 'json',
                                        success: function(reponse) {

                                            if (reponse.length == 0) {

                                                // id n'existe pas //
                                                
                                            } else {

                                                // id existe ont dis que la valeur n'est pas bonne
                                                switch (nomInp) {

                                                    case 'Num':
                                                    $('#aff_num')
                                                    .removeClass('hidden')
                                                    .addClass('form-group col-sm-9 alert alert-danger danger-dismissable')
                                                    .html("Ce numéro existe déja !!!");

                                                    $('#Num').val(tab[0]);                                                    
                                                    recupclassdiv('aff_num', 5000);
                                                    break;

                                                    case 'NomU':
                                                    $('#aff_nomu')
                                                    .removeClass('hidden')
                                                    .addClass('form-group col-sm-9 alert alert-danger danger-dismissable')
                                                    .html("Ce nom existe déja !!!");

                                                    $('#NomU').val(tab[1]);                                                    
                                                    recupclassdiv('aff_nomu', 5000);
                                                    break;

                                                    case 'Empla':
                                                    $('#aff_empla')
                                                    .removeClass('hidden')
                                                    .addClass('form-group col-sm-9 alert alert-danger danger-dismissable')
                                                    .html("Cette emplacement et déja utilisé !!!");

                                                    $('#Empla').val(tab[2]);                                                    
                                                    recupclassdiv('aff_empla', 5000);                                                
                                                    break;                                                

                                                    case 'NumP':
                                                    $('#aff_nump')
                                                    .removeClass('hidden')
                                                    .addClass('form-group col-sm-9 alert alert-danger danger-dismissable')
                                                    .html("Ce numéro de prise existe déja !!!");

                                                    $('#NumP').val(tab[5]);                                                    
                                                    recupclassdiv('aff_nump', 5000);                                                
                                                    break;

                                                }

                                            }                                                           
                                                                
                                        }
                                          
                                    });
                                }
                                 
                            }                                                       
                        }
                    });                    

                }                                         

            });
        }

        // verifier la valeur du port Emplacement //
        
        $('#Empla').on('keyup', function() {

            let separator = "-";
            let v;
            let value = $('#Empla').val();

            if (value.length == 1) {

                if (value == 0 || value >= '3') {

                    $('#Empla').val('');
                    $('#aff_empla')
                    .addClass('form-group col-sm-9 alert alert-danger danger-dismissable')
                    .html('le premier élément ne peut pas être égal à 0 ou supérieur à 2 !!');
                    recupclassdiv('aff_empla', 5000);
                } else {

                    $('#Empla').val(value + separator);

                } 
                
            } else if (value.length == 4) {

                v = value.split('-', 2); // explose la valeur de l'input //
                
                if ( v[1] >= '21') { // si la valeur et superieur à 20  

                    $('#Empla').val(v[0] + separator);
                    $('#aff_empla')
                    .addClass('form-group col-sm-9 alert alert-danger danger-dismissable')
                    .html('le deuxiéme élément ne peut pas être supérieur à 20 !!');
                    recupclassdiv('aff_empla', 5000);
                    
                } else {

                    $('#Empla').val(value + separator); 
               }                

            } else if (value.length == 7) {

                v = value.split('-', 3)

                if (v[2] >= '16') { // si la valeur et supérieur à 15
                    
                    $('#Empla').val(v[0] + separator + v[1] + separator);
                    $('#aff_empla')
                    .addClass('form-group col-sm-9 alert alert-danger danger-dismissable')
                    .html('le troisiéme élément ne peut pas être supérieur à 15 !!');
                    recupclassdiv('aff_empla', 5000);

                } else {

                    $('#Empla').val(value);
                }

            }          
        }); 

        // view link selectionner //
        
        $(document).on('click', 'button[data-role=viewLink]', function(){

            let id = $(this).data('id');

            window.location.href ='?p=links.linkselect&id='+id;

        });    

        // ADD LINK //
        
        $(document).on('click', 'button[data-role=AddLink]', function(){

            rowtablephone = $(this).closest('tr');
            id = parseInt(rowtablephone.find('td:eq(0)').text());
            annu = rowtablephone.find('td:eq(1)').text();

            $('#addlink').modal('show'); // ouvre la modal
            $('.modal-title').html('Ajout Liaison entre IPBX et prise de l\'annuaire: ' + annu);
            $('.title_port').html('Prise/Port');

            load_SelectHeadband(); // charge le select bandeau //

            $('#NumP').attr('readonly', true);
            $('#ArmDiv').addClass('hidden'); // cache la panel armoire divisionnaire //

            var tab = [];
            checkedLink(tab);

            $('#Op').val('Add'); // ecris dans l'input op //
            $('#id_link').val(id); // ecris l'id link //

        });

        // EDIT LINK //

        $(document).on('click', 'button[data-role=EditLink]', function(){

            rowtablephone = $(this).closest('tr');
            id = parseInt(rowtablephone.find('td:eq(0)').text());
                        
            $.ajax({
                url: '?p=links.datalinks',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    let annu = reponse[0].num_tel;
                    let band = reponse[0].nom_bandeau;
                    let nomU = reponse[0].nom_tel;
                    let empl = reponse[0].empl_ipbx;
                    let portrg = reponse[0].port_rg;
                    let portarm = reponse[0].port_arm;
                    let nump = reponse[0].num_pbureau;
                    let lieu = reponse[0].lieux_bureau;

                    $('#link').modal('show'); // ouvre la modal
                    $('.modal-title').html('Edition Liaison entre IPBX et prise du N°: ' +annu);
                    
                    // ecris dans les inputs pour l'édition //
                    
                    $('#Num').val(annu);
                    $('#NomU').val(nomU);
                    $('#Empla').val(empl);
                    $('#Bandeau').val(band);
                    $('#Port_rg').val(portrg);
                    
                    // si nomarm existe //
                    if (band != "RG") {

                        $('#ArmDiv').removeClass('hidden').addClass('display'); // affiche la div armdiv
                        $('#Armoir').val(reponse[0].nom_arm);
                        $('#Port_arm').val(portarm);
                        $('#Niv').val(reponse[0].niveau_arm);

                    } else {

                        $('#ArmDiv').removeClass('display').addClass('hidden'); // efface la div armdiv                

                    }                      
                    
                    $('#NumP').val(nump);
                    $('#Lieux').val(lieu);        

                    var tab =[annu,nomU,empl,portrg,portarm,nump,lieu];
                    checkedLink(tab);

                    $('#id_band').val(reponse[0].band_id);
                    $('#op').val('Edit'); // ecris dans l'input op //
                    $('#id_link').val(id); // ecris l'id phone //                                                          
                                        
                }
                  
            });            

        });           

        // ajoute le lien IPBX //
            
        $('#Link').validator().on('submit', function (event) {

            let op = $('#Op').val(); // récupére l'operation edit ou add //
            let id = $('#id_link').val(); // récupére l'id lien //            

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();

                if (op == 'Add') {                   

                    $.ajax({
                        url : '?p=links.add', 
                        method : 'POST',
                        data : $('#Link').serialize(),
                        success : function(reponse){

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("Le lien à bien était ajouté !!!");

                            $('#addlink').modal('hide'); // ferme la modal
                            $("#Link")[0].reset(); // reset le formulaire
                            recupclassdiv('info_user', 7000);       

                        }                   

                    });                                        
                    
                } else {

                    // mise a jour des données édition link //
                    $.ajax({
                        url : '?p=links.edit', 
                        method : 'POST',
                        data : $('#Link').serialize(),
                        success : function(response){

                            $('#link').modal('toggle');

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("Le lien à bien était modifié !!!");

                            $("#Link")[0].reset();
                            recupclassdiv('info_user', 7000);
                                                        
                        }

                    });

                }

                if ($('.AffTLinks').is(':visible') == true) {

                    TableLinks.ajax.reload(); 

                } else if($('.AffPhoneBook').is(':visible') == true) {

                    TablePhoneBook.ajax.reload();

                } else if ($('.AffTLinkSelect').is(':visible') == true) {

                    viewlinkselect(id);
                }

            }

        })
        
        // DELETE LINK //
        
        $(document).on('click', 'button[data-role=deleteLink]', function(){ 
            
            let btn = $(this).data('btn');

            if (confirm("Etes-vous sûr de vouloir supprimer cet élément ?")) {

                rowtablelink = $(this).closest('tr');
                id = parseInt(rowtablelink.find('td:eq(0)').text());

                $.ajax(
                {
                    type: "post",
                    url: "?p=links.delete",
                    data: {id:id},
                    cache: false,
                    success: function() {
                        
                        $("#info_user")
                        .removeClass('hidden')
                        .addClass('alert alert-success success-dismissable col-lg-12')
                        .html("Le lien à bien était supprimé !!!");

                        recupclassdiv('info_user', 5000);

                        if (btn == 'links') {

                            TableLinks.ajax.reload();
                            
                        } else {

                            viewlinkselect(id);

                        }

                    }
                });               
            }
        
        });              

        // modifie le champ en function de ce qui et frappé / ????? //                  

        $('#NumP').on('keyup', function() {

            let nump = $('#NumP').val();
            let numb = $('input[name=Bandeau]').val();
            let val = numb.substr(0, 2);

            if (numb == "SR04") { // si bandeau et egal à SR04 //

                $('#NumP').attr('maxlength',3); // attribu maxlength a 3             

            } else if (numb == "RG") {

                $('#NumP').attr('maxlength',8); // attribu maxlength a 8//

            } else {

                $('#NumP').attr('maxlength',10); // attribu maxlength a 10//
            }

            ////////////////////////////////////////

            if (val == "SR" && nump.length == 4) {

                if (nump != numb) { // si nump et différent de numb 

                    $('#NumP').val(numb+'.'); // ecris la valeur de bandeau + un point dans input

                } else {

                    $('#NumP').val(nump+'.'); // ont ajoute un point a nump
                }                        

            } else if (val == "SR" && nump.length == 6) {

                $('#NumP').val(nump+'.');

            } else if (val == "RG") {

                if (nump.length == 2 || nump.length == 4) {

                    $('#NumP').val(nump+'.');
                }
                
            }

        });
    
    // ANNUAIRE / PHONES BOOK //

        if($('.AffPhoneBook').is(':visible') == true){
            $('a.item-T').attr('class', 'active');
            $('ul.item-t').attr('style', 'display:block;');
            $('li.item-a').attr('class', 'active');
        }

        // Table Annuaire //
        var TablePhoneBook = $('#TablePhoneBook').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '50vh',
            scrollX: true,
            scollCollapse: true,
            paging: false,
            ajax: {
                url:'?p=phones.book',
                type: "POST"
                },                
                columns: [                
                    { data: "id" },
                    { data: "num_tel" },
                    { data: "num_sda" },
                    { data: "type" },
                    { data: "nom_tel" },
                    { data: "nom_service" },                    
                    { data: "zone" },
                    { render : function(id,row,type) {

                        if (typeU == "administrateur") {

                            if (type.link == 0 && type.type !="DECT") { // l'annuaire n'a pas de lien & dif de DECT //

                                return  `<button class="btn btn-primary btn-xs" data-role="EditPhoneBook"<abbr title="Edition Annuaire"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<button type="submit" class="btn btn-danger btn-xs" data-role="deletePhoneBook"<abbr title="Supprimé le numéro"><span class="fa fa-trash-o"></span></abbr></button> `+
                                        `<button class='btn btn-info btn-xs disabled'<abbr title='Voir le lien'><span class='fa fa-eye'></span></abbr></button> `+
                                        `<button class='btn btn-success btn-xs' data-role='AddLink'<abbr title='Ajouter un Lien'><span class='fa fa-random'></span></abbr></button>`

                            } else if (type.link == 1 && type.type !="DECT") {  // l'annuaire a un lien enregistrer & dif de DECT// 

                                return  `<button class="btn btn-primary btn-xs" data-role="EditPhoneBook"<abbr title="Edition Annuaire"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<button type="submit" class="btn btn-danger btn-xs" data-role="deletePhoneBook"<abbr title="Supprimé le numéro"><span class="fa fa-trash-o"></span></abbr></button> `+
                                        `<button class='btn btn-info btn-xs' data-role='viewLink' data-id='`+ type.id+`'<abbr title='Voir le lien'><span class='fa fa-eye'></span></abbr></button> `+
                                        `<button class='btn btn-success btn-xs disabled'<abbr title='Ajouter un Lien'><span class='fa fa-random'></span></abbr></button>`

                            } else if (type.type = "DECT") {

                                return  `<button class="btn btn-primary btn-xs" data-role="EditPhoneBook"<abbr title="Edition Annuaire"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<button type="submit" class="btn btn-danger btn-xs" data-role="deletePhoneBook"<abbr title="Supprimé le numéro"><span class="fa fa-trash-o"></span></abbr></button> `+
                                        `<button class='btn btn-info btn-xs disabled'<abbr title='Voir le lien'><span class='fa fa-eye'></span></abbr></button> `+
                                        `<button class='btn btn-success btn-xs disabled'<abbr title='Ajouter un Lien'><span class='fa fa-random'></span></abbr></button>`
                            }

                        } else { 

                            return `<button class="btn btn-primary btn-xs"<abbr title="Edition Annuaire" disabled><span class="fa fa-pencil"></span></abbr></button>`+
                                   `<button type="submit" class="btn btn-danger btn-xs"<abbr title="Supprimé le numéro" disabled><span class="fa fa-trash-o""></span></abbr></button>`+
                                   `<button class='btn btn-info btn-xs' data-role='viewLink' data-id='`+ type.id+`'<abbr title='Voir le lien'><span class='fa fa-eye'></span></abbr></button> `
                        }
                    }}                    
                    
                ]            

        });

        TablePhoneBook.on('xhr', function(e, settings, json) {

            if(json.data.length == "0") {
                $('.VPDF')
                .css('cursor', 'default')
                .css('text-decoration', 'none');
             
                $('.VPDF').on("click", function(e) {
                    e.preventDefault();
                });
            }

        });
        
        // verifie l'annuaire //

        function checkedphonebook(tab) {

            $(document).click(function(){

                let i,fieldB                

                let obj = $(this)

                let nomInp = obj[0].activeElement.id  // recupére le nom de l'id de l'input //              

                if (nomInp) {

                    // verification //
                    switch(nomInp) {

                        case 'num':
                        fieldB = 'num_tel';
                        i = 0;
                        break;

                        case 'numSda':
                        fieldB = 'num_sda';
                        i = 1;
                        break;

                        case 'nomU':
                        fieldB = 'nom_tel';
                        i = 2;
                        break;

                        default:
                        fieldB = '';
                        i = false;                                       

                    }

                    // function si input change //
                    $('#'+ nomInp).change(function(){

                        let field = $('#'+ nomInp).val() // récupére le contenu de l'input apres changement // 

                        if(field && fieldB) {                            

                            // faire une verification dans la base si la valeur existe ou pas //
                            $.ajax({
                                url: '?p=phones.checkedFields',
                                data: {field:field, fieldB:fieldB},
                                method: 'POST',
                                dataType: 'json',
                                success: function(reponse) {

                                    if (reponse.length == 0) {

                                        // id n'existe pas ont dis que la valeur et bonne
                                        switch (nomInp) {

                                            case 'num':
                                            $('#info_addphone').removeClass('hidden').addClass('alert alert-success success-dismissable col-sm-12').html("Ce numéro d'annuaire et valide !!!")                                                                                                
                                            recupclassdiv('info_addphone', 5000)
                                            break;

                                            case 'numSda':
                                            $('#info_addphone').removeClass('hidden').addClass('alert alert-success sucess-dismissable col-sm-12').html("Ce numéro SDA et valide !!!")                                                                                               
                                            recupclassdiv('info_addphone', 5000)
                                            break;

                                            case 'nomU':
                                            $('#info_addphone').removeClass('hidden').addClass('alert alert-success success-dismissable col-sm-12').html("Ce nom et valide !!!")                                                                                               
                                            recupclassdiv('info_addphone', 5000)
                                            break;

                                        }
                                        
                                    } else {

                                        // id existe ont dis que la valeur n'est pas bonne
                                        switch (nomInp) {

                                            case 'num':
                                            $('#info_addphone').removeClass('hidden').addClass('alert alert-danger danger-dismissable col-sm-12').html("Ce numéro d'annuaire existe déja !!!")
                                            $('#num').val(tab[0])                                                    
                                            recupclassdiv('info_addphone', 5000)
                                            break;

                                            case 'numSda':
                                            $('#info_addphone').removeClass('hidden').addClass('alert alert-danger danger-dismissable col-sm-12').html("Ce numéro SDA existe déja !!!")
                                            $('#numSda').val(tab[1])                                                    
                                            recupclassdiv('info_addphone', 5000)
                                            break;

                                            case 'nomU':
                                            $('#info_addphone').removeClass('hidden').addClass('alert alert-danger danger-dismissable col-sm-12').html("Ce nom existe déja !!!")
                                            $('#nomU').val(tab[2])                                                    
                                            recupclassdiv('info_addphone', 5000)
                                            break;

                                        }

                                    }                                                           
                                                        
                                }
                                  
                            })
                                                            
                                                                                   
                        }
                    })                  

                }                                         

            })
        } 

        // ADD Phone Book (annuaire) //
        
        $(document).on('click', 'button[data-role=ADDPhoneBook]', function(){

            $('#phonebook').modal('show') // ouvre la modal
            $('.modal-title').html('Ajout Annuaire')
            load_SelectService() // charge le select service //

            let tab = [];
            checkedphonebook(tab);
            
            $('#op').val('Add'); // ecris dans l'input op //            

        });

        // EDIT PHONE BOOK //

        $(document).on('click', 'button[data-role=EditPhoneBook]', function(){

            rowtablephone = $(this).closest('tr')
            id = parseInt(rowtablephone.find('td:eq(0)').text())

            $.post('?p=phones.finddataphonebook',

                {
                    id : id 

                }, function(data) {  

                $('#phonebook').modal('show') // ouvre la modal
                let annu = data[0].num_tel 
                $('.modal-title').html('Edition Annuaire du N°: '+annu)
                load_SelectService("Book") // charge le select service //

                // ecris dans les inputs pour l'édition //           
                $('#num').val(annu)

                let numSda = data[0].num_sda
                $('#numSda').val(numSda)

                let nomU = data[0].nom_tel
                $('#nomU').val(nomU)

                $('#service').val(data[0].nom_service)

                let zone = data[0].zone          
                $('#zone').val(zone)

                $('#serv option[value="' + data[0].id_serv +'"]').attr('selected', true)
                
                $('#typephone option[value="' + data[0].type +'"]').attr('selected', true)
                
                $('#id_book').val(data[0].id)
                $('#op').val('Edit')

                var tab =[annu,numSda,nomU]
                checkedphonebook(tab)
            })

        });

        // ajoute ou edit l'annuaire //
            
        $('#PHONEBOOK').validator().on('submit', function (event) {

            var op = $('#op').val() // récupére l'operation edit ou add //            

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault()

                if (op == 'Add') {

                    // ajoute un annuaire //
                    $.ajax({
                        url : '?p=phones.addphonebook', 
                        method : 'POST',
                        data : $('#PHONEBOOK').serialize(),
                        success : function(reponse){

                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("Le téléphone à bien était ajouté !!!")                       
                            $('#phonebook').modal('hide') // ferme la modal
                            $("#PHONEBOOK")[0].reset() // reset le formulaire

                            TablePhoneBook.ajax.reload()                            

                            recupclassdiv('info_user', 7000)       

                        }                   

                    });
                                        
                    
                } else {

                    // mise a jour des données édition annuaire
                    $.ajax({
                        url : '?p=phones.editphonebook', 
                        method : 'POST',
                        data : $('#PHONEBOOK').serialize(),
                        success : function(response){

                            $('#phonebook').modal('toggle')  // ferme la modal                          
                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("Le téléphone à bien était modifié !!!")                            
                            $("#PHONEBOOK")[0].reset()

                            TablePhoneBook.ajax.reload()
                            recupclassdiv('info_user', 7000)
                                                        
                        }

                    });

                }

            }

        });

        // DELETE PHONEBOOK //
        
        $(document).on('click', 'button[data-role=deletePhoneBook]', function() {            

            if (confirm("Etes-vous sûr de vouloir supprimer cet élément ?")) {

                rowtablelink = $(this).closest('tr');
                id = parseInt(rowtablelink.find('td:eq(0)').text());

                $.ajax(
                {
                    type: "post",
                    url: "?p=phones.deletePhoneBook",
                    data: {id:id},
                    cache: false,
                    success: function() {

                        $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-12').html("Le numéro annuaire et sont lien onts bien était supprimé !!!");
                        recupclassdiv('info_user', 5000);

                        TablePhoneBook.ajax.reload();
                    }
                });                
            }
        
        });    

    // HEADBAND / BANDEAU //
    
        if ($('.AffHeadBands').is(':visible') == true) {

            $('a.item-T').attr('class', 'active');
            $('ul.item-t').attr('style', 'display:block;');
            $('li.item-ba').attr('class', 'active');            

            load_SelectHeadband();
            
        }      
        
        // function select bandeau //
        
        function load_SelectHeadband() {

            $.ajax({
                url: '?p=phones.selectheadband',
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#Slcheadband option').remove();

                    $("#Slcheadband").append('<option value="0" selected disabled>Veuillez choisir le bandeau !!!</option>') // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;
                        var headband = reponse[i].nom_bandeau;                            

                        $("#Slcheadband").append('<option value="'+ id +'">'+ headband +'</option>') // remplis les données dans le select //

                    }                        
                    
                }
            }) 
        }

        // function qui verifie si le bandeau existe en base //
        
        function checkedBandeau(){            

            $('#headband').change(function(){

                let Band = $('#headband').val();
                
                $("#aff_band").removeClass('display').addClass('hidden'); // efface l'info  //

                if (Band == "") {

                } else {

                    $.ajax({
                        url : '?p=phones.findband', 
                        method : 'POST',
                        data : {Band:Band},
                        dataType: 'json',
                        success : function(data){                                         

                            if (data != false ) { 

                                // msg d'erreur si le bandeau existe //
                                
                                $("#aff_band")
                                .removeClass('hidden')
                                .addClass('alert alert-danger danger-dismissable')
                                .html('Ce bandeau existe déja !!! ');

                                $('#AddHeadBand')[0].reset(); // reset le form //

                            } 

                        }

                    });

                }

            });

        }

        // function add bandeau //

        $(document).on('click', 'button[data-role=addHeadBand]', function() {

            $('#headband').modal('show'); // ouvre la modal //
            $('.modal-title').html('Ajouter un bandeau');
            checkedBandeau();
            $('input[name=op]').val('add');

        });

        // function edit bandeau //
        
        $(document).on('click', 'button[data-role=editHeadBand]', function() {

            $('#headband').modal('show'); // ouvre la modal //
            $('.modal-title').html('Edition bandeau');

            let nom_bandeau = $(this).data('nom');
            let id_band = $(this).data('id');

            $('input[name=headband]').val(nom_bandeau);
            $('input[name=id_band]').val(id_band);

            $('input[name=op]').val('edit');

        });

        // validation add & edit headband //
        
        $('#HeadBand').validator().on("submit", function(event){

            var op = $('input[name=op]').val();

            if (event.isDefaultPrevented()) {

            } else {

                event.preventDefault();

                if (op == 'add') {

                    $.ajax({
                        url: '?p=phones.addheadband',
                        data: $('#HeadBand').serialize(),
                        method: 'POST',
                        success: function(reponse) {

                            $("#aff_band")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("Le bandeau à bien était ajouté !!!");

                            recupclassdiv('aff_band', 5000, 'headband'); // affiche info et ferme la modal apprés 5sec //

                            load_SelectHeadband();                                                                                                            
                                                  
                        }
                        
                    });

                } else {

                    $.ajax({
                        url: '?p=phones.editheadband',
                        data: $('#HeadBand').serialize(),
                        method: 'POST',
                        success: function(reponse) {

                            $("#aff_band")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable')
                            .html("Le bandeau à bien était modifié !!!");

                            recupclassdiv('aff_band', 5000, 'headband'); // affiche info et ferme la modal apprés 5sec //

                            load_SelectHeadband();                                                                                                            
                                                  
                        }
                        
                    });

                }
                
            }  
        });
        
        // affiche ou efface la section sous condition (édition) dans Link //
        
        $('#Bandeau').on('change', function(){

            $('#Port_rg').val(''); // efface l'input //

        });

        // contrôle le champ sur la frappe et rectifie le champ si besoin //            

        $('#Bandeau').on('keyup', function() {

            let band = $('#Bandeau').val();

            if (band.length == 1) {

                // 1er valeur de bandeau doit etre soit S ou R //
                if (band == "S" || band == "R") {
                    // tout et ok //
                } else {
                    // valeurs pas bonne //
                    $('#Bandeau').val(''); 
                }

            } else if (band.length == 2) {                    

                // 2eme valeur de bandeau doit etre soit RG ou SR //
                if (band == "SR" || band == "RG") {
                    // tout et ok //
                } else {
                    // valeurs pas bonne //
                    let val = band.substr(0, 1);
                    $('#Bandeau').val(val);
                }

            } else if (band.length == 3) {

                // 3eme valeur de bandeau doit etre comprise entre 0 et 7 //
                
                if (band == "SR0") {
                    //tout et ok
                    $('#Bandeau').val(band);
                } else {
                    // valeur pas bonne //
                    let val = band.substr(0, 2);
                    $('#Bandeau').val(val); 
                }

            }                

            if (band !='RG') {

                // affiche la section //
                $('#ArmDiv').removeClass('hidden').addClass('display')
                $('#Armoir').val(band) //ecris la valeur dans l'input //                            
                $('#Port_arm').attr('required', true)

                var index = band.substring(0, 4) // recupére les quatre premier element //
                            
                switch (index) {                                

                    case 'SR02':
                    $('#Niv').val('RDC')
                    break;

                    case 'SR03':
                    $('#Niv').val('RDC')
                    break;

                    case 'SR04':
                    $('#Niv').val('1er Etage')
                    break;

                    case 'SR05':
                    $('#Niv').val('1er Etage')
                    break;

                    case 'SR06':
                    $('#Niv').val('2éme Etage')
                    break;

                    case 'SR07':
                    $('#Niv').val('2éme Etage')
                    break;

                    default:
                    $('#Niv').val('')               

                }                       

            } else {

                // efface la section //
                $('#ArmDiv').removeClass('display').addClass('hidden')
                $('#Armoir').val("") // efface l'input                            
                $('#Port_arm').attr('required', false)
            }

            if (band == "SR04") { // si bandeau et egal à SR04 //

                $('#NumP').val("") // efface l'input //             

            } else if (band == "RG") {

                $('#NumP').val(band+'.') // ecris dans l'input //

            } else {

                $('#NumP').val(band+'.') // ecris dans l'input //
            }                     

        }); 

        // action au changement du select bandeau //
        
        $("#Slcheadband").on('change', function() {

            let valslc = $('#Slcheadband').val();
            let nomslc = $('#Slcheadband option:selected').text(); 

            $('#NumP').attr('readonly', false);

            if ($('.AffPhoneBook').is(':visible')) { // page phonesbook //

                $('.EditHeadBand').attr('data-nom', nomslc).attr('data-id', valslc).attr('disabled', false);

                if (nomslc != "RG") {

                    $('#ArmDiv').removeClass('hidden').addClass('display'); // affiche //
                    load_arm(nomslc); // charge l'armoire correspondante au bandeau /*********AC****/

                } else {

                    $('#ArmDiv').removeClass('display').addClass('hidden'); // efface //

                }

            } else { // page bandeau //

                $('.conteneur-grid').attr({id:valslc, data:valslc});
            }            

        });                    

        // function pour bandeau /******************** a revoir& a continuer *******************/

        $(".conteneur-grid").on('click', 'div', function(){

            var rowdiv = $(this).closest('div');
            var port = rowdiv[0].firstChild.data; // récupére le port du bandeau
            var arm = $('#arm').val(); // récupére le nom de l'armoire 
            var band = $('#Slcheadband option:selected').val(); // récupére la valeur du bandeau selectionner //

            console.log(port, arm, band);             

            $.ajax({
                url: '?p=phones.findband',
                data: {port:port, band:band, arm:arm},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                   console.log(reponse);                                                           
                                        
                }
                  
            }); 

        });

    // SERVICE //

        if($('.AffPhoneService').is(':visible') == true) {
            $('a.item-T').attr('class', 'active');
            $('ul.item-t').attr('style', 'display:block;');
            $('li.item-es').attr('class', 'active');
        }
    
        // Table Service //
        var TableService = $('#TableService').DataTable({

            language: {url: "../public/media/French.json"},
            scrollY: '50vh',
            scrollX: true,
            scollCollapse: true,
            paging: false,
            ajax: {
                url:'?p=services.allservices',
                type: "POST",
                dataSrc: ""
            },                
            columns: [                
                { data: "id" },
                { data: "nom_service" },
                { render : function() {

                    if (typeU == "administrateur") {                            

                        return  `<button class="btn btn-primary btn-xs" data-role="EditService"<abbr title="Edition Service"><span class="fa fa-pencil"></span></abbr></button> `+
                                `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteBook"<abbr title="Supprimé le numéro"><span class="fa fa-trash-o"></span></abbr></button> `                           

                    } else { 

                        return `<button class="btn btn-primary btn-xs" <abbr title="Edition Annuaire" disabled><span class="fa fa-pencil"></span></abbr></button>`+
                               `<button type="submit" class="btn btn-danger btn-xs" <abbr title="Supprimé le numéro" disabled><span class="fa fa-trash-o""></span></abbr></button>`
                    }                        

                }}                   
                
            ]            

        });
     
        // function select service //
        
        function load_SelectService(val) {

            let index

            if (val == "link" ) { // link 
                index = 'Serv'
                $('#Serv option').remove()
            } else {
                index = 'serv' // annuaire
                $('#serv option').remove()
            }            

            $.ajax({
                url: '?p=services.selectService',
                method: 'POST',
                async: false,
                success: function(reponse) {                    

                    $("#"+index).append('<option value=" " selected disabled>Veuillez choisir un service</option>') // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id

                        var serv = reponse[i].nom_service                            

                        $("#"+index).append('<option value="'+ id +'">'+ serv +'</option>') // remplis les données dans le select //

                    }                        
                    
                }
            }) 
        }   
    
        // ouvre la modal ajout service //

        $(document).on('click','button[data-role=addService]', function(){

            $('#addservice').modal('show') // ouvre la modal
            $('#serviceadd').on('change', function() {

                var service = $('#serviceadd').val()

                if (service === " ") {                   

                } else { 

                    $.ajax({
                        url: '?p=services.checkedService', 
                        data: {service:service},
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) { 

                            if (data == false ) {

                                // si le service n'existe pas ont fait l'enregistrement //                                                           

                                $('#AddService').validator().on('submit', function (event) {

                                    if (event.isDefaultPrevented()) {

                                    } else {
                                    
                                        event.preventDefault()

                                        var service = $('#serviceadd').val()

                                        $.ajax({
                                            url : '?p=services.addService',
                                            method : 'POST',
                                            data : {service:service},
                                            success : function(data){                                                   
                                                
                                                $("#affaddservice").removeClass('hidden').addClass('alert alert-success success-dismissable').html("Le service à bien était ajouté !!!")
                                            
                                                recupclassdiv('affaddservice', 7000)                                                                                      

                                                load_SelectService();                                                                                    

                                                $("#AddService")[0].reset()
                                                $('#addservice').modal('hide') // ferme la maodal add service //                                                                                                   

                                            }                    

                                        })
                                    }

                                });

                            } else { 

                                // msg d'erreur si le service existe  //                                 
                                
                                $("#error_service").removeClass('hidden').addClass('display')                                               
                                //recupclassdiv('affInfo', 7000)

                                $("#AddService")[0].reset()
                            }                                                        
                                                
                        }
                          
                    })
                }  
            })
        }); 

        // edition du service //
        
        $(document).on('click', 'button[data-role=EditService]', function(){

            rowtableservice = $(this).closest('tr')
            id = parseInt(rowtableservice.find('td:eq(0)').text())
            service = rowtableservice.find('td:eq(1)').text()

            $('#editservice').modal('show') // ouvre la modal
            $('#service').val(service)
            $('#id_service').val(id) 

        });

        $('#EDITSERVICE').validator().on('submit', function (event){

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault()

                // mise a jour des données édition materiel
                $.ajax({
                    url : '?p=services.editService', 
                    method : 'POST',
                    data : $('#EDITSERVICE').serialize(),
                    success : function(response){

                        $('#editservice').modal('toggle') // ferme la modal                          
                        $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("Le service à bien était modifié !!!")                            
                        $("#EDITSERVICE")[0].reset()

                        TableService.ajax.reload()
                        recupclassdiv('info_user', 7000)
                                                    
                    }

                })
            }

        });

    // BASE_OF_KNOWLEDGE //
    
        if($('.AffKnowledge').is(':visible') == true) {
            $('a.item-BDC').attr('class', 'active');

            load_PanelCategories();
        }

        // function  categories //
        
        function load_PanelCategories() { 

            $('.categories').empty() // efface le li                   

            $.ajax({
                url: '?p=knowledges.PanelCategories',
                method: 'POST',
                success: function(reponse) {                    

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id
                        var categories = reponse[i].categorie
                        var nbr = reponse[i].nbr

                        if (nbr == null) {

                            nbr = 0
                        }                            

                        $(".categories").append('<li><a href="#" data-role="viewknowledge" data-id="'+ id +'">'+ categories +'<span class="label label-theme pull-right inbox-notification">'+ nbr +'</span></a></li></br>') // remplis les données dans le select //

                    }           
                }
            }); 
        }

        // function qui affiche la table suject par sont id category //
        
        function viewTableKnowledge(id) {

            // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableKnowledge')) {

                $('#TableKnowledge').DataTable().destroy()

            }

            $('#idcategory').val(id)                        
            
            $('#TableKnowledge').DataTable({

                language: {url: "../public/media/French.json"},
                scrollY: '30vh',
                scollCollapse: true,
                paging: false,
                ajax: {
                    url:'?p=knowledges.findknowledge',
                    type: "POST",
                    data: {id:id},
                    dataSrc: "",
                    },
                    columns: [                
                        { data: "id" },
                        { data: "sujet" },
                        { data: "probleme" },
                        { render : function(id, type, row) {                            

                            if (typeU == "administrateur") {
                                return `<button class="btn btn-primary btn-xs" data-role="Editsuject"<abbr title="Edition Sujet"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                       `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteSuject" <abbr title="Supprimé le sujet"><span class="glyphicon glyphicon-trash"></span></abbr></button>`
                            } else {
                                return `<button class="btn btn-primary btn-xs"<abbr title="Edition sujet" disabled><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                       `<button type="submit" class="btn btn-danger btn-xs"<abbr title="Supprimé le sujet" disabled><span class="glyphicon glyphicon-trash"></span></abbr></button>`
                            }
                        }}                    
                        
                    ]            

            })
            
        }

        // function qui affiche la resolution du sujet / id sujet //
        
        function AffResolution(id, index) {

            $.post('?p=knowledges.findresolution',

                {id : id}, function(data) {                
                    
                    if (data.length == 0 ) {                         
                        // ont affiche rien
                    } else {

                        if (index == 'edit') {

                            $('#resolution').val(data[0].resolution); 

                        } else {

                            $('#affresolution').html(data[0].resolution); // affiche la resolution 
                            $('input[name=id_resolut]').val(id); // ecris dans input hidden resolut //
                        }                                      
                       
                    }

            });     
        }

        // function qui affiche la base de connaissance en function de la catégorie //
        $(document).on('click','a[data-role=viewknowledge]', function(){

            let id = $(this).data('id') // id category
            let cat = $(this).text()
            let category = cat.slice(0, -1) // supprime le dernier caractére //

            $('.AffKnowledge').removeClass('hidden').addClass('display') // affiche la div
            $('#affpsujet').html('Sujet de la catégorie: ' + category + ' <button class="btn btn-round btn-success" data-role="Addsuject"<abbr title="Ajouter un sujet "><span class="glyphicon  glyphicon-plus"></span></abbr></button>')
            $('.AffResolution').removeClass('display').addClass('hidden') // efface la div

            viewTableKnowledge(id)

        });

        // checked & add catégorie //
        
        $('button[data-role=Addcategories]').click(function() {

            $('#error_cate').removeClass('display').addClass('hidden');
            $('#addcategorie').modal('show'); // ouvre la modal 
            $('.modal-title').html(' Ajout Catégorie');

            $('#cate').change(function(){ 

                $('#error_cate').removeClass('display').addClass('hidden');               

                let cat = $('#cate').val()

                // verifie si catégorie existe déja //
                
                $.ajax({
                    url : '?p=knowledges.checkedCategorie',
                    method : 'POST',
                    data : { cat: cat},
                    dataType: 'json',
                    success : function(data){

                        if (data.length == 0) {  // la categorie n'existe pas 

                            $('#AddCategorie').validator().on('submit',function(event){

                                if (event.isDefaultPrevented()) {

                                } else {
                                
                                    event.preventDefault(); 

                                    $.ajax({
                                        url : '?p=categories.add', 
                                        method : 'POST',
                                        data : {cat:cat},
                                        success : function(data){

                                            $("#info_user")
                                            .removeClass('hidden')
                                            .addClass('alert alert-success success-dismissable col-lg-8')
                                            .html("La catégorie à bien était ajouté !!!");

                                            $('#addcategorie').modal('hide'); // ferme la modal
                                            load_PanelCategories();

                                            recupclassdiv('info_user', 5000);
                                        }                    

                                    });
                                }
                            });

                        } else { // categorie existe //

                            $('#cate').val('');
                            $('#error_cate').removeClass('hidden').addClass('display');
                        }
                        
                    }
                });
            });

        });

        // function qui ouvre une section pour voir la resolution du probléme //
        
        $('#TableKnowledge').on('click', 'tr', function (){

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9' }); // affiche le tr en gris //                          
            
            // recupére l'id sur le tr table knowledge //
            let rowtable = $(this).closest('tr');
            let id = parseInt(rowtable.find('td:eq(0)').text()); // recupére l'id du sujet //

            $('#affresolution').empty();

            if (!isNaN(id)) {
                $('.AffResolution').removeClass('hidden').addClass('display'); 
                AffResolution(id); // affiche la resolution / id knowledge (sujet) //
            }            

        });

        // function qui ajoute un sujet a la catégorie //
        
        $(document).on('click', 'button[data-role=Addsuject]', function(){
            
            $('#Suject').modal('show') // ouvre la modal
            $('.modal-title').html('Ajout du sujet & résolution ')

            $('.AffAreaResolut').removeClass('hidden').addClass('display')
            $('#resolution').attr('required', true) 

            let id_category = $('#idcategory').val() // récupére l'id de la category //
            $('#id_category').val(id_category)

            $('#op').val('add') 
        });

        // function qui edit le suject & probleme //
        
        $(document).on('click', 'button[data-role=Editsuject]', function(){

            rowtable = $(this).closest('tr');
            id = parseInt(rowtable.find('td:eq(0)').text());
            suject = rowtable.find('td:eq(1)').text();
            probleme = rowtable.find('td:eq(2)').text();

            $('#Suject').modal('show'); // ouvre la modal
            $('.modal-title').html('Edition du sujet');

            $('.Affinpsujet').removeClass('hidden').addClass('display');
            $('.AffAreaResolut').removeClass('display').addClass('hidden');

            $('#suject').val(suject);
            $('#probleme').val(probleme);

            $('#id_suject').val(id);
            $('#op').val('edit'); 

        });

        // function qui edit la resolution //
        
        $(document).on('click', 'button[data-role=Editresolut]', function(){
            
            $('#Suject').modal('show'); // ouvre la modal
            $('.modal-title').html('Edition de la résolution du sujet');
            $('.Affinpsujet').removeClass('display').addClass('hidden'); // efface la div
            $('.AffAreaResolut').removeClass('hidden').addClass('display'); // affiche la div

            let id = $('input[name=id_resolut]').val(); // id resolut

            // récupére la resolution et l'affiche dans le texarea //            
            AffResolution(id, 'edit');             
           
            $('#id_suject').val(id); // id resolut //
            $('#op').val('resolutedit'); 

        });

        // function qui ajoute ou edit le sujet ou la résolution //

        $('#SUJECT').validator().on('submit', function (event){

            let op = $('#op').val()
            let id_category = $('#idcategory').val() // id catégorie pour réinit table

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault()

                if (op == 'add') {

                    // add sujet
                    $.ajax({
                        url : '?p=knowledges.addsuject', 
                        method : 'POST',
                        data : $('#SUJECT').serialize(),
                        success : function(response){

                            $('#Suject').modal('toggle') // ferme la modal                          
                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("Le sujet à bien était ajouté !!!")                            
                            $("#SUJECT")[0].reset()

                            viewTableKnowledge(id_category)
                            load_PanelCategories()                            
                            recupclassdiv('info_user', 7000)
                                                        
                        }

                    })

                } else if (op == 'edit'){

                    // mise a jour des données édition sujet
                    $.ajax({
                        url : '?p=knowledges.editsuject', 
                        method : 'POST',
                        data : $('#SUJECT').serialize(),
                        success : function(response){

                            $('#Suject').modal('toggle') // ferme la modal                          
                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("Le sujet à bien était modifié !!!")                            
                            $("#SUJECT")[0].reset()

                            viewTableKnowledge(id_category)                            
                            recupclassdiv('info_user', 7000)
                                                        
                        }

                    })

                } else {

                    let id_suject = $('#id_suject').val()

                    // mise a jour des données édition resolution
                    $.ajax({
                        url : '?p=knowledges.editresolution', 
                        method : 'POST',
                        data : $('#SUJECT').serialize(),
                        success : function(response){

                            $('#Suject').modal('toggle') // ferme la modal                          
                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("La résolution à bien était modifié !!!")                            
                            $("#SUJECT")[0].reset()

                            AffResolution(id_suject, "refresh")                            
                            recupclassdiv('info_user', 7000)
                                                        
                        }

                    })
                }
                
            }

        });

        // DELETE SUJECT //
        
        $(document).on('click', 'button[data-role=deleteSuject]', function() { 

            $('.AffResolution').removeClass('display').addClass('hidden')           

            if (confirm("Etes-vous sûr de vouloir supprimer cet élément ?")) {

                rowtablesuject = $(this).closest('tr')
                id = parseInt(rowtablesuject.find('td:eq(0)').text())
                id_category = $('#idcategory').val() 

                $.ajax(
                {
                    type: "post",
                    url: "?p=knowledges.deletesuject",
                    data: {id:id},
                    cache: false,
                    success: function() {
                        
                        $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-12').html("Le sujet à bien était supprimé !!!")
                        recupclassdiv('info_user', 5000)

                        viewTableKnowledge(id_category)
                        load_PanelCategories()

                   }
                })                
            }
        
        });

    // BILLINGS CAB MEDECINS GCS //
    
        // LIST PRATICE //
        if ($('.AffCabDoctors').is(':visible') == true) {

            $('a.item-FA').attr('class', 'active')
            $('ul.item-fa').attr('style', 'display:block;')
            $('li.item-lcm').attr('class', 'active')            

            // Table interv cab doctors //
            var TableCabDoctors = $('#TableCabDoctors').DataTable({

                language: {url: "../public/media/French.json"},
                scrollY: '50vh',
                scrollX: true,
                scollCollapse: true,
                paging: true,
                ajax: {
                    url:'?p=billings.listcabdoctors',
                    type: "POST",
                    dataSrc: ""
                },                
                columns: [                
                    { data: "id" },
                    { data: "nom_cab" },
                    { data: "telephone" },
                    { data: "email" },
                    { render : function() {

                        if (typeU == "administrateur") {                            

                            return  `<button class="btn btn-primary btn-xs" data-role="editcab"<abbr title="Edition Cabinet Médical"><span class="fa fa-pencil"></span></abbr></button> `+
                                    `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteCab"<abbr title="Supprimé le cabinet Médical"><span class="fa fa-trash-o"></span></abbr></button> `

                        } else if (niveauUser == "2") { 

                            return `<button class="btn btn-primary btn-xs" <abbr title="Edition Cabinet Médical"><span class="fa fa-pencil"></span></abbr></button> `+
                                   `<button type="submit" class="btn btn-danger btn-xs" <abbr title="Supprimé le cabinet Médical" disabled><span class="fa fa-trash-o""></span></abbr></button>`

                        } else { 

                            return `<button class="btn btn-primary btn-xs" <abbr title="Edition Cabinet Médical" disabled><span class="fa fa-pencil"></span></abbr></button> `+
                                   `<button type="submit" class="btn btn-danger btn-xs" <abbr title="Supprimé le cabinet Médical" disabled><span class="fa fa-trash-o""></span></abbr></button>`
                        }                        

                    }}                   
                    
                ]            

            });

            // add & edit cabinets médicaux //
            
            $(document).on('click', 'a[data-role=addcab]', function() {

                $('#cabinet').modal('show') // ouvre la modal
                $('.modal-title').html('Ajout Cabinet Médical')

                $('#op').val('add')

            });

            $(document).on('click', 'button[data-role=editcab]', function() {

                $('#cabinet').modal('show') // ouvre la modal
                $('.modal-title').html('Edition Cabinet Médical')

                rowtable = $(this).closest('tr')
                id = parseInt(rowtable.find('td:eq(0)').text())
                nomcab = rowtable.find('td:eq(1)').text()
                phone = rowtable.find('td:eq(2)').text()
                email = rowtable.find('td:eq(3)').text()

                $('#nomcab').val(nomcab)
                $('#phone').val(phone)
                $('#email').val(email)

                $('#id_cab').val(id)
                $('#op').val('edit') 
                
            });

            // function qui ajoute ou edit le sujet ou la résolution //

            $('#CABINET').validator().on('submit', function (event) {

                let op = $('#op').val() // add ou edit //
                let id_cab = $('#id_cab').val() // id cabinet pour réinit table

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault()

                    if (op == 'add') {

                        // add cabinet
                        $.ajax({
                            url : '?p=billings.addcab', 
                            method : 'POST',
                            data : $('#CABINET').serialize(),
                            success : function(response){

                                $('#cabinet').modal('toggle') // ferme la modal                          
                                $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("Le cabinet médical à bien était ajouté !!!")                            
                                $("#CABINET")[0].reset()

                                TableCabDoctors.ajax.reload()
                                recupclassdiv('info_user', 7000)
                                                            
                            }

                        })

                    } else if (op == 'edit'){

                        // mise a jour des données édition cabinet
                        $.ajax({
                            url : '?p=billings.editcab', 
                            method : 'POST',
                            data : $('#CABINET').serialize(),
                            success : function(response){

                                $('#cabinet').modal('toggle') // ferme la modal                          
                                $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("Le cabinet médical à bien était modifié !!!")                            
                                $("#CABINET")[0].reset()

                                TableCabDoctors.ajax.reload()
                                recupclassdiv('info_user', 7000)
                                                            
                            }

                        })

                    }
                    
                }

            });       
        
            // DELETE CABINET DOCTORS //
        
            $(document).on('click', 'button[data-role=deleteCab]', function() {

                rowtable = $(this).closest('tr');
                id = parseInt(rowtable.find('td:eq(0)').text());            

                if (confirm("Etes-vous sûr de vouloir supprimer cet élément ?")) {

                    $.ajax({
                        url: '?p=billings.checkedIntervCab',
                        data: {id:id},
                        method: 'POST',
                        dataType: 'json',
                        success: function(reponse) {

                            if (reponse.length == 0) {
                                // on efface si le cabinet médecin n'a pas fait de demande d'intervention //
                                $.ajax({
                                    type: "post",
                                    url: "?p=billings.deletecab",
                                    data: {id:id},
                                    cache: false,
                                    success: function() {
                                        
                                        $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-12').html("Le cabinet à bien était supprimé !!!");
                                        recupclassdiv('info_user', 5000);
                                        TableCabDoctors.ajax.reload();

                                   }
                                });

                            } else {

                                // ont ne peut pas effacer 
                                $("#info_user").removeClass('alert alert').addClass('alert alert-danger danger-dismissable').html("Le cabinet médecin ne peut être éffacé !!!");
                                recupclassdiv('info_user', 7000);
                            }
                        }
                    });           
                }

            });
        
        }
        
        // INTERV CAB DOCTORS //
        if($('.AffIntervCabDoctors').is(':visible') == true) {

            $('a.item-FA').attr('class', 'active');
            $('ul.item-fa').attr('style', 'display:block;');
            $('li.item-icm').attr('class', 'active');
        }

        // Table interv cab doctors //
        var TableIntervDoctors = $('#TableIntervDoctors').DataTable({

            language: {url: "../public/media/French.json"},
            scrollY: '60vh',
            scrollX: true,
            scollCollapse: true,
            paging: true,
            ajax: {
                url:'?p=billings.affinterv',
                type: "POST"
            },                
            columns: [                
                { data: "id" },
                { data: "dateintervfr" },
                { data: "num_interv" },
                { data: "nom_cab" },
                { data: "designation" },
                { data: null },
                { render : function(data, type, row) {   // action //                 

                    if (row.nbrline == 0 ) { // pas de ligne a l'intervention //

                        return  `<button class="btn btn-primary btn-xs" data-role="EditIntervCab" data-id="`+ row.idcab +`"<abbr title="Edition Intervention"><span class="fa fa-pencil"></span></abbr></button> `+
                                `<a class="btn btn-default btn-xs disabled"<abbr title="Voir le bon d'intervention">PDF</abbr></a> `+                                                                        
                                `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteIntervCab"<abbr title="Supprimé l'intervention"><span class="fa fa-trash-o"></span></abbr></button> `

                    }  else { // ligne ajouter a l'intervention + validation cab & travaux réaliser //

                        if (typeU == "administrateur") { // user admin //

                            if (row.validate_cab == 1 && row.travaux == 1 && row.idfact == null) { 

                                return  `<button class="btn btn-primary btn-xs" data-role="EditIntervCab" data-id="`+ row.idcab +`"<abbr title="Edition Intervention"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<a class="btn btn-default btn-xs" target="_blank" href="?p=billings.viewinterv&id=` + row.id + `"<abbr title="Voir le bon d'intervention">PDF</abbr></a> `+ 
                                        `<button type="button" class="btn btn-success btn-xs" data-role="geneBilling"<abbr title="Créer Facture"><span class="fa fa-file"></span></abbr></button> `+                                                                           
                                        `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé l'intervention"><span class="fa fa-trash-o"></span></abbr></button> `

                            } else if (row.validate_cab == 1 && row.idfact) {

                                return  `<button class="btn btn-primary btn-xs" data-role="EditIntervCab" data-id="`+ row.idcab +`"<abbr title="Edition Intervention"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<a class="btn btn-default btn-xs" target="_blank" href="?p=billings.viewinterv&id=` + row.id + `"<abbr title="Voir le bon d'intervention">PDF</abbr></a> `+ 
                                        `<a class="btn btn-info btn-xs" target="_blank" href="?p=billings.viewfact&id=` + row.idfact +`"<abbr title="voir Facture"><span class="fa fa-eye"></span></abbr></a> `+                                                                          
                                        `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé l'intervention"><span class="fa fa-trash-o"></span></abbr></button> `
                            } else {

                                return  `<button class="btn btn-primary btn-xs" data-role="EditIntervCab" data-id="`+ row.idcab +`"<abbr title="Edition Intervention"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<a class="btn btn-default btn-xs" target="_blank" href="?p=billings.viewinterv&id=` + row.id + `"<abbr title="Voir le bon d'intervention">PDF</abbr></a> `+                                                                         
                                        `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteIntervCab" <abbr title="Supprimé l'intervention"><span class="fa fa-trash-o"></span></abbr></button> `
                            }

                        } else { // user normal //

                            if (row.validate_cab == 1 && row.travaux == 1 && row.idfact == null) { 

                                return  `<button class="btn btn-primary btn-xs" data-role="EditIntervCab" data-id="`+ row.idcab +`"<abbr title="Edition Intervention"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<a class="btn btn-default btn-xs" target="_blank" href="?p=billings.viewinterv&id=` + row.id + `"<abbr title="Voir le bon d'intervention">PDF</abbr></a> `+ 
                                        `<button type="button" class="btn btn-success btn-xs" data-role="geneBilling"<abbr title="Créer Facture"><span class="fa fa-file"></span></abbr></button> `+                                                                           
                                        `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé l'intervention"><span class="fa fa-trash-o"></span></abbr></button> `

                            } else if (row.validate_cab == 1 && row.idfact) {

                                return  `<button class="btn btn-primary btn-xs" data-role="EditIntervCab" data-id="`+ row.idcab +`"<abbr title="Edition Intervention"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<a class="btn btn-default btn-xs" target="_blank" href="?p=billings.viewinterv&id=` + row.id + `"<abbr title="Voir le bon d'intervention">PDF</abbr></a> `+ 
                                        `<a class="btn btn-info btn-xs" target="_blank" href="?p=billings.viewfact&id=` + row.idfact +`"<abbr title="voir Facture"><span class="fa fa-eye"></span></abbr></a> `+                                                                          
                                        `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé l'intervention"><span class="fa fa-trash-o"></span></abbr></button> `
                            } else {

                                return  `<button class="btn btn-primary btn-xs" data-role="EditIntervCab" data-id="`+ row.idcab +`"<abbr title="Edition Intervention"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<a class="btn btn-default btn-xs" target="_blank" href="?p=billings.viewinterv&id=` + row.id + `"<abbr title="Voir le bon d'intervention">PDF</abbr></a> `+                                                                         
                                        `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé l'intervention"><span class="fa fa-trash-o"></span></abbr></button> `
                            }
                        }
                    } 
                    
                }}                   
                
            ],
            columnDefs: [
                {
                    targets: 5,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {  // Etat intervention cab //                          
                        
                        if (row.etat == 'Attente Lignes') {                            

                            return `
                            <div>
                                <button class="btn-primary btn-round btn-xs" disabled>Attente Lignes</button>                                                                         
                            </div>                            
                            `                                                   
                              
                        } else if (row.etat == 'Attente Validation') {                            

                            return `
                            <div>                                
                                <select class="btn-warning btn-round" data-role="etatIntervCab">
                                    <option selected disabled>Attente Validation cdl</option>
                                    <option value="1">Validation Bon Intervention</option>
                                </select>                                 
                            </div>
                            `                                                   
                              
                        } else if (row.etat == 'Validation') {                            

                            return `
                            <div>
                                <select class="btn-default btn-round" data-role="etatIntervCab">
                                    <option selected disabled>Bon Validé</option>
                                    <option value="2">Attente Validation Cab</option>
                                </select>                                  
                            </div>
                            `                                                  
                              
                        } else if (row.etat == 'Attente Validation Cab') {
                            
                            return `
                            <div>                                
                                <select class="btn-theme btn-round" data-role="etatIntervCab">
                                    <option selected disabled>Attente Validation Cab</option>
                                    <option value="3">Validation Cabinet</option>
                                    <option value="4">Refus Cabinet</option>
                                </select>                                 
                            </div>
                            `
                            
                        } else if (row.etat == 'Validation Cabinet') {
                            
                            return `
                            <div>
                                <div>                                
                                <select class="btn-theme02 btn-round" data-role="etatIntervCab">
                                    <option selected disabled>Validation Cabinet</option>
                                    <option value="5">Travaux Réaliser</option>
                                </select>                                 
                            </div>
                            `
                        } else if (row.etat == 'Travaux Réaliser') {
                            
                            return `
                            <div>
                                <button class="btn-success btn-round btn-xs" disabled>Travaux Réaliser</button>                                 
                            </div>
                            `
                        } else if (row.etat == 'Refus Cabinet') {
                            
                            return `
                            <div>
                                <button class="btn-danger btn-round btn-xs" disabled>Refus Cabinet</button>                                 
                            </div>
                            `       
                        }
                    }
                }

            ]                     

        });        

        // function qui affiche les lignes de l'intervention / id interv //
        function viewLines(id) {

            $('.AffTableLines').removeClass('hidden').addClass('display'); 
            $('#Id_Interv').val(id); // ecris l id interv dans input hidden //

            // reinitialise la table //
            if ($.fn.dataTable.isDataTable('#TableLines')) {

                $('#TableLines').DataTable().destroy();

            }                                    
            
            $('#TableLines').DataTable({

                language: {url: "../public/media/French.json"},
                scrollY: '30vh',
                scrollX: true,
                scollCollapse: true,
                paging: false,
                ajax: {
                    url:'?p=lines.findlines',
                    type: "POST",
                    data: {id:id},
                    dataSrc: ""
                    },
                    columns: [                
                        { data: "id" },
                        { data: "designation" },
                        { data: "quantite" },
                        { data: "ligne_ht",
                            render: function(data, type, row) {
                    
                                if (row.ligne_ht == null) {
                                    return ligne_ht = '0.00 €';
                                } else {

                                    mht = Number(row.ligne_ht);                                
                                    return mht.toFixed(2) +' €';
                                }                            
                            }      
                        },
                        { render : function(id, type, row) {                            

                            if (row.validintd == null) { // si il n'y a pas de validation du bon d'intervention  //

                                return `<button class="btn btn-primary btn-xs" data-role="Editline"<abbr title="Edition ligne"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                       `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteline" <abbr title="Supprimé la ligne"><span class="glyphicon glyphicon-trash"></span></abbr></button>`
                            } else {

                                return `<button class="btn btn-primary btn-xs"<abbr title="Edition Ligne" disabled><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                       `<button type="submit" class="btn btn-danger btn-xs"<abbr title="Supprimé la ligne" disabled><span class="glyphicon glyphicon-trash"></span></abbr></button>`
                            }                                
                            
                        }}                    
                        
                    ]            

            });
        }

        // function select cab_doctors //
        function select_cabDoctors() {
            // affiche le select cab doctors et rempli les champs correspondant //
            $.ajax({
                url: '?p=billings.listcabdoctors',
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#nomcab option').remove();

                    $("#nomcab").append('<option value="0" disabled selected>Choix Cabinet</option>'); // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;
                        var cab = reponse[i].nom_cab;                        

                        $("#nomcab").append('<option value="'+ id +'" >'+ cab +'</option>'); // remplis les données dans le select //

                    }                                               

                }
            });
        }

        // function qui récupére les valeur du select etatIntervCab //
        $(document).on('change', 'select[data-role=etatIntervCab]', function() {

            $('.AffTableLines').removeClass('display').addClass('hidden');

            let rowtableIC = $(this).closest('tr');
            let id = parseInt(rowtableIC.find('td:eq(0)').text()); // récupére l'id de la demande d'intervention //            
            let valslc = $(this).children('option:selected').val();

            $.post('?p=intervcab.etatinterv',

                {id:id, valslc:valslc}, function(data) {

                  TableIntervDoctors.ajax.reload();           

            });

        });

        // si nom cabinet change //
        
        $('#nomcab').change(function(){

            let id = $('#nomcab option:selected').val();

            $.post('?p=billings.affdatacabinet',

                {id : id}, function(data) {                
                    
                    $('#telephone').val(data[0].telephone);
                    $('#email').val(data[0].email);

            });
            
        });            

        // function qui ouvre la table pour voir les lignes de l'intervention //        
        $('#TableIntervDoctors').on('dblclick', 'tr', function () {

            $('tr td').css({ 'background-color' : '#e5e5e5'});// affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9' }); // affiche le tr en gris //                               
            
            // recupére l'id sur le tr table IntervDoctors //
            let rowtable = $(this).closest('tr');
            let id = parseInt(rowtable.find('td:eq(0)').text()); // recupére l'id de l'interv //

            $('.dataTables_scrollBody').css('height','25vh');

            $.post('?p=intervcab.findvalidinterv',

                {id : id}, function(data) {                                   
                    
                    if (data.length == 0 ) {                   
                        
                        // pas de facture édité //
                        $('.AddLines').attr('disabled', false);

                    } else {                   
                       
                       // facture édité //
                       $('.AddLines').attr('disabled', true);
                    }

              });

            viewLines(id);

        });

        // ajout intervention cab //
        
        $(document).on('click', 'button[data-role=addInterv]', function() {

            $('.AffTableLines, .Affcolor, .AffDateInterv').removeClass('display').addClass('hidden');
            $('.dataTables_scrollBody').css('height','60vh');
            $('#intervdoc').modal('show'); // ouvre la modal 

            $('.modal-title').html('Ajouter une Intervention');               
            $('.AffIntervenant').removeClass('hidden').addClass('display');

            $('#contribut').change(function(){

                let val = $('#contribut option:selected').val();
                let deb;

                if (val == 1) {

                    deb = "ST";
                } else {
                    deb = "SI";
                }

                $.post('?p=intervcab.findnumInterv',

                    {deb,deb},function(data) {

                        $('.Affcolor').removeClass('hidden').addClass('display');                
                        
                        if (data.length == 0) {

                            $('.Affnuminterv').html('Numéro Intervention: '+ deb+"001");
                            $('#numinterv').val(deb+"001");    

                        } else { 

                            let i = data.length -1;
                            let numI = data[i].num_interv;

                            // voir si il y a 0 ou 00 avant le nombre //

                            var str = numI.substr(2); // val 001 ou 012 etc
                            var ch = '0'
                            var nbrz = str.split(ch).length - 1; // nbr de zéro

                            if (nbrz == 1) {
                                mi = "0";
                            } else {
                                mi = "00";
                            }

                            var fin = Number(numI.substr(2))+1; // ajoute 1 a la valeur
                            var numInterv = deb+mi+fin;

                            $('.Affnuminterv').html('Numéro Intervention: '+ numInterv);
                            $('input[name=numinterv]').val(numInterv);                          
                            
                        }

                    });
            });
        
            select_cabDoctors();

            $('#op').val('add');

        });

        // edition intervention cab / a  terminé /
        
        $(document).on('click', 'button[data-role=EditIntervCab]', function() {

            rowtable = $(this).closest('tr');
            idInterv = parseInt(rowtable.find('td:eq(0)').text());

            dateI = rowtable.find('td:eq(1)').text();
            // retourne la date //
            var parts = dateI.split(/-/);
            parts.reverse();
            var datereverse = (parts.join('-'));

            numInterv = rowtable.find('td:eq(2)').text();

            $('#intervdoc').modal('show'); // ouvre la modal 
            $('.modal-title').html('Edition Intervention'); 
            $('.AffIntervenant').removeClass('display').addClass('hidden'); 

            $('.Affcolor').removeClass('hidden').addClass('display');
            $('.Affnuminterv').html('Numéro Intervention: '+ numInterv);

            $('.AffDateInterv').removeClass('hidden').addClass('display');
            $('#dateI').val(datereverse);

            $('#contribut').attr('required', false);               

            select_cabDoctors();
            let id = $(this).data('id');

            $('#nomcab option[value="0"]').attr('selected', false);
            $('#nomcab option[value="' + id +'"]').attr('selected', true); 

            $.post('?p=billings.affdatacabinet',

                {id : id}, function(data) {                
                    
                    $('#telephone').val(data[0].telephone);
                    $('#email').val(data[0].email);

            });

            let design = rowtable.find('td:eq(4)').text();
            $('#design').val(design);

            $('#id_interv').val(idInterv);
            $('#numinterv').val(numInterv);
            $('#op').val('edit');

        });            

        // function qui ajoute ou edit l'intervention  //

        $('#INTERVDOC').validator().on('submit', function (event){

            let op = $('#op').val();

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();

                if (op == 'add') {

                    // add demande interv 
                    $.ajax({
                        url : '?p=intervcab.addinterv', 
                        method : 'POST',
                        data : $('#INTERVDOC').serialize(),
                        success : function(response){

                            $('#intervdoc').modal('toggle'); // ferme la modal

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("La demande d'intervention à bien était ajouté !!!");

                            $("#INTERVDOC")[0].reset();

                            TableIntervDoctors.ajax.reload();                           
                            recupclassdiv('info_user', 7000);
                                                        
                        }

                    });

                } else if (op == 'edit'){

                    // mise a jour des données édition demande interv 
                    $.ajax({
                        url : '?p=intervcab.editinterv', 
                        method : 'POST',
                        data : $('#INTERVDOC').serialize(),
                        success : function(response){

                            $('#intervdoc').modal('toggle'); // ferme la modal

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("La demande d'intervention à bien était modifié !!!");

                            $("#INTERVDOC")[0].reset();

                            TableIntervDoctors.ajax.reload();                           
                            recupclassdiv('info_user', 7000);
                                                        
                        }

                    });

                }
                
            }

        });

        // DELETE INTERV CAB //
    
        $(document).on('click', 'button[data-role=deleteIntervCab]', function() {            

            if (confirm("Etes-vous sûr de vouloir supprimer cet élément ?")) {

                rowtable = $(this).closest('tr');
                id = parseInt(rowtable.find('td:eq(0)').text());

                $.ajax(
                {
                    type: "post",
                    url: "?p=intervcab.deleteIntervCab",
                    data: {id:id},
                    cache: false,
                    success: function() {
                        
                        $("#info_user")
                        .removeClass('hidden')
                        .addClass('alert alert-success success-dismissable col-lg-12')
                        .html("L'intervention à bien était supprimé !!!");

                        recupclassdiv('info_user', 5000);

                        TableIntervDoctors.ajax.reload();

                    }
                });                
            }

        });

        // function qui ajoute une ou plusieurs ligne //
        
        $(document).on('click', 'button[data-role=addLines]', function() {

            let id_interv = $('#Id_Interv').val(); // récupére l'id interv cab
            $('#line').modal('show'); // ouvre la modal
            $('.modal-title').html('Ajouter une ligne ');
            $('#ID_interv').val(id_interv); // ecris id intervs dans input hidden
            $('#Op').val('add');

            // transforme la valeur avec une virgule en point //
            $('.Montant').on('click', function() {
                let inp = $(this).attr("name");
                $('#'+inp).on('change', function() {
                    let val = $('#'+inp).val();
                    montant(inp, val);
                });                        
            }); 

        });

        // edition ligne //
        
        $(document).on('click', 'button[data-role=Editline]', function() {

            let rowtable = $(this).closest('tr');
            let id = parseInt(rowtable.find('td:eq(0)').text()); // id line //
            let design = rowtable.find('td:eq(1)').text();
            let q = rowtable.find('td:eq(2)').text();
            let prixht = rowtable.find('td:eq(3)').text();
            let pht = prixht.slice(0, -1); // supprime le caractére euro //

            $('#line').modal('show'); // ouvre la modal
            $('.modal-title').html('Edition ligne ');
            $('#designation').val(design);
            $('#quantite').val(q);
            $('#prix_ht').val(pht);

            $('#id_line').val(id); // ecris id line dans input hidden 
            $('#Op').val('edit');

            // transforme la valeur avec une virgule en point //
            $('.Montant').on('click', function() {
                let inp = $(this).attr("name");
                $('#'+inp).on('change', function() {
                    let val = $('#'+inp).val();
                    montant(inp, val);
                });                        
            });

        }); 

        // ajoute ou edit la ligne //
        $('#LINE').validator().on('submit', function (event){

            let id_interv = $('#Id_Interv').val();
            let op = $('#Op').val();                

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();

                if (op == 'add') {                    

                    // add ligne
                    $.ajax({
                        url : '?p=lines.addline', 
                        method : 'POST',
                        data : $('#LINE').serialize(),
                        success : function(response){

                            $("#info_lines")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("La ligne à bien était ajouté !!!");

                            recupclassdiv('info_lines', 7000);

                            viewLines(id_interv);

                            $('#LINE')[0].reset();

                            TableIntervDoctors.ajax.reload();

                        }

                    });

                } else if (op == 'edit'){

                    // edit ligne
                    $.ajax({
                        url : '?p=lines.editline', 
                        method : 'POST',
                        data : $('#LINE').serialize(),
                        success : function(response){

                            $("#info_lines")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("La ligne à bien était modifié !!!");

                            recupclassdiv('info_lines', 7000);

                            viewLines(id_interv);

                            $('#LINE')[0].reset();

                            $('#line').modal('hide'); // ferme la modal

                        }

                    });
                }
            }

        });

        // delete line //
        $(document).on('click', 'button[data-role=deleteline]', function() {

            if (confirm("Etes-vous sûr de vouloir supprimer cette ligne ?")) {

                var rowtable = $(this).closest('tr');
                var id = parseInt(rowtable.find('td:eq(0)').text());
                var id_interv = $('#Id_Interv').val(); // récupére l'id interv cab

                $.ajax(
                {
                    type: "post",
                    url: "?p=lines.deleteline",
                    data: {id:id, id_interv:id_interv},
                    cache: false,
                    success: function() {
                        
                        $("#info_user")
                        .removeClass('hidden')
                        .addClass('alert alert-success success-dismissable col-lg-12')
                        .html("La ligne à bien était supprimé !!!");

                        recupclassdiv('info_user', 5000);
                        viewLines(id_interv);

                    }
                });                
            }

        });        

        // function qui génére la facture intervention //
        $(document).on('click', 'button[data-role=geneBilling]', function() {

            rowtable = $(this).closest('tr');
            id = parseInt(rowtable.find('td:eq(0)').text()); // id interv

            $.ajax({
                url: '?p=billings.generateBilling',
                data: {id:id}, 
                method: 'POST',
                success: function(reponse) {

                    $("#info_user")
                    .removeClass('hidden')
                    .addClass('alert alert-success success-dismissable col-lg-6')
                    .html("La facture à bien était créer !!!");

                    recupclassdiv('info_user', 3000);

                    TableIntervDoctors.ajax.reload();                                                            
                                        
                }
                    
            });  

        });        

        // BILLINGS CAB DOCTORS //
        if ($('.AffBillingsCabDoctors').is(':visible') == true) {

            $('a.item-FA').attr('class', 'active');
            $('ul.item-fa').attr('style', 'display:block;');
            $('li.item-fam').attr('class', 'active'); 

            // Table interv cab doctors //
            var TableBillings = $('#TableBillings').DataTable({

                language: {url: "../public/media/French.json"},
                scrollY: '50vh',
                scrollX: true,
                scollCollapse: true,
                paging: true,
                ajax: {
                    url:'?p=billings.allbillings',
                    type: "POST",
                    dataSrc: ""
                },                
                columns: [                
                    { data: "id" },
                    { data: "num_fact" },
                    { data: "date_fafr" },
                    { data: "nom_cab" },
                    { data: "montantTTC",

                        render: function(data, type, row) {
                        
                            if (row.montantTTC == null) {
                                return mfactTTC = '0.00 €';
                            } else {

                                mfactTTC = Number(row.montantTTC);                                
                                return mfactTTC.toFixed(2) +' €';
                            }                            
                        }

                    },
                    { data: null},
                    { render: function(data, type, row) {

                        if (typeU == "administrateur" || niveauUser == "2") {                            

                            return  `<button class="btn btn-primary btn-xs" data-role="EditFactCab"<abbr title="Edition Facture"><span class="fa fa-pencil"></span></abbr></button> `+
                                    `<a class="btn btn-default btn-xs" target="_blank" href="?p=billings.viewfact&id=` + row.id + `"<abbr title="Voir la facture ">PDF</abbr></a> `+ 
                                    `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteBilling"<abbr title="Supprimé la Facture"><span class="fa fa-trash-o"></span></abbr></button> `                           

                        } else { 

                            return  `<button class="btn btn-primary btn-xs" <abbr title="Edition Facture" disabled><span class="fa fa-pencil"></span></abbr></button> `+
                                    `<a class="btn btn-default btn-xs" target="_blank" href="?p=billings.viewfact&id=` + row.id + `"<abbr title="Voir la facture ">PDF</abbr></a> `+ 
                                    `<button type="submit" class="btn btn-danger btn-xs" <abbr title="Supprimé la facture" disabled><span class="fa fa-trash-o""></span></abbr></button>`
                        }                        

                    }}
                    
                ],
                columnDefs: [
                    {
                        targets: 5,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {  // Etat Facturation cab //

                            if (row.etat == 'A Facturer') {                            

                                return `
                                <div>                                
                                    <select class="btn-warning btn-round" data-role="etatFactCab">
                                        <option selected disabled>`+ row.etat +`</option>
                                        <option value="1">Facturer</option>
                                    </select>                                 
                                </div>
                                `                                 
                            } else {

                                return `
                                <div>
                                    <button class="btn-success btn-round btn-xs" disabled>`+ row.etat +`</button>                                                                         
                                </div>                            
                                `     
                            }
                        }
                    }
                ]          

            });

            // Edition BILLING CAB //
            $(document).on('click', 'button[data-role=EditFactCab]', function() {
                rowtable = $(this).closest('tr');
                id = parseInt(rowtable.find('td:eq(0)').text());
                numfact = rowtable.find('td:eq(1)').text();
                datefact = rowtable.find('td:eq(2)').text();
                cab = rowtable.find('td:eq(3)').text();
                montantTTC = rowtable.find('td:eq(4)').text();

                $('#editbilling').modal('show'); // ouvre la modal

                // retourne la date //
                var parts = datefact.split(/-/);
                parts.reverse();
                var datereverse = (parts.join('-'));
                $('#dateF').val(datereverse);

                $('#numfac').val(numfact);
                $('#nomcab').val(cab);
                $('#montant').val(montantTTC);

                $('#id_fact').val(id);

            });

            // edition facture //
            $('#EDITBILLING').validator().on('submit', function (event){

                let id_fact = $('#id_fact').val();                

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();                        

                    // edit ligne
                    $.ajax({
                        url : '?p=billings.editbilling', 
                        method : 'POST',
                        data : $('#EDITBILLING').serialize(),
                        success : function(response){

                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-6')
                            .html("La facture à bien était modifié !!!");

                            recupclassdiv('info_user', 7000);
                            TableBillings.ajax.reload();
                            $('#EDITBILLING')[0].reset();
                            $('#editbilling').modal('hide'); // ferme la modal

                        }

                    });
                }               

            });

            // function qui récupére les valeur du select etatFactuationCab //
            $(document).on('change', 'select[data-role=etatFactCab]', function() {

                let rowtable = $(this).closest('tr');
                let id = parseInt(rowtable.find('td:eq(0)').text()); // récupére l'id de la facture //
                let textslc = $(this).children('option:selected').text();

                $.post('?p=billings.etatfact',

                    {id:id, textslc:textslc}, function(data) {

                      TableBillings.ajax.reload();           

                });

            });

            // DELETE BILLING CAB //
        
            $(document).on('click', 'button[data-role=deleteBilling]', function() {            

                if (confirm("Etes-vous sûr de vouloir supprimer cet élément ?")) {

                    rowtable = $(this).closest('tr');
                    id = parseInt(rowtable.find('td:eq(0)').text());

                    $.ajax(
                    {
                        type: "post",
                        url: "?p=billings.deleteBilling",
                        data: {id:id},
                        cache: false,
                        success: function() {
                            
                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-12')
                            .html("La facture à bien était supprimé !!!");

                            recupclassdiv('info_user', 5000);

                            TableBillings.ajax.reload();

                       }
                    });                
                }

            });

        }

    // METER_READINDG //
        
        // compteurs Clinique //
        
        if ($('.AffMeterReading').is(':visible') == true) {

            $('a.item-RC').attr('class', 'active');
            $('ul.item-rc').attr('style', 'display:block;');
            $('li.item-rcc').attr('class', 'active');

            if (typeU == "administrateur") {
                let btn = $('<button class="btn btn-round btn-success pull-left" data-toggle="modal" data-role="addmeter"<abbr title="Ajouter des relevés"><span class="glyphicon  glyphicon-plus"></span></abbr></button>'); 
                btn.appendTo($("p[id=btn_MeterReading]"));
            }                       

            // Table relevés de compteurs clinique //
            var TableMeterReading = $('#TableMeterReading').DataTable({

                language: {url: "../public/media/French.json"},
                scrollY: '50vh',
                scrollX: true,
                scollCollapse: true,
                paging: true,
                order: [[0, "desc"]],
                ajax: {
                    url:'?p=meterreading.allmeterreading',
                    type: "POST",
                    dataSrc: ""
                },
                columnDefs: [
                    {
                        targets:[2],
                        searchable: false
                    },
                    {                        
                        targets:[4,7,10,13,16,19,22],
                        visible: false,
                        searchable: false
                    }                   
                ],                 
                columns: [                
                    { data: "id" },
                    { data: "datefr" },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: green">' + row.eau + '</span>';
                        }
                    },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: red">' + row.conso_eau + '</span>';
                        }
                    },
                    { data: "rst_eau" },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: green">' + row.gaz + '</span>';
                        }
                    },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: red">' + row.conso_gaz + '</span>';
                        }
                    },
                    { data: "rst_gaz" },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: green">' + row.elec_scan + '</span>';
                        }
                    },
                    { data: null, 
                        render: function(data, type, row) {

                            return '<span style="color: red">' + row.conso_scan + '</span>';
                        }
                    },
                    { data: "rst_scan" },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: green">' + row.elec_irm + '</span>';
                        }
                    },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: red">' + row.conso_irm + '</span>';
                        }
                    },
                    { data: "rst_irm" },                    
                    { data: null,
                        render: function(data, type, row) {
                            return '<span style="color: green">' + row.elec_radio + '</span>';
                        }
                    },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: red">' + row.conso_radio + '</span>';
                        }
                    },
                    { data: "rst_radio" },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: green">' + row.eau_radio + '</span>';
                        }
                    },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: red">' + row.conso_eauradio + '</span>';
                        }
                    },
                    { data: "rst_eauradio" },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: green">' + row.eau_apf + '</span>';
                        }
                    },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: red">' + row.conso_apf + '</span>';
                        }
                    },
                    { data: "rst_apf" },                          
                    { render : function() {

                        if (typeU == "administrateur") {                            

                            return  `<button class="btn btn-primary btn-xs" data-role="editmeter"<abbr title="Edition relevé"><span class="fa fa-pencil"></span></abbr></button> `+
                                    `<button type="submit" class="btn btn-danger btn-xs" data-role="deletemeter"<abbr title="Supprimé le relevé"><span class="fa fa-trash-o"></span></abbr></button> `                           

                        } else { 

                            return `<button class="btn btn-primary btn-xs" <abbr title="Edition relevé" disabled><span class="fa fa-pencil"></span></abbr></button>`+
                                   `<button type="submit" class="btn btn-danger btn-xs" <abbr title="Supprimé le relevé" disabled><span class="fa fa-trash-o""></span></abbr></button>`
                        }                        

                    }}                   
                    
                ]                          

            });
            
            // function qui récupére la derniére valeur relevé //
            
            function dataMeterReading(col, page){

                $.post('?p=meterreading.findlastnonzeroelement',

                {col:col, page:page}, function(data) {

                    if (col == 'eau') {
                        var inp = "last_eau";
                        if (data.length == 0) {
                            val = "0";
                        } else {
                            var val = data[0].eau;    
                        }

                    }

                    if (col == 'gaz') {
                        var inp = "last_gaz";
                        if (data.length == 0) {
                            val = "0";
                        } else {
                            var val = data[0].gaz;    
                        }
                    }

                    if (col == 'elec_scan') {
                        var inp = "last_scan";
                        if (data.length == 0) {
                            val = "0";
                        } else {
                            var val = data[0].elec_scan;    
                        }
                    }

                    if (col == 'elec_irm') {
                        var inp = "last_irm";
                        if (data.length == 0) {
                            val = "0";
                        } else {
                            var val = data[0].elec_irm;    
                        }
                    }
                        
                    if (col == 'elec_radio') {
                        var inp = "last_radio";
                        if (data.length == 0) {
                            val = "0";
                        } else {
                            var val = data[0].elec_radio;    
                        }
                    } 

                    if (col == 'eau_radio') {
                        var inp = "last_eauR";
                        if (data.length == 0) {
                            val = "0";
                        } else {
                            var val = data[0].eau_radio;    
                        }
                    }

                    if (col == 'eau_apf') {
                        var inp = "last_eauA";
                        if (data.length == 0) {
                            val = "0";
                        } else {
                            var val = data[0].eau_apf;    
                        }
                    }                                         
                    
                    $("#"+inp).val(val);

                }); 
            } 

            
            // ajouter des données relevés compteurs Clinique / radio / scan / irm / apf //
            
            $(document).on('click', 'button[data-role=addmeter]', function() {

                $('.Reset').prop('readonly', true);
                $('#MeterReading').modal('show'); // ouvre la modal
                $('.modal-title').html('Ajout relevés de compteurs Clinique');

                $('.AffRstCounter').show(); // affiche la class //
                $('.AffConso').removeClass('display').addClass('hidden'); // efface les conso //

                var tab = Array("eau", "gaz", "elec_scan", "elec_irm", "elec_radio", "eau_radio", "eau_apf");
                var page = "clin";

                for (var i = 0; i < tab.length; i++) {
                    dataMeterReading(tab[i], page);
                }

                // EAU GENERALE //
                $('#eau').on('focusout', function(){
                    var inp2 = $('#eau').val(); // récupére la valeur de l'input // 
                    var lasteau = $('#last_eau').val(); // récupére la derniére valeur compteur                   
                    
                    if (inp2 == 0) {
                        $('#conso_eau').val("0");
                    } else {

                        if (Number(inp2) >= Number(lasteau)) {  // si eau et sup au dernier relevé //
                            var conso = inp2-lasteau; // ont calcul la conso
                            $('.AffConsoEau').removeClass('hidden').addClass('display'); // affiche l'input //
                            $('#conso_eau').val(conso); // ont ecris la conso dans input //
                        } else { //sinon                            
                            alert('le nombre ne peut pas être inférieur au dernier relevé !!!');
                            $('#eau').val(""); // ont efface input conso //
                        } 
                    }
                }); 

                let lasteau = [];                

                $('input[name=rst_eau]').on('click', function() {

                    $('#conso_eau').val('');                     

                    lasteau.push($('#last_eau').val());

                    if ($('input[name=rst_eau]').is(':checked') == true) { // si checkbox rst_eau et coché 

                        $('#last_eau').val("0");
                        
                    } 

                    if ($('input[name=rst_eau]').is(':checked') == false) { // si checkbox rst_eau et décoché

                        $('#last_eau').val(lasteau[0]);
                    }                  
                });

                // FIN EAU GENERALE //

                // GAZ //
                $('#gaz').on('focusout', function(){
                    var inp2 = $('#gaz').val(); // récupére la valeur de l'input //
                    var lastgaz = $('#last_gaz').val(); // récupére la derniére valeur compteur

                    if (inp2 == 0) {
                        $('#conso_gaz').val("0");
                    } else {

                        if (Number(inp2) >= Number(lastgaz)) {
                            var conso = inp2-lastgaz;
                            $('.AffConsoGaz').removeClass('hidden').addClass('display'); // affiche l'input //
                            $('#conso_gaz').val(conso);
                        } else {
                            alert('le nombre ne peut pas être inférieur au dernier relevé !!!');
                            $('#gaz').val(""); // ont efface input conso //
                        }
                    }
                });

                let lastgaz = [];

                $('input[name=rst_gaz]').on('click', function() {

                    $('#conso_gaz').val(''); 

                    lastgaz.push($('#last_gaz').val());
                    
                    if ($('input[name=rst_gaz]').is(':checked') == true) { // si checbox rst_gaz et coché 

                        $('#last_gaz').val("0");                        
                    }

                    if ($('input[name=rst_gaz]').is(':checked') == false) {

                        $('#last_gaz').val(lastgaz[0]);
                    }                      
                });

                // FIN GAZ //

                // ELEC SCANNER //
                $('#scan').on('focusout', function(){
                    var inp2 = $('#scan').val(); // récupére la valeur de l'input //
                    var lastscan = $('#last_scan').val(); // récupére la derniére valeur compteur
                    
                    if (inp2 == 0) {
                        $('#conso_scan').val("0");
                    } else {

                        if (Number(inp2) >= Number(lastscan)) {
                            var conso = inp2-lastscan;
                            $('.AffConsoScan').removeClass('hidden').addClass('display'); // affiche l'input //
                            $('#conso_scan').val(conso); 
                        } else {
                            alert('le nombre ne peut pas être inférieur au dernier relevé !!!');
                            $('#scan').val(""); // ont efface input conso //
                        }
                    }                    
                });

                let lastscan = [];

                $('input[name=rst_scan]').on('click', function() {

                    $('#conso_scan').val(''); 

                    lastscan.push($('#last_scan').val());
                    
                    if ($('input[name=rst_scan]').is(':checked') == true) { // si checbox rst_scan et coché 

                        $('#last_scan').val("0");                        
                    }

                    if ($('input[name=rst_scan]').is(':checked') == false) {

                        $('#last_scan').val(lastscan[0]);
                    }                      
                });

                // FIN SCANNER // 

                // ELEC IRM //
                $('#irm').on('focusout', function(){
                    var inp2 = $('#irm').val(); // récupére la valeur de l'input //
                    var lastirm = $('#last_irm').val(); // récupére la derniére valeur compteur

                    if (inp2 == 0) {
                        $('#conso_irm').val("0");
                    } else {

                        if (Number(inp2) >= Number(lastirm)) {
                            var conso = inp2-lastirm;
                            $('.AffConsoIrm').removeClass('hidden').addClass('display'); // affiche l'input //
                            $('#conso_irm').val(conso);
                        } else {
                            alert('le nombre ne peut pas être inférieur au dernier relevé !!!');
                            $('#irm').val(""); // ont efface input conso //
                        }
                    }
                });

                let lastirm = [];

                $('input[name=rst_irm]').on('click', function() {

                    $('#conso_irm').val(''); 

                    lastirm.push($('#last_irm').val());
                    
                    if ($('input[name=rst_irm]').is(':checked') == true) { // si checbox rst_irm et coché 

                        $('#last_irm').val("0");                        
                    }

                    if ($('input[name=rst_irm]').is(':checked') == false) {

                        $('#last_irm').val(lastirm[0]);
                    }                      
                });

                // FIN IRM //

                // ELEC RADIO //
                $('#radio').on('focusout', function(){
                    var inp2 = $('#radio').val(); // récupére la valeur de l'input //
                    var lastradio = $('#last_radio').val(); // récupére la derniére valeur compteur

                    if (inp2 == 0) {
                        $('#conso_radio').val("0");
                    } else {

                        if (Number(inp2) >= Number(lastradio)) {
                            var conso = inp2 - lastradio;
                            $('.AffConsoRadio').removeClass('hidden').addClass('display'); // affiche l'input //
                            $('#conso_radio').val(conso);
                        } else {
                            alert('le nombre ne peut pas être inférieur au dernier relevé !!!');
                            $('#radio').val(""); // ont efface input conso //
                        }
                    }

                });

                let lastradio = [];

                $('input[name=rst_radio]').on('click', function() {

                    $('#conso_radio').val(''); 

                    lastradio.push($('#last_radio').val());
                    
                    if ($('input[name=rst_radio]').is(':checked') == true) { // si checbox rst_radio et coché 

                        $('#last_radio').val("0");                        
                    }

                    if ($('input[name=rst_radio]').is(':checked') == false) {

                        $('#last_radio').val(lastradio[0]);
                    }                      
                });

                // FIN ELEC RADIO //

                // EAU Radio//
                $('#eauR').on('focusout', function(){
                    var inp2 = $('#eauR').val(); // récupére la valeur de l'input //
                    var lasteauR = $('#last_eauR').val(); // récupére la derniére valeur compteur

                    if (inp2 == 0) {
                        $('#conso_eauR').val("0");
                    } else {

                        if (Number(inp2) >= Number(lasteauR)) {
                            var conso = inp2-lasteauR;
                            $('.AffConsoEauR').removeClass('hidden').addClass('display'); // affiche l'input //
                            $('#conso_eauR').val(conso); 
                        } else {
                            alert('le nombre ne peut pas être inférieur au dernier relevé !!!');
                            $('#eauR').val(""); // ont efface input conso //

                        } 
                    }                   
                                       
                });

                let lasteauR = [];

                $('input[name=rst_eauR]').on('click', function() {

                    $('#conso_eauR').val(''); 

                    lasteauR.push($('#last_eauR').val());
                    
                    if ($('input[name=rst_eauR]').is(':checked') == true) { // si checbox rst_eauR et coché 

                        $('#last_eauR').val("0");                        
                    }

                    if ($('input[name=rst_eauR]').is(':checked') == false) {

                        $('#last_eauR').val(lasteauR[0]);
                    }                      
                });

                // FIN EAU RADIO //

                // EAU APF//
                $('#eauA').on('focusout', function(){
                    var inp2 = $('#eauA').val(); // récupére la valeur de l'input //
                    var lasteauA = $('#last_eauA').val(); // récupére la derniére valeur compteur

                    if (inp2 == 0) {
                        $('#conso_eauA').val("0");
                    } else {

                        if (Number(inp2) >= Number(lasteauA)) { 
                            var conso = inp2-lasteauA;
                            $('.AffConsoEauA').removeClass('hidden').addClass('display'); // affiche l'input //
                            $('#conso_eauA').val(conso); 
                        } else {
                            alert('le nombre ne peut pas être inférieur au dernier relevé !!!');
                            $('#eauA').val(""); // ont efface input conso //
                        } 
                    }                   
                                       
                });

                let lasteauA = [];

                $('input[name=rst_eauA]').on('click', function() {

                    $('#conso_eauA').val(''); 

                    lasteauA.push($('#last_eauA').val());
                    
                    if ($('input[name=rst_eauA]').is(':checked') == true) { // si checbox rst_eauA et coché 

                        $('#last_eauA').val("0");                        
                    }

                    if ($('input[name=rst_eauA]').is(':checked') == false) {

                        $('#last_eauA').val(lasteauA[0]);
                    }                      
                });

                // FIN EAU APF //

                $('#op').val('add');

            });            

            // editer des données relevés compteurs Clinique / radio / scan / irm //

            $(document).on('click', 'button[data-role=editmeter]', function() {

                $('#MeterReading').modal('show'); // ouvre la modal
                $('.modal-title').html('Edition relevés de compteurs');

                $('.AffConsoEau, .AffConsoGaz, .AffConsoScan, .AffConsoIrm, .AffConsoRadio, .AffConsoEauR, .AffConsoEauA').show(); // affiche //
                $('.AffRstCounter').hide(); // efface la class //

                $('.Reset').prop('readonly', true);

                rowtable = $(this).closest('tr');
                id = parseInt(rowtable.find('td:eq(0)').text());
                date_meter = rowtable.find('td:eq(1)').text();

                // retourne la date //
                var parts = date_meter.split(/-/);
                parts.reverse();
                var datereverse = (parts.join('-'));
                $("#date").val(datereverse); // affiche la date enregistrer

                // Eau GENERAL //
                let eau = rowtable.find('td:eq(2)').text(); // récupére le compteur eau
                $('#eau').val(eau); // ecris dans input //
                var c_eau = rowtable.find('td:eq(3)').text(); // récupére la conso eau //
                $('#conso_eau').val(c_eau); // ecris dans input //
                if (c_eau == "0") {                    
                    $('#last_eau').val('0');
                }

                // GAZ //
                let gaz = rowtable.find('td:eq(4)').text();
                $('#gaz').val(gaz);
                let c_gaz = rowtable.find('td:eq(5)').text();
                $('#conso_gaz').val(c_gaz);
                if(c_gaz == "0") {
                    $('#last_gaz').val('0');
                }

                // ELEC Scanner //
                let scan = rowtable.find('td:eq(6)').text(); // valeur du relevé scan
                $('#scan').val(scan);
                let c_scan = rowtable.find('td:eq(7)').text(); // conso scan
                $('#conso_scan').val(c_scan);
                if(c_scan == "0") {
                    $('#last_scan').val('0');
                }

                // ELEC IRM //
                let irm = rowtable.find('td:eq(8)').text();
                $('#irm').val(irm);
                let c_irm = rowtable.find('td:eq(9)').text();
                $('#conso_irm').val(c_irm);
                if(c_irm == "0") {
                    $('#last_irm').val('0');
                }

                // ELEC RADIO //
                let radio = rowtable.find('td:eq(10)').text();
                $('#radio').val(radio);
                let c_radio = rowtable.find('td:eq(11)').text();
                $('#conso_radio').val(c_radio);
                if(c_radio == "0") {
                    $('#last_radio').val('0');
                } 

                // Eau RADIO //
                let eauR = rowtable.find('td:eq(12)').text(); // récupére le compteur eau radio
                $('#eauR').val(eauR); // ecris dans input //
                var c_eauR = rowtable.find('td:eq(13)').text(); // récupére la conso eau radio //
                $('#conso_eauR').val(c_eauR); // ecris dans input //
                if (c_eauR == "0") {
                    $('#last_eauR').val('0');
                }

                // Eau APF //
                let eauA = rowtable.find('td:eq(14)').text(); // récupére le compteur eau apf
                $('#eauA').val(eauA); // ecris dans input //
                var c_eauA = rowtable.find('td:eq(15)').text(); // récupére la conso eau apf //
                $('#conso_eauA').val(c_eauA); // ecris dans input //
                if (c_eauA == "0") {
                    $('#last_eauA').val('0');
                }                     
                    
                // sinon ont récupére les derniére valeur en lui passant l'id de la ligne selectionner //                    
                $.ajax({
                    url: '?p=meterreading.findpreviousmeter',
                    data: {id:id},
                    method: 'POST',
                    dataType: 'json',
                    success: function(reponse) {

                        if (reponse.length == 0) {

                        } else {

                            // EAU GENERAL //
                            var last_eau = reponse[0].eau; // dernier relevé eau
                            var rst  = TableMeterReading.row(rowtable).data()['rst_eau']; // récupére rst_eau

                            if (rst === 1) {
                                $('#last_eau').val("0 - Reset compteur");
                                last_eau = "0";                            
                            } else {
                                $('#last_eau').val(last_eau); //ecris la valeur de la derniere valeur
                            }                            

                            // si eau change recalculer la conso //
                            $('#eau').on('change', function() { 

                                var inp2 = $('#eau').val(); // récupére la valeur de l'input modifié//

                                if (Number(inp2) < Number(last_eau)) {

                                    alert('le nombre ne peut pas être inférieur au dernier relevé !!!');
                                } 
                                    
                                if (inp2) {       
                                    var conso = inp2 - last_eau;
                                    $('#conso_eau').val(conso);                                                           
                                } else {
                                    $('#conso_eau').val("0");
                                }
                                
                            });

                            $('#last_eau').on('change', function() {

                                let lasteau = $('#last_eau').val();
                                let r_eau = $('#eau').val();

                                let conso = r_eau - lasteau;
                                $('#conso_eau').val(conso);

                            });

                            // FIN EAU GENERAL //
                            
                            // GAZ  //
                            var last_gaz = reponse[0].gaz;
                            var rst  = TableMeterReading.row(rowtable).data()['rst_gaz']; // récupére rst_gaz

                            if (rst === 1) {
                                $('#last_gaz').val("0 - Reset compteur");
                                last_gaz = "0";                            
                            } else {
                                $('#last_gaz').val(last_gaz); //ecris la valeur de la derniere valeur
                            }                            

                            $('#gaz').on('change', function() {
                                // si la valeur de gaz change //
                                var inp2 = $('#gaz').val(); // récupére la valeur de l'input modifié//

                                if (Number(inp2) < Number(last_gaz)) {
                                    alert('le nombre ne peut pas être inférieur au dernier relevé!!!');
                                } 

                                if (inp2) {
                                    var conso = inp2 - last_gaz;
                                    $('#conso_gaz').val(conso);                       
                                } else {
                                    $('#conso_gaz').val("0");    
                                }    
                                
                            });

                            $('#last_gaz').on('change', function() {

                                let lastgaz = $('#last_gaz').val();
                                let r_gaz = $('#gaz').val();

                                let conso = r_gaz - lastgaz;
                                $('#conso_gaz').val(conso);

                            });

                            // FIN GAZ //
                            
                            // ELEC SCANNER //
                            var last_scan = reponse[0].elec_scan;
                            var rst  = TableMeterReading.row(rowtable).data()['rst_scan']; // récupére rst_scan

                            if (rst === 1) {
                                $('#last_scan').val("0 - Reset compteur");
                                last_eau = "0";                            
                            } else {
                                $('#last_scan').val(last_scan); //ecris la valeur de la derniere valeur
                            }         

                            $('#scan').on('change', function() {
                                // si la valeur de scan change //
                                var inp2 = $('#scan').val(); // récupére la valeur de l'input //
                                
                                if (Number(inp2) < Number(last_scan)) {
                                    alert('le nombre ne peut pas être inférieur au dernier relevé!!!');
                                }

                                if (inp2) {                        
                                    var conso = inp2 - last_scan;
                                    $('#conso_scan').val(conso);                                    
                                } else {
                                    $('#conso_scan').val("0");
                                } 

                            });

                            // FIN SCANNER //
                            
                            // ELEC IRM //
                            var last_irm = reponse[0].elec_irm;
                            var rst  = TableMeterReading.row(rowtable).data()['rst_irm']; // récupére rst_irm

                            if (rst === 1) {
                                $('#last_irm').val("0 - Reset compteur");
                                last_irm = "0";                            
                            } else {
                                $('#last_irm').val(last_irm); //ecris la valeur de la derniere valeur
                            }         

                            $('#irm').on('change', function() {
                                // si la valeur de irm change //
                                var inp2 = $('#irm').val(); // récupére la valeur de l'input //
                                var c_irm = $('#conso_irm').val(); // récupére la valeur de l'input conso irm //

                                if (Number(inp2) < Number(last_irm)) {
                                    alert('le nombre ne peut pas être inférieur au dernier relevé!!!');
                                }

                                if (inp2) { 
                                    var conso = inp2-last_irm;
                                    $('#conso_irm').val(conso);    
                                } else {
                                    $('#conso_irm').val("0");
                                }                     
                                 
                            });
                            // FIN IRM //
                            
                            // ELEC RADIO //
                            var last_radio = reponse[0].elec_radio;
                            var rst  = TableMeterReading.row(rowtable).data()['rst_radio']; // récupére rst_radio

                            if (rst === 1) {
                                $('#last_radio').val("0 - Reset compteur");
                                last_radio = "0";                            
                            } else {
                                $('#last_radio').val(last_radio); //ecris la valeur de la derniere valeur
                            }         

                            $('#radio').on('change', function() {
                                // si la valeur de radio change //
                                var inp2 = $('#radio').val(); // récupére la valeur de l'input //

                                if (Number(inp2) < Number(last_radio)) {
                                    alert('le nombre ne peut pas être inférieur au dernier relevé!!!');
                                } 

                                if (inp2) {                        
                                    var conso = inp2 - last_radio;
                                    $('#conso_radio').val(conso);    
                                } else {
                                     $('#conso_radio').val("0");
                                }

                            });

                            // si last elec radio change recalculer la conso //
                            $('#last_radio').on('change', function() {

                                radio = $('#radio').val();
                                last_radio = $('#last_radio').val(); // récupére la valeur //

                                if (Number(last_radio) < 0) {
                                    alert('le nombre ne peut pas être inférieur au relevé!!!');
                                    $('#conso_radio').val('0');
                                } else {
                                    var conso = radio - last_radio;
                                    $('#conso_radio').val(conso);
                                }

                            });
                            // FIN ELEC RADIO //
                            
                            // EAU RADIO //
                            var last_eauR = reponse[0].eau_radio; // dernier relevé eau base //
                            var rst  = TableMeterReading.row(rowtable).data()['rst_eauradio']; // récupére rst_eauradio

                            if (rst === 1) {
                                $('#last_eauR').val("0 - Reset compteur");
                                last_eauR = "0";                            
                            } else {
                                $('#last_eauR').val(last_eauR); //ecris la valeur de la derniere valeur
                            }                                                       

                            // si eau change recalculer la conso //
                            $('#eauR').on('change', function() {
                                
                                var inp2 = $('#eauR').val(); // récupére la valeur de l'input modifié//

                                if (Number(inp2) < Number(last_eauR)) {
                                    alert('le nombre ne peut pas être inférieur au dernier relevé!!!');
                                }

                                if (inp2) {                        
                                    var conso = inp2 - last_eauR;
                                    $('#conso_eauR').val(conso);    
                                } else {
                                    $('#conso_eauR').val('0');
                                } 

                            });

                            // si last eau radio change recalculer la conso //
                            $('#last_eauR').on('change', function() {

                                eauR = $('#eauR').val();
                                last_eauR = $('#last_eauR').val(); // récupére la valeur //

                                if (Number(last_eauR) < 0) {
                                    alert('le nombre ne peut pas être inférieur au relevé!!!');
                                    $('#conso_eauR').val('0');
                                } else {
                                    var conso = eauR - last_eauR;
                                    $('#conso_eauR').val(conso);
                                }

                            });

                            // FIN EAU Radio //
                             
                            // EAU APF //
                            var last_eauA = reponse[0].eau_apf; // dernier relevé eau
                            var rst  = TableMeterReading.row(rowtable).data()['rst_apf']; // récupére rst_apf

                            if (rst === 1) {
                                $('#last_eauA').val("0 - Reset compteur");
                                last_eauA = "0";                            
                            } else {
                                $('#last_eauA').val(last_eauA); //ecris la valeur de la derniere valeur
                            }

                            // si eau change recalculer la conso //
                            $('#eauA').on('change', function() {
                                
                                var inp2 = $('#eauA').val(); // récupére la valeur de l'input modifié//

                                if (Number(inp2) < Number(last_eauA)) {
                                    alert('le nombre ne peut pas être inférieur au dernier relevé!!!');
                                } 

                                if (inp2) {                        
                                    var conso = inp2 - last_eauA;
                                    $('#conso_eauA').val(conso);
                                    
                                } else {
                                    $('#conso_eauA').val("0"); 
                                }

                            });

                            // si last eau APF change recalculer la conso //
                            $('#last_eauA').on('change', function() {

                                eauA = $('#eauA').val();
                                last_eauA = $('#last_eauA').val(); // récupére la valeur //

                                if (Number(last_eauA) < 0) {
                                    alert('le nombre ne peut pas être inférieur au relevé!!!');
                                    $('#conso_eauA').val('0');
                                } else {
                                    var conso = eauA - last_eauA;
                                    $('#conso_eauA').val(conso);
                                }

                            });

                            // FIN EAU APF // 

                        }           
                    }
                      
                });              
                
                ////////////////////////////////////////
                $('#id_meter').val(id);
                $('#op').val('edit');

            });

            // function qui ajoute ou edit les données compteurs  & envoi un email a la compta //

            $('#METERREADING').validator().on('submit', function (event){

                let op = $('#op').val();
                let idmeter = $('#id_meter').val();

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();

                    if (op == 'add') {

                        // add sujet
                        $.ajax({
                            url : '?p=meterreading.addmeter', 
                            method : 'POST',
                            data : $('#METERREADING').serialize(),
                            success : function(response){

                                $('#MeterReading').modal('toggle'); // ferme la modal 

                                $("#info_user")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-6')
                                .html("Les relevés onts bien était ajouté !!!"); 

                                $("#METERREADING")[0].reset();

                                // CC = compteur clinique //
                                //sendmail_Compta('add', 'CC');

                                TableMeterReading.ajax.reload();                           
                                recupclassdiv('info_user', 7000);
                                                            
                            }

                        })

                    } else if (op == 'edit'){

                        // mise a jour des données compteur relevés
                        $.ajax({
                            url : '?p=meterreading.editmeter', 
                            method : 'POST',
                            data : $('#METERREADING').serialize(),
                            success : function(response){

                                $('#MeterReading').modal('toggle'); // ferme la modal 

                                $("#info_user")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-6')
                                .html("Les relevés ont bien était modifié !!!");

                                $("#METERREADING")[0].reset();

                                // CC = compteur clinique //
                                //sendmail_Compta('edit', 'CC', idmeter);

                                TableMeterReading.ajax.reload();                            
                                recupclassdiv('info_user', 7000);
                                                            
                            }

                        })

                    }
                    
                }

            });

            // DELETE METERREADING //
        
            $(document).on('click', 'button[data-role=deletemeter]', function() {            

                if (confirm("Etes-vous sûr de vouloir supprimer cet élément ?")) {

                    rowtable = $(this).closest('tr');
                    id = parseInt(rowtable.find('td:eq(0)').text());

                    $.ajax(
                    {
                        type: "post",
                        url: "?p=meterreading.deleteMeter",
                        data: {id:id},
                        cache: false,
                        success: function() {
                            
                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-12').html("Les relevés ont bien était supprimé !!!");
                            recupclassdiv('info_user', 5000);

                            TableMeterReading.ajax.reload();

                        }
                    });                
                }

            });

        }

        // compteurs CTA //
        
        if ($('.AffMeterReadingCTA').is(':visible') == true) {

            $('a.item-RC').attr('class', 'active');
            $('ul.item-rc').attr('style', 'display:block;');
            $('li.item-rcta').attr('class', 'active');

            if (typeU == "administrateur") {
                let btn = $('<button class="btn btn-round btn-success pull-left" data-toggle="modal" data-role="addmeter"<abbr title="Ajouter des relevés"><span class="glyphicon  glyphicon-plus"></span></abbr></button>'); 
                btn.appendTo($("p[id=btn_MeterReading]"));
            }                       

            // Table relevés des compteurs  Clinique //
            var TableMeterReadingCTA = $('#TableMeterReadingCTA').DataTable({

                language: {url: "../public/media/French.json"},
                scrollY: '50vh',
                scrollX: true,
                scollCollapse: true,
                paging: true,
                order: [[0, "desc"]],
                ajax: {
                    url:'?p=meterreading.allmeterreadingcta',
                    type: "POST",
                    dataSrc: ""
                },                
                columns: [                
                    { data: "id" },
                    { data: "datefr" },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: green">' + row.elec_ctaNord + '</span>';
                        }
                    },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: red">' + row.conso_ctaNord + '</span>';
                        }
                    },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: green">' + row.elec_ctaSud + '</span>';
                        }
                    },
                    { data: null,
                        render: function(data, type, row) {

                            return '<span style="color: red">' + row.conso_ctaSud + '</span>';
                        }
                    },                   
                    { render : function() {

                        if (typeU == "administrateur") {                            

                            return  `<button class="btn btn-primary btn-xs" data-role="editmeter"<abbr title="Edition relevé"><span class="fa fa-pencil"></span></abbr></button> `+
                                    `<button type="submit" class="btn btn-danger btn-xs" data-role="deletemeter"<abbr title="Supprimé le relevé"><span class="fa fa-trash-o"></span></abbr></button> `                           

                        } else { 

                            return `<button class="btn btn-primary btn-xs" <abbr title="Edition relevé" disabled><span class="fa fa-pencil"></span></abbr></button>`+
                                   `<button type="submit" class="btn btn-danger btn-xs" <abbr title="Supprimé le relevé" disabled><span class="fa fa-trash-o""></span></abbr></button>`
                        }                        

                    }}                   
                    
                ]            

            });

            // function qui récupére la derniére valeur relevé //
            
            function dataMeterReadingCta(col, page){

                $.post('?p=meterreading.findlastnonzeroelement',

                {col:col, page:page}, function(data) {

                    if (col == 'elec_ctaNord') {
                        var inp = "last_ctan";
                        if (data.length == 0) {
                            val = "0";
                        } else {
                            var val = data[0].elec_ctaNord;    
                        }

                    }

                    if (col == 'elec_ctaSud') {
                        var inp = "last_ctas";
                        if (data.length == 0) {
                            val = "0";
                        } else {
                            var val = data[0].elec_ctaSud;    
                        }
                    }                                 
                    
                    $("#"+inp).val(val);

                }); 
            }            

            // ajouter des données relevés compteurs CTA//
            
            $(document).on('click', 'button[data-role=addmeter]', function() {

                $('.Reset').prop('readonly', true);
                $('#MeterReading').modal('show'); // ouvre la modal
                $('.modal-title').html('Ajout relevés de compteurs CTA');

                $('.AffConsoCtaNord, .AffConsoCtaSud').hide(); // efface les conso //

                var tab = Array("elec_ctaNord", "elec_ctaSud");
                var page = "cta";

                for (var i = 0; i < tab.length; i++) {
                    dataMeterReadingCta(tab[i], page);
                } 

                // CTA NORD //
                $('#ctan').on('focusout', function(){
                    var inp2 = $('#ctan').val(); // récupére la valeur de l'input //
                    var lastctan = $('#last_ctan').val(); // récupére la derniére valeur compteur

                    if (lastctan == 0) {
                        $('#conso_ctan').val("0");
                    } else {

                        if (Number(inp2) > Number(lastctan)) {  // si inp2 et supérieur a lasteau //                                     
                            $('.AffConsoCtaNord').show(); //affiche la div input conso
                            var conso = inp2-lastctan;
                            $('#conso_ctan').val(conso); 
                        } else {                            
                            $('.AffConsoCtaNord').hide(); //efface l'input
                            $('#conso_ctan').val("0");
                        } 
                    }                                       
                });

                // CTA SUD //
                $('#ctas').on('focusout', function(){
                    var inp2 = $('#ctas').val(); // récupére la valeur de l'input //
                    var lastctas = $('#last_ctas').val(); // récupére la derniére valeur compteur

                    if (lastctas == 0) {
                        $('#conso_ctas').val("0");
                    } else {

                        if (Number(inp2) > Number(lastctas)) {
                            $('.AffConsoCtaSud').show(); //affiche l'input
                            var conso = inp2-lastctas;
                            $('#conso_ctas').val(conso);
                        } else {
                            $('.AffConsoCtaSud').hide(); //efface l'input
                            $('#conso_ctas').val("0");
                        }
                    }
                });

                $('#op').val('add');

            });            

            // editer des données relevés compteurs CTA //

            $(document).on('click', 'button[data-role=editmeter]', function() {

                $('#MeterReading').modal('show'); // ouvre la modal
                $('.modal-title').html('Edition relevés de compteurs CTA');

                rowtable = $(this).closest('tr');
                id = parseInt(rowtable.find('td:eq(0)').text());
                date_meter = rowtable.find('td:eq(1)').text();

                // retourne la date //
                var parts = date_meter.split(/-/);
                parts.reverse();
                var datereverse = (parts.join('-'));
                $("#date").val(datereverse); // affiche la date enregistrer

                // Elec cta nord //
                let ctan = rowtable.find('td:eq(2)').text(); // récupére le compteur cta Nord
                $('#ctan').val(ctan); // ecris dans input //
                var c_ctan = rowtable.find('td:eq(3)').text(); // récupére la conso cta Nord //
                $('#conso_ctan').val(c_ctan); // ecris dans input //
                if (c_ctan == "0") {
                    $('#last_ctan').val('0');
                }

                // Elec cta sud //
                let ctas = rowtable.find('td:eq(4)').text();
                $('#ctas').val(ctas);
                let c_ctas = rowtable.find('td:eq(5)').text();
                $('#conso_ctas').val(c_ctas);
                if(c_ctas == "0") {
                    $('#last_ctas').val('0');
                }                    
                    
                // sinon ont récupére les derniére valeur en lui passant l'id de la ligne selectionner//                    
                $.ajax({
                    url: '?p=meterreading.findpreviousmetercta',
                    data: {id:id},
                    method: 'POST',
                    dataType: 'json',
                    success: function(reponse) {

                        if (reponse.length == 0) {

                        } else {

                            // CTA NORD //
                            var last_ctan = reponse[0].elec_ctaNord; // dernier relevé cta nord
                            $('#last_ctan').val(last_ctan); //ecris la valeur de la derniere valeur

                            // si CTA Nord change recalculer la conso //
                            $('#ctan').on('change', function() {
                                
                                var inp2 = $('#ctan').val(); // récupére la valeur de l'input modifié//
                                var c_ctan = $('#conso_ctan').val();// récupére la valeur de l'input conso cta//

                                if (Number(inp2) < Number(last_ctan)) { // si inp2 et inférieur à last_ctan //
                                    alert('le nombre ne peut pas être inférieur au dernier relevé!!!');
                                } else {
                                    if (inp2) {                        
                                        if (c_ctan == 0) {
                                            $('#conso_ctan').val(c_ctan);
                                        } else {
                                            var conso = inp2 - last_ctan;
                                            $('#conso_ctan').val(conso); 
                                        }                        
                                    } 
                                }
                            });

                            // FIN CTA NORD //
                            // CTA SUD //
                            var last_ctas = reponse[0].elec_ctaSud;
                            $('#last_ctas').val(last_ctas);

                            $('#ctas').on('change', function() {
                                // si la valeur de gaz change //
                                var inp2 = $('#ctas').val(); // récupére la valeur de l'input modifié//
                                var c_ctas = $('#conso_ctas').val(); // récupére la valeur de l'input conso gaz //

                                if (Number(inp2) < Number(last_ctas)) {
                                    alert('le nombre ne peut pas être inférieur au dernier relevé!!!');
                                } else {
                                    if (inp2) {                        
                                        if (c_ctas == 0) {
                                            $('#conso_ctas').val(c_ctas);
                                        } else {
                                            var conso = inp2 - last_ctas;
                                            $('#conso_ctas').val(conso); 
                                        }                        
                                    } 
                                }
                            });

                            // FIN CTA SUD //                             

                        }           
                    }
                      
                });              
                
                ////////////////////////////////////////
                $('#id_meter').val(id);
                $('#op').val('edit');

            });

            // function qui ajoute ou edit les données compteurs  CTA //

            $('#METERREADING').validator().on('submit', function (event){

                let op = $('#op').val();
                let idmeter = $('#id_meter').val();

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();

                    if (op == 'add') {

                        // add sujet
                        $.ajax({
                            url : '?p=meterreading.addmetercta', 
                            method : 'POST',
                            data : $('#METERREADING').serialize(),
                            success : function(response){

                                $('#MeterReading').modal('toggle'); // ferme la modal                          
                                $("#info_user")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-6')
                                .html("Les relevés onts bien était ajouté !!!");

                                $("#METERREADING")[0].reset();

                                // CTA = compteur CTA //
                                sendmail_Compta('add', 'CTA');

                                TableMeterReadingCTA.ajax.reload();                           
                                recupclassdiv('info_user', 7000);
                                                            
                            }

                        })

                    } else if (op == 'edit'){

                        // mise a jour des données compteur relevés
                        $.ajax({
                            url : '?p=meterreading.editmetercta', 
                            method : 'POST',
                            data : $('#METERREADING').serialize(),
                            success : function(response){

                                $('#MeterReading').modal('toggle'); // ferme la modal                          
                                $("#info_user")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-6')
                                .html("Les relevés ont bien était modifié !!!");

                                $("#METERREADING")[0].reset();

                                // CTA = compteur CTA //
                                sendmail_Compta('edit', 'CTA', idmeter);

                                TableMeterReadingCTA.ajax.reload();                            
                                recupclassdiv('info_user', 7000);
                                                            
                            }

                        })

                    }
                    
                }

            });

            // DELETE METERREADING CTA //
        
            $(document).on('click', 'button[data-role=deletemeter]', function() {            

                if (confirm("Etes-vous sûr de vouloir supprimer cet élément ?")) {

                    rowtable = $(this).closest('tr');
                    id = parseInt(rowtable.find('td:eq(0)').text());

                    $.ajax(
                    {
                        type: "post",
                        url: "?p=meterreading.deleteMeterCta",
                        data: {id:id},
                        cache: false,
                        success: function() {
                            
                            $("#info_user")
                            .removeClass('hidden')
                            .addClass('alert alert-success success-dismissable col-lg-12')
                            .html("Les relevés ont bien était supprimé !!!");
                            
                            recupclassdiv('info_user', 5000);

                            TableMeterReadingCTA.ajax.reload();

                        }
                    });                
                }

            });

        }

        // compteurs EAU //
        
        if ($('.MeterReadingEau').is(':visible') == true) {

            $('a.item-RC').attr('class', 'active');
            $('ul.item-rc').attr('style', 'display:block;');
            $('li.item-rcec').attr('class', 'active');

            if (typeU == "administrateur") {
                let btn = $('<button class="btn btn-round btn-success pull-left" data-toggle="modal" data-role="addmeterEau"<abbr title="Ajouter des relevés"><span class="glyphicon  glyphicon-plus"></span></abbr></button>'); 
                btn.appendTo($("p[id=btn_MeterReading]"));
            }

            // affiche la table eau id = année //
            function TableEau(id) {

                if ($.fn.DataTable.isDataTable('#TableMeterReadingEAU')) {
                
                  $('#TableMeterReadingEAU').DataTable().clear().destroy();
                }

                // Table relevés des compteurs  Cabinet medecin & clinique EAU  //
                var TableMeterReadingEAU = $('#TableMeterReadingEAU').DataTable({

                    language: {url: "../public/media/French.json"},
                    scrollY: '50vh',
                    scrollX: true,
                    scollCollapse: true,
                    paging: true,
                    order: [[0, "asc"]],
                    destroy: true,
                    ajax: {
                        url:'?p=meterreading.dataeauselect',
                        type: "POST",
                        data: {id : id}
                    },                                   
                    columns: [                
                        { data: "id" },
                        { data: "lotID" },
                        { data: "lieux_compt" },
                        { data: null,
                            render: function(data, type, row) {

                                return '<span style="color: green">' + row.compteur_eau + '</span>';
                            }
                        },
                        { data: null,
                            render: function(data, type, row) {

                                return '<span style="color: red">' + row.conso_eau + '</span>';
                            }
                        },
                        { data: "appartenance" },                   
                        { render : function() {

                            if (typeU == "administrateur") {                            

                                return  `<button class="btn btn-primary btn-xs" data-role="editmeterEau"<abbr title="Edition relevé"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<button type="submit" class="btn btn-danger btn-xs" data-role="deletemeter"<abbr title="Supprimé le relevé"><span class="fa fa-trash-o"></span></abbr></button> `                           

                            } else { 

                                return `<button class="btn btn-primary btn-xs" <abbr title="Edition relevé" disabled><span class="fa fa-pencil"></span></abbr></button>`+
                                       `<button type="submit" class="btn btn-danger btn-xs" <abbr title="Supprimé le relevé" disabled><span class="fa fa-trash-o""></span></abbr></button>`
                            }                        

                        }}                   
                        
                    ]            

                });               
                
            }

            // function qui affiche les années de relevé eau // 
            function Year() {

                $('.breadcrumb').empty(); // vide la liste des années //

                $.post('?p=meterreading.extractyear',
                function(data) {                    

                    for (var i = 0; i < data.length; i++) {                       
                       
                       // faire un ajax pour consulter la base chart_panne et voir si l'année exsiste sinon l'enregistrer //  
                       
                        let id = data[i].annee;

                        $('.breadcrumb').append('<li class="year"><a class="h4 tt" href="javascript:;" data-role="viewdataeau" data-id="'+id+'">'+ id +'</a></li>'); 
                    }

                });

            }

            Year();           

            // recherche le dernier relevé enrgistrer //
            function LastMeterEau(year, lot) {                              

                $.post('?p=meterreading.findlastmetereau',

                    {year:year, lot:lot}, function(data) {

                        if (data.length == 1) {

                            $("#last_counter").val(data[0].compteur_eau); // dernier relever //                                        

                        }

                        $('input[name=previousyear]').val(year); // ecris l'année antérieur //

                });                

            }

            // affiche la table Relevés eau lot cabinet - id = année //

            $(document).on('click', 'a[data-role=viewdataeau]', function(){

                var id = $(this).data('id');
                $('.AffMeterReadingEAU').removeClass('hidden').addClass('display');
                $('.tt').removeClass('active').css('color', '#797979');
                $(this).addClass('active').css('color', "red");

                $('#yearselect').val(id);                

                TableEau(id);

            });

            // ajoute les relevés eau //            
            $(document).on('click', 'button[data-role=addmeterEau]', function(){

                $('input[name=year]').val(''); // efface l'input hidden //
                $('.Reset').prop('readonly', true);
                $('#MeterReadingEau').modal('show'); // ouvre la modal
                $('#titleMRE').html('Ajout relevés de compteurs EAU Froide LOT');
                $('.AffDateMRE, .SelectLot').removeClass('hidden').addClass('display');// affiche les class //
                $('#date, #SelectLot').attr('required', true); // required true //
                
                // extrait toutes les années enregistrer dans la base //                    
                $.ajax({
                    url: '?p=meterreading.extractyear',
                    method: 'POST',
                    dataType: 'json',
                    success: function(reponse) {

                        var tabyear = [];

                        var rep = reponse.length;

                        for (var i = 0; i < rep; i++) {

                            tabyear.push(reponse[i].annee); // sur la base production tabyear.push(Number(reponse[i].annee)) pour avoir le tableau [2016, 2017] au lieu de ['2016', '2017']

                        }

                        // effectue des verification sur la date //
                        $('#date').on('focusout',function(){

                            $('#counter, #last_counter, #conso_counter, input[name=previousyear]').val(''); // efface les input //

                            let date = new Date($('#date').val()); // récupére la date //
                            let yearS = date.getFullYear(); // extrait l'année //

                            $('input[name=year]').val(yearS); // ecris l'année dans input hidden modal//                            
                            $('#yearselect').val(yearS); // ecris l'année dans input hidden DOM //

                            if (tabyear.length == 0) { // aucune année entrée dans le tableau //

                                $('input[name=previousyear]').val('0000');
                                load_SelectLot(yearS); // charge le lot correspondant //

                            } else {

                                let index = tabyear.indexOf(yearS); // récupére l'index du tableau pour l'année selectionner de 0 à ... ou -1 si n'existe pas //
                                let result = tabyear[index]-1; // retire une année au resultat //                                                              

                                if (yearS < reponse[0].annee) { // année selectionner inférieur à premiere année entré dans le tableau //

                                    alert("l'année entré ne peut pas être inférieur à "+ reponse[0].annee);
                                    $('#date, #SelectLot').val('');

                                } else if (yearS > reponse[rep-1].annee) { // année selectionner suppérieur a la derniere année entrée dans le tableau //
             
                                    load_SelectLot(yearS); // charge le lot correspondant //                                

                                } else if (isNaN(result)) {

                                    alert("l'année entré n'existe pas dans la base");
                                    $('#date, #SelectLot').val('');

                                } else { // sinon on charge le select lot 

                                    load_SelectLot(yearS); // charge le lot correspondant //                                    
                                
                                } 
                            }                            
    
                        }); 

                        $('#SelectLot').change(function(){
                           
                            var lot = $('#SelectLot option:selected').val(); // numero de lot //                            

                            // recherche de l'année antérieur //                            
                            let date = new Date($('#date').val()); // récupére la date //
                            let yearS = date.getFullYear(); // extrait l'année //

                            let index = tabyear.indexOf(yearS); // récupére l'index du tableau pour l'année selectionner de 0 à x ou -1 si n'existe pas //
                            let year = tabyear[index-1]; // retire une année au resultat //

                            if (index == 0 && year == undefined) {

                                $('input[name=previousyear]').val('0000'); // ecris l'année antérieur à 0000 //

                            } else if(index == -1 && year == undefined) {

                                year = tabyear[rep-1];
                                $('input[name=previousyear]').val(year); // ecris l'année antérieur //

                                // remonte le compteur conrespondant a l'année antérieur //
                                LastMeterEau(year,lot);                               

                            } else {            

                                // remonte le compteur conrespondant a l'année antérieur // 
                                LastMeterEau(year, lot);

                            }                                   

                            // verification de donnée presente dans input //                            
                            let inp = $("#last_counter").val();
                            if (inp = " ") {
                               $("#last_counter").val("0");
                            }                                            

                            // calculer la conso du dernier relevé année précédente et le nouveau relevé année en cours //
                            
                            $('#counter').on('focusout', function(){
                                var inp = $('#counter').val(); // récupére la valeur de l'input //
                                var lastlot = $('#last_counter').val(); // récupére la derniére valeur compteur

                                if (lastlot == 0) {
                                    $('#conso_counter').val("0");
                                } else {

                                    if (Number(inp) > Number(lastlot)) {                             
                                        var conso = (inp-lastlot).toFixed(3);
                                        $('#conso_counter').val(conso); 
                                    } else {
                                        
                                        $('#conso_counter').val("0");
                                    } 
                                }                   
                                                   
                            });

                        });               

                        $('input[name=op]').val('add');                       

                    }

                });               

            });

            // edit le relevé eau //

            $(document).on('click', 'button[data-role=editmeterEau]', function(){

                let rowtable = $(this).closest('tr');
                let id = parseInt(rowtable.find('td:eq(0)').text());
                let lot = rowtable.find('td:eq(1)').text();
                let relv = rowtable.find('td:eq(3)').text();
                let conso = rowtable.find('td:eq(4)').text();
                
                $('#MeterReadingEau').modal('show'); // ouvre la modal
                $('#titleMRE').html('Edition relevé de compteurs EAU Froide LOT '+ lot);
                $('.AffDateMRE, .SelectLot').removeClass('display').addClass('hidden');
                $('#date, #SelectLot').attr('required', false);
               
                $('#counter').val(relv); // ecris relv dans counter //

                // extrait l'année antérieur enregistrer dans la base //                    
                $.ajax({
                    url: '?p=meterreading.previousyear',
                    method: 'POST',
                    data: {id:id},
                    dataType: 'json',
                    success: function(reponse) {

                        let year = reponse[0].annee_ante;

                        if (reponse[0].annee_ante == "0000") {

                            $("#last_counter").val("0");

                        } else {

                            $.post('?p=meterreading.findlastmetereau',

                                {year:year, lot:lot}, function(data) {

                                    if (data.length == 1) {

                                        $("#last_counter").val(data[0].compteur_eau); // dernier relever //                                        

                                    } 

                            });
                        }                        

                    }
                });            

                $('#conso_counter').val(conso); // ecris conso dans conso_counter //

                // calculer la conso du dernier relevé année -1 et le nouveau relevé année en cours //                    
                $('#counter').on('change', function(){
                    var inp = $('#counter').val(); // récupére la valeur de l'input //
                    var lastcounter = $('#last_counter').val(); // récupére la derniére valeur compteur

                    if (lastcounter == 0) {
                        $('#conso_counter').val("0");
                    } else {

                        if (Number(inp) > Number(lastcounter)) {                             
                            var conso = (inp-lastcounter).toFixed(3);
                            $('#conso_counter').val(conso); 
                        } else {
                            
                            $('#conso_counter').val("0");
                        } 
                    }                   
                                       
                });

                $('#id_meter').val(id);
                $('input[name=op]').val('edit');

            });

            // validation de add & edit //
            $('#METERREADINGEAU').validator().on('submit', function(event){

                let op = $('input[name=op]').val();
                let idmeter = $('#id_meter').val();
                var annee = $('#yearselect').val();                

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();

                    if (op == 'add') {

                        // add sujet
                        $.ajax({
                            url : '?p=meterreading.addmetereau', 
                            method : 'POST',
                            data : $('#METERREADINGEAU').serialize(),
                            success : function(response){

                                $('#MeterReadingEau').modal('toggle'); // ferme la modal                          
                                $("#info_user")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-6')
                                .html("Les relevés onts bien était ajouté !!!");

                                $("#METERREADINGEAU")[0].reset();
                                                           
                                recupclassdiv('info_user', 7000);

                                Year(); // recherche si une année a était ajouté //

                                if ($('#TableMeterReadingEAU').is(':visible') == true) {                                    

                                    // reset de la table //
                                    TableEau(annee);
                                    
                                }                                

                                //sendmail_Compta('add', 'CC', idmeter);
                                                            
                            }

                        });

                    } else if (op == 'edit'){

                        // mise a jour des données compteur relevés
                        $.ajax({
                            url : '?p=meterreading.editmetereau', 
                            method : 'POST',
                            data : $('#METERREADINGEAU').serialize(),
                            success : function(response){

                                $('#MeterReadingEau').modal('toggle'); // ferme la modal                          
                                $("#info_user")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable col-lg-6')
                                .html("Les relevés ont bien était modifié !!!");

                                $("#METERREADINGEAU")[0].reset();

                                //sendmail_Compta('edit', 'CC', idmeter);                            

                                // reset de la table //
                                TableEau(annee);
                                                            
                                recupclassdiv('info_user', 7000);
                                                            
                            }

                        });

                    }
                    
                }
            });

            ////////////////////PDF/////////////////////////////////////////////
            
            $(document).on('click', 'a[data-role=viewEauPdf]', function(){

                var yearselect = $('#yearselect').val();
                
                window.open('?p=meterreading.EauPdf&year='+yearselect, '_blank');

            });

            ///////////////////LOT//////////////////////////////////////////////
            
            // function qui affiche le select Lot //
            
            function load_SelectLot(year) {

                $.ajax({
                    url: '?p=meterreading.selectLot',
                    method: 'POST',
                    async: false,
                    success: function(reponse) {
                        // charge le select lot
                        $('#SelectLot option').remove();

                        $("#SelectLot").append('<option value="0" selected disabled>Veuillez choisir un lot</option>'); // remplis les données dans le select //

                        for (var i = 0; i < reponse.length; i++) {

                            var lots = reponse[i].num_lot;
                            var lieux = reponse[i].lieux_compt;
                            var appa = reponse[i].appartenance;                            

                            $("#SelectLot").append('<option value="'+ lots +'">'+ lots +' ('+ lieux + ' - ' + appa +')'+'</option>'); // remplis les données dans le select //

                        }

                        $.post('?p=meterreading.findLot',

                            {year : year}, function(data) {               
                            
                            // vérifie quelle lot et déja enregistrer //
                            
                            let nbrlot = data.length // nombre de lot déja enregistrer 
                            
                            for (var i = 0; i < nbrlot; i++) {
                                lotid = data[i].lotID;
                                $('#SelectLot option[value="'+lotid+'"]').prop('disabled', true).css('color', 'red');
                            }                           


                        });
                    }    
                    
                }); 

            }

            // function qui verifie si le lot existe en base //
            function checkedLot(){            

                $('#numlot').change(function(){

                    let numlot = $('#numlot').val();
                    
                    $("#affinfolot").removeClass('display').addClass('hidden'); // efface l'info lot //

                    if (numlot == "") {

                    } else {

                        $.ajax({
                            url : '?p=meterreading.checkedLot', 
                            method : 'POST',
                            data : {numlot:numlot},
                            dataType: 'json',
                            success : function(data){                                         

                                if (data == false ) {                                 
                                    // si le lot n'existe pas //

                                    $("#affinfolot")
                                    .removeClass('hidden')
                                    .addClass('alert alert-success success-dismissable')
                                    .html("Ce lot et valide !!!");

                                    recupclassdiv('affinfolot', 3000);                              

                                } else { 

                                    // msg d'erreur si le lot existe //
                                    
                                    $("#affinfolot")
                                    .removeClass('hidden')
                                    .addClass('alert alert-danger danger-dismissable')
                                    .html("Ce lot existe déja !!!");

                                    recupclassdiv('affinfolot', 3000);                                
                                    $('input').val('');
                                }

                            }

                        });

                    }

                });

            }            

            // ajoute un ou plusieurs lot dans la base //
            $(document).on('click', 'button[data-role=AddLot]', function(){

                $('#titleLot').html('Ajout LOT');
                $('#ModalLot').modal('show'); // ouvre la modal

                // verification de lot déja dans la base //
                checkedLot();                

                $('input[name=op]').val('add');

            });

            // validation ajout ou edit du lot //
            
            $('#LOT').validator().on('submit', function(event){

                var op = $('input[name=op]').val();
                var year = $('input[name=year]').val(); // récupére l'année selectionner

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();

                    if (op == 'add') {

                        // add lot
                        $.ajax({
                            url : '?p=meterreading.addLot', 
                            method : 'POST',
                            data : $('#LOT').serialize(),
                            success : function(response){

                                $('#ModalLot').modal('toggle'); // ferme la modal                          
                                $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("Le lot à bien était ajouté !!!");                            
                                $("#LOT")[0].reset();

                                load_SelectLot(year);                           
                                recupclassdiv('info_user', 7000);
                                                            
                            }

                        })

                    } else if (op == 'edit'){

                        // mise a jour du lot selectionner //
                        $.ajax({
                            url : '?p=meterreading.editlot', 
                            method : 'POST',
                            data : $('#LOT').serialize(),
                            success : function(response){

                                $('#ModalLot').modal('toggle'); // ferme la modal                          
                                $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable col-lg-6').html("Le lot à bien était modifié !!!");                            
                                $("#LOT")[0].reset();

                                //rafrechir les lot //
                                //                            
                                recupclassdiv('info_user', 7000);
                                                            
                            }

                        })

                    }
                    
                }

            });

        }

        // function qui desactive readonly des inputs //            

        $('.Reset').dblclick(function (){

            var name = $(this).attr("name");            

            $('input[name='+name+']').prop('readonly', false);

            $('input[name='+name+']').on('change', function() {

               $('input[name='+name+']').prop('readonly', true);               

            });

        });

    // EMAIL //
    
        if($('.AffSendMail').is(':visible') == true){

            $('a.item-EM').attr('class', 'active');

        } 
    
        // affiche la table Email All //
        
        let TableMail = $('#TableMail').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '50vh',
            scrollX: true,
            scollCollapse: true,
            ajax: {
                url:'?p=emails.all',
                type: "POST",
                dataSrc: ""
                },
                paging: true,
                columns: [                
                    { data: "id" },
                    { data: "date_mailfr" },
                    { data: "email" },
                    { data: "sujet" }                                             
                    
                ]            

        });

        // function qui affiche le mail selectionner //
        
        $('#TableMail').on('click', 'tr', function() {

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9' }); // affiche le tr en gris //                
            
            // recupére l'id sur le tr table mate //
            let rowtablemail = $(this).closest('tr');
            let id = parseInt(rowtablemail.find('td:eq(0)').text()); // recupére l'id du mail //

            $('.AffPA, .AffCC, .AffBCC, .attachment-mail').removeClass('display').addClass('hidden');
            
            $.ajax({
                url: '?p=emails.view',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    $('#VIEWEMAIL').modal();

                    if (reponse[0].pannes_id != '0') {

                        $('.AffPA').removeClass('hidden').addClass('display');
                        $('#PanneID').html('Panne numéro: '+ reponse[0].pannes_id); 
                    }
                                                                             
                    $('#nom').html(reponse[0].nom);
                    $('#email').html('[' + reponse[0].email + ']');
                    $('#datemail').html('Date: '+ reponse[0].date_mailfr);

                    $('#message').html(reponse[0].message);

                    if (reponse[0].cc) {

                        $('.AffCC').removeClass('hidden').addClass('display').html('<strong>CC.</strong>'+' [' + reponse[0].cc + ']');
                    } 

                    if (reponse[0].bcc) {

                        $('.AffBCC').removeClass('hidden').addClass('display').html('<strong>BCC.</strong>'+' [' + reponse[0].bcc + ']');
                    } 
                    
                    if (reponse[0].lien_pdf != null) {

                        $('.attachment-mail').removeClass('hidden').addClass('display');
                        $('.atch-thumb').prop('href', reponse[0].lien_pdf).html(reponse[0].num_pdf);
                    } 
                                        
                }
                  
            });

        });       

        // function select Contributor (pour email) //
            
        function load_Select_Contri(index) {         

            $.ajax({
                url: '?p=contributors.selectContri',
                data: {index:index},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#Contributors option').remove();

                    $("#Contributors").append('<option disabled selected>Choix Intervenant</option>') // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {

                    let id = reponse[i].id;

                    let contri = reponse[i].nom;                           

                    $("#Contributors").append('<option value="'+ id +'">'+ contri +'</option>'); // remplis les données dans le select //

                    }           
                }
            });

        }

        // function select email pour envoi email //

        function load_SelectEmail(id) { // id contributor //

            $.ajax({
                url: '?p=contributors.selectEmailContact',
                data: {id:id},
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#to option').remove();

                    $("#to").append('<option disabled selected>Choix Email</option>'); // remplis les données dans le select //

                    for (let i = 0; i < reponse.length; i++) {

                        let mail = reponse[i].c_email;
                        let contact_id = reponse[i].id;
                        let contact = reponse[i].nom_contact;

                        $("#to").append('<option value="'+ mail +'" data-id="'+ contact_id +'">'+ mail + "  [" + contact + "]" + '</option>'); // remplis les données dans le select //

                    }           
                }
            });

        }

        // function qui affiche l'envoi du mail //
        
        function load_sendmail(id, index, numfile, tabidpanne) {

            $('#selectvolets').modal('hide');

            $('.AffSendMail').removeClass('hidden').addClass('display');                        

            let ancre = "#BtnHaut";
            ScrollAncre(ancre);

            load_Select_Contri('EXT'); // charge le select intervenant 

            $('#Contributors').change(function(){                
            
                let idc = $('#Contributors').val() // récupére la valeur du contribut choisi

                let nomcontribut = $('#Contributors option:selected').text()

                $('input[name=IdContribu]').val(idc) // ont ecris dans l'input hidden //

                $('button[name=btnAddContact]').attr('data-id', idc).attr('data-nom', nomcontribut) // ecris attribut data dans input

                $('.AffSelectEmail').removeClass('hidden').addClass('display') // affiche le select email //                                                                                                                            

                load_SelectEmail(idc) // charge les mails lier a l'intervenant et contacts (id contribut)                              

            });

            $('#to').change(function(){

                let mail = $('#to option:selected').val(); // récupére la value selectionner //
                let contact_id = $('#to option:selected').data('id'); // récupére l'id du contact //

                $('input[name=mailselect]').val(mail); // ecris dans l'input hidden //
                $('input[name=IdContact]').val(contact_id); // ecris dans l'input hidden //

            });

            $('#subject').val('Demande de devis réparation');     
               
            let  mess;

            if (index == 'Multi') { // email avec pièce jointe car plusieurs matériels en panne // 

                mess = "Bonjour,\n\n Veuillez trouver ci joint en pièces jointe une demande de devis."           
                mess += "\n\nCordialement"
                mess += "\n\n"+ nameUser
                mess += "\nGCS du Marsan - Clinique des landes"
                mess += "\n250,rue Fréderic Joliot Curie"
                mess += "\n40280 Saint Pierre Du Mont"
                mess += "\nTel: " + phoneUser

                $('#mess').html(mess);

                // affiche le nom du fichier pdf passer en pièce jointe & permet de la voir //
                $('.AffFileEmail').html('<a href="../public/documents/pdf/'+numfile+'.pdf" target="_blank">'+ numfile +'.pdf</a>'); 
                $('input[name=numfile').val(numfile); // ecris le nom de la piéce jointe //
                $('input[name=type]').val('Multi'); // ecris le type de mail passer //

                $('input[name=Idpanne]').val(tabidpanne); // ecris le tableau Id Panne dans input hidden //

            } else { // email sans pièce jointe avec un seul matériel en panne //

                // remplis le textarea pour le message - id panne //
                $.ajax({
                    url: '?p=pannes.findDataPanneMate',
                    data: {id:id},
                    method: 'POST',
                    dataType: 'json',
                    success: function(data) {
                       
                        let nacell
                        
                        if(data[0].nacelle == 1){
                            
                            nacell = "Besoin d'une nacelle"
                        } else {

                            nacell = "pas besoin de nacelle"
                        }

                        mess = "Bonjour,\n\n Veuillez trouver ci joint une demande de devis pour un " + data[0].produit                              
                        mess += "\n\nMarque: " + data[0].marque
                        mess += "\nModel: " + data[0].model
                        mess += "\nNuméro Série: " + data[0].num_serie
                        mess += "\nsitué au " + data[0].situe
                        mess += "\nPanne: "+ data[0].designation
                        mess += "\nP.S: " + nacell
                        mess += "\n\nCordialement"
                        mess += "\n\n"+ nameUser
                        mess += "\nGCS du Marsan - Clinique des landes"
                        mess += "\n250,rue Fréderic Joliot Curie"
                        mess += "\n40280 Saint Pierre Du Mont"
                        mess += "\nTel: " + phoneUser

                        $('#mess').html(mess)

                        $('input[name=type]').val('Seul'); // ecris le type de mail passer //
                        $('input[name=Idpanne]').val(id); //ecris l'id panne // 
                        
                    }
                });

            }

            if (typeU == "administrateur"){               
                
                $('#btn_passStage').show();// affiche le btn passe étape //

            } else {
                
                $('#btn_passStage').hide();// efface le btn passe étape //
            }           

            // validation de l'envoi email //

            $('#SendMail').validator().on('submit', function(event){

                let IdContribut = $('input[name=IdContribu]').val();                        
                let mail = $('input[name=mailselect]').val();
                let IdContact = $('input[name=IdContact]').val();
                let sujet = $('#subject').val();
                let cc = $('#cc').val();
                let bcc = $("#bcc").val();
                let tabidpanne = $('input[name=Idpanne').val();                                                

                if (event.isDefaultPrevented()) {

                    } else {

                        event.preventDefault()

                    // envoi le mail // 
                    $.ajax({
                        url : '?p=emails.sendmail', 
                        method : 'POST',
                        dataType: 'text',
                        data : $('#SendMail').serialize(),
                        success : function(data){                                       

                            $('.AffSendMail').removeClass('display').addClass('hidden'); //efface la div affsendMail //

                            $("#info_event")
                            .removeClass('hidden')
                            .addClass('alert alert-info info-dismissable')
                            .html("Le mail à bien était envoyé !!!");

                            recupclassdiv('info_event', 7000);

                            // créer un evenement & modifier etatpanne dans pannes (etatpanne  = attente devis)
                            let Etat = '14';                                                                          

                            $.ajax({
                                url : '?p=events.addEvent', 
                                method : 'POST',
                                data : {IdPanne:id, Etat:Etat, Contributors:IdContribut, IdContact:IdContact, mail:mail, index:index, tabidpanne:tabidpanne},
                                success : function(data){

                                    affPanneMate(id, 'Select'); // affichage de la pannes du matériel par id panne  //
                                    NbrQuota(id, '2');

                                }
                            });
                            
                        }                    

                    });                                                             

                }   
            });

            // passage étape envoi email //

            $('#btn_passStage').on('click', function(event){

                let IdContribut = $('input[name=IdContribu]').val();                        
                let mail = $('input[name=mailselect]').val();
                let IdContact = $('input[name=IdContact]').val();
                let sujet = $('#subject').val();
                let cc = $('#cc').val();
                let bcc = $("#bcc").val();
                let tabidpanne = $('input[name=Idpanne').val();

                $('.AffSendMail').removeClass('display').addClass('hidden'); //efface la div affsendMail //

                // créer un evenement & modifier etatpanne dans pannes (etatpanne  = attente devis)                               

                let Etat = '14';

                if (event.isDefaultPrevented()) {

                    } else {

                        event.preventDefault()                                                                          

                        $.ajax({
                            url : '?p=events.addEvent', 
                            method : 'POST',
                            data : {IdPanne:id, Etat:Etat, Contributors:IdContribut, IdContact:IdContact, mail:mail, index:index, tabidpanne:tabidpanne},
                            success : function(data){

                                affPanneMate(id, 'Select'); // affichage de la pannes du matériel par id panne  //
                                NbrQuota(id, '2');

                            }
                        });

                    }
            });
        }

        // function qui envoi un email a la compta //
        
        function sendmail_Compta(etat, index, id) {

            // etat == add ou edit / index == compteur clinique CC ou CTA //

            $.post('?p=emails.sendmailcompta',

            {etat:etat, index:index, id:id}, function(data) {                
                
                // le mail a bien etait envoyer //                    
    
                $("#info_email")
                .removeClass('hidden')
                .addClass('alert alert-info info-dismissable col-sm-6')
                .html("L'email à bien était envoyé !!!");

                recupclassdiv('info_email', 7000);                   

          });            

        }

        // function qui envoi un email a la Technique //
        
        function sendmail_Tech(index, tab, Etat) {            

            // index == add ou edit ou events // tab = tableau / Etat = evenement //           

            $.ajax({
                url: '?p=emails.sendmailtech',
                data: {index:index, tab:tab, Etat:Etat},
                method: 'POST',
                success: function(reponse) {

                   // le mail a bien etait envoyer //
                    if (index === 'add') {

                        $("#info_emailP")
                        .removeClass('hidden')
                        .addClass('alert alert-info info-dismissable')
                        .html("L'email à bien était envoyé !!!");

                        recupclassdiv('info_emailP', 7000);
    
                    } else if (index === 'events') {
    
                        $("#info_emailE")
                        .removeClass('hidden')
                        .addClass('alert alert-info info-dismissable')
                        .html("L'email à bien était envoyé !!!");

                        recupclassdiv('info_emailE', 7000);

                    } else if (index === 'quota') {
    
                        $("#info_emailQ")
                        .removeClass('hidden')
                        .addClass('alert alert-info info-dismissable')
                        .html("L'email à bien était envoyé !!!");

                        recupclassdiv('info_emailQ', 7000);
                    }                                                           
                                        
                }
          
            });                       

        }

        // si la page Email Params et visible //

        if($('.AffEmailParams').is(':visible') == true) {

            $('.item-PA').attr('class', 'active');
            $('ul.item-pa').attr('style', 'display:block;');
            $('li.item-ep').attr('class', 'active');

            $.ajax({
                url: '?p=params.data',                
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    if(reponse.length != 0) {

                        $('#host').val(reponse[0].host);
                        $('#port').val(reponse[0].port);
                        $('#TLS option[value="' + reponse[0].TLS +'"]').attr('selected', true);
                        $('#STARTTLS option[value="'+reponse[0].STARTTLS+'"]').attr('selected', true);
                        $('#username').val(reponse[0].user_name);
                        $('#password').val(reponse[0].password);
                        $('#EMAIL_FROM').val(reponse[0].setfrom_addres);
                        $('#NAME_FROM').val(reponse[0].setfrom_name);

                        $('#op').val('update');
                        $('#id').val(reponse[0].id);

                    } else {

                        $('#op').val('add');
                    }

                }
                  
            });  
           
        }

        // modification & validation du formulaire paramétrage email //
        
        $('#Modif').on('click', function(){

            $('fieldset').attr('disabled', false); // passe a true la balise //

            $('.AffbtnValid').removeClass('hidden').addClass('display'); // affiche les btn valid & efface //
            $('.AffbtnModif').addClass('hidden'); // efface les btn modif & test //
        });

        // demande de test envoi email //
        
        $('#test').on('click', function(){

            $.post('?p=emails.test',

                function(data) {                
                    
                    $('.Affresult').removeClass('hidden').addClass('display');
                    $('#result').val(data);

              });

        }); 

        // validation paramétre email //

        $('#PARAMS_EMAIL').validator().on('submit', function(event) {

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();                    

                $.ajax({
                    url: '?p=params.validparams',
                    data: $('#PARAMS_EMAIL').serialize(),
                    method: 'POST',
                    success: function(reponse) {

                        $('fieldset').attr('disabled', true); // passe a true la balise // 
                        $('.AffbtnValid').removeClass('display').addClass('hidden'); // efface les btn valid & efface //
                        $('.AffbtnModif').removeClass('hidden').addClass('display'); // affiche les btn modif & test //                                                           
                                            
                    }
                      
                });


            }
            
        });


        // function qui envoi un mail de récap journaliére //
        
        function sendmail_Recap(tab) {

            $.ajax({
                url: '?p=emails.sendmailrecap',
                data: {tab:tab},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    $("#info_emailP")
                    .removeClass('hidden')
                    .addClass('alert alert-info info-dismissable')
                    .html("L'email journalier à bien était envoyé !!!");

                    recupclassdiv('info_emailP', 7000);                                                          
                                        
                }
                  
            }); 
        }

    // REGULATORY CONTROLS //
    
        if($('.AffContReg').is(':visible') == true){

            if (typeU == "administrateur") {
                let btn = $(`<button class="btn btn-round btn-success pull-left" id="btnAddControl" data-toggle="modal" data-role="ADDControl"<abbr title="Ajouter un contrôle"><span class="glyphicon  glyphicon-plus"></span></abbr></button> ` +
                            ` <a class="btn btn-round btn-default " target="_blank" href="?p=controls.viewPdf" <abbr title="Créer un PDF">PDF</abbr></a>`); 
                btn.appendTo($("p[id=btn_addcontrol]"));
            }

            $('a.item-CR').attr('class', 'active');
            $('ul.item-cr').attr('style', 'display:block;');
            $('li.item-c').attr('class', 'active');
        }

        // affiche tout les contrôls réglementaire ou interne //  

        var TableControls = $('#TableControls').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '45vh',
            scrollX: true,
            scollCollapse: true,
            processing: true,
            paging: true,
            ajax: {
                url:'?p=controls.All',
                type: "POST"
                },
                columnDefs: [
                    {
                        className: "category_id",
                        targets:[2],
                        visible: false,
                        searchable: false
                    }
                ],                
                columns: [                    
                    { data: "id" },
                    { data: "type" },
                    { data: "category_id" },
                    { data: "categorie" },
                    { data: "prestation" },
                    { data: "controleur" },
                    { data: "nom" },
                    { data: "frequency" },                                                            
                    { data: "planif",
                        render : function(data, type) {

                            if (data != "00-00-0000") {
                                return `<button class='btn-success' disabled><span class='fa fa-check-circle-o'> le `+ data +`</span></button>`                                
                            } else {
                                return `<button class='btn-primary' data-role='planif'><span class="fa fa-clock-o"> A planifier</span></button>`
                            }                            

                        }
                    },
                    { data: "verification",
                        render : function(data, type) {

                            if (data == 'En Attente') {
                                return `<button class="btn-danger" data-role='verif'>`+ data +`</button>`

                            } else if (data == 'Valider') {
                                return `<button class='btn-default' disabled><span class='fa fa-check'> `+ data +`</span></button>`
                            } else {
                                return ``
                            }                          

                        }
                    },
                    { data: "last_control",
                        render : function(data, type) {

                            if (data != "00-00-0000") {
                                return data
                            } else {
                                return ``
                            }
                        }
                    },
                    { data: "deadline",
                        render : function(data, type) {

                            if (data != "00-00-0000") {
                                return `<button class='btn-theme04' disabled>`+ data +`</button>`
                            } else {
                                return ``
                            }
                        }
                    },                                    
                    { render : function(id, type, row) {                        
                        
                        if (typeU == "administrateur") {

                            if (row.lien_control === null) {

                                if (row.verification == "" || row.verification == "En Attente") {

                                    return  `<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editcontrol" data-role="EDITControl"<abbr title="Edition Controle"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+ 
                                            `<button class="btn btn-warning btn-xs disabled"<abbr title="ajouter un PDF"><span class="fa fa-plus"></span></abbr></button> `+                                   
                                            `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteControl"<abbr title="Supprimé le contrôle"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`
                                } else {

                                     return  `<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editcontrol" data-role="EDITControl"<abbr title="Edition Controle"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+ 
                                             `<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalAddDoc" data-role="addfile" data-b="CON"<abbr title="ajouter un PDF"><span class="fa fa-plus"></span></abbr></button> `+                                   
                                             `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteControl"<abbr title="Supprimé le contrôle"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`

                                }

                            } else {

                                return  `<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editcontrol" data-role="EDITControl"<abbr title="Edition Controle"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+ 
                                        `<a href="`+ row.lien_control +`" target="_blank" class="btn btn-info btn-xs"<abbr title="Voir le Contrôle"><span class="fa fa-eye"></span></abbr></a> `+
                                        `<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalAddDoc" data-role="uploadfile" data-b="CON" data-doc="`+row.lien_control+`"<abbr title="changer le PDF"><span class="fa fa-refresh"></span></abbr></button> `+                                   
                                        `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteControl"<abbr title="Supprimé le contrôle"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`
                            }

                        } else {

                            if (row.lien_control === null) {

                                if (row.verification == "" || row.verification == "En Attente") {

                                    return  `<button class="btn btn-primary btn-xs disabled" <abbr title="Edition controle"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                            `<button class="btn btn-warning btn-xs disabled" <abbr title="ajouter un PDF"><span class="fa fa-plus"></span></abbr></button> `+
                                            `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé le contrôle"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`
                                } else {

                                     return  `<button class="btn btn-primary btn-xs disabled" <abbr title="Edition Controle"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+ 
                                             `<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalAddDoc" data-role="addfile" data-b="CON"<abbr title="ajouter un PDF"><span class="fa fa-plus"></span></abbr></button> `+                                   
                                             `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé le contrôle"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`

                                }

                            } else {

                                return  `<button class="btn btn-primary btn-xs disabled" <abbr title="Edition controle"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                        `<a href="`+ row.lien_control +`" target="_blank" class="btn btn-info btn-xs"<abbr title="Voir le contrôle"><span class="fa fa-eye"></span></abbr></a> `+
                                        `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé le contrôle"><span class="glyphicon  glyphicon-trash"></span></abbr></button>`

                            }
                        }
                    }}    
                ]            

        });

        // affiche ou efface nom tech //
        
        $('#lastcont').on('change', function(){ 

            if ($('#lastcont').val() == "") {
                $('.tech').removeClass('display').addClass('hidden'); // efface //
            } else {
                $('.tech').removeClass('hidden').addClass('display'); // affiche //
            }              

        });        

        // add control reglementaire // 

        $(document).on('click', 'button[data-role=ADDControl]', function() {

            $('#Controls')[0].reset();
            $('#controls').modal('show'); // ouvre la modal
            $('.modal-title').html('Ajout Contrôle Réglementaire');

            $('.ctrl').attr("disabled", false).prop('readonly', false);
            $('.ctrl option[value="0"]').attr('selected', true);

            $('.tech').addClass('hidden'); // nom tech hidden par défaut //

            load_SelectCategories('CR'); // p (page) --> CR = control reglementaire //

            $('button[data-role=Addcategorie]').click(function() {
                
                $('#btn-addcategorie').removeClass('hidden').addClass('display')
                load_SelectCategories('CR'); // p (page) --> CR = control reglementaire //

                $('#addcategorie').change(function(){                

                    let cat = $('input[id=addcategorie]').val();
                    let page = 'CR';                            

                    $('#AddCategorie').click(function(){

                        $.ajax({
                            url : '?p=categories.add', 
                            method : 'POST',
                            data : {cat:cat, page:page},
                            success : function(data){

                                $("#succaddcate")
                                .removeClass('hidden')
                                .addClass('alert alert-success success-dismissable')
                                .html("La catégorie à bien était ajouté !!!")
                                .slideUp(5000);                                
                                                                                 
                                $('#btn-addcategorie').removeClass('display').addClass('hidden');

                                load_SelectCategories('CR'); // p (page) --> CR = control reglementaire //

                            }                    

                        });

                    });

                });

            });

            $('#prestation').on('change', function() {

                let type = $('#typecont option:selected').text();
                let cat = $('#categorie option:selected').text();
                let prest = $('#prestation').val();


                $.ajax({
                    url: '?p=controls.find',
                    data: $('#Controls').serialize(),
                    method: 'POST',
                    dataType: 'json',
                    success: function(reponse) {

                        if (reponse.length == 0) {                            

                        } else {

                            if (reponse[0].statut != "Terminé") {

                                $('#Controls')[0].reset();

                                $("#info_control")
                                .addClass('alert alert-info info-dismissable')
                                .html('Ce contrôle Réglementaire et déja en cours !!!');
                           
                                recupclassdiv('info_control', 5000);
                            }

                        }                                                      
                                            
                    }
                      
                });


            });

            $('#str').val("add"); // ecris dans l'input           

        });        

        // edition du control //
        
        $(document).on('click', 'button[data-role=EDITControl]', function() {

            $('#controls').modal('show'); // ouvre la modal
            $('.modal-title').html('Edition Contrôle Réglementaire');

            $('.tech').addClass('hidden'); // nom tech hidden par défaut //

            load_SelectCategories('CR'); // p (page) --> CR = control reglementaire //         

            var rowtable = $(this).closest('tr');
            var id = parseInt(rowtable.find('td:eq(0)').text()); // récupére l'id du controle //

            $('#id').val(id);
            $('#str').val("edit"); // ecris dans l'input

            $.ajax({
                url: '?p=controls.datactrl',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    let type = reponse[0].type;
                    if (type) {
                        $('#typecont option[value="0"]').attr('selected', false);
                        $('#typecont option[value="' + type +'"]').attr('selected', true);
                        $('#typecont').attr('disabled', true);
                    } 
                    
                    let category = reponse[0].category_id;
                    if (category != 0) {
                        $('#categorie option[value="0"]').attr('selected', false);
                        $('#categorie option[value="' + category +'"]').attr('selected', true);
                        $('#categorie').attr('disabled', true);                    
                    }

                    let prest = reponse[0].prestation;
                    $('#prestation').val(prest);

                    let freq = reponse[0].frequency;                    
                    $('#freq option[value="' + freq +'"]').attr('selected', true); 

                    let ctrl = reponse[0].controleur;
                    $('#controleur').val(ctrl);

                    if (nom == "") { 

                        let nom = reponse[0].nom;
                        $('.tech').removeClass('hidden').addClass('display'); // affiche //
                        $('#nom').val(nom);

                    }                  

                    let last_ctrl = reponse[0].last_control;
                    $('#lastcont').val(last_ctrl);                                                                            
                                        
                }
                  
            });            

        });

        // ajoute ou edit le controle réglementaire  //
            
        $('#Controls').validator().on('submit', function(event) {

            let str = $('#str').val(); // recupére le str add ou edit //               

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();                

                if (str === 'add') {

                    var url = '?p=controls.add';
                    var title = 'Le contrôle Réglementaire à bien était ajouté !!!';                    

                } else if (str === 'edit') {

                    var url = '?p=controls.edit'
                    var title = 'Le contrôle Réglementaire à bien était mis à jour !!!';
                }

                $.ajax({
                    url : url, 
                    method : 'POST',
                    data : $('#Controls').serialize(),
                    success : function(data){

                        $("#info_user")
                        .removeClass('hidden').
                        addClass('alert alert-success success-dismissable col-lg-6')
                        .html(title);

                        $('#controls').modal('hide'); // ferme la modal
                        recupclassdiv('info_user', 5000);

                        TableControls.ajax.reload();

                    }                    

                });                                                            

            }

        });        

        // modifie la planification //
        
        $(document).on('click',  'button[data-role=planif]', function(){

            let rowtable = $(this).closest('tr');
            let id = parseInt(rowtable.find('td:eq(0)').text()); // récupére l'id du controle //

            $('#PLANIF')[0].reset();
            $('#planif').modal('show'); // ouvre la modal //
            $('.modal-title').html('Planification');

            $('input[name=ControlID]').val(id);

            // ajoute la date de planification   //
            
            $('#PLANIF').validator().on('submit', function(event) {      

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();           

                    $.ajax({
                        url : '?p=controls.planif', 
                        method : 'POST',
                        data : $('#PLANIF').serialize(),
                        success : function(data){                            

                            $('#planif').modal('hide'); // ferme la modal                            

                            TableControls.ajax.reload();

                        }                    

                    });                                                            

                }

            });

        }); 

        // modifie la vérification //
        
        $(document).on('click',  'button[data-role=verif]', function(){

            let rowtable = $(this).closest('tr');
            let id = parseInt(rowtable.find('td:eq(0)').text()); // récupére l'id du controle //

            $('#VERIF')[0].reset();
            $('#verif').modal('show'); // ouvre la modal //
            $('.modal-title').html('Date de vérification');

            $('.tech').removeClass('hidden').addClass('display');

            $('input[name=ControlID]').val(id);

            // ajoute la date de planification   //
            
            $('#VERIF').validator().on('submit', function(event) {      

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();           

                    $.ajax({
                        url : '?p=controls.verif', 
                        method : 'POST',
                        data : $('#VERIF').serialize(),
                        success : function(data){                            

                            $('#verif').modal('hide'); // ferme la modal                            

                            TableControls.ajax.reload();

                        }                    

                    });                                                            

                }

            });
            
        });       

    // CONTRACTS //
    
        if($('.AffContracts').is(':visible') == true){
            
            let btn = $(`<button class="btn btn-round btn-success" id="btnAddContract" data-toggle="modal" data-role="ADDContract" <abbr title="Ajouter un contrat"><i class="fa fa-plus"></i></abbr></button> `+
                        `<a class="btn btn-round btn-default" target="_blank" href="?p=contracts.viewPdf" <abbr title="Créer un PDF">PDF</abbr></a>`); 
            btn.appendTo($("p[id=btn_addcontract]"));            

            $('a.item-CO').attr('class', 'active');
        }

        // charge les contrats dans un select // 
        function load_SelectContract() {

            $('#btncontrat').attr('disabled', false);

            $.ajax({
                url: '?p=contracts.SelectContrat',
                method: 'POST',
                async: false,
                success: function(reponse) {

                    $('#numcontrat option').remove();

                    $("#numcontrat").append('<option value="0" disabled selected>Veuillez choisir un contrat</option>'); // remplis les données dans le select //

                    for (var i = 0; i < reponse.length; i++) {

                        var id = reponse[i].id;
                        var cont = reponse[i].num_contrat;                            

                        $("#numcontrat").append('<option value="'+ id +'">'+ cont +'</option>'); // remplis les données dans le select //

                    }                        
                    
                }
            });
            
        }

        // affiche tout les contrats //  

        var TableContracts = $('#TableContracts').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '45vh',
            scrollX: true,
            scollCollapse: true,
            processing: true,
            paging: true,
            ajax: {
                url:'?p=contracts.All',
                type: "POST"
                },                
                columnDefs: [
                    {
                        className: "id_contribu",
                        targets:[2],
                        visible: false,
                        searchable: false
                    }
                ],
                columns: [                    
                    { data: "id" },
                    { data: "num_contrat" },
                    { data: "id_contri" },
                    { data: "nom" },
                    { data: "date_deb" },
                    { data: "durer" },                                    
                    { data: "reconduction" },
                    { data: "montant" },                                    
                    { render : function(id, type, row) {
                        
                        if (typeU == "administrateur") { // administrateur //

                            if (row.lien_contrat === null) {

                                return  `<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editcontrat" data-role="EDITContract"<abbr title="Edition Contrat"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalAddDoc" data-role="addfile" data-b="CO"<abbr title="ajouter un PDF"><span class="fa fa-plus"></span></abbr></button> `+                                    
                                        `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteContrat"<abbr title="Supprimé le contrat"><span class="fa fa-trash-o"></span></abbr></button>`
                            } else {

                                return  `<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editcontrat" data-role="EDITContract"<abbr title="Edition Contrat"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<a href="`+ row.lien_contrat +`" target="_blank" class="btn btn-info btn-xs"<abbr title="Voir Contrat"><span class="fa fa-eye"></span></abbr></a> `+
                                        `<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalAddDoc" data-role="uploadfile" data-b="CO" data-doc="`+row.lien_contrat+`"<abbr title="changer le PDF"><span class="fa fa-refresh"></span></abbr></button> `+                                    
                                        `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteContrat"<abbr title="Supprimé le contrat"><span class="fa fa-trash-o"></span></abbr></button>`
                            }                             

                        } else { // utilisateur //

                            if (row.lien_contrat === null) {

                                return  `<button class="btn btn-primary btn-xs disabled" <abbr title="Edition contrat"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ModalAddDoc" data-role="addfile" data-b="CO"<abbr title="ajouter un PDF"><span class="fa fa-plus"></span></abbr></button> `+                                    
                                        `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé le contrat"><span class="fa fa-trash-o"></span></abbr></button> `
                            } else {

                                return  `<button class="btn btn-primary btn-xs disabled" <abbr title="Edition contrat"><span class="fa fa-pencil"></span></abbr></button> `+
                                        `<a href="`+ row.lien_contrat +`" target="_blank" class="btn btn-info btn-xs"<abbr title="Voir Contrat"><span class="fa fa-eye"></span></abbr></a> `+                                     
                                        `<button type="submit" class="btn btn-danger btn-xs disabled"<abbr title="Supprimé le contrat"><span class="fa fa-trash-o"></span></abbr></button>`
                            }                           
                                    
                        }
                    }}    
                ]            

        });

        // add contrat // 

        $(document).on('click', 'button[data-role=ADDContract]', function() {

            $('#contract').modal('show'); // ouvre la modal
            $('#titleContract').html('Ajout Contrat');

            $('#NumContract').on('change', function(){

                let numc = $('#NumContract').val();
                $('.error_numcontrat').html("");

                $.post('?p=contracts.checkednumcontract',

                    {numc : numc}, function(data) {                
                        
                        if (data != false ) {                   
                            
                            $('#NumContract').val("");
                            $('.error_numcontrat').css('color', 'red').html(' Le numéro de contrat existe déja');
                        } 

                  });

            });

            load_SelectContriIC('EXT');            

            $('#str').val("add"); // ecris dans l'input

        });        

        // edition du contrat //
        
        $(document).on('click', 'button[data-role=EDITContract]', function() {

            $('#contract').modal('show'); // ouvre la modal
            $('.modal-title').html('Edition Contrat');                      

            var rowtable = $(this).closest('tr');
            var id = parseInt(rowtable.find('td:eq(0)').text()); // récupére l'id du contrat //
            var numcontrat = rowtable.find('td:eq(1)').text(); // récupére le numéro du contrat //
            var date = rowtable.find('td:eq(3)').text(); // récupére la date de debut  //
            var durer = rowtable.find('td:eq(4)').text(); // récupére la durer  //
            var recond = rowtable.find('td:eq(5)').text(); //récupére la reconduction //
            var montant = rowtable.find('td:eq(6)').text(); //récupére le montant //

            var id_contribu  = TableContracts.row(rowtable).data()['id_contri'];

            $('#NumContract').val(numcontrat);

            load_SelectContriIC('EXT');

            $('#ContributIC option[value="'+ id_contribu +'"]').attr("selected", "selected"); 

            // retourne la date //
            let parts = date.split(/-/);
            parts.reverse();
            let datereverse = (parts.join('-'));
            $('#datedeb').val(datereverse);

            $('#durer').val(durer);

            if (recond == "") {
                $('#recond option[value="0"]').attr("selected", "selected");
            } else {
                $('#recond').val(recond);
            }

            $('#montant').val(montant);

            // ecris dans l'input 
            $('#ContractID').val(id);
            $('#str').val("edit");                 

        });

        // ajoute ou edit le contrat //
            
        $('#AEContract').validator().on('submit', function(event) {

            let str = $('#str').val(); // recupére le str add ou edit               

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();                

                if (str === 'add') {

                    var url = '?p=contracts.add';
                    var title = 'Le contrat à bien était ajouté !!!';                    

                } else if (str === 'edit') {

                    var url = '?p=contracts.edit'
                    var title = 'Le contrat à bien était mis à jour !!!';
                }

                $.ajax({
                    url : url, 
                    method : 'POST',
                    data : $('#AEContract').serialize(),
                    success : function(data){

                        $("#info_user")
                        .removeClass('hidden')
                        .addClass('alert alert-success success-dismissable col-lg-6')
                        .html(title);

                        $('#contract').modal('hide'); // ferme la modal                        
                        recupclassdiv('info_user', 5000);

                        if ($('.AffContracts').is(':visible') == true) {
                            TableContracts.ajax.reload();
                        } else {
                            load_SelectContract(); 
                        }                                                                         

                    }                    

                });                                                            

            }

        });

        // affiche le tableau du matériel associer au contrat  //
        
        $('.Contracts').on('dblclick', 'tr', function (){

            $('tr td').css({ 'background-color' : '#e5e5e5'}); // affiche le tr en vert //
            $('td', this).css({ 'background-color' : '#c1f1c9'}); // affiche le tr en gris //

            $('.dataTables_scrollBody').css('height','200px');

            let rowtable = $(this).closest('tr');
            let id = parseInt(rowtable.find('td:eq(0)').text()); // recupére l'id du contrat//

            $('.ViewPdf').attr('data-id',id);

            $.ajax({
                url: '?p=contracts.findmatescontract',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    if (reponse.length != 0) {

                        $('.AffMatesLier').removeClass('hidden').addClass('display');

                        // reinitialise la table //
                        if ($.fn.dataTable.isDataTable('#TableMateLier')) {

                            $('#TableMateLier').DataTable().destroy();
                        }

                        // AFF Materials lier aux contrat //              
            
                        var TableMateLier = $('#TableMateLier').DataTable({

                            language: {url: "../public/media/French.json"},
                            lengthMenu: [10, 15, 25, 50],
                            scrollY: '40vh',
                            scrollX: true,
                            scollCollapse: true,
                            paging: true,
                            searching: false,
                            data: reponse.data,                           
                            columns: [
                                { data: "id"},                    
                                { data: "num_inventaire" },
                                { data: "produit" },
                                { data: "marque" },                    
                                { data: "model" },
                                { data: "type" },
                                { data: "num_serie" },
                                { data: "niveau",
                                    render: function(data, type, row) {
                                        if (row.niveau == null) {
                                            return niveau = row.lieux_install;
                                        } else {
                                            return row.niveau;
                                        }
                                    }
                                },
                                { data: "statut",
                                    render: function(data, type) {

                                        if (type === 'display') {
                                            
                                            if (data === 'En Panne' || data === 'En Attente' || data === 'HS') {
            
                                                return '<a class="btn-danger btn-xs btn-round" disabled>'+ data +'</a>';
            
                                            } else if (data === 'Intervention En Cours') {
            
                                                return '<a class="btn-warning btn-xs btn-round" disabled>'+ data +'</a>';                                
            
                                            } else {
            
                                                return '<a class="btn-success btn-xs btn-round" disabled>'+ data +'</a>';
                                            }                               
                                        }                          
                                            return data;
                                    }
                                },
                                { data: "mtr",
                                      render: function(data, type, row) {
                                        
                                        if (row.mfr == null && row.mfi == null) {
                                            return mtr = '0.00 €';
                                        } else {
                                            mfr = Number(row.mfr);
                                            mfi = Number(row.mfi);
                                            mtr = mfr + mfi;
                                            return mtr.toFixed(2) +' €';
                                        }                               
                                    }
                                },                                                                     
                                { data: "nbrtotalpanne" },
                                {
                                    render: function() {
                                        return `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteMatLierCont"<abbr title="Supprimé le matériel lier au contrat"><span class="fa fa-trash-o"></span></abbr></button>`
                                    }
                                }
                                
                            ] 
                        });

                    }                                                        
                                        
                }
                  
            });                              

        });

        // delete le matériel lier au contrat //
        
        $(document).on('click', 'button[data-role=deleteMatLierCont]', function(){

            // recupére l'id du matériel //            
            let rowtable = $(this).closest('tr');
            let id = parseInt(rowtable.find('td:eq(0)').text()); // id matériel lier //                    
                
            if(confirm("Voulez-vous vraiment supprimer le matériel lier au contrat?"))
            {
               $.ajax({
                url:"?p=materials.deleteMateLierCont",
                method: 'POST',
                data:{id : id},                            
                    success: function(data) {  

                       refresh();
                        
                    }
                 
                });
            }            
            
        });

        // voir tous les matériel lier au contrat en pdf //
        
        $(document).on('click','a[data-role=ViewPdfMateContract]', function(){

            let id = $('.ViewPdf').data('id'); // id contrat //

            window.open('?p=materials.mateContratPdf&id='+id, '_blank');

        });

    // PROFIL // 
    
        // changer le mot de passe//
         
        $(document).on('click', 'button[data-role=changeMP]', function(){

            let id, mp, mp2
            let tab = new Array();

            $('#ChangeMP').modal('show'); // ouvre la modal 
            id = $(this).data('id'); // récupére l'id de l'utilisateur

            $('#MP').change(function() {

                mp = $('#MP').val(); // recupére le mot de passe

                tab[0] = mp;

            });

            $('#MP2').change(function() {

                mp2 = $('#MP2').val();

                tab[1] = mp2;

                if (tab[0] != tab[1]) {

                    $('#error_pwd').removeClass('hidden').addClass('display');
                    recupclassdiv('error_pwd', 3000); 
                    $('#MP2').val("");

                } else {

                    $('#CHMP').validator().on('submit', function(event) {                               

                        if (event.isDefaultPrevented()) {

                        } else {
                        
                            event.preventDefault();

                            $.ajax({
                                url: '?p=change_mp',
                                data: {id:id, mp:mp},
                                method: 'POST',
                                success: function(reponse) {

                                    $("#info_user")
                                    .removeClass('hidden')
                                    .addClass('alert alert-success success-dismissable')
                                    .html("Le mot de passe à était mis à jour !!!");
                                                                                        
                                    recupclassdiv('info_user', 3000);

                                    $("#CHMP")[0].reset();
                                    $('#ChangeMP').modal('hide');

                                }
                                  
                            });
                        }

                    });

                }
            });             

        });
        
    // USER //    
    
        if ($('#adduser').is(":visible") == true) {

            $('.item-PA').attr('class', 'active');
            $('ul.item-pa').attr('style', 'display:block;');
            $('li.item-cp').attr('class', 'active');

            $('.AffNiveauAuth').addClass('hidden');

            // verifier le numero de téléphone //
            $('.TEL').on('keyup', function() {
                checkednum('phone', 'add');
            });

        } else if ($('#TableUsers').is(":visible") == true) {

            $('.item-PA').attr('class', 'active');
            $('ul.item-pa').attr('style', 'display:block;');
            $('li.item-vtu').attr('class', 'active');
        }        

        // AFF USERS ALL // ADMIN //        

        var TableUsers = $('#TableUsers').DataTable({

            language: {url: "../public/media/French.json"},
            lengthMenu: [10, 15, 25, 50],
            scrollY: '350px',
            scrollX: true,
            scollCollapse: true,
            processing: true,
            paging: true,
            ajax: {
                url:'?p=users.all',
                type: "POST",
                },                
                columns: [
                    { data: "id" },
                    { data: "username" },
                    { data: "last_name" },
                    { data: "first_name" },
                    { data: "type" },
                    { data: "niveau" },
                    { data: "u_email" },
                    { data: "u_annu" },
                    { data: "u_phone" },
                    { data: "u_etat",
                    render: function(data, type) {  // compte //                     

                        if (type === 'display') {

                            var color = '';
                            var glyph = '';

                            switch (data) {

                                case 'Actif':
                                    color = 'success';
                                    glyph = 'thumbs-up';
                                    break;
                                case 'Inactif':
                                    color = 'warning';
                                    glyph = 'thumbs-down';
                                    break;
                            }

                                return '<button class="btn btn-'+ color +' btn-xs" data-role="EtatUser" data-etat="'+ data +'"<abbr title="'+ data +'"><span class="glyphicon glyphicon-'+glyph+'"></span></abbr></button>';
                            }

                            return data
                        }
                    }, 
                    { data: "nbr_connec" },
                    { data: "dateconnectfr" },                   
                    { render : function(data, type, row) { // action //
                            
                        return `<button class="btn btn-primary btn-xs" data-role="EditUser" <abbr title="Edition Utilisateur"><span class="glyphicon glyphicon-pencil"></span></abbr></button> `+
                                `<button class="btn btn-warning btn-xs" data-role="changeMP" data-id="`+ row.id +`"<abbr title="Changer le mot de passe"><span class="fa fa-retweet"></span></abbr></button> `+
                                `<button type="submit" class="btn btn-danger btn-xs" data-role="deleteUser"<abbr title="Supprimé l\'utilisateur"><span class="glyphicon  glyphicon-trash"></span></abbr></button> ` 
                    }}
                ]
        });

        // si type compte change //            
        $('#type').on('change', function(){

            var type = $('#type option:selected').text();

            if (type === "Utilisateur") {

                $('.AffNiveauAuth').removeClass('hidden').addClass('display');
                
            } else {

                $('.AffNiveauAuth').removeClass('display').addClass('hidden');
            }

        });        

        // add user //

        $('#adduser').validator().on('submit', function (event) {

            if (event.isDefaultPrevented()) {

            } else {
            
                event.preventDefault();                                      

                $.ajax({
                    url : '?p=users.add_user', 
                    method : 'POST',
                    dataType : 'json',
                    data : $('#adduser').serialize(),
                    success : function(reponse){

                        if (reponse === false) {

                            // si l'utilisateur existe //
                            $("#info_user").removeClass('hidden').addClass('alert alert-danger danger-dismissable').html("L'utilisateur existe déja !!!")
                            recupclassdiv('info_user', 7000)
                            refresh()

                        } else {
                            // si l'utilisateur n'existe pas //
                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable').html("L'utilisateur à bien était enregister !!!")
                            recupclassdiv('info_user', 7000)
                            refresh()
                        }                    
                                              

                    }                    

                })
            }

        });

        // Edit le profil utilisateur //
        
        $(document).on('click','button[data-role=EditUser]', function(){

            $('#EtatUser').modal('show'); // ouvre la modal 

            rowtableuser = $(this).closest('tr');
            id = parseInt(rowtableuser.find('td:eq(0)').text());
            login = rowtableuser.find('td:eq(1)').text();
            nom = rowtableuser.find('td:eq(2)').text();
            prenom = rowtableuser.find('td:eq(3)').text();
            type = rowtableuser.find('td:eq(4)').text();
            niveau = rowtableuser.find('td:eq(5)').text();
            email = rowtableuser.find('td:eq(6)').text();
            annu = rowtableuser.find('td:eq(7)').text();
            sda = rowtableuser.find('td:eq(8)').text();

            $('#IdUser').val(id);
            $('#login').val(login);
            $('#nom').val(nom);
            $('#prenom').val(prenom);
            $('#type').val(type);

            $('input[type=checkbox]').attr('checked', false);

            if (niveau == "10") {

                $('.AffNiveauAuth').removeClass('display').addClass('hidden');

            } else {

                $('.AffNiveauAuth').removeClass('hidden').addClass('display');
                if (niveau == "2") {
                    $('input[name=NC]').attr('checked', true);
                } else if (niveau == "9") {
                    $('input[name=ND]').attr('checked', true);
                } else if (niveau == "7") {
                    $('input[name=NT]').attr('checked', true);
                }  
            }            

            $('#email').val(email);

            // verifier le numero de téléphone //
            $('.TEL').on('keyup', function() {
                checkednum('phone', 'edit', sda);
            });

            $('#annu').val(annu);
            $('#phone').val(sda);        

            // validation de l'edition // 
            $('#EDITUSER').validator().on('submit', function (event) {

                if (event.isDefaultPrevented()) {

                } else {
                
                    event.preventDefault();                                      

                    $.ajax({
                        url : '?p=users.edit_user', 
                        method : 'POST',
                        data : $('#EDITUSER').serialize(),
                        success : function(reponse){                        

                            // si l'édition de l'utilisateur c'est bien mis a jour//
                            $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable').html("L'utilisateur à bien était mis à jour !!!");
                            recupclassdiv('info_user', 3000);
                            // fermé la modal
                            $('#EtatUser').modal('hide');
                            // reset du tableau 
                            TableUsers.ajax.reload(); // reload la table
                        }                    

                    });
                }

            });

        });

        // voir le mot de passe en clair //

        $('.viewpass').on('click', function(){            

            let id = $(this).data('id')

            // récupére le type de l'input//
            var type = $("input[id='"+id+"']").attr('type');

            if (type === "password") {

                // change le type password en text //            
                $("#"+id+"").attr('type', 'text');
                // change le glyphicon //
                $('#span_eye').removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');

            } else {

                // change le type text en password //            
                $("#"+id+"").attr('type', 'password');
                // change le glyphicon //
                $('#span_eye').removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');

            }         

        });

        // desactiver un compte //
        
        $(document).on('click','button[data-role=EtatUser]', function(){
            // récupére l'ID//
            var rowtableuser = $(this).closest('tr')
            var id = parseInt(rowtableuser.find('td:eq(0)').text())
            // récupére l'état //
            var etat = $(this).data('etat')

            if (etat == 'Actif') {

                etat = 'Inactif';

            } else {

                etat = 'Actif';
            }          

            $.ajax({
                url: '?p=users.ChangeEtat_User',
                data: {id:id, etat:etat},
                method: 'POST',
                success: function(reponse) {

                    if (etat == 'Actif') {

                        $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable').html("L'utilisateur à bien était Activé !!!")
                    
                        
                    } else {

                        $("#info_user").removeClass('hidden').addClass('alert alert-warning warning-dismissable').html("L'utilisateur à bien était désactivé !!!")                    
                       
                    }

                    TableUsers.ajax.reload() // reload la table
                    recupclassdiv('info_user', 4000)                     
                    
                }   
                           
                        
            })

        });

        // DELETE USER //

        // supprime l'utilisateur avec condition //
        
        $(document).on('click','button[data-role=deleteUser]', function(){

            var rowtableuser = $(this).closest('tr');
            var id = parseInt(rowtableuser.find('td:eq(0)').text());

            $.ajax({
                url: '?p=users.checked_User',
                data: {id:id},
                method: 'POST',
                dataType: 'json',
                success: function(reponse) {

                    if (reponse) {

                        // ont peut effacé
                        if(confirm("Voulez-vous vraiment supprimer l'utilisateur?")) {

                           $.ajax({
                            url:"?p=users.delete_user", 
                            method: 'POST' ,
                            data:{id : id},                            
                            success:function(data)
                                {                                                      

                                    $("#info_user").removeClass('hidden').addClass('alert alert-success success-dismissable').html("L'utilisateur à bien était supprimé !!!")
                                    
                                    TableUsers.ajax.reload() // reload la table 

                                    recupclassdiv('info_user', 4000) 
                                    
                                }   
                            });
                        }
                        
                    } else {

                        // ont ne peut pas effacer 
                        $("#info_user").removeClass('hidden').addClass('alert alert-danger danger-dismissable').html("L'utilisateur ne peut être éffacé !!!")

                        recupclassdiv('info_user', 4000)
                    }                                                        
                                        
                }
                  
            });  

        });

});

