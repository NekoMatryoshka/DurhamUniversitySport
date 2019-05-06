<?php

//action.php
include('../DB/DB_Connection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{				
		
		
		$folder_path = "../public/img/".$_FILES["file"]["name"];
		$img_path = "./public/img/".$_FILES["file"]["name"];
        move_uploaded_file($_FILES['file']['tmp_name'],$folder_path);
            
		$query = "
		INSERT INTO facilities (name, open_time, close_time, description, contact, tel, price, image) 
		VALUES ('".$_POST["name"]."','".$_POST["open_time"]."','".$_POST["close_time"]."','".$_POST["description"]."'
		,'".$_POST["contact"]."','".$_POST["tel"]."','".$_POST["price"]."','".$img_path."')
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>New facility is inserted.</p>';
	}
	
	
	if($_POST["action"] == "load_form")
	{
		
	
		$query = "
			SELECT id, name, TIME_FORMAT(open_time, '%H:%i') as open_time, TIME_FORMAT(close_time, '%H:%i') as close_time, contact, price, description, tel
	 		FROM facilities WHERE id = '".$_POST["id"]."'
		";
		
	
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{	
			$output['id'] = $row['id'];
			$output['name'] = $row['name'];
			$output['open_time'] = $row['open_time'];
			$output['close_time'] = $row['close_time'];
			$output['description'] = $row['description'];
			$output['contact'] = $row['contact'];
			$output['tel'] = $row['tel'];
			$output['price'] = $row['price'];
		}
		echo json_encode($output);
	}
	
	if($_POST["action"] == "update")
	{
	
		$folder_path = "../public/img/".$_FILES["file"]["name"];
		$img_path = "./public/img/".$_FILES["file"]["name"];
        move_uploaded_file($_FILES['file']['tmp_name'],$folder_path);
	
		$query = "
		UPDATE facilities 
		SET name = '".$_POST["name"]."', 
		open_time = '".$_POST["open_time"]."',
		close_time = '".$_POST["close_time"]."',
		contact = '".$_POST["contact"]."',
		price = '".$_POST["price"]."',
		tel = '".$_POST["tel"]."',
		image = '".$img_path."',
		description = '".$_POST["description"]."'  
		WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Successfully Updated.</p>';
		
	}
	
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM facilities WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Successfully Deleted.</p>';
	}
}

?>
