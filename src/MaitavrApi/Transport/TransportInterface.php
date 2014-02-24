<?php
namespace MaitavrApi\Transport;

/**
 * Interface TransportInterface
 * @package MaitavrApi\Transport
 */
interface TransportInterface {
    /**
     * @param string $requestUrl URL запроса
     * @param string $requestData JSON-содержимое запроса
     * @return mixed
     */
    public function performRequest($requestUrl, $requestData);
}