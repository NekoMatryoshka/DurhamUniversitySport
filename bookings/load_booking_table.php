<?php
include("../DB/DB_Connection.php");

session_start();
$user_type = $_SESSION['type'];
$user_id = $_SESSION['id'];


if($user_type == "admin"){
	$query = "SELECT * FROM bookings";	
}
else
{
    $query = "SELECT * FROM bookings WHERE m_id = '$user_id'";		
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
	<table class="table table-striped table-dark text-center" id="booking_table">
		<tr id="title">
			<th>Booking ID</th>
			<th>Facility</th>
			<th>Booking User</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Total Payment</th>
		</tr>
	';
		
if($total_row > 0)
{
	foreach($result as $row)
	{
        $bookingId = $row["id"];
        $facilityId = $row["f_id"];
        $facility = $row["f_name"];
		$user = $row["m_name"];
		$userId = $row["m_id"];
		$startTime = substr($row["start_time"], 0, -3);
        $endTime = substr($row["end_time"], 0, -3);


        $query = "SELECT * FROM facilities WHERE id = '$facilityId'";
		$statement = $connect->prepare($query);
		$statement->execute();
        $res = $statement->fetch();
		$pay = $res['price'];

		$query = "SELECT * FROM members WHERE id = '$userId'";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetch();
		$to = $result['email'];
		if (substr("95223131@durham.ac.uk", -13) == '@durham.ac.uk')
			$pay *= 0.8;

        $output .=
        "<tr>
			<td width='16%'>$bookingId</td>
			<td width='16%' id='facility'>$facility</td>
			<td width='16%' id='user'>$user</td>
			<td width='16%'>$startTime</td>
			<td width='16%'>$endTime</td>
			<td width='16%'>$pay</td>
			<td width=‘4%’>
				<button type='button' name='delete' class='btn btn-outline-danger delete' id='$bookingId'>Del</button>
			</td>
		</tr>";
	}
}
else
{
	$output .='
	<tr>
		<td colspan="8" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</table>';
echo $output;
?>