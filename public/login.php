<?php
session_start();
include 'php/database_connections.php';
$email= $_POST['email'];
$password=$_POST['password'];

$query=pg_query("SELECT * FROM member WHERE email='$email' AND password='$password'");

$member = pg_fetch_array($query);
	
	if ($member['position']==1) {
		echo "admin";
	} else if($member['position']==2){
		echo "pm";
	} else if($member['position']==''){
		echo "error";
	} else if($member['position']!==1 && $member['position']!==2){
		echo "employee";
	}

$_SESSION['id']=$member['id'];
?>



