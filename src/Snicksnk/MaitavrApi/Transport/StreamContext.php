<?php
namespace Snicksnk\MaitavrApi\Transport;
use Snicksnk\MaitavrApi\Transport\Exceptions\TransportLevelException;
/**
 * Отправка запроса с использованием Stream Context
 * Class StreamContext
 * @package Snicksnk\MaitavrApi\Transport
 */
class StreamContext implements TransportInterface {
    /**
     * @param string $requestUrl
     * @param string $requestData
     * @return string
     */
    public function performRequest($requestUrl, $requestData){
        $postdata = http_build_query(
            array(
                'request' => $requestData
            )
        );
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        set_error_handler(array(get_class($this), 'errorHandler'));
        $result = file_get_contents($requestUrl, false, $context);
        restore_error_handler();
        return $result;
    }

    /**
     * Хэндлер, ловящий ошибки стрим контекста
     * @param $errno Номер ошибки
     * @param $errstr Текст ошибки
     * @throws Exceptions\TransportLevelException
     */
    protected static function errorHandler($errno, $errstr){
        throw new TransportLevelException($errstr);
    }


} 