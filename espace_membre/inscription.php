<?php
session_start();
require("../bddconnect.php");

if(isset($_POST['execute']))
{
	$_GET['email'] = ($_POST['email']);
	$_GET['email2'] = ($_POST['email2']);
	$_GET['nom'] = ($_POST['nom']);
	$_GET['prenom'] = ($_POST['prenom']);
	$_GET['tel'] = ($_POST['tel']);
	$_GET['adresse'] = ($_POST['adresse']);
	$_GET['mdp'] = sha1($_POST['mdp']);
	$_GET['mdp2'] = sha1($_POST['mdp2']);

	if(!empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{
		if($_GET['email'] == $_GET['email2'])
		{
			if(filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
			{
				$reqemail = $bdd->prepare("SELECT * FROM utilisateur WHERE email= :email");
				$reqemail->bindValue('email', $_GET['email'], PDO::PARAM_STR);
				$reqemail->execute();
				$emailexist = $reqemail->rowCount();
				if($emailexist == 0)
				{
					if($_GET['mdp'] == $_GET['mdp2'])
					{
						$mdplength = strlen($_GET['mdp']);
						if($mdplength > 6)
						{
							if (ctype_alpha($_GET['nom']) AND ctype_alpha($_GET['prenom'])){
								$tellength = strlen($_GET['tel']);
								if($tellength == 10 OR $tellength==12){



							$insertmbr = $bdd->prepare("INSERT INTO utilisateur(email, nom, prenom, tel,adresse, mdp) VALUES(:email, :nom, :prenom, :tel, :adresse, :mdp)");
							$insertmbr->bindValue('email', $_GET['email'], PDO::PARAM_STR);
							$insertmbr->bindValue('nom', $_GET['nom'], PDO::PARAM_STR);
							$insertmbr->bindValue('prenom', $_GET['prenom'], PDO::PARAM_STR);
							$insertmbr->bindValue('tel', $_GET['tel'], PDO::PARAM_STR);
							$insertmbr->bindValue('adresse', $_GET['adresse'], PDO::PARAM_STR);
							$insertmbr->bindValue('mdp', $_GET['mdp'], PDO::PARAM_STR);
							$insertmbr->execute();
							$erreur = "Inscription réussie";
							}
							else{
								$erreur = "votre telephone doit contenir 10 ou 12 caractères(format +336... ou 06...)";
							}
							}
							else{
								$erreur = "votre nom et votre prenom ne doivent contenir que des lettres";
							}
						}
						else
						{
							$erreur = "Mot de passe trop court, 6 caractères obligatoire";
						}
				}
				else
				{
					$erreur = "les mots de passes ne correspondent pas";
				}
			}
			else
			{
				$erreur = "Votre email est déjà utilisé";
			}
		}
	}
	else
	{
		$erreur = "Vos  emails ne correspondent pas.";
	}
}
else
{
	$erreur = "Remplissez tout les champs obligatoires";
}
}
?> </div>
<html>
	<head>
		<meta charset="utf-8">
		<link href="style3.css" rel="stylesheet" type="text/css">
		<title>Inscription</title>
	</head>
	<body>
		<div align="center">
			<br/><br/>
			<h1>Inscription</h1>
			<br/>
			<form method="POST" action="inscription.php">
			<div class="infobox">
				<table><center>
					<table>
					<tr>
						<td><label for="nom">Nom :</label></td>
						<td><input type="text" name="nom" placeholder="Nom"/></td>
					</tr>
					<tr>
						<td><label for="nom">Prenom :</label></td>
						<td><input type="text" name="prenom" placeholder="Prénom"/></td>
					</tr>
					<tr>
						<td><label for="nom">Email :</label></td>
						<td><input type="email" placeholder="Votre email" id="email" name="email" value="<?php if(isset($_GET['email'])) { echo $_GET['email']; } ?>"/></td>
					</tr>
					<tr>
						<td><label for="nom">Confirmer Email :</label></td>
						<td><input type="email" placeholder="Confirmez votre email" id="email2" name="email2" value="<?php if(isset($_GET['email2'])) { echo $_GET['email2']; } ?>"/>
						</td>
					</tr>
					<tr>
						<td><label for="nom">Téléphone :</label></td>
						<td><input type="text" name="tel" placeholder="Télephone"/>
						</td>
					</tr>
					<tr>
						<td><label for="nom">adresse :</label></td>
						<td><input type="text" name="adresse" placeholder="adresse"/>
						</td>
					</tr>
					<tr>
						<td><label for="nom">Mot de passe :</label></td>
						<td><input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"/>
						</td>
					</tr>
					<tr>
						<td><label for="mdp2">Confirmer mot de passe</label></td>
						<td><input type="password" id="mdp2" name="mdp2"/></td>
					</tr>
				</table></center>
				<br/>
				<input type="submit" name="execute" value="Inscription"/><br/><br/>
				<input type="button" name="connection" value="Déjà inscrit ?"
				onclick="self.location.href='connection.php'"onclick>
			</div>
			</form>
			<?php
			if(isset($erreur))
			{
					echo '<div class="err">' .$erreur. "</div>";
			}
			?>
		</div>
	</body>
</html>
