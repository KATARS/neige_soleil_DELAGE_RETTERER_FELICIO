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
	    <link rel="stylesheet" href="../css/bootstrap.min.css">
	  </head>
	  <body>
    	<h1>Neige & Soleil</h1></br>
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Accueil</a>
          </li>
        </ul>
    	</br>
		  <h1>Espace Personnel</h1></br>
		  <p>Bienvenue <?php echo htmlspecialchars($_SESSION['civilite']); ?>
				<?php echo htmlspecialchars($_SESSION['nom']); ?>
				<?php echo htmlspecialchars($_SESSION['prenom']); ?>
				dans votre espace personnel</p>
		  <ul class="nav justify-content-center">
		    <li class="nav-item">
		      <a class="nav-link active" href="../logement/liste_type.php">Louer un bien</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link active" href="profil.php?page=1">Proposer un bien</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link active" href="deconnection.php">Deconnexion</a>
		    </li>
		  </ul></br>
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
					include("logement.php");
				}
				else {
					include("request.php");
				}
		    break;
				case 2:
				if(isset($_SESSION['status']) AND $_SESSION['status'] >= 1)
			  {
					include("logement_liste.php");
				}
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
