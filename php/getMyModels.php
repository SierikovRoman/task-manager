<?php 

require_once 'database_connections.php';

$data = json_decode(file_get_contents("php://input")); 

$query = "SELECT id, name FROM model WHERE id != 1 AND id != 2 ";

$result = pg_query($con, $query);

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);

?>