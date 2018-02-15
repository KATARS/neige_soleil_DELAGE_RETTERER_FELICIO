
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
      <h1>Neige & Soleil</h1></br></br>
        <h2> Menu de navigation</h2>
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link active" href="index.php?page=#">Louez a la montage</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="index.php?page=1">Liste Membre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="index.php?page=2">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="index.php?page=#">A propos</a>
          </li>
        </ul>
    </center>
    <?php
    $page =(isset($_GET['page']))? $_GET['page'] :0 ;
    $unControler= new Controler ("localhost","test","root","","user",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    switch($page){
      case 1:
      $resultats = $unControler->selectAll();
      include("vu/vu.php");
      break;
      case 2:
      include("vu/vuinsert.php");
      if(isset($_POST['valider'])){
        // insertion d'un nouvel eleve
        $unUser = new User ();
        $unUser->renseigner($_POST);
        $unControler->insert ($unUser);
        echo "insertion réussie";
      }
      break;
      case 3:
      break;
      case 4:
      break;

    }
     ?>
  </body>


</html>
