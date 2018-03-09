<?php
//initialise debut de session
require("bddconnect.php"); //connection bdd
if(isset($_POST['choisirdate'])) //submit
{
	$datearr= $_POST['datearr'];
	$datedep = $_POST['datedep'];
  $id = $_SESSION['id'];

	if(!empty($_POST['datearr']) AND !empty($_POST['datedep']))
	{
		/*$_SESSION['id'] = $id;
		$_SESSION['datearr'] = $datearr;
		$_SESSION['datedep'] = $datedep;*/
		echo "<h2>Error[44444]: Flemme de faire la requete</h2>";
  }
	else
	{
		echo  "Remplissez tous les champs !";
	}
}
?></br>
<h3>Choisissez vos dates</h3></br>
<form method ="post" action ="">
  <table>
    <tr>
      <td><label for="datearr">Date Debut : </label></td>
      <td><input type="date" name="datearr" required></td>
    </tr>
    <tr>
      <td><label for="datedep">Date Fin : </label></td>
      <td><input type="date" name="datedep" required></td>
    </tr>
	</table>
	</br>
    <button type="submit" class="btn btn-success" name="choisirdate">Valider</button>
</form>
