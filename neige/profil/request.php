<?php
require("bddconnect.php");
if(isset($_SESSION['id']) AND $_SESSION['id'] > 0) //recupere id de session si id = 0 ou session = 0 retourne a l'index
{
  if(isset($_POST['valider']))
  {
    $id = $_SESSION['id'];
		$email = $_SESSION['email'];
    $validation = $_POST['validation'];
	  $createdate = date('Y-m-d');
  	$insertrequest = $bdd->prepare('INSERT INTO request(id,email,createdate,validation)
    VALUES(?,?,?,?)') or die(print_r($bdd->errorInfo()));
		$insertrequest->bindValue(1, $id, PDO::PARAM_INT);
  	$insertrequest->bindValue(2, $email, PDO::PARAM_STR);
  	$insertrequest->bindValue(3, $createdate, PDO::PARAM_STR);
    $insertrequest->bindValue(4, $validation, PDO::PARAM_STR);
  	$insertrequest->execute();
  	echo "<h6>Demande envoyée !</h6><p>Vous aurez une réponse sous 24h.</p>";
  }
  ?>
  <center>
    <h3>Demande de status</h3></br>
		<p>En effectuant cette demande vous devenez un membre sous contrat avec la société Neige & Soleil.</br>
			Ce status vous affecte des responsablités envers sa communautée.</br>
			<a href="cgu.html">Cliquez ici pour en savoir plus</a></p></br>
    <form method ="post" action ="">
			<table>
				<tr>
					<td><input type="hidden" name="validation" value="waiting.."> </td>
					<td><div class="custom-control custom-checkbox mb-3">
		      <input type="checkbox" class="custom-control-input" id="customControlValidation1" required>
		      <label class="custom-control-label" for="customControlValidation1">Accepter les CGU et créer un contrat</label></td>
				</tr>
			</table>
      </br>
      <button type="submit" class="btn btn-success" name="valider">Soumettre</button>
    </center>
  <?php
  }
else
{
  header("Location: index.php");
}
?>
