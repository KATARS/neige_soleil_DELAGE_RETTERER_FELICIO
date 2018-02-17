<?php
  class Logement
  {
    private $titre,$emplacement;

    public function __construct()
    {
      $this->titre="";
      $this->emplacement="";
      /*$this->type="";
      $this->taille= "";
      $this->etage="";
      $this->caracteristique="";
      $this->photos="";
      $this->prix="";*/
    }
    public function renseignerLogement ($tab) //recupere donnees
    {
      $this->titre= $tab["titre"];
      $this->emplacement= $tab["emplacement"];
      /*$this->type= $tab["type"];
      $this->taille= $tab["taille"];
      $this->etage= $tab["etage"];
      $this->caracteristique= $tab["caracteristique"];
      $this->photos= $tab["photos"];
      $this->prix= $tab["prix"];*/
    }
    public function serialiserLogement () //serialisation
    {
      $tab = array();
      $tab["titre"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->titre));
      $tab["emplacement"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->emplacement));
      /*$tab["type"] = iconv('UTF-8', 'ASCII//TRANSLIT', ($this->type));
      $tab["taille"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->taille));
      $tab["etage"] = iconv('UTF-8', 'ASCII//TRANSLIT', ($this->etage));
      $tab["caracteristique"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->caracteristique));
      $tab["photos"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->photos));
      $tab["prix"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->prix));*/
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
    /*public function getType()
    {
      return $this->type;
    }
    public function setType($type)
    {
      $this->type=$type;
    }
    public function getTaille()
    {
      return $this->taille;
    }
    public function setTaille($taille)
    {
      $this->taille=$taille;
    }
    public function getEtage()
    {
      return $this->etage;
    }
    public function setEtage($etage)
    {
      $this->etage=$etage;
    }
    public function getCaracteristique()
    {
      return $this->caracteristique;
    }
    public function setCaracteristique($caracteristique)
    {
      $this->caracteristique=$caracteristique;
    }
    public function getPhotos()
    {
      return $this->photos;
    }
    public function setPhotos($photos)
    {
      $this->photos=$photos;
    }
    public function getPrix()
    {
      return $this->prix;
    }
    public function setPrix($prix)
    {
      $this->prix=$prix;
    }*/
  }
 ?>
