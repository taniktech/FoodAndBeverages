<?php
require_once "vendor/autoload.php";
$mail = new PHPMailer;
//Enable SMTP debugging.                              
//Set PHPMailer to use SMTP.
//$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "relay-hosting.secureserver.net";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = false;                          
//Provide username and password     
$mail->Username = "nikhil@biryanibazaar.in";                 
$mail->Password = "nik007";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 25;                                   
$mail->From = "nikhil@biryanibazaar.in";
$mail->FromName = "Nikhil";
$mail->addAddress("ernikhilvats@gmail.com", "Nikhil");
$mail->WordWrap = 50;
$mail->isHTML(true);
$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";
if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}