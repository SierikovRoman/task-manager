<?php 
// Including database connections
require_once 'database_connections.php';

// Fetching and decoding the inserted data
$data = json_decode(file_get_contents("php://input")); 

// Escaping special characters from submitting data & storing in new variables.
$name = pg_escape_string($con, $data->name);
$surname = pg_escape_string($con, $data->surname);
$email = pg_escape_string($con, $data->email);
$access_type = pg_escape_string($con, $data->access_type);
$position = pg_escape_string($con, $data->pos_id);
$password = pg_escape_string($con, $data->password);

// pg insert query
$query = "INSERT INTO member(
	name, surname, email, access_type, position, password)

	VALUES ('$name', '$surname', '$email', '$access_type', '$position', '$password');";

	// VALUES ('test', 'test', 'test', '2', '0', '12345');";


// Inserting data into database
$result = pg_query($con, $query);
echo true;

?>