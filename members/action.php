<?php

//action.php
include('../DB/DB_Connection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{				
		
    	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    	
		$query = "
		INSERT INTO members (m_id, password, name, email, tel) 
		VALUES ('".$_POST["m_id"]."','".$password."','".$_POST["name"]."','".$_POST["email"]."'
		,'".$_POST["tel"]."')
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>New facility is inserted.</p>';
	}
	
	
	if($_POST["action"] == "load_form")
	{
		
	
		$query = "
			SELECT * FROM members WHERE id = '".$_POST["id"]."'
		";
		
	
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{	
			$output['id'] = $row['id'];
			$output['m_id'] = $row['m_id'];
			$output['name'] = $row['name'];
			$output['password'] = $row['password'];
			$output['email'] = $row['email'];
			$output['tel'] = $row['tel'];
		}
		echo json_encode($output);
	}
	
	if($_POST["action"] == "update")
	{
	
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	
		$query = "
		UPDATE members
		SET m_id= '".$_POST["m_id"]."', 
		password = '".$password."',
		name = '".$_POST["name"]."',
		email = '".$_POST["email"]."',
		tel = '".$_POST["tel"]."'
		WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Successfully Updated.</p>';
		
	}
	
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM members WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Successfully Deleted.</p>';
	}
}

?>
