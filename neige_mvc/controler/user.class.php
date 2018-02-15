<?php
  class user
  {
    private $nom,$prenom,$email,$password,$civilite,$adresse,$ville,$cp,$tel,$datebirth,$status;

    public function __construct()
    {
      $this->civilite="";
      $this->nom= "";
      $this->prenom="";
      $this->email="";
      $this->password="";
      $this->adresse="";
      $this->ville="";
      $this->cp=0;
      $this->tel="";
      $this->datebirth="";
      $this->status=0;

    }
    public function renseigner ($tab) //recupere donnees
    {
      $this->nom= $tab["nom"];
      $this->prenom= $tab["prenom"];
      $this->email= $tab["email"];
      $this->passeword= $tab["password"];
      $this->civilite= $tab["civilite"];
      $this->adresse= $tab["adresse"];
      $this->ville= $tab["ville"];
      $this->cp= $tab["cp"];
      $this->tel= $tab["tel"];
      $this->datebirth= $tab["datebirth"];
      $this->satus= $tab["status"];
    }
    public function serialiser () //serialisation
    {
      $tab = array();
      $tab["nom"] = mb_strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT', ($this->nom)));
      $tab["prenom"]= ucfirst(iconv('UTF-8', 'ASCII//TRANSLIT', ($this->prenom)));
      $tab["email"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->email));
      $tab["password"] = password_hash($this->password , PASSWORD_DEFAULT);
      $tab["civilite"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->civilite));
      $tab["adresse"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->adresse));
      $tab["ville"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->ville));
      $tab["cp"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->cp));
      $tab["tel"]= iconv('UTF-8', 'ASCII//TRANSLIT', ($this->tel));
      $tab["datebirth"]= $this->datebirth;
      $tab["status"]= $this->status;
      return $tab;
    }

    //setters & getters
    public function getNom()
    {
      return $this->nom;
    }
    public function setNom($nom)
    {
      $this->nom=$nom;
    }
    public function getPrenom()
    {
      return $this->prenom;
    }
    public function setPrenom($prenom)
    {
      $this->prenom=$prenom;
    }
    public function getEmail()
    {
      return $this->email;
    }
    public function setEmail($email)
    {
      $this->email=$email;
    }
    public function getPassword()
    {
      return $this->password;
    }
    public function setPassword($password)
    {
      $this->password=$password;
    }
    public function getCivilite()
    {
      return $this->civilite;
    }
    public function setCivilite($civilite)
    {
      $this->civilite=$civilite;
    }
    public function getAdresse()
    {
      return $this->adresse;
    }
    public function setAdresse($adresse)
    {
      $this->adresse=$adresse;
    }
    public function getVille()
    {
      return $this->ville;
    }
    public function setVille($ville)
    {
      $this->ville=$ville;
    }
    public function getCp()
    {
      return $this->cp;
    }
    public function setCp($cp)
    {
      $this->cp=$cp;
    }
    public function getTel()
    {
      return $this->tel;
    }
    public function setTel($tel)
    {
      $this->tel=$tel;
    }
    public function getDatebirth()
    {
      return $this->datebirth;
    }
    public function setDatebirth($datebirth)
    {
      $this->datebirth=$datebirth;
    }
    public function getStatus()
    {
      return $this->status;
    }
    public function setStatus($status)
    {
      $this->status=$status;
    }
  }


 ?>
