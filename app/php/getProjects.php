<?php
// Including database connections
require_once 'database_connections.php'; 
// mysqli query to fetch all data from database

$query = "SELECT * FROM project_manager WHERE "; // JOIN access_type ON member.access_type = access_type.id LEFT JOIN position ON member.position = position.id

$result = pg_query($con, $query);

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);
?>