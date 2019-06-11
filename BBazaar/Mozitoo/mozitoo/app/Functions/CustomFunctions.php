<?php
namespace App\Functions;
use App\SMS_API\Sms;
use Mail;
class CustomFunctions
{
//OTP email sending
public function sendOtpMail($to_email, $otp)
{

   $send_mail = Mail::send('email_otp_teamplate', ['otp' => $otp], function ($message) use ($to_email) {
	$message->to($to_email)
			->subject('Mozitoo.com')
			->from('rental@mozitoooo.com', 'Mozitoo');
			});
} 
//Send email confirmation for invoice payment
public function sendInvConf($to_email, $msg)
{

   $send_mail = Mail::raw($msg, function ($message) use ($to_email) {
	$message->to($to_email)
			->subject('Mozitoo.com')
			->from('rental@mozitoooo.com', 'Mozitoo');
			});

} 
//This function can be used only in live server
public function sendSMS($to_mobile, $message)
{	
		$mobile = $to_mobile; //enter Mobile numbers comma seperated
		$message = urlencode($message);

		//Please Enter Your Details
		$user = "RMOZITO"; //your username
		$password = "Mozitoo123"; //your password		
		$sender_id = "Mozito"; //Your senderid
		$apid = 18214; //APID or Port Number
		$dcs = 0;
		//Make query string
		$query_string = "user=$user&password=$password&sender=$sender_id&dest=$mobile&apid=$apid&text=$message&dcs=$dcs";
		
		//Make CURL Request
		$curl = curl_init('http://5.9.0.178:5000/Sendsms?'.$query_string);
		if (!$curl)
		{
			return "Couldn't initialize a cURL handle";
		}
   	 	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
   	 	$response = curl_exec($curl);
		//If any error
		if(curl_errno($curl))
		{
			return 'curl error : '. curl_error($curl);
		}
		//If response is empty
		if (empty($response))
		{
		// some kind of an error happened
		die(curl_error($curl));
		curl_close($curl); // close cURL handler
		} 
		else 
		{
			$info = curl_getinfo($curl);
			curl_close($curl); // close cURL handler
			return $response;
			
		}
}
//End of file
}


?>