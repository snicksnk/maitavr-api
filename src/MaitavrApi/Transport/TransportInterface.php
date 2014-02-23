<?php
namespace snicksnk\MaitavrApi\Transport;

/**
 * Interface TransportInterface
 * @package snicksnk\MaitavrApi\Transport
 */
interface TransportInterface {
    /**
     * @param string $requestUrl URL запроса
     * @param string $requestData JSON-содержимое запроса
     * @return mixed
     */
    public function performRequest($requestUrl, $requestData);
}