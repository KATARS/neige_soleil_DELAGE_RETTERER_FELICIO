<?php
session_start();
require("bddconnect.php");

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
  if(isset($_SESSION['status']) AND $_SESSION['status'] = 9)
  {
    ?>
  <html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
      <link href="../style.css" rel="stylesheet" type="text/css">
      <link href="../logement/calendrier/style_calendrier.css" rel="stylesheet" type="text/css">
    </head>
      <title>Requete</title>
    </head>
    <body></br><center>
      <h1>Panel Admin</h1></br>
      <nav class="nav">
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=1';">Liste Membres</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=2';">Liste Propriétaires</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=3';">Liste Propriétés</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='request.php';">Zone de Validation</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=4';">Historique Réservations</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=5';">Ajouter un bien</button></br></br>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='index.php';">Aller sur le site</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='panel.php?page=6';">Deconnection</button>
      </nav></br>
    <div class="d-flex justify-content-center">
      <div class="p-2">
        <h7>Demande de Statut</h7></br>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='request.php?page=1';">En Attente</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='request.php?page=2';">Validée</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='request.php?page=3';">Refusée</button></br>
      </div></br>
      <div class="p-2">
        <h7>Proposition de Logement</h7></br>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='request.php?page=4';">En Attente</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='request.php?page=5';">Valide</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='request.php?page=6';">Invalide</button></br>
      </div>
    </div></br>
    <?php
    $page =(isset($_GET['page']))? $_GET['page'] :0 ;
    switch($page)
    {
      case 1:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM request WHERE status = "En attente" AND idlogement IS NULL;');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
          <table border="2">
            <tr>
              <td>Id Req</td>
              <td>Id User</td>
              <td>Email user</td>
              <td>Date de demande</td>
              <td>Status</td>
            </tr>
            <?php
            while ($data = $reponse->fetch())
            {
              echo "<tr><td>".$data['idreq']."</td>";
              echo "<td>".$data['id']."</td>";
              echo "<td>".$data['email']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            if(isset($_POST['Valider']))
            {
              $id = $_POST['id'];
              $update = $bdd->prepare("UPDATE request SET request.status='Valide user' WHERE idreq = ?");
              $update->bindValue(1, $id, PDO::PARAM_INT);
              $update->execute();
              echo "<h6>Reussie</h6>";
            }
            if(isset($_POST['Refuser']))
            {
              $id = $_POST['id'];
              $delete = $bdd->prepare("UPDATE request SET request.status='Invalide user' WHERE idreq = ?");
              $delete->bindValue(1, $id, PDO::PARAM_INT);
              $delete->execute();
              echo "<h6>Reussie</h6>";
            }
            ?>
          </table></br>
          <p>Pour effectuer une action sur une demande,</br>Veuillez renseigner son ID</p>
          <form class="" action="" method="post">
            <label for="id">Renseigner ID Req</label>
            <input type="text" name="id" value="" pattern="^[_0-9]{1,}$" minlength="1" maxlength="5"required></br></br>
            <button type="submit" class="btn btn-primary" name="Valider">Autoriser</button>
            <button type="submit" class="btn btn-danger" name="Refuser">Refuser</button>
          </form>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 2:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM request WHERE status = "Valide user";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
          <table border="2">
            <tr>
              <td>Id Req</td>
              <td>Id User</td>
              <td>Email user</td>
              <td>Date de demande</td>
              <td>Status</td>
            </tr>
            <?php
            while ($data = $reponse->fetch())
            {
              echo "<tr><td>".$data['idreq']."</td>";
              echo "<td>".$data['id']."</td>";
              echo "<td>".$data['email']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            ?>
          </table>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 3:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM request WHERE status = "Invalide user";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
          <table border="2">
            <tr>
              <td>Id User</td>
              <td>Email user</td>
              <td>Id Req</td>
              <td>Date de demande</td>
              <td>Status</td>
            </tr>
            <?php
            while ($data = $reponse->fetch())
            {
              echo "<tr><td>".$data['id']."</td>";
              echo "<td>".$data['email']."</td>";
              echo "<td>".$data['idreq']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            ?>
          </table>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 4:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM request WHERE status = "En attente" AND idlogement IS NOT NULL;');
        $reponse->execute(); //recupere toute les info du logement qui correspond a id de session en cours
        ?>
          <table border="2">
            <tr>
              <td>Id Req</td>
              <td>Id User</td>
              <td>Email user</td>
              <td>Date de demande</td>
              <td>Status</td>
            </tr>
            <?php
            while ($data = $reponse->fetch())
            {
              echo "<tr><td>".$data['idreq']."</td>";
              echo "<td>".$data['id']."</td>";
              echo "<td>".$data['email']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            if(isset($_POST['Valide']))
            {
              $id = $_POST['id'];
              $update = $bdd->prepare("UPDATE request SET request.status='Valide logement' WHERE idreq = ?");
              $update->bindValue(1, $id, PDO::PARAM_INT);
              $update->execute();
              echo "<h6>Reussie</h6>";
            }
            if(isset($_POST['Invalide']))
            {
              $id = $_POST['id'];
              $delete = $bdd->prepare("UPDATE request SET request.status='Invalide logement' WHERE idreq = ?");
              $delete->bindValue(1, $id, PDO::PARAM_INT);
              $delete->execute();
              echo "<h6>Reussie</h6>";
            }
            ?>
          </table></br>
          <p>Pour effectuer une action sur une demande,</br>Veuillez renseigner son ID</p>
          <form class="" action="" method="post">
            <label for="id">Renseigner ID Req</label>
            <input type="text" name="id" value="" pattern="^[_0-9]{1,}$" minlength="1" maxlength="5"required></br></br>s
            <button type="submit" class="btn btn-primary" name="Valide">Valide</button>
            <button type="submit" class="btn btn-danger" name="Invalide">Invalide</button>
          </form>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 5:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM request WHERE status = "Valide logement";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
        <table border="2">
          <tr>
            <td>Id Req</td>
            <td>Id Logement</td>
            <td>Id User</td>
            <td>Email user</td>
            <td>Date de demande</td>
            <td>Status</td>
          </tr>
          <?php
          while ($data = $reponse->fetch())
          {
            echo "<tr><td>".$data['idreq']."</td>";
            echo "<td>".$data['idlogement']."</td>";
            echo "<td>".$data['id']."</td>";
            echo "<td>".$data['email']."</td>";
            echo "<td>".$data['createdate']."</td>";
            echo "<td>".$data['status']."</td></tr>";
          }
          $reponse->closeCursor();
          ?>
        </table>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 6:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM request WHERE status = "Invalide logement";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
          <table border="2">
            <tr>
              <td>Id Req</td>
              <td>Id Logement</td>
              <td>Id User</td>
              <td>Email user</td>
              <td>Date de demande</td>
              <td>Status</td>
            </tr>
            <?php
            while ($data = $reponse->fetch())
            {
              echo "<tr><td>".$data['idreq']."</td>";
              echo "<td>".$data['idlogement']."</td>";
              echo "<td>".$data['id']."</td>";
              echo "<td>".$data['email']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            ?>
          </table>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
    }
    ?>
  </center>
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
