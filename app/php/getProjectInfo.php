<?php

require_once 'database_connections.php'; 

$data = json_decode(file_get_contents("php://input"));

$project_id = pg_escape_string($con, $data->project_id);

$query = "SELECT p.title, p.start_dt, p.end_dt, p.progress, mod.name AS model_name, m.name AS member_name, m.surname AS member_surname 
		  FROM project p
		  JOIN model mod ON p.model_id = mod.id
		  JOIN project_manager pr ON pr.project_id = '$project_id'
		  JOIN member m ON m.id = pr.employee_id
		  WHERE p.id = '$project_id' ";

$result = pg_query($con, $query);

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);

$done = array();
$done['project'] = $arr;
$fp = fopen('project.json', 'w');
fwrite($fp, json_encode($done));
fclose($fp);
?>