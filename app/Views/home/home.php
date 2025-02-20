<div class="AffHome">

    <h2>Accueil</h2>

    <!-- RECAP -->
    <div class="container col-sm-4">

        <div class="jumbotron">
            
            <h3>Recap</h3>
                    
            <p><a class="label label-default" href="?p=contributors">Nbr d'intervenants <span class="badge"><?= $contri[0]->id; ?></span></a></p>
            
            <p><a class="label label-info" href="?p=materials">Nbr de Matériels Enregistrer <span class="badge"><?= $mate[0]->id; ?></span></a></p>

            <p><a class="label label-info" href="?p=materialslier">Nbr de Matériels Lier Enregistrer <span class="badge"><?= $matelier[0]->id; ?></span></a></p>

            <p><a class="label label-warning" href="?p=pannes">Nbr total de pannes déclaré <span class="badge"><?= $panne[0]->id; ?></span></a></p>

            <p><a class="label label-warning" href="?p=pannes.pannesAttRep">Nbr de pannes en attente de réparation <span class="badge"><?= $attrep[0]->id; ?></span></a></p>

            <p><a class="label label-success" href="?p=intervs">Nbr total d'Intervention <span class="badge"><?= $tinterv[0]->id; ?></span></a></p>

            <p><a class="label label-success" href="?p=intervs.intervsEnCours">Nbr d'Intervention en Cours <span class="badge"><?= $attinterep[0]->id; ?></span></a></p>

            <a class="label label-theme" href="?p=quotation.affpendingquote">Nbr de devis en Attente <span class="badge"><?= $nda[0]->id; ?></span></a> 
              
        </div>
    </div>

    <!-- RECAP VOLETS -->
    <div class="container col-sm-4">

        <div class="jumbotron">
            
            <p><a class="label label-warning" href="?p=materials&index=volets">Nbr Total de volets: <span class="badge"><?= $nbrtvolet[0]->nbrtv; ?></span></a></p>

            <h3>Recap Volets En Panne </h3>
            <p><a class="label label-success" href="?p=pannes.pannesVolets">Voir toutes les pannes volets: <span class="badge"><?= $nbrptvolet[0]->nbrpv; ?></span></a></p>     

            <h3>Attente Demande Devis </h3>
            <p class="label label-info">Panne Volets avec Nacelle: <span class="badge"><?= $pvanacl[0]->nbrpvancl; ?></span></p><br><br>
            <p class="label label-theme">Panne Volets sans Nacelle: <span class="badge"><?= $pvsnacl[0]->nbrpvsncl; ?></span></p>
            
            <h3>Attente Retour Devis </h3>
            <p class="label label-primary">Panne Volets en attente devis: <span class="badge"><?= $pvaquota[0]->nbrpvaquota; ?></span></p> 
              
        </div>

    </div> 
       
    <!-- MONTANT TOTAL DES REPARATIONS & DEVIS -->
    <div class="container col-sm-4">

        <div class="jumbotron">
            
            <h3>Montant Total des Réparations</h3>                    
            <h3><span class="label label-default">Montant</span> <?= $mtr; ?> €</h3>

            <h3>Montant Total des Devis</h3>                    
            <h3><span class="label label-default">Montant</span> <?= $mtquota; ?> €</h3>      
              
        </div>

    </div>

    <!-- NBRS DE FACTURES MANQUANTE -->
    <div class="container col-sm-4">

        <div class="jumbotron">
            
           <h4>Nbr de Factures Manquante</h4>
           <h4><span class="label label-default">Nombre</span> <?= $mfactrep; ?></h4>       
              
        </div>

    </div>
    
    <!-- CHART1 -->
    <div class="col-sm-12">    
        <div class="container col-sm-6">
            <h4>Nbrs de pannes Total par années</h4>    
            <div id="mychartannee" style="height: 250px;"></div>
        </div>

        <div class="container col-sm-6">
            <h4>Prix Total des pannes Total par années</h4>
            <div id="mychartprixT" style="height: 250px;"></div>
        </div>
    </div>

    <!-- CHART2 -->
    <div class="col-sm-12">    
        <div class="container col-sm-6">
            <h4>Nbrs de pannes volets par années</h4>    
            <div id="mychartpavolet" style="height: 250px;"></div>
        </div>

        <div class="container col-sm-6">
            <h4>Prix Total des pannes volets par années</h4>
            <div id="mychartvoletprixT" style="height: 250px;"></div>
        </div>
    </div>

</div>

  <!--script for this page-->
  <script src="../public/lib/morris/morris.min.js"></script>
  <script src="../public/lib/raphael/raphael.min.js"></script>



 



