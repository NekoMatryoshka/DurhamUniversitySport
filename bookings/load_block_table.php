<?php
include("../DB/DB_Connection.php");



	if(isset($_POST["query"]))
	{	
		$search = $_POST["query"];
		$query = "
		SELECT * FROM blocks 
		WHERE name LIKE '%".$search."%'
        OR start_date LIKE '%".$search."%'
        OR end_date LIKE '%".$search."%'
		OR start_time LIKE '%".$search."%'
		OR end_time LIKE '%".$search."%'
		";
	}
	else
	{
		$query = "SELECT * FROM blocks";	
	}


$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
	<table class="table table-striped table-dark text-center" id="booking_table">
		<tr id="title">
            <th>Block ID</th>
            <th>Description</th>
			<th>Facility</th>
			<th>Start Time</th>
			<th>End Time</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Days of Week</th>
		</tr>
	';
		
if($total_row > 0)
{
	foreach($result as $row)
	{
        $blockbookingId = $row["id"];
        $facilityId = $row["f_id"];
		$startTime = substr($row["start_time"], 0, -3);
        $endTime = substr($row["end_time"], 0, -3);
        $start_date = $row["start_date"];
        $end_date = $row["end_date"];
        $dow = $row["dow"];
        $name = $row["name"];


        $query = "SELECT * FROM facilities WHERE id = '$facilityId'";
		$statement = $connect->prepare($query);
		$statement->execute();
        $res = $statement->fetch();
		$facility = $res['name'];

        $output .=
        "<tr>
            <td width='12%'>$blockbookingId</td>
            <td width='12%'>$name</td>
			<td width='12%'>$facility</td>
			<td width='12%'>$startTime</td>
            <td width='12%'>$endTime</td>
            <td width='12%'>$start_date</td>
            <td width='12%'>$end_date</td>
			<td width='12%'>$dow</td>
			<td width='4%'>
				<button type='button' name='delete' class='btn btn-outline-danger delete' id='$blockbookingId'>Del</button>
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