<?php
namespace snicksnk\MaitavrApi\Request\Users;
use snicksnk\MaitavrApi\Request\RequestInterface;
/**
 * Получить количество пользователей на сайте, привязанных к партнеру
 * Class Count
 * @package snicksnk\MaitavrApi\Request\Users
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