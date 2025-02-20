
<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title><?= App::getInstance()->title; ?></title>

    <!-- Favicons -->
    <link href="../public/img/img_societe/gcsM.ico" rel="icon">

    <!-- Bootstrap core CSS -->
      <link href="../public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- ok -->
      <!--external css-->
      <link href="../public/lib/font-awesome/css/font-awesome.css" rel="stylesheet" /> <!-- ok -->    

    <!-- Custom styles for this template -->      
      
      <link rel="stylesheet" type="text/css" href="../public/lib/DataTables/datatables.min.css" >
      <link rel="stylesheet" type="text/css" href="../public/css/selectDataTable.css" />
      <link rel="stylesheet" type="text/css" href="../public/lib/bootstrap-fileupload/bootstrap-fileupload.css" />
      <link rel="stylesheet" type="text/css" href="../public/lib/gritter/css/jquery.gritter.css" />      
      <link rel="stylesheet" type="text/css" href="../public/css/style.css" />
      <link rel="stylesheet" type="text/css" href="../public/css/style-responsive.css" />
      <link rel="stylesheet" href="../public/css/morris.css">

    <!-- Mon CSS -->

      <link rel="stylesheet" href="../public/css/MonCss.css">         
      
    <!-- script-->  
      <script src="../public/lib/jquery/jquery.js"></script> 

    <!-- =======================================================
      Template Name:  
    ======================================================= -->
  </head>

  <body>
    <section id="container">      

      <!--header start-->
      <header class="header black-bg">
        <div class="sidebar-toggle-box">
          <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="?p=home" class="logo"><b>BD<span>CDL</span></b></a>

        <div class="nav notify-row" id="top_menu">
          <!--  notification start -->
          <ul class="nav top-menu">
            <!-- notification dropdown start-->
            <li id="header_notification_bar" class="dropdown" hidden>
              <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                <i class="fa fa-bell-o"></i>
                <span id="notif" class="badge bg-warning"></span>
                </a>
              <ul class="dropdown-menu extended notification">
                <div class="notify-arrow notify-arrow-yellow"></div>
                <li>
                  <p id="affnotif" class="yellow"></p>
                </li>
                <li class="affliennotif"></li>                
                <li class="affnotifquota"></li>                
              </ul>
            </li>
            <!-- notification dropdown end -->
          </ul>
        </div>
        
        <div class="top-menu">
          <ul class="nav pull-right top-menu">
            <!-- Bouton deconnexion -->
            <li><a class="logout" href="?p=destroy"><span class="glyphicon  glyphicon-off"></span></a></li>            
            <!-- bouton user -->
            <li class="navbar-brand dropdown affuser">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?= $_SESSION['username']; ?> </a>
              <ul class="dropdown-menu">
                <address>               
                  <p class="text-center"><strong>Utilisateur: </strong></p>
                  <p id="nameUser" class="text-center"> <?= $_SESSION['name']; ?></p>

                  <input id="phoneUser" type="hidden" value="<?= $_SESSION['phone'] ?>"> <!-- hidden -->
                  <input id="niveauUser" type="hidden" value="<?= $_SESSION['niveau'] ?>"> <!-- hidden -->

                  <p class="text-center"><strong>Compte: </strong></p>
                  <p id="typeUser" class="text-center"><?= $_SESSION['type']; ?></p>
                  <button type="button" data-role="changeMP" data-id="<?= $_SESSION['auth']; ?>" class="btn btn-success btn-xs center-block">Changer Mot de Passe</button>
                </address> 
              </ul>
            </li>
            <!-- DATE -->
            <p class="navbar-brand datenavbar"><span class="glyphicon glyphicon-calendar"></span> <?= date('d/m/Y'); ?></p> 
          </ul>
        </div>
      </header>
      <!-- **********************************************************************************************************************************************************
          MAIN SIDEBAR MENU
          *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
        <div id="sidebar" class="nav-collapse ">
          <!-- sidebar menu start-->
          <ul class="sidebar-menu" id="nav-accordion">

            <li class="mt">
              <a class="item-A" href="?p=home"><i class="fa fa-building-o"></i><span>Accueil</span></a>
            </li>
            
            <li class="sub-menu I" hidden>
              <a class="item-I" href="javascript:;"><i class="fa fa-users"></i><span>Intervenant</span></a>
              <ul class="item-i sub">
                <li class="item-li"><a href="?p=contributors">Intervenants Extérieur</a></li>
                <li class="item-lii"><a href="?p=contributors.interne">Intervenants Interne</a></li>
                <li class="item-lc"><a href="?p=contacts">Contacts</a></li>
              </ul>
            </li>

            <li class="sub-menu M" hidden>
              <a class="item-M" href="javascript:;"><i class="fa fa-rocket"></i><span>Matériels</span></a>
              <ul class="item-m sub">
                <li class="item-lm"><a href="?p=materials">Liste Matériels</a></li>
                <li class="item-lml"><a href="?p=materialslier">Liste Matériels Lié</a></li>
                <li class="item-lmr"><a href="?p=materials.affRebus">Liste Matériels Rebus</a></li>
                <li class="item-epmmt"><a href="?p=materials.PMMT">Edition PMMT</a></li>
                <li class="item-enl"><a href="?p=places.LevelPlace">Edition Niveau, Lieux, Piéces</a></li>
                <li class="item-ea"><a href="?p=armoires">Edition Armoires</a></li>
              </ul>
            </li>

            <li class="sub-menu P" hidden>
              <a class="item-P" href="javascript:;"><i class="fa fa-book"></i><span>Pannes</span></a>
              <ul class="item-p sub">
                <li class="item-lp"><a href="?p=pannes">Liste Pannes</a></li>
              </ul>
            </li>

            <li class="sub-menu IN" hidden>
              <a class="item-In" href="javascript:;"><i class="fa fa-wrench"></i><span>Interventions</span></a>
              <ul class="item-in sub">
                <li class="item-lin"><a href="?p=intervs">Liste Interventions</a></li>
                <li class="item-lisp"><a href="?p=intervssanspanne">Interventions sans Pannes</a></li>
                <li class="item-licm"><a href="?p=intervscm">Interventions Contrat</a></li>
              </ul>
            </li>

            <li class="sub-menu D" hidden>
              <a class="item-D" href="javascript:;"><i class="fa fa-file"></i><span>Devis</span></a>
              <ul class="item-d sub">
                <li class="item-tld"><a href="?p=quotation">Tous les devis</a></li>
              </ul>
            </li>

            <li class="sub-menu DO" hidden>
              <a class="item-DO" href="?p=documents"><i class="fa fa-file-o"></i><span>Documents</span></a> 
            </li>

            <li class="sub-menu TJ" hidden>
              <a class="item-TJ" href="javascript:;"><i class="fa fa-calendar"></i><span>Travaux Journalier</span></a>
              <ul class="item-tj sub">
                <li class="item-lt"><a href="?p=dailyWorks">Liste Travaux</a></li>
                <li class="item-ej"><a href="?p=dailyEvents">Evénements Journalier</a></li>
              </ul>
            </li>

            <li class="sub-menu T" hidden>
              <a class="item-T" href="javascript:;"><i class="fa fa-phone"></i><span>Téléphones</span></a>
              <ul class="item-t sub">
                <li class="item-a"><a href="?p=phonesbook">Annuaire</a></li>
                <li class="item-ba"><a href="?p=phones.bandeau">Bandeau</a></li> 
                <li class="item-c"><a href="?p=links">Cheminement IPBX</a></li>                
                <li class="item-es"><a href="?p=services">Edition Service</a></li>                  
              </ul>                                
            </li>

            <li class="sub-menu EM" hidden>
              <a class="item-EM" href="?p=emails"><i class="fa fa-envelope"></i><span>EMail </span></a>
            </li>

            <li class="sub-menu BDC" hidden>
              <a class="item-BDC" href="?p=knowledges"><i class="fa fa-book"></i><span>Base De Connaissance</span></a>            
            </li>

            <li class="sub-menu FA" hidden>
              <a class="item-FA" href="javascript:;"><i class="fa fa-money"></i><span>Facturation</span></a>
              <ul class="item-fa sub">
                <li class="item-lcm"><a href="?p=listpratice">Liste Cabinet Médecins</a></li>
                <li class="item-icm"><a href="?p=intervsdoctors">Interv Cabinet Médecins</a></li>
                <li class="item-fam"><a href="?p=billings">Facture Cabinet Médecins</a></li>                  
              </ul>            
            </li>

            <li class="sub-menu RC" hidden>
              <a class="item-RC" href="javascript:;"><i class="fa fa-dashboard"></i><span>Relevés Compteurs</span></a>
              <ul class="item-rc sub">
                <li class="item-rcc CC"><a href="?p=meterreading">Compteurs Clinique</a></li>
                <li class="item-rcta CTA"><a href="?p=meterreading.cta">Compteurs CTA</a></li>                  
                <li class="item-rcec CEC"><a href="?p=meterreading.eau">Compteurs Eau Cabinet</a></li>                  
              </ul>  
            </li>

            <li class="sub-menu CR" hidden>
              <a class="item-CR" href="javascript:;"><i class="fa fa-folder-open"></i><span>Contrôles Réglementaires</span></a>
              <ul class="item-cr sub">
                <li class="item-c C"><a href="?p=controls">Contrôles</a></li>                 
                <li class="item-d D"><a href="?p=controls.documents">Documents</a></li>                 
              </ul>  
            </li>

            <li class="sub-menu CO" hidden>
              <a class="item-CO" href="?p=contracts"><i class="fa fa-suitcase"></i><span>Contrats</span></a> 
            </li>

            <li class="sub-menu PA" hidden>
              <a class="item-PA" href="javascript:;"><i class="fa fa-cogs"></i><span>Paramétrage</span></a>
              <ul id="Param" class="item-pa sub">
                <li class="item-ep"><a href="?p=params.email">Email</a></li>
                <li class="item-cp"><a href="?p=adduser">Créer un profil</a></li>
                <li class="item-vtu"><a href="?p=users.viewall">Voir tous les utilisateurs</a></li>                    
              </ul>
            </li>
          </ul>
          <!-- sidebar menu end-->
        </div>
      </aside>
      <!--sidebar end-->
      <!-- **********************************************************************************************************************************************************
          MAIN CONTENT
          *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12 main-chart">
              <div class="col-lg-12">
                <div id="info_user" class="" role="alert"></div>
                <div id="info_email" class="" role="alert"></div>
              </div>            
              <!-- /row -->
              <?= $content; ?>
            </div>            
          </div>
          <!-- /row -->
        </section>

        <!--footer start-->
        <footer class="site-footer">
          <div class="text-center">            
            <div class="credits">            
              <p>Auteur: Dautricourt Philippe<br><a href="mailto:servicetechnique@cliniquedeslandes.com">servicetechnique@cliniquedeslandes.com</a></p>
            </div>
            <a href="#" class="go-top">
              <i class="fa fa-angle-up"></i>
              </a>
          </div>
        </footer>
        <!--footer end-->
      </section>
      <!--main content end-->      
    </section>

      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->     

      <script src="../public/lib/bootstrap/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../public/lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
      <script class="include" type="text/javascript" src="../public/lib/jquery.dcjqaccordion.2.7.js"></script>
      <script src="../public/lib/jquery.scrollTo.min.js"></script>
      <script src="../public/lib/jquery.nicescroll.js"></script>     
      
      <script src="../public/js/validator.min.js"></script>
      <script src="../public/lib/DataTables/datatables.min.js"></script>

      <!-- common script for all page-->
      <script src="../public/lib/common-scripts.js"></script>
      <script type="text/javascript" src="../public/lib/gritter/js/jquery.gritter.js"></script>
      <script type="text/javascript" src="../public/lib/gritter-conf.js"></script>   

      <script src="../public/js/MonCode.js"></script>      

  </body>

</html>
<!-- modal profil user -->
<div id="ChangeMP" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Changer le mot de passe</h4>
      </div>
      <div class="modal-body">

        <form class="cmxform form-horizontal style-form" role="form" data-toggle="validator" method="post" id="CHMP">            

          <div class="form-group ">
            <label for="MP" class="control-label col-sm-12">Mot de passe: (8 caractére mini & au moins une Majuscule)</label>
            <div class="col-sm-12">
              <div class="input-group">
                <input type="password" id="MP" name="MP" class="form-control" placeholder="Entrer Le Mot de Passe" required>
                <span class="input-group-btn">
                  <button class="btn btn-default viewpass" data-id="MP" type="button">
                    <span id="span_eye" class="glyphicon glyphicon-eye-close"></span>
                  </button>
                </span>
              </div>                
            </div>
          </div>

          <div class="form-group ">              
            <div class="col-sm-12">
              <label for="MP2" class="control-label">Confirmer Votre Mot de passe: </label>
              <div class="input-group">                  
                <input type="password" id="MP2" name="MP2" class="form-control" placeholder="Retaper Le Mot de Passe" data-error="Veuillez retaper votre mot de passe" required>
                <span class="input-group-btn">
                  <button class="btn btn-default viewpass" data-id="MP2" type="button">
                    <span id="span_eye" class="glyphicon glyphicon-eye-close"></span>
                  </button>
                </span>
              </div>                
            </div>            
          </div>            

          <br>

          <div id="error_pwd" class="alert alert-danger danger-dismissable hidden">Les mot de passe ne sont pas indentique !!!</div>               
      
          <div class="modal-footer">                  
            <button type="submit" class="btn btn-success pull-right"><span class="glyphicon  glyphicon-ok"></span></button>
            <button type="reset" onclick="this.form.reset();" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon  glyphicon-remove"></span></button>
          </div>               

        </form>
      </div>
    </div>
  </div>
</div>

