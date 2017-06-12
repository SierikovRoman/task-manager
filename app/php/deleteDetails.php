<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input")); 

$id = pg_escape_string($con, $data->del_id);

$query_del_project_executor = pg_query("DELETE FROM project_manager WHERE employee_id = '$id' ;");

$query = "DELETE FROM member WHERE id = '$id' ;";

$result = pg_query($con, $query);
echo true;

?>