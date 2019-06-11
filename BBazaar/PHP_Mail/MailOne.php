<?php
$fromMail = "ernikhilvats@gmail.com";
$fromName = "Nikhil";
$toMail = "nikhilvats554@gmail.com";
$toName = "Nikhil";
require_once "vendor/autoload.php";
$mail = new PHPMailer;                                                          
$mail->From = $fromMail;
$mail->FromName = $fromName;
$mail->addAddress($toMail, $toName);
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