<?php
session_start();
require("bddconnect.php");

	$reponse = $bdd->prepare('SELECT * FROM type');
	$reponse->execute();
?>
<html>
	<head><!-- haut de la page -->
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<title>Liste</title>
	</head>
	<body>
		<h1>Neige & Soleil</h1></br>
			<ul class="nav justify-content-center">
				<li class="nav-item">
					<a class="nav-link active" href="index.php">Accueil</a>
				</li>
			</ul>
		</br>
		<p>Vous souhaitez voyager du <?php echo htmlspecialchars($_SESSION['datearr']); ?>
		au <?php echo htmlspecialchars($_SESSION['datedep']); ?>.</br>
		Nous allons vous proposer tout nos biens disponibles pour cette periode</p>
		<h1>Catégories</h1></br>
		<?php
		while ($donnees = $reponse->fetch())
		{
			echo'<a href="type.php?idtype='.$donnees['idtype'].'">'.stripslashes(htmlspecialchars($donnees['nom'])).'</a></br>';
		}
		$reponse->closeCursor();
		?>
		</div>
		<div class="p-2"></div>
	</div>
	</body>
</html>
