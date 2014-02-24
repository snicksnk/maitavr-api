<?php
namespace Snicksnk\MaitavrApi\Response;
/**
 * Interface ResponseInterface
 * @package Snicksnk\MaitavrApi\Response
 */
interface ResponseInterface {
    /**
     * Передать классу json ответ от сервера
     * @param $jsonResponse
     * @return null
     */
    public function setJSONResponse($jsonResponse);

    /**
     * Получить ответ в виде массива
     * @return array
     */
    public function toArray();
} 