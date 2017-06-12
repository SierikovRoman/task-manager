<?php
// session_start();
// $id=$_SESSION['id'];

require_once 'database_connections.php'; 

$data = json_decode(file_get_contents("php://input"));

$model_id = pg_escape_string($con, $data->id);

$query = "SELECT id, name FROM stage WHERE model_id = '$model_id' ORDER BY id ";

$result = pg_query($con, $query);

$arr = array();
if(pg_num_rows($result) != 0) {
	while($row = pg_fetch_assoc($result)) {
			$arr[] = $row;
	}
}

echo $json_info = json_encode($arr);

// echo $model_id;
// echo $model_name;
?>