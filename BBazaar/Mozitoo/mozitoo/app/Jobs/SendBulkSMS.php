<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBulkSMS extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $tenant_details;
    protected $sms_text;
    public function __construct($tenant_details, $sms_text)
    {
        $this->tenant_details= $tenant_details;
        $this->sms_text= $sms_text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mobile = $this->tenant_details->mobile;
		$message = urlencode($this->sms_text);
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
}
