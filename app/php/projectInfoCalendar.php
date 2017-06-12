<?php

require_once 'database_connections.php';

$query = "SELECT p.id, p.title, p.start_dt AS start, p.end_dt AS end, p.progress, mod.name AS model, m.name AS name, m.surname AS surname 
		  FROM project p
		  LEFT JOIN project_manager prm ON prm.project_id = p.id
		  LEFT JOIN member m ON m.id = prm.employee_id
		  LEFT JOIN model mod ON mod.id = p.model_id";

$result = pg_query($query);

$arr = array();
while($row = pg_fetch_assoc($result)){
	 $arr[] = $row; 
}  

echo json_encode($arr);


//------ FOR TESTING RESULT.JSON


	// $sql="SELECT * FROM project"; 

	// $response = array();
	// $projects = array();
	// $result=pg_query($sql);
	// while($row=pg_fetch_array($result)) 
	// {
	// $id=$row['id'];
	// $title=$row['title']; 
	// $start_date=$row['start_dt']; 
	// $end_date=$row['end_dt']; 

	// $projects[] = array('id'=>$id, 'title'=> $title, 'start_dt'=> $start_date, 'end_dt'=> $end_date);

	// } 

	// $response['project'] = $projects;

	// $fp = fopen('results.json', 'w');
	// fwrite($fp, json_encode($response));
	// fclose($fp);


?>