<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Liste</title>
  </head>
  <body>
    <center>
      <h2> Liste des membres </h2></br>
      <table border="1">
        <tr>
          <td>Civilité</td>
          <td>Nom</td>
          <td>Prenom</td>
          <td>Email</td>
          <td>Adresse</td>
          <td>Ville</td>
          <td>CP</td>
          <td>Téléphone</td>
          <td>Date Naissance</td>
          <td>Status</td>
        </tr>
        <?php
          foreach ($resultats as $unResultat)
          {
            echo "<tr><td>".$unResultat['civilite']."</td>";
            echo "<td>".$unResultat['nom']."</td>";
            echo "<td>".$unResultat['prenom']."</td>";
            echo "<td>".$unResultat['email']."</td>";
            echo "<td>".$unResultat['adresse']."</td>";
            echo "<td>".$unResultat['ville']."</td>";
            echo "<td>".$unResultat['cp']."</td>";
            echo "<td>".$unResultat['tel']."</td>";
            echo "<td>".$unResultat['datebirth']."</td>";
            echo "<td>".$unResultat['status']."</td></tr>";
          }
        ?>
      </table>
    </center>
  </body>
</html>
