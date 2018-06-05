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
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
      <link href="../style.css" rel="stylesheet" type="text/css">
      <link href="../logement/calendrier/style_calendrier.css" rel="stylesheet" type="text/css">
    </head>
      <body></br><center>
        <h1>Panel Admin</h1></br>
        <nav class="nav">
          <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=1';">Liste Membres</button>
          <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=2';">Liste Propriétaires</button>
          <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=3';">Liste Propriétés</button>
          <!--<button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=7';">Contrats</button>-->
          <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='request.php';">Zone de Validation</button>
          <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=4';">Historique Réservations</button>
          <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=5';">Ajouter un bien</button></br></br>
          <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='index.php';">Aller sur le site</button>
          <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=6';">Deconnection</button>
        </nav>
        <?php
        $page =(isset($_GET['page']))? $_GET['page'] :0 ;
        switch($page)
        {
          case 1:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9) //si user pas admin, page bloqué
          {
            include("panel_liste1.php"); //liste user
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;
          case 2:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
          {
            include("panel_liste2.php"); //liste proprio
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;
          case 3:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
          {
            include("panel_liste3.php"); //liste biens
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;
          case 4:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
          {
            include("cal_admin.php"); //calendrier admin
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;
          case 5:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
          {
            include("requestlogement.php"); //request
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;
          case 6:
  				$_SESSION = array(); //recupere la session en cours
  				session_destroy(); //detruit la session
  				header("Location: index.php"); //retourne a l'accueil
  		    break;
          /*case 7:
          if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
          {
            if(isset($_POST['execute']))
            {
            $stmt = $bdd->prepare("CALL afficher_contratloc_idres(?)");
            $idres = $_POST['idres'];
            $stmt->bindParam(1, $idres, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);

            // appel de la procédure stockée
            $stmt->execute();
            print $idres;
            }
            ?>
            <label for="idres">Renseignez ID reservation<br/>pour afficher ses informations</label>
            <input type="text" name="idres" placeholder="ID">
            <input type="submit" name="execute">
            <?php
          }
          else {
            echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
          }
          break;*/
        }
        ?></center></br>
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
