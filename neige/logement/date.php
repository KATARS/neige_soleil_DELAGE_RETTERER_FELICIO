<?php
session_start(); //initialise debut de session
require("bddconnect.php"); //connection bdd

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
  if(isset($_POST['choisirdate'])) //submit
  {
  	$datearr= $_POST['datearr'];
  	$datedep = $_POST['datedep'];
    $id = $_SESSION['id'];

  	if(!empty($_POST['datearr']) AND !empty($_POST['datedep']))
  	{
			$_SESSION['id'] = $id;
			$_SESSION['datearr'] = $datearr;
			$_SESSION['datedep'] = $datedep;
			header("Location: liste_type.php");
    }
  	else
  	{
  		$erreur = "Remplissez tous les champs !";
  	}
  }
  ?>
  <html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href="../style.css" rel="stylesheet" type="text/css">
      <title>Choisir Date</title>
    </head>
    <body>
      <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="nav-link active" href="../index.php"><img src="../images/logos.png" alt="neige&soleil" width="110px"></a>
      </div>
            <ul class="nav navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" href="#">Catalogue</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../apropos.php">A propos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../contact.php">Contact</a>
              </li>
              <li class="nav-item" >
                <div class="alert alert-info" role="alert">
                    <strong>-30% jusqu'au 03/06/2018</strong> sur les chalets familiales
                </div>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="../profil/portail.php"><span class="glyphicon glyphicon-user"></span> Espace personnel</a></li>
            </ul>
          </div>
        </nav>
      <center>
        </div>
            <div id="carouselFade" class="carousel slide carousel-fade" data-ride="carousel">

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img class="d-block img-fluid" src="../images/montagne1.jpg" alt="montagne1">
                        <div class="carousel-caption">
                          <h3>First slide label</h3>
                          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                        </div>
                    </div>
                    <div class="item">
                      <img class="d-block img-fluid" src="../images/montagne2.jpg" alt="montagne2">
                      <div class="carousel-caption">
                          <h1 class="super-heading">Lorem ipsum dolor color</h1>
                          <p class="super-paragraph">This is a demo for the Bootstrap Carousel Guide.</p>
                      </div>
                    </div>
                    <div class="item">
                      <img class="d-block img-fluid" src="../images/montagne3.jpg" alt="montagne3">
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
        <h2>Choisissez vos dates</h2></br>

      	<form method ="post" action ="">

      	  <table>
      	    <tr>
      	      <td><label for="datearr">Date Debut : </label></td>
      	      <td><input type="date" name="datearr" required></td>
      	    </tr>
      	    <tr>
      	      <td><label for="datedep">Date Fin </label></td>
      	      <td><input type="date" name="datedep" required></td>
      	    </tr>
      		</table>
      		</br>
      	    <button type="submit" class="btn btn-success" name="choisirdate">Valider</button>
      	</form>

      </center>


    </body>
  </html>
<?php
  }
  else {
    echo "<h5>Vous devez vous connecter pour reserver</h5>";
  }
 ?>
