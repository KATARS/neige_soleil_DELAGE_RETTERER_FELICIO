<?php
session_start();
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="images/logos.png" alt="neige&soleil" width="110px">
    </div>
          <ul class="nav navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="./logement/liste_type.php">Louez à la montage</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="index.php?page=1">Espace Personnel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="index.php?page=2">A propos</a>
            </li>
            <li><a href="#">Page 2</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
      </nav>
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
