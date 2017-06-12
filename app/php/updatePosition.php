<?php 
// Including database connections
require_once 'database_connections.php';

// Fetching the updated data & storin in new variables
$data = json_decode(file_get_contents("php://input"));

// Escaping special characters from updated data
$id = pg_escape_string($con, $data->id);
$pos_name = pg_escape_string($con, $data->pos_name);


$query = "UPDATE position SET pos_name = '$pos_name' WHERE id = '$id';";

// Updating data into database
$result = pg_query($con, $query);
echo $id;

?>