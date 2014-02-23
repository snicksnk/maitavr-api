<?php
namespace snicksnk\MaitavrApi\Request;
use snicksnk\MaitavrApi\Request\RequestInterface;
/**
 * Запрос, указывающий необходимые в ответе поля
 * Interface RequestWithResponseRows
 * @package snicksnk\MaitavrApi\Request
 */
interface RequestWithResponseRowsInterface extends RequestInterface {
    /**
     * Получить список полей необходимых в ответе
     * @return array список полей, необходимых в ответе
     */
    public function getRows();
} 