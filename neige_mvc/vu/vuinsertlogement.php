<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Ajoutez votre bien</title>
  </head>
  <body><center>
    <h3>Ajoutez un bien à notre catalogue</h3></br>
    <form method ="post" action ="">
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
              <option value="Appartement">Appartement</option>
              <option value="Chalet">Chalet</option>
              <option value="Maison">Maison</option>
            </select></td>
        </tr>
        <tr>
          <td><label for="caracteristique">Caractéristiques: </label></td>
          <td><textarea name="caracteristique" rows="4" cols="30" required></textarea></td>
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
  </center></body>
</html>
