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
			'color' =>  "yellow",
			'f_name' => $row["f_name"]
		);
	} 
	else
	{
		$data[]= array(
			'id' => $row["id"],
			'f_id' => $row["f_id"],
			'title' => $row["m_name"],
			'start' => $row["start_time"],
			'end' => $row["end_time"],
			'f_name' => $row["f_name"]
		);
	}
}

$query = "SELECT * FROM blocks";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row)
{
	$f_id = $row["f_id"];
	$f_query = "SELECT * FROM facilities WHERE id = '$f_id'";
	$f_statement = $connect->prepare($f_query);
	$f_statement->execute();
	$f_result = $f_statement->fetch();
	$f_name = $f_result['name'];

	$data[]= array(
		'type' => 'block',
		'id' => $row["id"],
		'title' => $row["name"],
		'f_id' => $row["f_id"],
		'f_name' => $f_name,
		'start' => $row["start_time"],
		'end' => $row["end_time"],
		'dow' => explode(',', $row["dow"]),
		'ranges' => array(
			'start' => $row["start_date"],
			'end' => $row["end_date"]
		),
		'backgroundcolor' => "red",
		'color' =>  "red",
		'textColor' => 'white'
	);
}

echo json_encode($data);

?>