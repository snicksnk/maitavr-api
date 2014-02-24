<?php
namespace MaitavrApi\Request;
use MaitavrApi\Request\RequestInterface;
/**
 * Запрос с фильтром
 * Interface RequestWithFilterInterface
 * @package MaitavrApi\Request
 */
interface RequestWithFilterInterface extends RequestInterface {
    /**
     * Получить фильтры, которые будут применены к ответу на стороне сервера
     * @return array
     */
    public function getFilters();
} 