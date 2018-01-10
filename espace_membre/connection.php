<?php
session_start();

require("../bddconnect.php");

if(isset($_POST['executeconnect']))
{
	$_GET['email'] = ($_POST['emailconnect']);
	$_GET['mdp'] = sha1($_POST['mdpconnect']);
	if(!empty($_POST['emailconnect']) AND !empty($_POST['mdpconnect']))
	{
		$reponse = $bdd->prepare("SELECT * FROM utilisateur WHERE email = :email AND mdp = :mdp");
		$reponse->bindValue('email', $_GET['email'], PDO::PARAM_STR);
		$reponse->bindValue('mdp', $_GET['mdp'], PDO::PARAM_STR);
		$reponse->execute();
		$userexist = $reponse->rowCount();
		if($userexist == 1)
		{
			$donnees = $reponse->fetch();
			$_SESSION['id'] = $donnees['id'];
			$_SESSION['email'] = $donnees['email'];
			header("Location: profil.php?id=".$_SESSION['id']);
		}
		else
		{
			$erreur = "Identifiants inconnus !";
		}
	}
	else
	{
		$erreur = "Remplissez tous les champs !";
	}
}


?>
<html>
	<head>
		<meta charset="utf-8">
		<link href="style3.css" rel="stylesheet" type="text/css">
		<title>Connection</title>
	</head>
	<body>
		<div align="center"><br/><br/><br/><br/>
			<h1>Connection</h1>
			<br/>
			<div class="infobox">
				<form method="POST" action="">
					<input type="text" name="emailconnect" placeholder="email"/>
					<input type="password" name="mdpconnect" placeholder="Mot de passe"/><br/><br/><br/><br/>
					<input type="submit" name="executeconnect" value="Connection !"/>
				</form>
			</div>
			<?php
				if(isset($erreur))
				{
					echo '<div class="erreur">' .$erreur. "</div>";
				}
			?>
		</div>
	</body>
</html>
