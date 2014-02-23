<?php
namespace snicksnk\MaitavrApi\Request;
use snicksnk\MaitavrApi\Request\RequestInterface;
/**
 * Запрос с фильтром
 * Interface RequestWithFilterInterface
 * @package snicksnk\MaitavrApi\Request
 */
interface RequestWithFilterInterface extends RequestInterface {
    /**
     * Получить фильтры, которые будут применены к ответу на стороне сервера
     * @return array
     */
    public function getFilters();
} 