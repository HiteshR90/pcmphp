<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'lib/PHPMailerAutoload.php';

$mail = new PHPMailer();  
 $mail->SMTPDebug = 2;
$mail->IsSMTP();  // Telling the class to use SMTP
            $mail->SMTPAuth   = true;                   // enable SMTP authentication
            $mail->SMTPSecure = 'tls';                  // sets the prefix to the servier
            $mail->Host       = 'smtp.gmail.com';       // sets GMAIL as the SMTP server
            $mail->Port       = '25';                
            $mail->Username   = '';     // GMAIL username
            $mail->Password   = '';        // GMAIL password
            $mail->SetFrom('', 'Michael M');
            $mail->Subject    = 'Welcome to X';
            $mail->MsgHTML("Test");
            $mail->AddAddress("");
            
 
if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent.';
}
?>