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
