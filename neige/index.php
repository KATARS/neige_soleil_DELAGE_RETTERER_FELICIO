<?php
session_start();
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
          <a class="nav-link active" href="./logement/liste_type.php">Louez à la montage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?page=1">Espace Personnel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?page=2">A propos</a>
        </li>
      </ul></br>
      <h2>Bienvenue sur Neige & Soleil</h2>
      <p>Leader de la location à la montagne</p></br>
      <h2>Pensez à reserver dès maintenant !</h2>
      <p>Nos meilleurs offres dans la section "Louez à la montagne"</p></br>
      <h2>Vous souhaitez mettre à disposition un bien immobilier ?</h2>
      <p>Rendez vous dans votre Espace Personnel</p>
      <?php
        $page =(isset($_GET['page']))? $_GET['page'] :0 ;
        switch($page)
        {
          case 1:
          if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
          {
            header("Location: ./profil/profil.php?id=".$_SESSION['id']);
          }
          else {
            header("Location: ./profil/portail.php");
          }
          break;
        }
      ?>
    </center>
  </body>
</html>
