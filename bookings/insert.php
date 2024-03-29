<?php

//insert.php

require '../DB/DB_Connection.php';
require_once('../util/email.php');

if($_POST["type"] == "user"){

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
		
		$date = date("Y-m-d", strtotime($_POST["date"]));
		$query = "
		SELECT * FROM bookings WHERE f_id =  '".$_POST["f_id"]."' AND m_id = '".$_POST["m_id"]."' 
		AND date = '".$date."'
		";

		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$total_row = $statement->rowCount();

		if($total_row > 0)
		{
			$output = "You already booked for this facility on ".$date;
		} 
		else
		{	
			$query = "
			SELECT * FROM bookings WHERE m_id = '".$_POST["m_id"]."'";
			$statement = $connect->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			$total_row = $statement->rowCount();
			
			if($total_row > 4)
			{
				$output = "You can't book more than 5";
			}
			else
			{
				$query = "
				SELECT * FROM bookings WHERE m_id = '".$_POST["m_id"]."' AND start_time =  '".$_POST["start_time"]."'
				";
				$statement = $connect->prepare($query);
				$statement->execute();
				$result = $statement->fetchAll();
				$total_row = $statement->rowCount();
						
						if($total_row > 0)
						{
							$output = "You already booked other facility on this time";
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

							// email sending
							$memberId = $_POST["m_id"];
							$bookingId = $connect->lastInsertId();
							$username = $_POST["m_name"];
							$facilityId = $_POST["f_id"];
							$facilityName = $_POST["f_name"];
							$startTime = substr($_POST["start_time"], 0, -3);
							$endTime = substr($_POST["end_time"], 0, -3);

							$query = "SELECT * FROM facilities WHERE id = '$facilityId'";
							$statement = $connect->prepare($query);
							$statement->execute();
							$result = $statement->fetch();
							$pay = $result['price'];
							//*(strtotime($endTime) - strtotime($startTime))/60/60

							$query = "SELECT * FROM members WHERE id = '$memberId'";
							$statement = $connect->prepare($query);
							$statement->execute();
							$result = $statement->fetch();
							$to = $result['email'];
							if (substr($to, -13) == '@durham.ac.uk'){
								$pay *= 0.8;
								$pay .= " (20% OFF)";
							}

							$bookingDetail = array("bookingId"=>$bookingId,
													"facilityName"=>$facilityName,
													"startTime"=>$startTime,
													"endTime"=>$endTime,
													"pay"=>$pay
							);
							sendBookingConfirmationEmail($to, $username, $bookingDetail);
						}
			}					
		}	
	}			
}
else
{
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
}



echo $output;

?>