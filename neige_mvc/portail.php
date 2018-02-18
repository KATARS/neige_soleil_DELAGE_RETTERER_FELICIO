<?php
include ("controler/controler.php");
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
    <p>Inscrivez vous afin de pouvoir louer un hébérgement</br>Ou bien proposez votre bien à la location !</p>
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="portail.php?page=1">Connection</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="portail.php?page=2">Inscription</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="profil.php">Profil</a>
      </li>
    </ul>
    <?php
    $page =(isset($_GET['page']))? $_GET['page'] :0 ;
    switch($page)
    {
      case 1:
      $controler= new Controler ("localhost","test","root","","user",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      include("vu/vuconnection.php");
      if(isset($_POST['valider']))
      {
        
      }
      break;
      case 2:
      $controler= new Controler ("localhost","test","root","","user",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      include("vu/vuinscription.php");
      if(isset($_POST['valider']))
      {
        // insertion d'un nouvel eleve
        $insert = new User ();
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
