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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
  <body>
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
  </ul>
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
  ?>
  </body>
</html>
<?php
}
?>
