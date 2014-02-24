<?php
namespace MaitavrApi\Request;

interface RequestInterface {
    /**
     * Метод, возвращающий относительный путь для конкретного запроса
     * @return mixed
     */
    public function getRequestRelativeURL();
} 