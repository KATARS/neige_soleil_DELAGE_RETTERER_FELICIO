<style>
.index-content{
    margin-bottom:20px;
    padding:50px 0px;

}

.index-content .card{
    background-color:   #3e3e3e  ;
    padding:0;
    border-radius:8px;

}
.index-content .card:hover{
    box-shadow: 0 0 2em  #9f9f9f;
}
.index-content .card img{
    width:100%;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}

@media (max-width: 768px) {

    .index-content .col-lg-4 {
        margin-top: 20px;
    }
}

</style>
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
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
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
						<a class="nav-link active" href="../apropos.html">A propos</a>
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
	<div class="index-content">
		<?php
		while ($donnees = $reponse->fetch())
		{
		echo '
		<a href="logement.php?idlogement='.$donnees["idlogement"].'">
			<div class="col-lg-4">
				<div class="card">
		  		<img src="../profil/'.$donnees["photo"].'" alt="Card image"></a>
					<h3>'.$donnees["titre"].'</h3>
					<h3>'.$donnees["emplacement"].'</h3>
					<h3>A partir de '.$donnees["prix"].'€/jour</h3>

					<a href="logement.php?idlogement='.$donnees["idlogement"].'" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Reservez des maintenant</a>
				</div>
				</div>';
		}

		/*
		<a href="blog-ici.html">
		                <div class="col-lg-4">
		                    <div class="card">
		                        <img src="http://cevirdikce.com/proje/hasem-2/images/finance-1.jpg">
		                        <h4>Investment Strategy</h4>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		                        <a href="blog-ici.html" class="blue-button">Read More</a>
		                    </div>
		                </div>
		</a>
		*/
		$reponse->closeCursor();
		?>
	</div>
	</center>
	</body>
</html>
