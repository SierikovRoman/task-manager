<?php
session_start();
$id=$_SESSION['id'];
include 'database_connections.php';

$query_get_lang = pg_query("SELECT lang FROM language WHERE member_id = '$id' ");
$lang_id=pg_fetch_array($query_get_lang);
$lang_id=$lang_id[0];

if ($lang_id == 'ukr') {
	$query = pg_query("UPDATE language SET lang='en' WHERE member_id = '$id' ");
}else if ($lang_id == 'en'){
	$query = pg_query("UPDATE language SET lang='ukr' WHERE member_id = '$id' ");
}

$query_get_lan = pg_query("SELECT lang FROM language WHERE member_id = '$id' ");
$lan_id=pg_fetch_array($query_get_lan);
$lan_id=$lan_id[0];

echo $lan_id ;
?>