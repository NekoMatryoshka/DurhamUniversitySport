<?php
	session_start();
	
	require '../DB/DB_Connection.php';
	
	$id = $_POST['id'];
	$password = $_POST['password'];
		
	$query="
			SELECT * FROM members WHERE m_id= '".$id."'
			";
	
	$statement = $connect->prepare($query);
	$statement->execute();
	$total_row = $statement->rowCount();
	
	
		if($total_row > 0)
		{
			$result = $statement->fetchAll();
			
			foreach($result as $row)
			{
				if(password_verify($password, $row['password']))
				{
					
					$_SESSION['id'] = $row['id'];
					$_SESSION['m_id'] = $row['m_id'];
					$_SESSION['type'] = $row['type'];
					echo "success";	
				}
				else
				{
					echo "fail";
				}
			}
		} 
?>
