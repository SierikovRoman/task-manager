<?php
session_start();
$id=$_SESSION['id'];
// Including database connections
require_once 'database_connections.php'; 


$query_id=pg_query("SELECT project_id FROM project_manager WHERE employee_id='$id'");
$project_id=pg_fetch_array($query_id);
$project_id=$project_id[0];
if ($id!=2) {

	
$query_project_id = pg_query("SELECT p.id, p.title, p.start_dt, p.end_dt, p.progress, mod.name AS model_name ,mem.name AS member_name FROM project p
				  			  JOIN model mod ON p.model_id = mod.project_id
							  JOIN project_manager pr ON p.id = '$project_id'
				  			  JOIN member mem ON mem.id = pr.employee_id
				  			  WHERE p.id = pr.project_id ");
}else{

	$query_project_id = pg_query("SELECT p.id, p.title, p.start_dt, p.end_dt, p.progress, mod.name AS model_name ,mem.name AS member_name FROM project p LEFT JOIN model mod ON p.model_id = mod.project_id LEFT JOIN project_manager pr ON p.id = pr.project_id LEFT JOIN member mem ON mem.id = pr.employee_id ");
}

$project_id = pg_fetch_array($query_project_id);
$project_id = $project_id[0];


$query_model_id = pg_query("SELECT model_id FROM project WHERE id = '$project_id' ");
$model_id = pg_fetch_array($query_model_id);
$model_id = $model_id[0];

$query = "SELECT id, name FROM stage WHERE model_id = '$model_id' ORDER BY id ";

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