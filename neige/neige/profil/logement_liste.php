<?php
require("bddconnect.php");

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	$id = intval($_SESSION['id']);
	$reponse = $bdd->prepare('SELECT * FROM logement WHERE id = ?');
	$reponse->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
	$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
	?>

	<center>
		<h2>Mes biens</h2></br>
		<table border="1">
			<tr>
				<td>Titre</td>
				<td>Emplacement</td>
				<td>Etages</td>
				<td>Prix (en €/jour)</td>
				<td>Taille (en m²)</td>
				<td>Type</td>
				<td>Caractéristiques</td>
			</tr>
			<?php
			while ($data = $reponse->fetch())
			{
				echo "<tr><td>".$data['titre']."</td>";
				echo "<td>".$data['emplacement']."</td>";
				echo "<td>".$data['etage']."</td>";
				echo "<td>".$data['prix']."</td>";
				echo "<td>".$data['taille']."</td>";
				echo "<td>".$data['idtype']."</td>";
				echo "<td>".$data['caracteristique']."</td></tr>";
			}
			$reponse->closeCursor();
			?>
		</table>
	</center>
<?php
}
else {
	header("Location : index.php");
} ?>
