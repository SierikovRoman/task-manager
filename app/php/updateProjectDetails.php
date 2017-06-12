<?php 
// Including database connections
require_once 'database_connections.php';

// Fetching the updated data & storin in new variables
$data = json_decode(file_get_contents("php://input"));

// Escaping special characters from updated data
$id = pg_escape_string($con, $data->id);
$title = pg_escape_string($con, $data->title);
$start_dt = pg_escape_string($con, $data->start_dt);
$end_dt = pg_escape_string($con, $data->end_dt);
$emp_id = pg_escape_string($con, $data->emp_id); // доделать изменение куратора проекта

$query_update_project = pg_query("UPDATE project SET title = '$title', start_dt = '$start_dt', end_dt = '$end_dt', progress = '0' WHERE id = '$id' ");
// $query_get_project_id = pg_query("SELECT id FROM project WHERE title = 'TEST-5' ");
// $project_id = pg_fetch_array($query_get_project_id);
// $project_id = $project_id[0];

$query = "UPDATE project_manager SET employee_id = '$emp_id' WHERE project_id = '$id' ";

$result = pg_query($con, $query);
echo true;
?>