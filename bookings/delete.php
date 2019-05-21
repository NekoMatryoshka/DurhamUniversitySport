<?php

//delete.php

require '../DB/DB_Connection.php';
require_once('../util/email.php');

if(isset($_POST["id"]))
{
	$bookingId = $_POST["id"];
	$query = "SELECT * FROM bookings WHERE id = '$bookingId'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetch();

	$query = "
	DELETE from bookings WHERE id='".$_POST["id"]."'";
	$statement = $connect->prepare($query);
	$statement->execute();

	$username = $result['m_name'];
	$userId = $result['m_id'];
	$query = "SELECT * FROM members WHERE id = '$userId'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetch();
	$to = $result['email'];

	echo sendBookingcancellationEmail($to, $username, $bookingId);
}

?>