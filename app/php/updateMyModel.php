<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input"));

$id = pg_escape_string($con, $data->id);
$name = pg_escape_string($con, $data->name);

					
$query = "UPDATE model SET name = '$name' WHERE id = '$id' ";


$result = pg_query($con, $query);
echo true;

?>