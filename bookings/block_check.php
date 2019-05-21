<?php

require '../DB/DB_Connection.php';

$date = strtotime($_POST["date"]);
$start_time = str_replace(":", "", $_POST["start_time"]);
$start_time = substr($start_time, strpos($start_time, " ") + 1);
$end_time = str_replace(":", "", $_POST["end_time"]);
$end_time = substr($end_time, strpos($end_time, " ") + 1);

$query = "SELECT * FROM blocks";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row)
{
	// $b_startTime = explode(" ", str_replace(":", "", $row["start_time"]), 2)[1];
	// $b_endTime = explode(" ", str_replace(":", "", $row["end_time"]), 2)[1];
	$b_startTime = str_replace(":", "", $row["start_time"]);
	$b_endTime = str_replace(":", "", $row["end_time"]);

	$b_startDate = strtotime($row["start_date"]);
	$b_endDate = strtotime($row["end_date"]);

	if ($date >= $b_startDate && $date <= $b_endDate) {
		if (($start_time >= $b_startTime && $start_time <= $b_endTime)
			|| ($end_time >= $b_startTime && $end_time <= $b_endTime)){
				echo "false";
				die();
			}
	}

}

// echo $date.',';
// echo $start_time.',';
// echo $end_time.',';
// echo $b_startTime.',';
// echo $b_endTime.',';
// echo $b_startDate.',';
// echo $b_endDate;

echo "true";

?>