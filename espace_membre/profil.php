<?php
session_start();
require("../bddconnect.php");

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
	$id = intval($_GET['id']);
	$reponse = $bdd->prepare('SELECT * FROM utilisateur WHERE id = :id');
	$reponse->bindValue('id', $_GET['id'], PDO::PARAM_INT);
	$reponse->execute();
    $donnees = $reponse->fetch();
    $reponse->closeCursor();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profil</title>
		<link href="style3.css" rel="stylesheet" type="text/css">
	</head>
	<body>

			<div id="wrapper">
   		<div id="header" class="container">
			<div id="logo">
				<a href="#"><img src="../images/logos.png" width="220px"  alt="" /></a>
			</div>
			<div id="menu">
				<ul>
					<li><a href="../index.html">Accueil</a></li>
					<li><a href="#">A propos</a></li>
					<li><a href="../logements/logements.php">Se Loger</a></li>
					<li><a href="#">Contact</a></li>
					<li class="page_actuel"><a href="#">Mon Compte</a></li>
				</ul>
			</div>
		</div>
      <div class="form-style-6" align="center">
         <h1>ESPACE MEMBRE</h1>
		<div class="profil" align="center">
			<br/><br/>
			<h2>Profil</h2>
			<?php
			if(isset($_SESSION['id']) AND isset($_GET['id']) == $_SESSION['id'])
			{
				echo htmlspecialchars($donnees['email']);
				echo '<br/>';
				echo htmlspecialchars($donnees['nom']);
				echo '<br/>';
				echo htmlspecialchars($donnees['prenom']);
				echo '<br/>';
				echo htmlspecialchars($donnees['adresse']);
				echo '<br/>';
				echo htmlspecialchars($donnees['tel']);
				echo '<br/>';
				if($donnees['status'] !=="null")
				{
						echo 'Je suis propriétaire';
				}
				else
				{
					echo 'nique ta mere';
				}
			?>
			<br/><br/>
			
		</div>
	</div>
		
      </div>
			<br/><br/><br/>
			<input type="button" name="exitprofil" value="Deconnection !"
			onclick="self.location.href='deconnection.php'"onclick>
			<?php
			}
			?>
		</div>
	</body>
</html>
<?php
}
?>
