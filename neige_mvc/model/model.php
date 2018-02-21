<?php
  class Model
  {
    private $pdo, $table;

    public function __construct($serveur, $bdd, $user, $mdp)
    {
        $this->pdo = null;
        $this->table = null;
        try
        {
          $this->pdo = new PDO("mysql:host=".$serveur.";dbname=".$bdd,$user,$mdp);
        }
        catch(Exception $exp)
        {
          echo "Erreur de connexion a la BDD:".$bdd;
        }
    }
    public function selectAll()
    {
        if($this->pdo == null)
        {
            return null;
        }
        else
        {
            $requete = "select * from ".$this->table." ;";
            $select = $this->pdo->prepare($requete);
            $select->execute();
            $resultats = $select->fetchAll();
            return $resultats;
        }
    }

    public function insert($donnee)
    {
      if($this->pdo != null)
      {
          $donnees = array();
          $champs = array();
          //Construction des champs
          foreach($donnee as $cle => $valeur)
          {
              $champs[] = ":".$cle;
              $donnees[":".$cle] = $valeur;
          }
          //explode : sépare une chaine de caractère en tableau
          //implode : concatène un tableau
          $listeChamps = implode(",", $champs);
          $requete = "INSERT INTO ".$this->table." VALUES (null,".$listeChamps.");";

          $insert = $this->pdo->prepare($requete);
          $insert->execute($donnees);
      }
    }
    public function connexion($tab)
    {
      $email = $_POST['email'];
      $password = $_POST['password'];
  		$req = "SELECT * FROM ".$this->table." WHERE email = $email AND password = $password";
  		$connexion = $this->pdo->prepare($req);
      $connexion->execute();
  		$userexist = $req->rowCount();
  		if($userexist == 1)
  		{
  			$donnees = $req->fetch();
  			$_SESSION['id'] = $donnees['id'];
  			$_SESSION['email'] = $donnees['email'];
  			header("Location: ./profil.php?id=".$_SESSION['id']);
  		}
  		else
  		{
  			echo "Identifiants inconnus !";
  		}
    }
    public function getPdo()
    {
        return $this->pdo;
    }
    public function setTable($table)
    {
        $this->table = $table;
    }
}
?>
