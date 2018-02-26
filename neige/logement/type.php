<?php
session_start();
require("bddconnect.php");

if(isset($_GET['idtype']) AND $_GET['idtype'] > 0)
{
	$reponse = $bdd->prepare('SELECT * FROM logement where idtype=?');
	$reponse->BindValue(1, $_GET['idtype'], PDO::PARAM_INT);
	$reponse->execute();
	$cat = $bdd->prepare('SELECT * FROM type where idtype=?');
	$cat->BindValue(1,$_GET['idtype'], PDO::PARAM_INT);
	$cat->execute();
}
?>
<html>
	<head><!-- haut de la page -->
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<title>Liste</title>
	</head>
	<body><br/>
		<h1>Bien disponible</h1>
		<title><?php echo htmlspecialchars($donnees['titre']); ?></title>
	</br>
		<?php
		while ($donnees = $reponse->fetch())
		{
			echo'<a href="logement.php?idlogement='.$donnees['idlogement'].'">'.stripslashes(htmlspecialchars($donnees['titre'])).'</a></br>';
		}
		$reponse->closeCursor();
		?>
	</body>
</html>
