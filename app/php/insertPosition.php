<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input")); 

$pos_name = pg_escape_string($con, $data->pos_name);

$query = "INSERT INTO position(pos_name) VALUES ('$pos_name');";

$result = pg_query($con, $query);
echo true;

?>