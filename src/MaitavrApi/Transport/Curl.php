<?php
namespace snicksnk\MaitavrApi\Transport;
use snicksnk\MaitavrApi\Transport\TransportInterface;
use snicksnk\MaitavrApi\Transport\Exceptions\TransportLevelException;

class Curl implements TransportInterface {
    const API_URL = 'https://maitavr.org/subsystem/partners/api';
    public function performRequest($requestData){
        $curl = curl_init();
        //Todo Fix it
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, self::API_URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("request"=>$requestData)));
        $out = curl_exec($curl);
        if ($error = curl_error($curl)){
            throw new TransportLevelException($error);
        }
        curl_close($curl);
        return $out;
    }
} 