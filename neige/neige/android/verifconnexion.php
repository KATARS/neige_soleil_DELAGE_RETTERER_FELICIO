<?php
  include ('model.class.php');

  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];

  $resultat []= Modele::verifConnexion($email,$password);

  print(json_encode($resultat));
 ?>
