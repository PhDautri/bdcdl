

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons -->
    <link href="../public/img/gcsM.ico" rel="icon">

    <!-- Bootstrap core CSS -->
    <link href="../public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">    
    <link href="../public/css/style.css" rel="stylesheet">   
    <link rel="stylesheet" href="../public/css/connection.css"/>   

    <!-- script-->  
    <script src="../public/lib/jquery/jquery.js"></script>      

    <title><?= App::getInstance()->title; ?></title>    
    
  </head>

  <body> 
    
     <!-- /.container -->

      <div class="container-fluid">

        <?= $content; ?>

      </div>
      
    
  </body>
  <!-- scripts js -->
  <script src="../public/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../public/js/validator.min.js"></script>
  <script src="../public/js/MonCodeLogin.js"></script>

  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="../public/lib/jquery/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("../public/img/img_societe/cdl.jpg", {
      speed: 500
    });
  </script>

</html>

