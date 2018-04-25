<?php
session_start();
require('profil/bddconnect.php');

if(isset($_POST['execute'])) //submit
{
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $message = $_POST['msg'];
  $createdate = date('Y-m-d');

  $contact = $bdd->prepare("INSERT INTO contact
    (nom,prenom,email,message,createdate)
    VALUES(?,?,?,?,?)");
  $contact->bindValue(1, $nom, PDO::PARAM_STR);
  $contact->bindValue(2, $prenom, PDO::PARAM_STR);
  $contact->bindValue(3, $email, PDO::PARAM_STR);
  $contact->bindValue(4, $message, PDO::PARAM_STR);
  $contact->bindValue(5, $createdate, PDO::PARAM_STR);
  $contact->execute();
}
?>
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <link href="style.css" rel="stylesheet" type="text/css">
    <title>Contact</title>
  </head>
  <body><center>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="nav-link active" href="./index.php"><img src="images/logos.png" alt="neige&soleil" width="110px"></a>
    </div>
          <ul class="nav navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="./logement/liste_type.php">Catalogue</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="apropos.html">A propos</a>
            </li>
            <li class="nav-item">
              <a class="btn disabled" href="contact.php">Contact</a>
            </li>
            <li class="nav-item" >
              <div class="alert alert-info" role="alert">
                  <strong>-30% jusqu'au 03/06/2018</strong> sur les chalets familiales
              </div>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="profil/portail.php"><span class="glyphicon glyphicon-user"></span> Espace personnel</a></li>
          </ul>
        </div>
      </nav></br></br>
      <p>Vous souhaitez nous faire part de votre avis ou d'un problème ?</br>
        C'est ici !</p></br>
    	<div class="container-fluid">
    	<form method ="post" action ="">
    	  <table>
    	    <tr>
    	      <td><label for="nom">Nom : </td>
    	      <td><input class="form-control" type="text" name="nom" value="" pattern="^[_A-zéèçêïîÏÎ]{1,}$" required></td>
    	    </tr>
    	    <tr>
    	      <td><label for="prenom">Prénom : </label></td>
    	      <td><input class="form-control" type="text" name="prenom" value="" pattern="^[_A-zéèçêïîÏÎ]{1,}$" required></td>
    	    </tr>
    	    <tr>
    	      <td><label for="email">Email : </label></td>
    	      <td><input class="form-control" type="email" name="email" value="" pattern="^[@_A-z0-9.]{1,}$" required></td>
    	    </tr>
          <tr>
    	      <td><label for="msg">Message : </label></td>
    	      <td><textarea class="form-control" rows="8" cols="80" type="text" name="msg" value="" required></textarea></td>
    	    </tr>
          <tr>
    	      <td></td>
    	      <td><button type="submit" class="btn btn-primary btn-block" name="execute">Contacter</button></td>
    	    </tr>
    	  </table>
    	</form>
    </div>
  </center>
  </body>
</html>
