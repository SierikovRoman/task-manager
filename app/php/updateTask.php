<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input"));

$id = pg_escape_string($con, $data->id);
$title = pg_escape_string($con, $data->title);
$description = pg_escape_string($con, $data->description);
$start_dt = pg_escape_string($con, $data->start_dt);
$end_dt = pg_escape_string($con, $data->end_dt);
$employee_id = pg_escape_string($con, $data->executor_id);
$stage_id = pg_escape_string($con, $data->stage_id);
$project_id = pg_escape_string($con, $data->project_id);
$is_done = pg_escape_string($con, $data->status);

$query_update_task = pg_query("UPDATE task SET title = '$title', description = '$description', is_done = '$is_done', start_dt = '$start_dt', end_dt = '$end_dt', stage_id = '$stage_id' WHERE id = '$id' ");

$query_update_task_executor = pg_query("UPDATE task_executor SET employee_id = '$employee_id' WHERE task_id = '$id' ");

$query_all_project_task = pg_query("SELECT COUNT(*) FROM task WHERE project_id = '$project_id' ");
$all_project_task = pg_fetch_array($query_all_project_task);
$all_project_task = $all_project_task[0];

// echo $all_project_task;
// echo $project_id;

$query_all_done_task = pg_query("SELECT COUNT(*) FROM task WHERE is_done = true AND project_id = '$project_id'");
$all_done_task = pg_fetch_array($query_all_done_task);
$all_done_task = $all_done_task[0];

// echo $all_done_task;

$progress = ($all_done_task / $all_project_task) * 100;
$progress = number_format($progress, 2, '.', '');

$query = "UPDATE project SET progress = '$progress' WHERE id = '$project_id' ";

$result = pg_query($con, $query);
echo $progress;
// 

?>