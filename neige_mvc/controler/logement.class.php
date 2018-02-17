<?php
  class Logement
  {
    private $titre,$emplacement,$etage,$prix,$taille,$type,$caracteristique;

    public function __construct()
    {
      $this->titre="";
      $this->emplacement="";
      $this->etage="";
      $this->prix="";
      $this->taille= "";
      $this->type="";
      $this->caracteristique="";
    }
    public function renseignerLogement ($tab) //recupere donnees
    {
      $this->titre= $tab["titre"];
      $this->emplacement= $tab["emplacement"];
      $this->etage= $tab["etage"];
      $this->prix= $tab["prix"];
      $this->taille= $tab["taille"];
      $this->type= $tab["type"];
      $this->caracteristique= $tab["caracteristique"];
    }
    public function serialiserLogement () //serialisation
    {
      $tab = array();
      $tab["titre"]= $this->titre;
      $tab["emplacement"]= $this->emplacement;
      $tab["etage"] = $this->etage;
      $tab["prix"]= $this->prix;
      $tab["taille"]= $this->taille;
      $tab["type"] = $this->type;
      $tab["caracteristique"]= $this->caracteristique;
      return $tab;
    }

    //setters & getters
    public function getTitre()
    {
      return $this->titre;
    }
    public function setTitre($titre)
    {
      $this->titre=$titre;
    }
    public function getEmplacement()
    {
      return $this->emplacement;
    }
    public function setEmplacement($emplacement)
    {
      $this->emplacement=$emplacement;
    }
    public function getEtage()
    {
      return $this->etage;
    }
    public function setEtage($etage)
    {
      $this->etage=$etage;
    }
    public function getPrix()
    {
      return $this->prix;
    }
    public function setPrix($prix)
    {
      $this->prix=$prix;
    }
    public function getTaille()
    {
      return $this->taille;
    }
    public function setTaille($taille)
    {
      $this->taille=$taille;
    }
    public function getType()
    {
      return $this->type;
    }
    public function setType($type)
    {
      $this->type=$type;
    }
    public function getCaracteristique()
    {
      return $this->caracteristique;
    }
    public function setCaracteristique($caracteristique)
    {
      $this->caracteristique=$caracteristique;
    }
  }
 ?>
