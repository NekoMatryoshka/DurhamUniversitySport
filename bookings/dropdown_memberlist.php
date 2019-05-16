<?php
	require '../DB/DB_Connection.php';

	$query = "SELECT id, m_id FROM members";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output ='<select id="member" name="member" class="form-control">';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '<option value="'.$row["id"].'">'.$row["m_id"].'</option>';
		}
	}
	$output.='</select>';
	echo $output;
?>