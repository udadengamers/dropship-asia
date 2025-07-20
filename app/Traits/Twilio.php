<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Twilio\Rest\Client;

trait Twilio 
{
    public function send_sms()
    {
        $sid = "ACdfc49799e29ea79653730f3e05c5fa34"; // Your Account SID from www.twilio.com/console please replace inside env

        $token = "97c8f30d4608696e3740bf45e3f4b039"; // Your Auth Token from www.twilio.com/console please replace inside env

        $client = new Client($sid, $token);

        $message = $client->messages->create(
            '+62895411966110', // Text this number
            [
                'from' => '+15017122661', // From a valid Twilio number
                'body' => 'Hello from Twilio!'
            ]
        );
    }
}
