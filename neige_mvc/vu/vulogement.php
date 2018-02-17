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
        </tr>
        <?php
          foreach ($resultats as $unResultat)
          {
            echo "<tr><td>".$unResultat['titre']."</td>";
            echo "<td>".$unResultat['emplacement']."</td></tr>";
          }
        ?>
      </table>
    </center>
  </body>
</html>
