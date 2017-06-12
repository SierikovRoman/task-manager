<?php
// Connecting to database as mysqli_connect("hostname", "username", "password", "database name");
// $con = mysqli_connect("localhost", "root", "root", "ProjectManager");

$con = pg_connect("
	host=ec2-46-137-117-43.eu-west-1.compute.amazonaws.com 
	port=5432 
	dbname=dj3vms44je7rl 
	user=tglmhflxuwmpht 
	password=f437df2b4caff41f0dadfe4dce187dc06d97790806f054ba41e4540ffc1a9705
	") or die("Could not connect" . pg_last_error());

	// $stat = pg_connection_status($con);
	// if ($stat === PGSQL_CONNECTION_OK) {
	//   echo 'Connection status ok';
	// } else {
	//   echo 'Connection status bad';
	// }

?>