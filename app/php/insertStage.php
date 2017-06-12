<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input")); 

$model_id = pg_escape_string($con, $data->model_id);
$name = pg_escape_string($con, $data->name);

$query = "INSERT INTO stage(name, model_id) VALUES ('$name', '$model_id')";

$result = pg_query($con, $query) or die(pg_last_error());
echo "true";

?>