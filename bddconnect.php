<?php
//tentative de connection//
try
{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=neige_soleil;charset=utf8', 'root', 'azerty', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
}
