<?php
namespace Snicksnk\MaitavrApi\Transport;

/**
 * Interface TransportInterface
 * @package Snicksnk\MaitavrApi\Transport
 */
interface TransportInterface {
    /**
     * @param string $requestUrl URL запроса
     * @param string $requestData JSON-содержимое запроса
     * @return mixed
     */
    public function performRequest($requestUrl, $requestData);
}