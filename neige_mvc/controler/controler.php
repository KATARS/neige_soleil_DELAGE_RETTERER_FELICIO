<?php
  include ("./model/model.php");
  class Controler{
    private $Model;
    public function __construct ($server,$bdd,$user,$mdp,$table){
      $this->Model = new Model ($server,$bdd,$user,$mdp);
      $this->Model->setTable($table);
    }
    public function selectAll(){
      if ($this ->Model->getPdo() != null) {
      return $this -> Model->selectAll();
      }
      else {
        return null;
      }

    }
    public function insert($insert)
    {
      try
      {
        $tab= $insert->serialiser();
        $this->Model->insert($tab);
        $this->Model->insert($insert);
      }
      catch (Exception $e)
      {
        die('Erreur : ' . $e->getMessage());
      }
    }
  }

?>
