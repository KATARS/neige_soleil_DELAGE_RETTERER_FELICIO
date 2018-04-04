<?php
session_start();
if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
  header("Location: profil.php?id=".$_SESSION['id']);
}
else {
 ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
  <link href="../style.css" rel="stylesheet" type="text/css">
</head>
  <body><center>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="nav-link active" href="./index.php"><img src="../images/logos.png" alt="neige&soleil" width="110px"></a>
    </div>
          <ul class="nav navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="../logement/liste_type.php">Catalogue</a>
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
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Espace personnel</a></li>
          </ul>
        </div>
      </nav>
      <center>
  <h1 class="display-1">Espace Personnel</h1>
  <h1 class="display-2">Inscrivez vous afin de pouvoir louer un hébérgement</h2>
  <h2 class="display-2">Ou bien proposez votre bien à la location !</h2>
  <div class="btn-group btn-group-justified">
    <a  class="btn btn-primary" href="portail.php?page=1">Connection</a>
    <a  class="btn btn-primary" href="portail.php?page=2">Inscription</a>
  </div>
  <?php
  $page =(isset($_GET['page']))? $_GET['page'] :0 ;
  switch($page)
  {
    case 1:
    include("connection.php");
    break;
    case 2:
    include("inscription.php");
    break;
  }
  ?></center>
  </body>
</html>
<?php
}
?>
