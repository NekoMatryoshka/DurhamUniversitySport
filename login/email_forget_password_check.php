<?php
	
    require_once(__DIR__ . '/../util/email.php');
    require '../DB/DB_Connection.php';

    session_start();

    $query="SELECT * FROM members WHERE m_id = '".$_POST['id']."'";
    $statement = $connect->prepare($query);
	$statement->execute();
    $result = $statement->fetch();
    $total_row = $statement->rowCount();

    // when id does not exist.
    if($total_row <= 0){
        echo "exist fail";
    }else{
        $email = $result['email'];
        $username = $result['name'];
        $res = sendSecurityConfirmationEmail($email, $username);
        //email unable to send.
        if($res == false){
            echo "email false";
        }else{
            $_SESSION['confirmation_code'] = $res;
            $_SESSION['id_reset_password'] = $_POST['id'];
            echo "true";
        }
    } 

    
	
?>
