<?php
require("bddconnect.php");
if(isset($_SESSION['id']) AND $_SESSION['id'] > 0) //recupere id de session si id = 0 ou session = 0 retourne a l'index
{
  if(isset($_POST['valider']))
  {
    $type = $_POST['type'];
    $titre = $_POST['titre'];
    $emplacement = ucfirst($_POST['emplacement']);
    $etage = $_POST['etage'];
    $prix = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $_POST['prix']);
    $taille = $_POST['taille'];
    $carac = $_POST['caracteristique'];
    $id = $_SESSION['id'];
    $nom_photo = md5(uniqid($_FILES['photo']['name'])); //nom de la photo
    $photo = $_FILES['photo']['tmp_name']; //photo
    $createdate = date('Y-m-d');
    $id = $_SESSION['id'];
		$email = $_SESSION['email'];

    $extensions_valides = array('.jpeg','.jpg','.png'); //extension autorisés
    $extension_upload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1)); //photo upload
    if (in_array($extension_upload,$extensions_valides)); //check si extension valide
    {
    	$photo = "./photos/{$nom_photo}"; //recupere chemin dossier
    	$resultat = move_uploaded_file($_FILES['photo']['tmp_name'],$photo); //deplace la photo uploadée dans le dossier
    	$insertlogement = $bdd->prepare('INSERT INTO logement(idtype,titre,emplacement,etage,taille,prix,caracteristique,photo,id,createdate)
      VALUES(?,?,?,?,?,?,?,?,?,?)') or die(print_r($bdd->errorInfo()));
    	$insertlogement->bindValue(1, $type, PDO::PARAM_STR);
    	$insertlogement->bindValue(2, $titre, PDO::PARAM_STR);
    	$insertlogement->bindValue(3, $emplacement, PDO::PARAM_STR);
    	$insertlogement->bindValue(4, $etage, PDO::PARAM_STR);
      $insertlogement->bindValue(5, $taille, PDO::PARAM_STR);
      $insertlogement->bindValue(6, $prix, PDO::PARAM_STR);
      $insertlogement->bindValue(7, $carac, PDO::PARAM_STR);
    	$insertlogement->bindValue(8, $photo, PDO::PARAM_STR);
      $insertlogement->bindValue(9, $id, PDO::PARAM_INT);
      $insertlogement->bindValue(10, $createdate, PDO::PARAM_STR);
      $insertlogement->execute();

      $insertrequest = $bdd->prepare('INSERT INTO request(id,email,createdate,idlogement)
      VALUES(?,?,?,?)') or die(print_r($bdd->errorInfo()));
  		$insertrequest->bindValue(1, $id, PDO::PARAM_INT);
    	$insertrequest->bindValue(2, $email, PDO::PARAM_STR);
    	$insertrequest->bindValue(3, $createdate, PDO::PARAM_STR);
      $insertrequest->bindValue(4, $idlogement, PDO::PARAM_INT);


      $insertrequest->execute();
      //$contrat->execute();

    	echo "<h6>Bien ajouté à notre catalogue</h6>";
    }
  }
  ?>
  <center>
    <h3>Ajoutez un bien à notre catalogue</h3></br>
    <form method ="post" action ="" enctype="multipart/form-data">
      <table>
        <tr>
          <td><label for="titre">Titre :</label></td>
          <td><input type="text" name="titre" value="" pattern="^[_ ,A-z0-9éèçêïîÏÎ]{1,}$" placeholder="EX: Chalet Moderne"required></td>
        </tr>
        <tr>
          <td><label for="emplacement">Emplacement :</label></td>
          <td><input type="text" name="emplacement" value="" pattern="^[_ ,A-z0-9éèçêïîÏÎ]{1,}$" required></td>
        </tr>
        <tr>
          <td><label for="etage">Etage :</label></td>
          <td><input type="text" name="etage" value="" pattern="^[_ A-z0-9éèçêïîÏÎ]{1,}$"></td>
        </tr>
        <tr>
          <td><label for="prix">Prix (en €/jour) :</label></td>
          <td><input type="text" name="prix" value="" pattern="^[_€0-9]{1,}$" placeholder="€/jours" required></td>
        </tr>
        <tr>
          <td><label for="taille">Taille (en m²) :</label></td>
          <td><input type="text" name="taille" value="" placeholder="m²" pattern="^[_m²0-9]{1,}$" minlength="1" maxlength="5" required></td>
        </tr>
        <tr>
          <td><label for="type">Type :</label></td>
          <td><select class="custom-select" name="type" required>
            <option selected>Selectionnez un type</option>
              <option value="1">Appartement</option>
              <option value="2">Chalet</option>
              <option value="3">Maison</option>
            </select></td>
        </tr>
        <tr>
          <td><label for="caracteristique">Caractéristiques: </label></td>
          <td><textarea name="caracteristique" rows="4" cols="30" required></textarea></td>
        </tr>
        <tr>
          <td><label for="photo">Photo Principale</label></td>
          <td><input type="file" name="photo"></td>
        </tr>
        <tr>
          <td></td>
          <td><div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="customControlValidation1" required>
            <label class="custom-control-label" for="customControlValidation1">Accepter les CGU et créer un contrat</label></td>
        </tr>
        <tr>
          <td><button type="reset" class="btn btn-warning" name="reset">Réinitialiser</button></td>
          <td><button type="submit" class="btn btn-success" name="valider">Ajouter</button></td>
        </tr>
      </table>
    </center>
  <?php
  }
else
{
  header("Location: index.php");
}
?>
