<?php
session_start();
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="nav-link active" href="./index.php"><img src="images/logos.png" alt="neige&soleil" width="110px"></a>
    </div>
          <ul class="nav navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="./logement/liste_type.php">Catalogue</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="apropos.php">A propos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="contact.php">Contact</a>
            </li>
            <li class="nav-item" >
              <div class="alert alert-info" role="alert">
                  <strong>-30% jusqu'au 03/06/2018</strong> sur les chalets familiales
              </div>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="profil/portail.php"><span class="glyphicon glyphicon-user"></span> Espace personnel</a></li>
          </ul>
        </div>
      </nav>

    <center>
    </div>
        <div id="carouselFade" class="carousel slide carousel-fade" data-ride="carousel">

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

            <a class="left carousel-control" href="#carouselFade" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carouselFade" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

      <h2>Bienvenue sur Neige & Soleil</h2>
      <p>Leader de la location à la montagne</p></br>
      <h2>Pensez à reserver dès maintenant !</h2>
      <p>Nos meilleurs offres dans la section "Louez à la montagne"</p></br>
      <h2>Vous souhaitez mettre à disposition un bien immobilier ?</h2>
      <p>Rendez vous dans votre Espace Personnel</p>
    </center>
  </body>
</html>
