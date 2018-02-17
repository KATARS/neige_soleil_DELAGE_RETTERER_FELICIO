<?php
include ("controler/controler.php");
include ("controler/logement.class.php");
include ("controler/user.class.php");
?>
<html>
  <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body>
    <center>
      <h1>Neige & Soleil</h1></br>
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="index.php?page=1">Louez un bien</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profil.php?page=2">Proposez un bien</a>
          </li>
        </ul>
    <?php
    $page =(isset($_GET['page']))? $_GET['page'] :0 ;
    switch($page)
    {
      case 1:
      $unControler= new Controler ("localhost","test","root","","user",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

      include("vu/vuconnection.php");
      break;
      case 2:
      $unControler= new Controler ("localhost","test","root","","logement",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      include("vu/vuinsertlogement.php");
      if(isset($_POST['valider']))
      {
        // insertion d'un nouvel eleve
        $unLogement = new Logement ();
        $unLogement->renseignerLogement($_POST);
        $unControler->insertLogement($unLogement);
        echo "insertion réussie";
      }
      break;
    }
    ?>
    </center>
  </body>
</html>
