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
	      </nav><center>
		  <h1>Espace Personnel</h1></br>
		  <p>Bienvenue <?php echo htmlspecialchars($_SESSION['civilite']); ?>
				<?php echo htmlspecialchars($_SESSION['nom']); ?>
				<?php echo htmlspecialchars($_SESSION['prenom']); ?>
				dans votre espace personnel</p>
			<div class="btn-group-inline" role="group" aria-label="Basic example">
	  		<button type="button" class="btn btn-secondary btn-lg" onclick="location.href='../logement/liste_type.php';">Louer un bien</button>
				<button type="button" class="btn btn-secondary btn-lg" onclick="location.href='profil.php?page=2';">Mes reservations</button>
	  		<button type="button" class="btn btn-secondary btn-lg" onclick="location.href='profil.php?page=1';">Proposer un bien</button>
				<?php
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 1)
				{ ?>
					<button type='button' class='btn btn-secondary btn-lg' onclick='location.href="profil.php?page=4"'>Mes Biens</button>
				<?php
				}
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 9)
				{ ?>
					<button type='button' class='btn btn-secondary btn-lg' onclick='location.href="panel.php"'>Administration</button>
				<?php
				}
				?>
	  		<button type="button" class="btn btn-secondary btn-lg" onclick="location.href='profil.php?page=3';">Deconnection</button>
			</div></br>
	    <?php
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
				$id = intval($_SESSION['id']);
				$resa = $bdd->prepare('SELECT * FROM reservation INNER JOIN logement WHERE reservation.idlogement = logement.idlogement AND reservation.id = ?');
				$resa->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
				$resa->execute();
				?>
					<h2>Mes Reservations</h2></br>
					<table border="1">
						<tr>
							<td>Titre</td>
							<td>Emplacement</td>
							<td>Date Arrivée</td>
							<td>Date Depart</td>
							<td>Prix (en €/jour)</td>
						</tr>
						<?php
						while ($data = $resa->fetch())
						{
							echo "<tr><td>".$data['titre']."</td>";
							echo "<td>".$data['emplacement']."</td>";
							echo "<td>".$data['datearr']."</td>";
							echo "<td>".$data['datedep']."</td>";
							echo "<td>".$data['prix']."</td></tr>";
						}
						$reponse->closeCursor();
						?>
					</table>
				<?php
		    break;
				case 3:
				session_start(); //initialise debut de session
				$_SESSION = array(); //recupere la session en cours
				session_destroy(); //detruit la session
				header("Location: index.php"); //retourne a l'accueil
		    break;
				case 4:
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 1)
			  {
					$id = intval($_SESSION['id']);
					$reponse = $bdd->prepare('SELECT * FROM logement WHERE id = ?');
					$reponse->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
					$reponse->execute(); //recupere toute les info de l'user qui correspond a id de session en cours
					?>
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
					<?php
				}
		    break;
			  }
	    ?></center>
	  	</body>
		</html>
	<?php
		}
		else
		{
			header("Location: portail.php");
		}
?>
