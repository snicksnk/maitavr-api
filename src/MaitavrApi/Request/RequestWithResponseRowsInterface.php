<?php
namespace MaitavrApi\Request;
use MaitavrApi\Request\RequestInterface;
/**
 * Запрос, указывающий необходимые в ответе поля
 * Interface RequestWithResponseRows
 * @package MaitavrApi\Request
 */
interface RequestWithResponseRowsInterface extends RequestInterface {
    /**
     * Получить список полей необходимых в ответе
     * @return array список полей, необходимых в ответе
     */
    public function getRows();
} 