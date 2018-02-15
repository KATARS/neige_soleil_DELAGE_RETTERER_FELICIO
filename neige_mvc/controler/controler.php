<?php
  include ("./model/model.php");
  class Controler{
    private $unModel;
    public function __construct ($server,$bdd,$user,$mdp,$table){
      $this->unModel = new Model ($server,$bdd,$user,$mdp);
      $this->unModel->setTable($table);
    }
    public function selectAll(){
      if ($this ->unModel->getPdo() != null) {
      return $this -> unModel->selectAll();
      }
      else {
        return null;
      }

    }
    public function insert($unUser)
    {
      try
      {
        $tab= $unUser->serialiser();
        $this->unModel->insert($tab);
        $this->unModel->insert($unUser);
      }
      catch (Exception $e)
      {
        die('Erreur : ' . $e->getMessage());
      }
    }
  }

?>
