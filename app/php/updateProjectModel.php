<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input"));

$id = pg_escape_string($con, $data->id);
$title = pg_escape_string($con, $data->title);
$start_dt = pg_escape_string($con, $data->start_dt);
$end_dt = pg_escape_string($con, $data->end_dt);
$progress = pg_escape_string($con, $data->progress);
$model_id = pg_escape_string($con, $data->model_id);


$query = "UPDATE project SET title = '$title', start_dt = '$start_dt', end_dt = '$end_dt', progress = '$progress', model_id = '$model_id' WHERE id = '$id';";


$result = pg_query($con, $query);
echo true;

?>