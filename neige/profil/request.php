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
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <title>Requete</title>
    </head>
    <body></br>
      <h1>Panel Admin</h1></br>
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" href="panel.php?page=1">Liste Membre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="panel.php?page=2">Liste Propriétaire</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="panel.php?page=3">Liste Proriétées</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="request.php">Zone de Validation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="panel.php?page=4">Historique des Rervations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="panel.php?page=5">Ajouter un bien</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Aller sur le site</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="panel.php?page=6">Deconnexion</a>
        </li>
      </ul></br>
  <div class="d-flex justify-content-center">
    <div class="p-2">
    <h7>Demande de Statut</h7>
    <ul class="nav flex-column" valign="left">
      <li class="nav-item">
        <a class="nav-link active" href="request.php?page=1">En Attente</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="request.php?page=2">Validée</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="request.php?page=3">Refusée</a>
      </li>
    </ul></br>
  </div>
  <div class="p-2">
    <h7>Proposition de Logement</h7>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="request.php?page=4">En Attente</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="request.php?page=5">Valide</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="request.php?page=6">Invalide</a>
      </li>
    </ul>
  </div>
    </div>
    <?php
    $page =(isset($_GET['page']))? $_GET['page'] :0 ;
    switch($page)
    {
      case 1:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM requestuser WHERE status = "En attente";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
        <center>
          <table border="2">
            <tr>
              <td>Id User</td>
              <td>Id Req</td>
              <td>Email user</td>
              <td>Date de demande</td>
              <td>Status</td>
            </tr>
            <?php
            while ($data = $reponse->fetch())
            {
              echo "<tr><td>".$data['id']."</td>";
              echo "<td>".$data['idrequ']."</td>";
              echo "<td>".$data['email']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            if(isset($_POST['Valider']))
            {
              $id = $_POST['id'];
              $update = $bdd->prepare("UPDATE requestuser SET requestuser.status='Valider' WHERE id = ?");
              $update->bindValue(1, $id, PDO::PARAM_INT);
              $update->execute();
              echo "<h6>Reussie</h6>";
            }
            if(isset($_POST['Refuser']))
            {
              $id = $_POST['id'];
              $delete = $bdd->prepare("UPDATE requestuser SET requestuser.status='Refuser' WHERE idrequ = ?");
              $delete->bindValue(1, $id, PDO::PARAM_INT);
              $delete->execute();
              echo "<h6>Reussie</h6>";
            }
            ?>
          </table></br>
          <p>Pour effectuer une action sur une demande,</br>Veuillez renseigner l'ID de son utilisateur</p>
          <form class="" action="" method="post">
            <label for="id">Renseigner ID User</label>
            <input type="text" name="id" value="" pattern="^[_0-9]{1,}$" minlength="1" maxlength="5"required></br></br>
            <button type="submit" class="btn btn-primary" name="Valider">Autoriser</button>
            <button type="submit" class="btn btn-danger" name="Refuser">Refuser</button>
          </form>
        </center>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 2:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM requestuser WHERE status = "Valider";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
        <center>
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
              echo "<td>".$data['idrequ']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            ?>
          </table>
        </center>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 3:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM requestuser WHERE status = "Refuser";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
        <center>
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
              echo "<td>".$data['idrequ']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            ?>
          </table>
        </center>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 4:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM requestlogement WHERE status = "En attente";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
        <center>
          <table border="2">
            <tr>
              <td>Id User</td>
              <td>Id Req</td>
              <td>Email user</td>
              <td>Date de demande</td>
              <td>Status</td>
            </tr>
            <?php
            while ($data = $reponse->fetch())
            {
              echo "<tr><td>".$data['id']."</td>";
              echo "<td>".$data['idreql']."</td>";
              echo "<td>".$data['email']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            if(isset($_POST['Valide']))
            {
              $id = $_POST['id'];
              $update = $bdd->prepare("UPDATE requestlogement SET requestlogement.status='Valide' WHERE id = ?");
              $update->bindValue(1, $id, PDO::PARAM_INT);
              $update->execute();
              echo "<h6>Reussie</h6>";
            }
            if(isset($_POST['Refuser']))
            {
              $id = $_POST['id'];
              $delete = $bdd->prepare("UPDATE requestlogement SET requestlogement.status='Invalide' WHERE idrequ = ?");
              $delete->bindValue(1, $id, PDO::PARAM_INT);
              $delete->execute();
              echo "<h6>Reussie</h6>";
            }
            ?>
          </table></br>
          <p>Pour effectuer une action sur une demande,</br>Veuillez renseigner l'ID de son utilisateur</p>
          <form class="" action="" method="post">
            <label for="id">Renseigner ID User</label>
            <input type="text" name="id" value="" pattern="^[_0-9]{1,}$" minlength="1" maxlength="5"required></br></br>s
            <button type="submit" class="btn btn-primary" name="Valide">Valide</button>
            <button type="submit" class="btn btn-danger" name="Invalide">Invalide</button>
          </form>
        </center>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 5:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM requestlogement WHERE status = "Valide";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
        <center>
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
              echo "<td>".$data['idreql']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            ?>
          </table>
        </center>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
      case 6:
      if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
      {
        $reponse = $bdd->prepare('SELECT * FROM requestlogement WHERE status = "Invalide";');
        $reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
        ?>
        <center>
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
              echo "<td>".$data['idreql']."</td>";
              echo "<td>".$data['createdate']."</td>";
              echo "<td>".$data['status']."</td></tr>";
            }
            $reponse->closeCursor();
            ?>
          </table>
        </center>
        <?php
      }
      else {
        echo "<h5>Vous nous pouvez pas acceder à ce contenu</h5>";
      }
      break;
    }
    ?>
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
