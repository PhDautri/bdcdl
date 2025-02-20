<div class="AffHomeCompta">

	<h2>Accueil Compta</h2>

	<div class="container col-sm-5">

        <div class="jumbotron">
            
            <h3>Recap</h3>
                    
            <h4>
                <span class="label label-default">Nbr d'interventions</span> <a href="?p=intervsdoctors"><?= $ni[0]->ni; ?></a>
            </h4>

            <h4>
                <span class="label label-warning">Nbr d'interventions non Facturer</span> <a href="?p=billings.notbilled"><?= $ninf[0]->ninf; ?></a>
            </h4>
            
            <h4>
                <span class="label label-info">Nbr de Facture Médecins</span> <a href="?p=billings"><?= $nf[0]->nf; ?></a>
            </h4>

              
              
        </div>
    </div>

</div>