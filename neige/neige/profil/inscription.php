<?php
require("bddconnect.php");
if(isset($_POST['execute']))
{
	$civilite = $_POST['civilite'];
	$nom = mb_strtoupper($_POST['nom']); //met tout en majuscule
	$prenom = ucfirst($_POST['prenom']); //met le premier caractere en majuscule
	$email = $_POST['email'];
	$email2 = $_POST['email2'];
	$password = sha1($_POST['password']); //hash sha1
	$password2 = sha1($_POST['password2']);
	$adresse = $_POST['adresse'];
	$ville = mb_strtoupper($_POST['ville']);
	$cp = $_POST['cp'];
	$tel = $_POST['tel'];
	$datebirth = $_POST['datebirth'];
	$status = $_POST['status'];
	$createdate = date('Y-m-d'); //note heure creation

	if(!empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
	{
		if($email == $email2)
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) //verifie que c'est bien un type mail
			{
				$reqemail = $bdd->prepare("SELECT * FROM user WHERE email= ?");
				$reqemail->bindValue(1, $email, PDO::PARAM_STR);
				$reqemail->execute();
				$emailexist = $reqemail->rowCount(); //verifie si l'email est libre
				if($emailexist == 0)
				{
					if($password == $password2)
					{
					$insertmbr = $bdd->prepare("INSERT INTO user
						(civilite,nom,prenom,email,password,adresse,ville,cp,tel,datebirth,status,createdate)
						VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
					$insertmbr->bindValue(1, $civilite, PDO::PARAM_STR);
					$insertmbr->bindValue(2, $nom, PDO::PARAM_STR);
					$insertmbr->bindValue(3, $prenom, PDO::PARAM_STR);
					$insertmbr->bindValue(4, $email, PDO::PARAM_STR);
					$insertmbr->bindValue(5, $password, PDO::PARAM_STR);
					$insertmbr->bindValue(6, $adresse, PDO::PARAM_STR);
					$insertmbr->bindValue(7, $ville, PDO::PARAM_STR);
					$insertmbr->bindValue(8, $cp, PDO::PARAM_INT);
					$insertmbr->bindValue(9, $tel, PDO::PARAM_STR);
					$insertmbr->bindValue(10, $datebirth, PDO::PARAM_STR);
					$insertmbr->bindValue(11, $status, PDO::PARAM_INT);
					$insertmbr->bindValue(12, $createdate, PDO::PARAM_STR);
					$insertmbr->execute(); //ajout des donnees dans la bdd
					echo "<h6>Inscription réussie</h6><p>Veuillez vous connecter</p>";
					}
					else
					{
						echo "<h5>Vos mots de passe ne correspondent pas.</h5>";
					}
				}
				else
				{
					echo "<h5>Adresse email en utilisation !</h5>";
				}
			}
			else
			{
				echo "<h5>Votre adresse email n'est pas valide !</h5>";
			}
		}
		else
		{
			echo "<h5>Vos adresses emails ne correspondent pas.</h5>";
		}
	}
	else
	{
		echo "<h5>Remplissez tout les champs</h5>";
	}
}
?>
<h2> Inscription </h2></br>
<center>
	<div class="container-fluid">
	<form method ="post" action ="">
	  <table>
	    <tr>
	      <td><label for="civilite">Civilité : </label></td>
	      <td>Mr. <input type="radio" name="civilite" value="Mr" required>
	      		Mme. <input type="radio" name="civilite" value="Mme" required></td>
	    </tr>
	    <tr>
	      <td><label for="nom">Nom : </td>
	      <td><input class="form-control" type="text" name="nom" value="" pattern="^[_A-zéèçêïîÏÎ]{1,}$" required></td>
	    </tr>
	    <tr>
	      <td><label for="prenom">Prénom : </label></td>
	      <td><input class="form-control" type="text" name="prenom" value="" pattern="^[_A-zéèçêïîÏÎ]{1,}$" required></td>
	    </tr>
	    <tr>
	      <td><label for="email">Email : </label></td>
	      <td><input class="form-control" type="email" name="email" value="" pattern="^[@_A-z0-9.]{1,}$" required></td>
	    </tr>
			<tr>
	      <td><label for="email2">Confirmation : </label></td>
	      <td><input class="form-control" type="email" name="email2" value="" pattern="^[@_A-z0-9.]{1,}$" required></td>
	    </tr>
	    <tr>
	      <td><label for="password">Mot de passe : </label></td>
	      <td><input class="form-control" type="password" name="password" value="" minlength="6" required></td>
	    </tr>
			<tr>
	      <td><label for="password2">Confirmation : </label></td>
	      <td><input class="form-control" type="password" name="password2" value="" minlength="6" required></td>
	    </tr>
	    <tr>
	      <td><label for="adresse">Adresse : </label></td>
	      <td><input class="form-control" type="text" name="adresse" value="" pattern="^[_ A-z0-9]{1,}$" required></td>
	    </tr>
	    <tr>
	      <td><label for="ville">Ville </label></td>
	      <td><input class="form-control" type="text" name="ville" value="" pattern="^[_A-zéèçêïîÏÎ]{1,}$" required></td>
	    </tr>
	    <tr>
	      <td><label for="cp">Code Postal: </label></td>
	      <td><input class="form-control" type="text" name="cp" value="" pattern="^[_0-9]{1,}$" minlength="5" maxlength="5"required></td>
	    </tr>
	    <tr>
	      <td><label for="tel">Téléphone: </label></td>
	      <td><input class="form-control" type="text" pattern="^[+_0-9]{1,}$" name="tel" maxlength="12" minlength="10" required></td>
	    </tr>
	    <tr>
	      <td><label for="datebirth">Date de Naissance</label></td>
	      <td><input class="form-control" name="datebirth" type="date" required/></td>
	    </tr>
	    <tr>
	      <td><input type="hidden" name="status" value="0">
	        	<button type="reset" class="btn btn-warning btn-block" name="reset">Réinitialiser</button></td>
	      <td><button type="submit" class="btn btn-primary btn-block" name="execute">S'inscrire</button></td>
	    </tr>
	  </table>
	</form>
</div>
</center>
