<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input")); 

$id = pg_escape_string($con, $data->id);

$query_del_project_executor = pg_query("DELETE FROM project_manager WHERE project_id = '$id' ;");

$query_del_project_tasks = pg_query("DELETE FROM task WHERE project_id = '$id' ;");

$query_del_project_from_member = pg_query("UPDATE member SET project_id = NULL WHERE project_id = '$id' ;");

$query = "DELETE FROM project WHERE id = '$id' ;";

$result = pg_query($con, $query);
echo true;

?>