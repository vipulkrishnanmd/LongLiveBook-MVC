<?php

class User extends Controller{
	
	/**
	 *This method impliments user login
	 */
	public function logIn(){
		if(isset($_POST["username"])){
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			$isCorrect = $this->model->login($username, $password);
			if($isCorrect){
				session_start();
				$_SESSION['username']=$_POST['username'];	
				$_SESSION['password']=$_POST['password'];
				$_SESSION['name']="vipul"; //TODO : dummy name
				require APP . 'view/home/index.php';
			}
			else{
				require APP . 'view/user/wrongLogIn.php';
			}
		}
	}
	
	/**
	 * This function distroys the session and makes the user signed out
	 */
	public function logOut(){
		session_start();
		session_unset();
		session_destroy();
		require APP . 'view/home/index.php';
	}
	
	public function signUp(){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$name = $_POST["name"];
		$mob = $_POST["mob"];
		$email = $_POST["email"];
		
		$isFine = $this->model->signUp($username, $password, $name, $mob, $email);
		
		if($isFine){
			require APP . 'view/user/wrongLogIn.php';
		}
	}
}