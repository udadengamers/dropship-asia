<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Twilio\Rest\Client;

trait Nexmo 
{
    public function send_sms()
    {
        $basic  = new \Vonage\Client\Credentials\Basic("9bd38b55", "yRWqtJsw664nKKsP");
        
        $client = new \Vonage\Client($basic);
        
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("62895411966110", 'Aldi', 'A text message sent using the Nexmo SMS API')
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
