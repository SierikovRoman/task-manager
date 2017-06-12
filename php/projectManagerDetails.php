<?php

require_once 'database_connections.php'; 

$data = json_decode(file_get_contents("php://input"));

$project_id = pg_escape_string($con, $data->id);

$query = "SELECT m.id, m.name, m.surname FROM member m WHERE position = '2' AND ( project_id IS NULL OR project_id = '$project_id' ) ORDER BY m.id";

$result = pg_query($con, $query); 

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);

?>