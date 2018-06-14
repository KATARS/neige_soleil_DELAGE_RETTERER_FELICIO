<html>
<head>
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
      <link href="../style.css" rel="stylesheet" type="text/css">
      <link href="../logement/calendrier/style_calendrier.css" rel="stylesheet" type="text/css">
    </head>
      <body></br><center>
</html>

<?php
require("bddconnect.php");

 $id= $_REQUEST['id'];

        $sql = $bdd->prepare('SELECT * FROM logement where id =?');
        $sql->bindValue(1, $id, PDO::PARAM_INT);
        $sql->execute();

		?>
    <center>
      <h2>Liste Propriétés</h2></br>
      <table border="2">
        <tr>
					<td>ID</td>
          <td>Titre</td>
          <td>Emplacement</td>
          <td>Etages</td>
          <td>Prix (en €/jour)</td>
          <td>Taille (en m²)</td>
          <td>Type</td>
          <td>Caractéristiques</td>
					<td>Photo</td>
					<td>Status</td>
        </tr>
        <?php
				while ($data = $sql->fetch())
				{
					echo "<tr><td>".$data['idlogement']."</td>";
          echo "<td>".$data['titre']."</td>";
          echo "<td>".$data['emplacement']."</td>";
          echo "<td>".$data['etage']."</td>";
          echo "<td>".$data['prix']."</td>";
          echo "<td>".$data['taille']."</td>";
          echo "<td>".$data['idtype']."</td>";
          echo "<td>".$data['caracteristique']."</td>";
					echo "<td><div class='col-lg-4'>
						<img width='300px' src=".$data['photo']."><br/>
						</div>
						<div class='col-lg-8'></td>";
					echo "<td>".$data['status']."</td></tr>";
				}

				$sql->closeCursor();
				
				?>
				
				</center></br>
      </body>
    </html>
			
