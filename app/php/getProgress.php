<?php
session_start();
$id=$_SESSION['id'];

require_once 'database_connections.php'; 

$query_id=pg_query("SELECT project_id FROM project_manager WHERE employee_id='$id'");
$project_id=pg_fetch_array($query_id);
$project_id=$project_id[0];

$query_all_project_task = pg_query("SELECT COUNT(*) FROM task WHERE project_id = '$project_id' ");
$all_project_task = pg_fetch_array($query_all_project_task);
$all_project_task = $all_project_task[0];

$query_all_done_task = pg_query("SELECT COUNT(*) FROM task WHERE is_done = true AND project_id = '$project_id' ");
$all_done_task = pg_fetch_array($query_all_done_task);
$all_done_task = $all_done_task[0];

$progress = ($all_done_task / $all_project_task) * 100;
echo $progress;

?>