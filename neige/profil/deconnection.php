<?php
session_start(); //initialise debut de session
$_SESSION = array(); //recupere la session en cours
session_destroy(); //detruit la session
header("Location: index.php"); //retourne a l'accueil
?>
