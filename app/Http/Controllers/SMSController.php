<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function compose()
    {
        return view('composer');
    }

    public function sendSMS(Request $request)
    {


        $message = "Hello!" . "\n\n" .
            "You have a message " . "\n\n" .
            $request->message;

        $args = http_build_query(array(
            'token' => config('sms.token'),
            'from' => config('sms.from'),
            'to' => $request->mobile_number,
            'text' => $message));

//        $url = "http://api.sparrowsms.com/v2/sms/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('sms.url'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status_code == 200) {
            return redirect()->route('sms.response')->with('success', 'SMS sent succesfully');
        } else {
            return redirect()->route('sms.response')->with('danger', 'SMS couldnot sent succesfully');
        }
    }

    public function smsResponse()
    {
        return view('sms-response');
    }
}
