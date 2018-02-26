<?php
require("bddconnect.php");

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	if(isset($_SESSION['status']) AND $_SESSION['status'] = 9)
  {
		$reponse = $bdd->prepare('SELECT * FROM user WHERE status = 1');
		$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
		?>
	<center>
		<h2>Liste Propriétaire</h2></br>
		<table border="2">
			<tr>
				<td>ID</td>
				<td>Civilite</td>
				<td>Nom</td>
				<td>Prenom</td>
				<td>Email</td>
				<td>Adresse</td>
				<td>Ville</td>
				<td>CP</td>
				<td>Téléphone</td>
				<td>Date Naissance</td>
				<td>Date Inscription</td>
				<td>Status</td>
			</tr>
			<?php
			while ($data = $reponse->fetch())
			{
				echo "<tr><td>".$data['id']."</td>";
				echo "<td>".$data['civilite']."</td>";
				echo "<td>".$data['nom']."</td>";
				echo "<td>".$data['prenom']."</td>";
				echo "<td>".$data['email']."</td>";
				echo "<td>".$data['adresse']."</td>";
				echo "<td>".$data['ville']."</td>";
				echo "<td>".$data['cp']."</td>";
				echo "<td>".$data['tel']."</td>";
				echo "<td>".$data['datebirth']."</td>";
				echo "<td>".$data['createdate']."</td>";
				echo "<td>".$data['status']."</td></tr>";
			}
			$reponse->closeCursor();
			if(isset($_POST['demote']))
			{
				$id = $_POST['id'];
				$update = $bdd->prepare("UPDATE user SET status = 0 WHERE id = ?");
				$update->bindValue(1, $id, PDO::PARAM_INT);
				$update->execute();
				echo "<h6>Reussie</h6>";
			}
			?>
		</table></br>
		<p>Pour effectuer une action sur un utilisateur,</br>Veuillez renseigner son ID</p>
		<form class="" action="" method="post">
			<label for="id">Renseigner ID</label>
			<input type="text" name="id" value="" pattern="^[_0-9]{1,}$" minlength="1" maxlength="5"required></br>
			<button type="submit" class="btn btn-danger" name="demote">Demote</button>
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
