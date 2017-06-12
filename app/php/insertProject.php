<?php 
require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input")); 

$title = pg_escape_string($con, $data->title);
$start_dt = pg_escape_string($con, $data->start_dt);
$end_dt = pg_escape_string($con, $data->end_dt);
$emp_id = pg_escape_string($con, $data->emp_id);
$progress = pg_escape_string($con, $data->progress);

$query_proj = pg_query("INSERT INTO project(title, start_dt, end_dt, progress) VALUES ('$title', '$start_dt', '$end_dt', '0')");

$project_id = pg_query("SELECT max(id) FROM project");
$project_id=pg_fetch_array($project_id);
$project_id=$project_id[0];

$query_add_project_id = pg_query("UPDATE member SET project_id = '$project_id' WHERE id = '$emp_id' ;") or die(pg_last_error()) ;

$query = "INSERT INTO project_manager (project_id, employee_id) VALUES ( '$project_id', '$emp_id' )";

$result = pg_query($con, $query) or die(pg_last_error());

?>