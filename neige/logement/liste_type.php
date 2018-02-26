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
	<br/><br/><br/><br/>
		<h1>Catégories</h1>
		<br/><br/><br/>
		<?php
		while ($donnees = $reponse->fetch())
		{
			echo'<a href="type.php?idtype='.$donnees['idtype'].'">'.stripslashes(htmlspecialchars($donnees['nom'])).'</a></br>';
		}
		$reponse->closeCursor();
		?>
	</body>
</html>
