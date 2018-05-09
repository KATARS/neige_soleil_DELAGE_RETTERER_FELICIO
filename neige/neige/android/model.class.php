<?php
  class Modele
  {
    private static $pdo=null;
    public static function connexion()
    {
      try{
        Modele::$pdo = new PDO('mysql:host=db727840043.db.1and1.com;dbname=db727840043;charset=utf8', 'dbo727840043', 'Neige&Soleil2018', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      }
      catch(Exception $exp)
      {
        echo"erreur de connexion";
      }
    }
    public static function verifConnexion ($email,$password)
    {
      Modele::connexion();
      $requete = 'select count(*) as nb, nom, prenom from user
      where email = :email and password = :password group by id;';
      $donnees = array(":email"=>$email,":password"=>$password);
      $select = Modele::$pdo->prepare ($requete);
      $select->execute ($donnees);
      $resultat = $select->fetch();
      return $resultat;
    }
  }

 ?>
