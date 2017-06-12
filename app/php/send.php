<?php

// Including database connections
require_once 'php/database_connections.php';
session_start(); 


// if($_SERVER["REQUEST_METHOD"] == "POST") {
//       // username and password sent from form 
      
//       $email = pg_escape_string($con, $_POST['email']);
// 	  $password = pg_escape_string($con, $_POST['password']); 
      
//       $query = "SELECT id FROM member WHERE email = '$email' and password = '$password'";
//       $result = pg_query($con,$query);
//       $row = pg_fetch_array($result,PG_ASSOC);
//       $active = $row['active'];
      
//       $count = pg_num_rows($result);
      
//       // If result matched $myusername and $mypassword, table row must be 1 row
		
//       if($count == 1) {
//          session_register("name");
//          $_SESSION['login_user'] = $name;
         
//          header("location: '../login.html'");
//       }else {
//          $error = "Your Login Name or Password is invalid";
//       }
//    }


   	function Login(){
		if(empty($_POST['email'])){
			$this->HandleError("Login is empty!");
			return false;
		}
		if(empty($_POST['password'])){
			$this->HandleError("Password is empty!");
			return false;
		}

	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	if(!$this->CheckLoginInDB($email,$password)){
		return false;
	}

	session_start();

		$_SESSION[$this->GetLoginSessionVar()] = $email;
		return true;
	}

	function CheckLoginInDB($username,$password){
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		} 

	$email = $this->SanitizeForSQL($email);
	$pwdmd5 = md5($password);

	$query = "SELECT email, password FROM $this->member WHERE email='$email' and password='$pwdmd5' AND confirmcode='y'";

	$result = pg_query($query,$this->connection);
	if(!$result || pg_num_rows($result) <= 0){
		$this->HandleError("Error logging in. ".
		"The username or password does not match");
		return false;
	}
	return true;
	}


?>