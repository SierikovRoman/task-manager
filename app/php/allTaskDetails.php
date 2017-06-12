<?php
session_start();
$id=$_SESSION['id'];
include 'database_connections.php';

$data = json_decode(file_get_contents("php://input"));

$query_task_id = pg_query("SELECT task_id FROM task_executor WHERE employee_id = '$id' ");
$task_id = pg_fetch_array($query_task_id);
$task_id = $task_id[0];

$query_project_id = pg_query("SELECT project_id FROM task WHERE id = '$task_id' ;"); 
$project_id = pg_fetch_array($query_project_id);
$project_id = $project_id[0];

$query = "SELECT t.id, t.title, t.description, t.start_dt, t.end_dt, m.name AS member_name, m.surname AS member_surname, t.is_done, st.name AS stage_name FROM task t
		  LEFT JOIN task_executor tx ON t.id = tx.task_id
		  LEFT JOIN member m ON tx.employee_id = m.id
		  LEFT JOIN stage st ON t.stage_id = st.id
		  WHERE t.project_id = '$project_id'
		  ORDER BY t.id;";

$result = pg_query($con, $query);


$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);
?>