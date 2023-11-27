<?php

namespace App\Models;
use AfricasTalking\SDK\AfricasTalking;
class messaging{
    function sendSMS($message, $phoneNumber){
        $username = 'test_sms_benso'; // use 'sandbox' for development in the test environment
        $apiKey   = 'db2ac1845ad8ddc1b42d09d5d79f36aae03233edde76ad2dd27a8c3ff70808f8'; // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => $phoneNumber,
            'message' => $message,
        ]);

//        print_r($result);
    }
}