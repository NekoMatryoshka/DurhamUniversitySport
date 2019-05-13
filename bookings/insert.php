<?php

//insert.php

require '../DB/DB_Connection.php';

if(isset($_POST["capacity"])){

	$query = "SELECT * FROM bookings 
	WHERE f_id =  '".$_POST["f_id"]."' AND start_time =  '".$_POST["start_time"]."'
	";	
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$num_events = $statement->rowCount();
	$capacity = (int)$_POST["capacity"];

	if($num_events > ($capacity - 1))
	{
		$output = "The number of available booking is exceeded";
	}
	else
	{
		$query = "
		INSERT INTO bookings 
		(m_id, m_name, f_id, f_name, date, start_time, end_time) 
		VALUES ('".$_POST["m_id"]."', '".$_POST["m_name"]."', '".$_POST["f_id"]."', '".$_POST["f_name"]."', 
		'".$_POST["date"]."', '".$_POST["start_time"]."', '".$_POST["end_time"]."')
		";
		$statement = $connect->prepare($query);
		$statement->execute();
	
		$output = "Succeessfully booked";
	}

	echo $output;

}
?>