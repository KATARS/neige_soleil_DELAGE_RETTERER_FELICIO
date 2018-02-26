<?php
require("bddconnect.php");

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	if(isset($_SESSION['status']) AND $_SESSION['status'] = 9)
  {
		$reponse = $bdd->prepare('SELECT * FROM user');
		$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
		?>
	<center>
		<h2>Liste membres</h2></br>
		<table border="2">
			<tr>
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
				<td>Id</td>
				<td>Status</td>
			</tr>
			<?php
			while ($data = $reponse->fetch())
			{
				echo "<tr><td>".$data['civilite']."</td>";
				echo "<td>".$data['nom']."</td>";
				echo "<td>".$data['prenom']."</td>";
				echo "<td>".$data['email']."</td>";
				echo "<td>".$data['adresse']."</td>";
				echo "<td>".$data['ville']."</td>";
				echo "<td>".$data['cp']."</td>";
				echo "<td>".$data['tel']."</td>";
				echo "<td>".$data['datebirth']."</td>";
				echo "<td>".$data['createdate']."</td>";
				echo "<td>".$data['id']."</td>";
				echo "<td>".$data['status']."</td></tr>";
			}
			$reponse->closeCursor();
			?>
		</table>
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
