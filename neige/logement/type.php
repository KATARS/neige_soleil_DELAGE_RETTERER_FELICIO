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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="../style.css" rel="stylesheet" type="text/css">
	<title>Liste</title>
</head>
<body>
	<nav class="navbar navbar-inverse">
<div class="container-fluid">
	<div class="navbar-header">
		<a class="nav-link active" href="../index.php"><img src="../images/logos.png" alt="neige&soleil" width="110px"></a>
	</div>
				<ul class="nav navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" href="#">Catalogue</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="../apropos.php">A propos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="../contact.php">Contact</a>
					</li>
					<li class="nav-item" >
						<div class="alert alert-info" role="alert">
								<strong>-30% jusqu'au 03/06/2018</strong> sur les chalets familiales
						</div>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../profil/portail.php"><span class="glyphicon glyphicon-user"></span> Espace personnel</a></li>
				</ul>
			</div>
		</nav>
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
