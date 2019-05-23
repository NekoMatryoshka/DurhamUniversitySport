<?php
	
	require '../DB/DB_Connection.php';

	session_start();
	$sentConfirmationCode = $_SESSION['confirmation_code'];
	$confirmationCode = $_POST['confirmation_code'];

	if(!isset($confirmationCode) || $confirmationCode != $sentConfirmationCode){
		echo "email fail";
		die();
	}
	
	
	if(isset($_POST["email"])) {
	
		$query="
		SELECT * FROM members WHERE email = '".$_POST['email']."' OR m_id = '".$_POST['id']."'
		";
	
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$total_row = $statement->rowCount();
	
		if($total_row > 0)
		{
			echo "fail";
		} 
	
		else
		{
			
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			
			$query ="INSERT INTO members (m_id, password, name, email, tel)
			VALUES ('".$_POST['id']."','".$password."','".$_POST['name']."','".$_POST['email']."','".$_POST['tel']."')
			";
	
			$statement = $connect->prepare($query);
			$statement->execute();
	
			echo "success";
	
		}
		
	}
	else{
		echo "fail";
	}
	
?>