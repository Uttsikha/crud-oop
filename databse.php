<?php 	
	class Database{
		private $host= "localhost";
		private $db="learn_php";
		private $username="root";
		private $password="";
		public $conn;
	

	 public function getConnection(){
	  
	        $this->conn = null;
	  
	        try{
	            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->password);
	        }catch(PDOException $exception){
	            echo "Connection error: " . $exception->getMessage();
	        }
	  
	        return $this->conn;
	    }
}

?>