<?php 

	class DbOperations{

		private $con; 

		function __construct(){

			require_once dirname(__FILE__).'/DbConnect.php';

			$db = new DbConnect();

			$this->con = $db->connect();

		}
        
        

		public function userLogin($email, $password){
			$stmt = $this->con->prepare("SELECT id FROM user WHERE email = ? AND password = ?");
			$stmt->bind_param("ss",$email,$password);
			$stmt->execute();
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}

		
		public function selectReservation($id){
			$stmt = $this->con->prepare("SELECT * FROM reservation WHERE id = ? ");
			$stmt->bind_param("s",$id);
			$stmt->execute();
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}
		
		
		public function getUserByUsername($email){
			$stmt = $this->con->prepare("SELECT id,nom,prenom,email,password,status FROM user WHERE email = ?");
			$stmt->bind_param("s",$email);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}

	}

?>