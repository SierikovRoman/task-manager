<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input"));

$id = pg_escape_string($con, $data->id);
$name = pg_escape_string($con, $data->name);
$surname = pg_escape_string($con, $data->surname);
$email = pg_escape_string($con, $data->email);
$access_type = pg_escape_string($con, $data->access_id);
$position = pg_escape_string($con, $data->position_id);
$password = pg_escape_string($con, $data->password);

$query = "UPDATE member SET name = '$name', surname = '$surname', email = '$email', access_type = '$access_type', position = '$position', password = '$password' WHERE id = '$id' ";

$result = pg_query($con, $query);
echo true;

?>