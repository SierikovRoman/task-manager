<?php
session_start();
$id=$_SESSION['id'];

require_once 'database_connections.php';

$query_task_id = pg_query("SELECT task_id FROM task_executor WHERE employee_id = '$id' ;"); 
$task_id = pg_fetch_array($query_task_id);
$task_id = $task_id[0];

$query_project_id = pg_query("SELECT project_id FROM task WHERE id = '$task_id' ;"); 
$project_id = pg_fetch_array($query_project_id);
$project_id = $project_id[0];

$query = "SELECT p.id, p.title, p.start_dt, p.end_dt, p.progress, mod.name AS model_name ,mem.name AS member_name, mem.surname AS member_surname FROM project p 
		  LEFT JOIN model mod ON p.model_id = mod.project_id 
		  LEFT JOIN project_manager pr ON p.id = pr.project_id 
		  LEFT JOIN member mem ON mem.id = pr.employee_id 
		  WHERE p.id = '$project_id'
		  ORDER BY p.id";

$result = pg_query($con, $query);

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);
?>