<?php 
session_start();
$id=$_SESSION['id'];

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input"));

$id_task = pg_escape_string($con, $data->id);
$description = pg_escape_string($con, $data->description);
$is_done = pg_escape_string($con, $data->status);

$query_project_id = pg_query("SELECT project_id FROM task WHERE id = '$id_task' ;"); 
$project_id = pg_fetch_array($query_project_id);
$project_id = $project_id[0];

// echo $project_id;

$query_all_project_task = pg_query("SELECT COUNT(*) FROM task WHERE project_id = '$project_id' ");
$all_project_task = pg_fetch_array($query_all_project_task);
$all_project_task = $all_project_task[0];

// echo $all_project_task;

$query_all_done_task = pg_query("SELECT COUNT(*) FROM task WHERE is_done = true AND project_id = '$project_id' ");
$all_done_task = pg_fetch_array($query_all_done_task);
$all_done_task = $all_done_task[0];

// echo $all_done_task;

$progress = (($all_done_task + 1) / $all_project_task) * 100;

$progress = number_format($progress, 2, '.', '');

// echo $progress;

$query_update_task = pg_query("UPDATE task SET description = '$description', is_done = '$is_done' WHERE id = '$id_task' ");

$query = "UPDATE project SET progress = '$progress' WHERE id = '$project_id' ;";


$result = pg_query($con, $query);
// echo true;
echo $progress;
?>