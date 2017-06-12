<?php
session_start();
$id=$_SESSION['id'];

require_once 'database_connections.php';

$query_task_id = pg_query("SELECT task_id FROM task_executor WHERE employee_id = '$id' ;"); 
$task_id = pg_fetch_array($query_task_id);
$task_id = $task_id[0];

$query_project_id = pg_query("SELECT project_id FROM task WHERE id = '$task_id' ;"); 
$project_id = pg_fetch_array($query_project_id);
$project_id = $project_id[0];

$query_get_progress = pg_query("SELECT p.progress FROM project p WHERE p.id = '$project_id' ");

$progress = pg_fetch_array($query_get_progress);
$progress = $progress[0];

echo $progress;
?>