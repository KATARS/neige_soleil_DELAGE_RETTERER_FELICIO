<?php
session_start();
require("bddconnect.php");

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
  if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
  {
    ?>
    <html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href="style.css" rel="stylesheet" type="text/css">
    </head>
      <body></br>
        <h1>Panel Admin</h1></br>
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link active" href="panel.php?page=1">Liste Membre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="panel.php?page=2">Liste Propriétaire</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="panel.php?page=3">Liste Proriétées</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="request.php">Zone de Validation</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="panel.php?page=4">Historique des Rervations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="panel.php?page=5">Ajouter un bien</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Aller sur le site</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="panel.php?page=6">Deconnection</a>
          </li>
        </ul>
        <?php
        $page =(isset($_GET['page']))? $_GET['page'] :0 ;
        switch($page)
        {
          case 1:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
          {
            include("panel_liste1.php");
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;
          case 2:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
          {
            include("panel_liste2.php");
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;
          case 3:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
          {
            include("panel_liste3.php");
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;
          case 5:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
          {
            include("requestlogement.php");
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;
          case 6:
  				session_start(); //initialise debut de session
  				$_SESSION = array(); //recupere la session en cours
  				session_destroy(); //detruit la session
  				header("Location: index.php"); //retourne a l'accueil
  		    break;
        }
        ?>
      </body>
    </html>
    <?php
    }
    else
    {
  header("Location : index.php");
    }
  }
  else
  {
    header("Location : index.php");
  }
?>
