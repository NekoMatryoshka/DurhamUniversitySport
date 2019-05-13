<?php

require '../DB/DB_Connection.php';

$query = "SELECT * FROM bookings";

$data = array();
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
	$data[] = array(
	'id' => $row["id"],
	'f_id' => $row["f_id"],
	'title' => $row["m_name"],
	'start' => $row["start_time"],
	'end' => $row["end_time"]
	);
	
}

echo json_encode($data);

?>