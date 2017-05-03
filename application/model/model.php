<?php

class Model{
	
	/**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
	
	function logIn($username, $password){
		$sql = "SELECT password FROM users WHERE username = ?";
		$query = $this->db->prepare($sql);
		$query->bind_param("s",$username);
		$query->execute();
		$query->bind_result($result);
		$query->fetch();
		if($result == $password)
			return true;
		else
			return false;
	}
	
	function signUp($username, $password, $name, $mob, $email){
		$sql = "INSERT INTO users VALUES (?,?,?,?,?,?)";
		$query = $this->db->prepare($sql);
		$query->bind_param("ssssss",$username, $password, $name, $notVerified, $email, $mob);
		$notVerified = "not verified";
		$success = $query->execute();
		
		
		if ($success == true)
			return true;
		else 
			return false;
	}
}


			