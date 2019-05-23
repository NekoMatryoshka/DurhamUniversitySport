<?php
	require '../DB/DB_Connection.php';

	$query = "SELECT id, name, capacity FROM facilities";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '<option value="'.$row["id"].'">'.$row["name"]." (Capacity: ".$row["capacity"].")".'</option>';
		}
	}
	echo $output;
?>