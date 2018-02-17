<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Liste</title>
  </head>
  <body>
    <center>
      <h2> Choisissez votre hébergement</h2></br>
      <table border="1">
        <tr>
          <td>Titre</td>
          <td>Emplacement</td>
          <td>Etages</td>
          <td>Prix (en €/jour)</td>
          <td>Taille (en m²)</td>
          <td>Type</td>
          <td>Caractéristiques</td>
        </tr>
        <?php
          foreach ($resultats as $unResultat)
          {
            echo "<tr><td>".$unResultat['titre']."</td>";
            echo "<td>".$unResultat['emplacement']."</td>";
            echo "<td>".$unResultat['etage']."</td>";
            echo "<td>".$unResultat['prix']."</td>";
            echo "<td>".$unResultat['taille']."</td>";
            echo "<td>".$unResultat['type']."</td>";
            echo "<td>".$unResultat['caracteristique']."</td></tr>";
          }
        ?>
      </table>
    </center>
  </body>
</html>
