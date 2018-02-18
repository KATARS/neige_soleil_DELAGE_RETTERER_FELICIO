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
        </ul>
    </br>
    <h1>Espace Personnel</h1></br>
    <p>Bienvenue dans votre espace personnel</p>
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="profil.php?page=1">Louer un bien</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="profil.php?page=2">Proposer un bien</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="profil.php">Profil</a>
      </li>
    </ul></br>
    <?php
    $page =(isset($_GET['page']))? $_GET['page'] :0 ;
    switch($page)
    {
      case 1:
      $controler= new Controler ("localhost","test","root","","logement",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      $resultats = $controler->selectAll();
      include("vu/vulogement.php");
      break;
      break;
      case 2:
      $controler= new Controler ("localhost","test","root","","logement",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      include("vu/vuinsertlogement.php");
      if(isset($_POST['valider']))
      {
        // insertion d'un nouvel eleve
        $insert = new Logement ();
        $insert->renseigner($_POST);
        $controler->insert($insert);
        echo "insertion réussie";

      }
      break;
    }
    ?>
    </center>
  </body>
</html>
