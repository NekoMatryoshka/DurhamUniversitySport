<?php
	require '../DB/DB_Connection.php';
		
		$query = "
		SELECT * FROM facilities WHERE id = '".$_POST["f_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{	
			$output['open_time'] = $row['open_time'];
			$output['close_time'] = $row['close_time'];
		}
		echo json_encode($output);
?>