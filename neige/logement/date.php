<?php
session_start(); //initialise debut de session
require("bddconnect.php"); //connection bdd

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
  if(isset($_POST['choisirdate'])) //submit
  {
  	$datearr= $_POST['datearr'];
  	$datedep = $_POST['datedep'];
    $id = $_SESSION['id'];

  	if(!empty($_POST['datearr']) AND !empty($_POST['datedep']))
  	{
			$_SESSION['id'] = $id;
			$_SESSION['datearr'] = $datearr;
			$_SESSION['datedep'] = $datedep;
			header("Location: liste_type.php");
    }
  	else
  	{
  		$erreur = "Remplissez tous les champs !";
  	}
  }
  ?>
  <html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <title>Choisir Date</title>
    </head>
    <body>
      <h1>Neige & Soleil</h1></br>
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../profil/portail.php">Espace Perso</a>
          </li>
        </ul>
    	</br>
      <h2>Choisissez vos dates</h2></br>
      <center>
      	<form method ="post" action ="">
      	  <table>
      	    <tr>
      	      <td><label for="datearr">Date Debut : </label></td>
      	      <td><input type="date" name="datearr" required></td>
      	    </tr>
      	    <tr>
      	      <td><label for="datedep">Date Fin </label></td>
      	      <td><input type="date" name="datedep" required></td>
      	    </tr>
      		</table>
      		</br>
      	    <button type="submit" class="btn btn-success" name="choisirdate">Valider</button>
      	</form>
      </center>
    </body>
  </html>
<?php
  }
  else {
    echo "<h5>Vous devez vous connecter pour reserver</h5>";
  }
 ?>
