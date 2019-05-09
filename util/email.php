<?php
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require './PHPMailer/src/Exception.php'; 
require './PHPMailer/src/PHPMailer.php'; 
require './PHPMailer/src/SMTP.php';

function sendSecureEmail($to, $username, $subject, $message) {
    //security filter on receiver address
    $field = filter_var($to, FILTER_SANITIZE_EMAIL);
    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) 
        return false;

    $mail = new PHPMailer(true);
    try {
        //set SMTP headers
        $mail->CharSet ="UTF-8";
        $mail->SMTPDebug = 0;
        $mail->IsSMTP(); 
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'donotreply.dus@gmail.com'; 
        $mail->Password = 'GROUPNINEDUS';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        //update SSL security policy, which this takes me more than 1 hour to debug it.
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //set email details
        $mail->SetFrom('donotreply.dus@gmail.com', 'Durham University Sport');
        $mail->AddAddress($to, $username);
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->Send();
        return true;
    } catch (Exception $e) {
        //echo $mail->ErrorInfo;
        return false;
    }
}



function sendSecurityConfirmationEmail($to, $username) {
    $randomConfirmationCode = strtoupper(substr(md5(uniqid(rand(), true)), 5, 5));
    $subject = "DSU: Please verify your email address";
    $message = "Hello $username,<br/>&nbsp&nbsp&nbsp&nbspPlease verify your email address. Your Confirmation code from DUS is <b>$randomConfirmationCode</b>.";
    $isSent = sendSecureEmail($to, $username, $subject, $message);
    if($isSent){
        return $randomConfirmationCode;
    } else{
        return false;
    }
}

function sendBookingConfirmationEmail($to, $username, $booking){
    $subject = "DSU: Block";
    $greetings = "Hello $username,<br/>&nbsp&nbsp&nbsp&nbspThank you for your booking. Here is your booking details";
    //TODO: Add booking detail as well as the payment number here, dont forget the discount for members.
    $bookingDetails = "<table></table>"
    $message = 
    $isSent = sendSecureEmail($to, $username, $subject, $message);
    if($isSent){
        return $randomConfirmationCode;
    } else{
        return false;
    }
}

?>