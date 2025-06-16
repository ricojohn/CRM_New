<?php
namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function makeCall($to, $url, $statusCallbackUrl = null)
    {
        return $this->twilio->calls->create(
            $to,
            config('services.twilio.voice_from'),
            [
            'url' => $url, // This is a TwiML webhook endpoint
            'statusCallback' => $statusCallbackUrl,
            'statusCallbackEvent' => ['completed'], // You can also use: initiated, ringing, answered, completed
            'statusCallbackMethod' => 'POST',
            ]
        );
    }
}
