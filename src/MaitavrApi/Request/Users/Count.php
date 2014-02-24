<?php
namespace MaitavrApi\Request\Users;
use MaitavrApi\Request\RequestInterface;
/**
 * Получить количество пользователей на сайте, привязанных к партнеру
 * Class Count
 * @package MaitavrApi\Request\Users
 */
class Count implements RequestInterface {
    /**
     * Получить относительный url для этого запроса
     * @return string
     */
    public function getRequestRelativeURL(){
        return 'usersCount';
    }
} 