<?php
session_start();
$id=$_SESSION['id'];
include 'database_connections.php';

$data = json_decode(file_get_contents("php://input"));

$stage_id = pg_escape_string($con, $data->stages_id);

$query_project_id = pg_query("SELECT max(project_id) FROM project_manager WHERE employee_id='$id'");
$project_id = pg_fetch_array($query_project_id);
$project_id = $project_id[0];

$query_model_id = pg_query("SELECT model_id FROM project WHERE id = '$project_id' ");
$model_id = pg_fetch_array($query_model_id);
$model_id = $model_id[0];

$query = "SELECT t.id, t.title, t.description, t.start_dt, t.end_dt, m.name AS member_name, m.surname AS member_surname, t.is_done, st.name AS stage_name, t.project_id FROM task t
		  LEFT JOIN task_executor tx ON t.id = tx.task_id
		  LEFT JOIN member m ON tx.employee_id = m.id
		  LEFT JOIN stage st ON t.stage_id = st.id
		  LEFT JOIN model mod ON st.model_id = mod.id
		  WHERE (t.project_id = '$project_id') AND (mod.id = '$model_id') ORDER BY t.id;";

$result = pg_query($con, $query);
// echo true;


$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);
?>