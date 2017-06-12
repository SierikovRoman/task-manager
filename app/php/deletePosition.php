<?php 
// Including database connections
require_once 'database_connections.php';
// Fetching and decoding the inserted data
$data = json_decode(file_get_contents("php://input")); 

$query = "DELETE FROM position WHERE id=$data->del_id";

$result = pg_query($con, $query);
echo true;

?>