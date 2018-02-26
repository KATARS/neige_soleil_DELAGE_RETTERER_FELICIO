<?php
require("bddconnect.php");

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	if(isset($_SESSION['status']) AND $_SESSION['status'] = 9)
  {
		$reponse = $bdd->prepare('SELECT * FROM request');
		$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
		?>
    <center>
      <h2>Demande en attente</h2></br>
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
					echo "<td>".$data['validation']."</td></tr>";
				}
				$reponse->closeCursor();
				if(isset($_POST['autoriser']))
				{
					$id = $_POST['id'];
					$update = $bdd->prepare("UPDATE user SET status = 1 WHERE id = ?");
					$update->bindValue(1, $id, PDO::PARAM_INT);
					$update->execute();
					echo "<h6>Reussie</h6>";
				}
				if(isset($_POST['refuser']))
				{
					$id = $_POST['id'];
					$delete = $bdd->prepare("DELETE FROM request WHERE id = ?");
					$delete->bindValue(1, $id, PDO::PARAM_INT);
					$delete->execute();
					echo "<h6>Reussie</h6>";
				}

        ?>
      </table></br>
			<p>Pour effectuer une action sur une demande,</br>Veuillez renseigner l'ID de l'utilisateur</p>
			<form class="" action="" method="post">
				<label for="id">Renseigner ID User</label>
				<input type="text" name="id" value="" pattern="^[_0-9]{1,}$" minlength="1" maxlength="5"required></br>
				<button type="submit" class="btn btn-primary" name="autoriser">Autoriser</button>
				<button type="submit" class="btn btn-danger" name="refuser">Refuser</button>
			</form>
    </center>
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
