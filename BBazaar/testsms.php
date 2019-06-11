<?php
					$mobile = $_REQUEST['mobile'];
					$mobile = $mobile;
					$message = "Testing SMS API from BiryaniBazaar";
					//Please Enter Your Details
					$username="biryanibazaar007"; //your username
					$password="Biryani007@"; //your password
					$mobile="91".$mobile; //enter Mobile numbers comma seperated
					$message =$message;
					$senderid="bbazar"; //Your senderid
					$stype= 2; //Type Of Your Message
					$url="http://www.metamorphsystems.com/index.php/api/bulk-sms";
					$message = urlencode($message);
					$ch = curl_init();
					if (!$ch){die("Couldn't initialize a cURL handle");}
					$ret = curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt ($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
					curl_setopt ($ch, CURLOPT_POSTFIELDS,
					"username=$username&password=$password&from=$senderid&to=$mobile&message=$message&sms_type=$stype");
					$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
					// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
					$curlresponse = curl_exec($ch); // execute
					if(curl_errno($ch))
					echo 'curl error : '. curl_error($ch);
					if (empty($ret))
					{
					// some kind of an error happened
					die(curl_error($ch));
					curl_close($ch); // close cURL handler
					} 
					else 
					{
						$info = curl_getinfo($ch);
						curl_close($ch); // close cURL handler
						echo $curlresponse;
						
					}

?>