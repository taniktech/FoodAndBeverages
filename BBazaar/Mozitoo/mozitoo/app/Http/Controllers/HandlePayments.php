<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HandlePayments extends Controller
{
    //Get checkout form
    public function getCheckout(Request $request)
    {
        return view('test_insta');
    }
    //Handle Payment
    public function createRequest(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array("X-Api-Key:test_3a13feefb92714acfe27bb36458",
                        "X-Auth-Token:test_b3ad2cca171184f5de650f40fa9"));
        $payload = Array(
            'purpose' => $request->purpose,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'buyer_name' => $request->name,
            'redirect_url' => 'http://localhost/mozitoo/checkout/',
            'send_email' => false,
            'webhook' => 'https://c9be2eb6.ngrok.io/mozitoo/checkout',
            'send_sms' => false,
            'email' => $request->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch); 

        $data = json_decode($response, true);
        $pay_url = $data['payment_request']['longurl'];
        header("Location: $pay_url");
        exit();
    }
}
