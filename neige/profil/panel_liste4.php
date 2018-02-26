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
          <td>Id</td>
					<td>Date de demande</td>
					<td>Id User</td>
					<td>Email user</td>
        </tr>
        <?php
				while ($data = $reponse->fetch())
				{
          echo "<tr><td>".$data['idreq']."</td>";
          echo "<td>".$data['createdate']."</td>";
          echo "<td>".$data['id']."</td>";
					echo "<td>".$data['email']."</td></tr>";
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
