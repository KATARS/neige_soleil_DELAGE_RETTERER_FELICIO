<?php
session_start();
require("bddconnect.php");

if(isset($_GET['idtype']) AND $_GET['idtype'] > 0)
{
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
						<a class="nav-link active" href="liste_type.php">Catalogue</a>
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
	</br><center>
		<h2>Bien disponible</h2>
	</br>
		<?php
		while ($donnees = $reponse->fetch())
		{
		echo '<div class="card">
		  <div class="card-body">
		    <p class="card-text">'.$donnees["titre"].'</p>
				<p class="card-text"> '.$donnees["emplacement"].'</p>
		  </div>
		  <a href="logement.php?idlogement='.$donnees["idlogement"].'"><img src="../profil/'.$donnees["photo"].'" alt="Card image"></a>
		  <div class="card-body">
		    <p class="card-text">A partir de '.$donnees["prix"].'€ par jour</p>
		  </div>
		</div>';
		}
		$reponse->closeCursor();
		?></center>
	</body>
</html>
