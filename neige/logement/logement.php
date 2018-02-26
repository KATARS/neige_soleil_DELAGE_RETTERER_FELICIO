<?php
session_start();
require("bddconnect.php");

if( isset( $_GET['idlogement'] ) and $_GET['idlogement'] > 0 )
{
  $reponse = $bdd->prepare('SELECT * FROM logement WHERE idlogement = ?');
  $reponse->bindValue(1, $_GET['idlogement'], PDO::PARAM_INT);
  $reponse->execute();

  $data = $reponse->fetch();
  $reponse->closeCursor();
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title><?php echo htmlspecialchars($data['titre']); ?></title>
    </head>
    <body>
    	<h3><?php echo stripslashes(htmlspecialchars($data['titre'])); ?>
        <br/><br/>
        <?php echo stripslashes(htmlspecialchars($data['emplacement'])); ?>
        <br/><br/>
        <img src="../profil/<?php echo $data['photo']; ?>"><br/>
        <br/><br/>
        <?php echo stripslashes(htmlspecialchars($data['taille'])); ?>
        <br/><br/>
        <?php echo stripslashes(htmlspecialchars($data['etage'])); ?>
        <br/><br/>
        <?php echo stripslashes(htmlspecialchars($data['prix'])); ?>
        <br/><br/>
        <?php echo stripslashes(htmlspecialchars($data['caracteristique'])); ?>
        <br/><br/>
    </body>
</html>
