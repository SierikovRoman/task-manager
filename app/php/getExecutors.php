<?php
session_start();
$id=$_SESSION['id'];

require_once 'database_connections.php'; 

$query_id = pg_query("SELECT max(project_id) FROM project_manager WHERE employee_id='$id'");
$project_id = pg_fetch_array($query_id);
$project_id = $project_id[0];

$query = "SELECT * FROM member WHERE (position != 1) AND (position != 2) AND (project_id = '$project_id' OR project_id IS NULL) ORDER BY id";

$result = pg_query($con, $query);

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

// Return json array containing data from the database
echo $json_info = json_encode($arr);
?>