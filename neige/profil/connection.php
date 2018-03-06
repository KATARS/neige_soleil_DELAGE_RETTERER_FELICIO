<?php //initialise debut de session
require("bddconnect.php"); //connection bdd

if(isset($_POST['executeconnect'])) //submit
{
	$email= $_POST['email'];
	$password = sha1($_POST['password']);

	if(!empty($_POST['email']) AND !empty($_POST['password']))
	{
		$reponse = $bdd->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
		$reponse->bindValue(1, $email, PDO::PARAM_STR);
		$reponse->bindValue(2, $password, PDO::PARAM_STR);
		$reponse->execute();
		$userexist = $reponse->rowCount(); //verifie si user existe
		if($userexist == 1) //si user existe lance la session
		{
			$donnees = $reponse->fetch(); //transmet ces données de session a profil.php
			$_SESSION['id'] = $donnees['id'];
			$_SESSION['status'] = $donnees['status'];
			$_SESSION['email'] = $donnees['email'];
			$_SESSION['civilite'] = $donnees['civilite'];
			$_SESSION['nom'] = $donnees['nom'];
			$_SESSION['prenom'] = $donnees['prenom'];

			if(isset($_SESSION['status']) AND $_SESSION['status'] <= 1)
			{
				header("Location: profil.php?id=".$_SESSION['id']);
			}
			else {
				header("Location: panel.php?id=".$_SESSION['id']);
			}
		}
		else
		{
			echo "<h5>Identifiants inconnus !</h5>";
		}
	}
	else
	{
		$erreur = "Remplissez tous les champs !";
	}
}
?>
<html>

	<body>
<div class="container-fluid">
  <form class="form-signin"method ="post" action ="">
    <h2 class="form-signin-heading">Connectez vous</h2>
    <label for="email" class="sr-only">Email</label>
    <input type="email" name="email" class="form-control" value="" pattern="^[@_A-z0-9.]{1,}$" placeholder="Email" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" name="password" value="" name="password" class="form-control" placeholder="Password" required>
		<button type="reset" class="btn btn-warning btn-block" name="reset">Réinitialiser</button>
		<button type="submit" class="btn btn-primary btn-block" name="executeconnect">Se Connecter</button>
  </form>
</div>

</body>
