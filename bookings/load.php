<?php

require '../DB/DB_Connection.php';

$query = "SELECT * FROM bookings";

$data = array();
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row)
{	
	if($_POST["session_id"] == $row["m_name"])
	{
		$data[]= array(
			'id' => $row["id"],
			'f_id' => $row["f_id"],
			'title' => $row["m_name"],
			'start' => $row["start_time"],
			'end' => $row["end_time"],
			'color' =>  "yellow"
		);
	} 
	else
	{
		$data[]= array(
			'id' => $row["id"],
			'f_id' => $row["f_id"],
			'title' => $row["m_name"],
			'start' => $row["start_time"],
			'end' => $row["end_time"]
		);
	}
}

echo json_encode($data);

?>