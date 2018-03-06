<?php
session_start();
require("bddconnect.php");
if( isset( $_GET['idlogement'] ) and $_GET['idlogement'] > 0 )
{
  /*$reponse = $bdd->prepare('SELECT * FROM logement INNER JOIN reservation
    ON logement.idlogement = ?, logement.status = "Valide" AND logement.idreservation = reservation.logement_idreservation;');*/
  $reponse = $bdd->prepare('SELECT * FROM logement WHERE idlogement = ? AND status = "Valide";');
  $reponse->bindValue(1, $_GET['idlogement'], PDO::PARAM_INT);
  $reponse->execute();

  $data = $reponse->fetch();
  $reponse->closeCursor();
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
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../js/availability-calendar.js"></script>
        <title><?php echo htmlspecialchars($data['titre']); ?></title>
    </head>
    <body>
      <nav class="navbar navbar-inverse">
      <div class="container-fluid">
      <div class="navbar-header">
        <a class="nav-link active" href="../index.php"><img src="../images/logos.png" alt="neige&soleil" width="110px"></a>
      </div>
            <ul class="nav navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" href="liste_type.php">Catalogue</a>
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
      <div class="container">
        <div class="row">
            <div class="col-lg-4">
              <img width="300px" src="../profil/<?php echo $data['photo']; ?>"><br/>
              </div>
              <div class="col-lg-8">
    	<h3><span class="label label-info">Titre</span><?php echo stripslashes(htmlspecialchars($data['titre'])); ?>
        <br/>
        <span class="label label-info">Etage</span>
        <?php echo stripslashes(htmlspecialchars($data['etage'])); ?>
        <br/>
        <span class="label label-info">Region</span>
        <?php echo stripslashes(htmlspecialchars($data['emplacement'])); ?>
        <br/>
        <span class="label label-info">Taille (en m²)</span>
        <?php echo stripslashes(htmlspecialchars($data['taille'])); ?>
        <br/>
        <span class="label label-info">Prix (en €/jour)</span>
        <?php echo stripslashes(htmlspecialchars($data['prix'])); ?>
        <br/>
        <span class="label label-info">Caracteristiques</span>
        <?php echo stripslashes(htmlspecialchars($data['caracteristique'])); ?>
        <br/>
    </div>
  </div>
  <div class="row">
  <center><?php
      if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
      { ?>
          <div id="calendar">
            <script>
              var unavailableDates = [
                  {start: '2018-03-15', end: '2018-06-15'},
                  {start: '2018-09-15', end: '2018-11-15'},
                  {start: '2019-03-15', end: '2019-06-15'},
                  {start: '2019-09-15', end: '2019-11-15'},
                  {start: '2020-03-15', end: '2020-06-15'},
                  {start: '2020-09-15', end: '2020-11-15'},
              ];

              $('#calendar').availabilityCalendar(unavailableDates);
            </script>
        </div><?php
        include("date.php");
      }
      else {
        echo "Vous devez vous connecter pour reserver";
      }?></center></div>
      </div>
    </body>
</html>
