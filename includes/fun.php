<?php 
// Start with PHPMailer class 
use PHPMailer\PHPMailer\PHPMailer;

//set mail craiterian

// $mail_host='sandbox.smtp.mailtrap.io';
// $mail_user = '9c133dd7610d47';
// $mail_password = '7073871097ffd8';
// $port = 2525;

// websmail craiterians
$mail_host='p3plzcpnl499908.prod.phx3.secureserver.net';
$mail_user = 'mesbah@king-of-herbs.com';
$mail_password = 'Mahammad101459012';
$port = 587;

function send_mail($mail_host, $mail_user, $mail_password,$port , $from_mail_header, $from_mail, $userEmailheader, $userEmail, $body , $alt_body, $subject){

    // create a new object
    $mail = new PHPMailer();
   
    //set mail craiterian
    $mail->isSMTP();
    $mail->Host = "$mail_host";
    $mail->SMTPAuth = true;
    $mail->Username = "$mail_user" ;
    $mail->Password = "$mail_password";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $port;
    
    //set mail reciver and sender
    $mail->setFrom("$from_mail", "$from_mail_header");
    $mail->addAddress("$userEmail", "$userEmailheader");
    $mail->Subject = "$subject";
   
    // Set HTML 
    $mail->isHTML(TRUE);
    $mail->Body = "$body";
    $mail->AltBody = "$alt_body";
    return $mail;
    
    }
    
    function after_send_email($mail, $msg)
    {
      // send the message
      if (!$mail->send()) {
        array_push(DataHandlingController::$errs, "There is an error to send mail, please try again");
        echo (json_encode(DataHandlingController::$errs));
      } else {
        //success massage will show after send mail 
        $success['success'] = true;
        $success['successMsg'] = "$msg";
        echo (json_encode($success));
        die();
      }
    }