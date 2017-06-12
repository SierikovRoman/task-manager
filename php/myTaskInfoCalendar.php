<?php
session_start();
$id=$_SESSION['id'];

require_once 'database_connections.php';

$query_project_id = pg_query("SELECT max(project_id) FROM project_manager WHERE employee_id = '$id' ;");
$project_id = pg_fetch_array($query_project_id);
$project_id = $project_id[0];

$query = "SELECT t.id, t.title, t.description, t.start_dt AS start, t.end_dt AS end, m.name AS name, m.surname AS surname, t.is_done, st.name AS stage_name FROM task t
		  LEFT JOIN task_executor tx ON t.id = tx.task_id
		  LEFT JOIN member m ON tx.employee_id = m.id
		  LEFT JOIN stage st ON t.stage_id = st.id
		  LEFT JOIN model mod ON st.model_id = mod.id
		  LEFT JOIN task_executor tx ON tx.employee = '$id'
		  WHERE (t.project_id = '$project_id') AND (tx.employee = '$id') ";

$result = pg_query($query);
	
$arr = array();
	while($row = pg_fetch_assoc($result)){
		 $arr[] = $row; 
}  

echo json_encode($arr);

$done = array();
$done['task'] = $arr;
$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($done));
fclose($fp);

?>