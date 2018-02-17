<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Ajoutez votre bien</title>
  </head>
  <body><center>
    <h3>Ajoutez un bien à notre catalogue</h3>
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
          <td><select class="custom-select" name="type">
            <option selected>Selectionnez un type</option>
              <option value="Appartement">Appartement</option>
              <option value="Chalet">Chalet</option>
              <option value="Maison">Maison</option>
            </select></td>
        </tr>
        <tr>
          <td><label for="caracteristique">Caractéristiques: </label></td>
          <td><textarea name="caracteristique" rows="4" cols="30"></textarea></td>
        </tr>
        <tr>
          <td>
            <button type="reset" class="btn btn-warning" name="reset">Réinitialiser</button></td>
          <td><button type="submit" class="btn btn-success" name="valider">Ajouter</button></td>
        </tr>
      </table>
  </center></body>
</html>
