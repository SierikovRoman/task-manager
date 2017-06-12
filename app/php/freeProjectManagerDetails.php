<?php

require_once 'database_connections.php'; 

$query = "SELECT m.id, m.name, m.surname FROM member m WHERE position = '2' AND project_id IS NULL ORDER BY m.id";

$result = pg_query($con, $query); 

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);

?>