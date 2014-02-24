<?php
namespace MaitavrApi\Transport;
use MaitavrApi\Transport\TransportInterface;
use MaitavrApi\Transport\Exceptions\TransportLevelException;

class Curl implements TransportInterface {
    private $SSLVerifypeer = true;
    /**
     * Отправить
     * @param string $requestUrl Абсолютный путь для запроса
     * @param string $requestData Json данные для запроса
     * @return mixed JSON ответ
     * @throws Exceptions\TransportLevelException
     */
    public function performRequest($requestUrl, $requestData){
        $curl = curl_init();
        //Todo Fix it
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->SSLVerifypeer);
        curl_setopt($curl, CURLOPT_URL, $requestUrl);
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

    /**
     * Установить значение для опцию curl CURLOPT_SSL_VERIFYPEER
     * @param bool $value Значение
     */
    public function setCurlOptSSLVerifypeer($value){
        $this->SSLVerifypeer = (bool)$value;
    }

} 