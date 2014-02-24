<?php
namespace Snicksnk\MaitavrApi\Request;
use Snicksnk\MaitavrApi\Request\RequestInterface;
/**
 * Запрос, указывающий необходимые в ответе поля
 * Interface RequestWithResponseRows
 * @package Snicksnk\MaitavrApi\Request
 */
interface RequestWithResponseRowsInterface extends RequestInterface {
    /**
     * Получить список полей необходимых в ответе
     * @return array список полей, необходимых в ответе
     */
    public function getRows();
} 