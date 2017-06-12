<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input")); 

$name = pg_escape_string($con, $data->name);

$query = "INSERT INTO model(name) VALUES ('$name')";

$result = pg_query($con, $query) or die(pg_last_error());
echo "true";

?>