<?php

include 'database_connections.php';

$data = json_decode(file_get_contents("php://input"));

$project_id = pg_escape_string($con, $data->project_id);

$query = "SELECT t.id, t.title, t.description, t.start_dt, t.end_dt, m.name AS member_name, t.is_done, st.name AS stage_name FROM task t
		  LEFT JOIN task_executor tx ON t.id = tx.task_id
		  LEFT JOIN member m ON tx.employee_id = m.id
		  LEFT JOIN stage st ON t.stage_id = st.id
		  LEFT JOIN model mod ON st.model_id = mod.id
		  WHERE t.project_id = '$project_id' ORDER BY t.id;";

$result = pg_query($con, $query);

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);
?>