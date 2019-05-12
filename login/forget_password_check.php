<?php
	
	require '../DB/DB_Connection.php';

	session_start();
	$sentConfirmationCode = $_SESSION['confirmation_code'];
    $confirmationCode = $_POST['confirmation_code'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id = $_SESSION['id_reset_password'];

	if($confirmationCode != $sentConfirmationCode){
		echo "email fail";
		die();
	}
	
	if(isset($id)) {
        $query="UPDATE members SET password = '$password' WHERE m_id = '$id'";
        $statement = $connect->prepare($query);
        $statement->execute();
		echo "success";
	}
	
?>
