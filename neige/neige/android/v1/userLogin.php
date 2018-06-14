<?php 

require_once '../includes/DbOperations.php';

$reponse = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['email']) and isset($_POST['password'])){
		$db = new DbOperations(); 

		if($db->userLogin($_POST['email'], $_POST['password'])){
			$email = $db->getUserByUsername($_POST['email']);
			$reponse['error'] = false; 
			$reponse['iduser'] = $email['id'];
			$reponse['nom'] = $email['nom'];
			$reponse['prenom'] = $email['prenom'];
			$reponse['email'] = $email['email'];
			$reponse['password'] = $email['password'];
			$reponse['status'] = $email['status'];
            $reponse['message'] = "bienvenue";
            
		}else{
			$reponse['error'] = true; 
			$reponse['message'] = "Verifiez vos identifiants";			
		}

	}else{
		$reponse['error'] = true; 
		$reponse['message'] = "remplir tous les champs";
	}
}

echo json_encode($reponse);

?>