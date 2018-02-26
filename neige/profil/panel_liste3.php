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
          <td>Titre</td>
          <td>Emplacement</td>
          <td>Etages</td>
          <td>Prix (en €/jour)</td>
          <td>Taille (en m²)</td>
          <td>Type</td>
          <td>Caractéristiques</td>
					<td>Id User</td>
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
          echo "<td>".$data['caracteristique']."</td>";
					echo "<td>".$data['id']."</td></tr>";
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
