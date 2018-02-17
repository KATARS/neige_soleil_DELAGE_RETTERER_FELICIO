<?php
include ("controler/controler.php");
include ("controler/logement.class.php");
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
          <a class="nav-link active" href="index.php?page=1">Louez a la montage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="portail.php">Espace Perso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?page=#">A propos</a>
        </li>
      </ul>
    </center>
    <?php
    $page =(isset($_GET['page']))? $_GET['page'] :0 ;
    switch($page)
    {
      case 1:
      $unControler= new Controler ("localhost","test","root","","logement",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      $resultats = $unControler->selectAll();
      include("vu/vulogement.php");
      break;
    }
    ?>
  </body>
</html>
