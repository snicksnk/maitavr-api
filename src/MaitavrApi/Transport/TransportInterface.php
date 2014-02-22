<?php
namespace snicksnk\MaitavrApi\Transport;

/**
 * Interface TransportInterface
 * @package snicksnk\MaitavrApi\Transport
 */
interface TransportInterface {
    /**
     * @param $requestData
     * @return mixed
     */
    public function performRequest($requestData);
}