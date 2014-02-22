<?php
namespace snicksnk\MaitavrApi\Transport;
use snicksnk\MaitavrApi\Transport\TransportInterface;

class Curl implements TransportInterface {
    const API_URL = 'https://maitavr.org/subsystem/partners/api';
    public function performRequest($requestData){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::API_URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("request"=>$requestData)));
        $out = curl_exec($curl);
        echo $out;
        curl_close($curl);
    }
} 