<?php
session_start();
require("bddconnect.php");

if(isset($_GET['idtype']) AND $_GET['idtype'] > 0)
{
	$datearr = $_SESSION['datearr'];
	$datedep = $_SESSION['datedep'];
	$checkdate = $bdd->prepare('SELECT * FROM reservation WHERE datearr IS NOT = ? AND datedep IS NOT = ?;');
	$checkdate->BindValue(1, $datearr, PDO::PARAM_STR);
	$checkdate->BindValue(2, $datedep, PDO::PARAM_STR);

	$reponse = $bdd->prepare('SELECT * FROM logement WHERE idtype=? AND status = "Valide";');
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
		<h1>Neige & Soleil</h1></br>
			<ul class="nav justify-content-center">
				<li class="nav-item">
					<a class="nav-link active" href="index.php">Accueil</a>
				</li>
			</ul>
		</br>
		<p>Vous souhaitez voyager du <?php echo htmlspecialchars($_SESSION['datearr']); ?>
		au <?php echo htmlspecialchars($_SESSION['datedep']); ?>.</br>
		Voici nos biens disponible de la catégorie séléctionnée</p>
		<h2>Bien disponible</h2>
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
