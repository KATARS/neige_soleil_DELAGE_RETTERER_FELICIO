<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Inscription</title>
  </head>
  <body><center></br></br>
    <form method ="post" action ="">
      <table>
        <tr>
          <td><label for="civilite">Civilité : </label></td>
          <td>Mr. <input type="radio" name="civilite" value="Mr" required>
          Mme. <input type="radio" name="civilite" value="Mme" required></td>
        </tr>
        <tr>
          <td><label for="nom">Nom : </td>
            <td><input type="text" name="nom" value="" pattern="^[_A-zéèçêïîÏÎ]{1,}$" required></td>
        </tr>
        <tr>
          <td><label for="prenom">Prénom : </label></td>
          <td><input type="text" name="prenom" value="" pattern="^[_A-zéèçêïîÏÎ]{1,}$" required></td>
        </tr>
        <tr>
          <td><label for="email">Email : </label></td>
          <td><input type="email" name="email" value="" pattern="^[@_A-z0-9.]{1,}$" required></td>
        </tr>
        <tr>
          <td><label for="password">Mot de passe : </label></td>
          <td><input type="password" name="password" value="" minlength="6" required></td>
        </tr>
        <tr>
          <td><label for="adresse">Adresse : </label></td>
          <td><input type="text" name="adresse" value="" pattern="^[_ A-z0-9]{1,}$" required></td>
        </tr>
        <tr>
          <td><label for="ville">Ville </label></td>
          <td><input type="text" name="ville" value="" pattern="^[_A-zéèçêïîÏÎ]{1,}$" required></td>
        </tr>
        <tr>
          <td><label for="cp">Code Postal: </label></td>
          <td><input type="text" name="cp" value="" pattern="^[_0-9]{1,}$" minlength="5" maxlength="5"required></td>
        </tr>
        <tr>
          <td><label for="tel">Téléphone: </label></td>
          <td><input type="text" pattern="^[+_0-9]{1,}$" name="tel" maxlength="12" minlength="10" required></td>
        </tr>
        <tr>
          <td><label for="datebirth">Date de Naissance</label></td>
          <td><input name="datebirth" type="date" required/></td>
        </tr>
        <tr>
          <td><input type="hidden" name="satus" value="0">
            <button type="reset" class="btn btn-warning" name="reset">Réinitialiser</button></td>
          <td><button type="submit" class="btn btn-success" name="valider">S'inscrire</button></td>
        </tr>
      </table>
  </center></body>
</html>
