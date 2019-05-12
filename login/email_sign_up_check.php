<?php
	
    require_once(__DIR__ . '/../util/email.php');

    session_start();
    
    $res = sendSecurityConfirmationEmail($_POST['email'], "newcomer");

    if($res == false){
        echo "false";
    }else{
        $_SESSION['confirmation_code'] = $res;
        echo "true";
    }
	
?>
