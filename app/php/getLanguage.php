<?php
session_start();
$id=$_SESSION['id'];
include 'database_connections.php';

$query_get_lan = pg_query("SELECT lang FROM language WHERE member_id = '$id' ");
$lan_id=pg_fetch_array($query_get_lan);
$lan_id=$lan_id[0];

echo $lan_id ;
?>