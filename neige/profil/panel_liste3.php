<?php
require("bddconnect.php");

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	if(isset($_SESSION['status']) AND $_SESSION['status'] = 9)
  {
		$reponse = $bdd->prepare('SELECT * FROM logement');
		$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
		?>
    <center>
      <h2>Liste Propriétés</h2></br>
      <table border="2">
        <tr>
					<td>ID</td>
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
					echo "<tr><td>".$data['idlogement']."</td>";
          echo "<td>".$data['titre']."</td>";
          echo "<td>".$data['emplacement']."</td>";
          echo "<td>".$data['etage']."</td>";
          echo "<td>".$data['prix']."</td>";
          echo "<td>".$data['taille']."</td>";
          echo "<td>".$data['idtype']."</td>";
          echo "<td>".$data['caracteristique']."</td></tr>";
				}
				$reponse->closeCursor();
				if(isset($_POST['delete']))
				{
					$id = $_POST['id'];
					$update = $bdd->prepare("DELETE FROM user WHERE id = ?");
					$update->bindValue(1, $id, PDO::PARAM_INT);
					$update->execute();
					echo "<h6>Reussie</h6>";
				}
				?>
			</table></br>
			<p>Pour effectuer une action sur une propriété,</br>Veuillez renseigner son ID</p>
			<form class="" action="" method="post">
				<label for="id">Renseigner ID</label>
				<input type="text" name="id" value="" pattern="^[_0-9]{1,}$" minlength="1" maxlength="5"required></br>
				<button type="submit" class="btn btn-danger" name="delete">Supprimer</button>
			</form>
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
