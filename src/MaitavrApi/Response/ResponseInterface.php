<?php
namespace snicksnk\MaitavrApi\Response;
/**
 * Interface ResponseInterface
 * @package snicksnk\MaitavrApi\Response
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