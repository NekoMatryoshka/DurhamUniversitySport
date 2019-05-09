<?php
	require '../DB/DB_Connection.php';

	$query = "SELECT id, name FROM facilities";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output ='<select id="facility" name="facility" class="form-control">
				<option value="all">All</option>';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
		}
	}
	$output.='</select>';
	echo $output;
?>