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
              <a class="nav-link active" href="./logement/liste_type.php">Catalogue</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="index.php?page=1">A propos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="index.php?page=2">Contact</a>
            </li>
            <li class="nav-item" >
              <div class="alert alert-info" role="alert">
                  <strong>-30% jusqu'au 03/06/2018</strong> sur les chalets familiales
              </div>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="profil/inscription.php"><span class="glyphicon glyphicon-user"></span> s'inscrire</a></li>
            <li><a href="profil/connection.php"><span class="glyphicon glyphicon-log-in"></span> se connecter</a></li>
          </ul>
        </div>
      </nav>

    <center>
    </div>
        <div id="carouselFade" class="carousel slide carousel-fade" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img class="d-block img-fluid" src="images/montagne1.jpg" alt="montagne1">
                    <div class="carousel-caption">
                      <h3>First slide label</h3>
                      <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                    </div>
                </div>
                <div class="item">
                  <img class="d-block img-fluid" src="images/montagne2.jpg" alt="montagne2">
                  <div class="carousel-caption">
                      <h1 class="super-heading">Lorem ipsum dolor color</h1>
                      <p class="super-paragraph">This is a demo for the Bootstrap Carousel Guide.</p>
                  </div>
                </div>
                <div class="item">
                  <img class="d-block img-fluid" src="images/montagne3.jpg" alt="montagne3">
                    <div class="carousel-caption">
                      <h3>Third slide label</h3>
                      <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carouselFade" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carouselFade" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

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
