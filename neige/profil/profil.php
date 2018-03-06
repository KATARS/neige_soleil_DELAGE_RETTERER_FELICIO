<?php
session_start();
require("bddconnect.php");

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	$id = intval($_SESSION['id']);
	$reponse = $bdd->prepare('SELECT * FROM user WHERE id = ?');
	$reponse->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
	$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
	?>
	<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	  <body>
			<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="nav-link active" href="./index.php"><img src="../images/logos.png" alt="neige&soleil" width="110px"></a>
	    </div>
	          <ul class="nav navbar-nav">
	            <li class="nav-item">
	              <a class="nav-link active" href="../logement/liste_type.php">Catalogue</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link active" href="apropos.php">A propos</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link active" href="contact.php">Contact</a>
	            </li>
	            <li class="nav-item" >
	              <div class="alert alert-info" role="alert">
	                  <strong>-30% jusqu'au 03/06/2018</strong> sur les chalets familiales
	              </div>
	            </li>
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Espace personnel</a></li>
	          </ul>
	        </div>
	      </nav>
		  <h1>Espace Personnel</h1></br>
		  <p>Bienvenue <?php echo htmlspecialchars($_SESSION['civilite']); ?>
				<?php echo htmlspecialchars($_SESSION['nom']); ?>
				<?php echo htmlspecialchars($_SESSION['prenom']); ?>
				dans votre espace personnel</p>
			<div class="btn-group-vertical" role="group" aria-label="Basic example">
	  		<button type="button" class="btn btn-secondary btn-lg" href="../logement/date.php">Louer un bien</button>
	  		<button type="button" class="btn btn-secondary btn-lg" href="profil.php?page=1">Proposer un bien</button>
	  		<button type="button" class="btn btn-secondary btn-lg" href="profil.php?page=3">Deconnection</button>
			</div>

	    <?php
			if(isset($_SESSION['status']) AND $_SESSION['status'] >= 1)
			{
				echo "</br><a href='profil.php?page=2'>Mes Biens</a>";
			}
			else {
				echo "";
			}
			if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
			{
				echo "</br><a href='panel.php'>Admin</a>";
			}
			else {
				echo "";
			}
		  $page =(isset($_GET['page']))? $_GET['page'] :0 ;
		  switch($page)
		  {
		    case 1:
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 1)
			  {
					include("requestlogement.php");
				}
				else {
					include("requestuser.php");
				}
		    break;
				case 2:
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 1)
			  {
					$id = intval($_SESSION['id']);
					$reponse = $bdd->prepare('SELECT * FROM logement WHERE id = ?');
					$reponse->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
					$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
					?>
					<center>
						<h2>Mes biens</h2></br>
						<table border="1">
							<tr>
								<td>Titre</td>
								<td>Emplacement</td>
								<td>Etages</td>
								<td>Prix (en €/jour)</td>
								<td>Taille (en m²)</td>
								<td>Type</td>
								<td>Caractéristiques</td>
								<td>Status</td>
							</tr>
							<?php
							while ($data = $reponse->fetch())
							{
								echo "<tr><td>".$data['titre']."</td>";
								echo "<td>".$data['emplacement']."</td>";
								echo "<td>".$data['etage']."</td>";
								echo "<td>".$data['prix']."</td>";
								echo "<td>".$data['taille']."</td>";
								echo "<td>".$data['idtype']."</td>";
								echo "<td>".$data['caracteristique']."</td>";
								echo "<td>".$data['status']."</td></tr>";
							}
							$reponse->closeCursor();
							?>
						</table>
					</center>
					<?php
				}
		    break;
				case 3:
				session_start(); //initialise debut de session
				$_SESSION = array(); //recupere la session en cours
				session_destroy(); //detruit la session
				header("Location: index.php"); //retourne a l'accueil
		    break;
			  }
	    ?>
	  	</body>
		</html>
	<?php
		}
		else
		{
			header("Location: portail.php");
		}
?>
