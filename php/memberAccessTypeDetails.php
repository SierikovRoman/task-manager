<?php
// Including database connections
require_once 'database_connections.php'; 

$query = "SELECT id, access_name FROM access_type ORDER BY id";

$result = pg_query($con, $query);

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

// Return json array containing data from the database
echo $json_info = json_encode($arr);
?>