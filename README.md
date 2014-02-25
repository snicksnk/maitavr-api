Maitavr-api
=========

Библиотека для работы с api maitavr.org

Установка через composer
--------------
Добавьте в composer.json 

```json
"require": {
    "snicksnk/maitavr-api": "0.1.*@dev"
}
```
И выполните 
```sh
php composer.phar update
```
Основные компоненты системы
-----

* Базовый класс api 
[MaitavrApi\Api](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Api.php)
* Запрос количества пользоватлей 
[MaitavrApi\Request\Users\Count](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/Count.php) 
* Запрос списка пользователей [MaitavrApi\Request\Users\UList](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/UList.php)
* Stream context transport [MaitavrApi\Transport\StreamContext](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Transport/StreamContext.php) - средство доставки запросов по умолчанию


Пример использования
-------------
```php
<?php
use MaitavrApi\Api;
use MaitavrApi\Request\Users\Count;
use MaitavrApi\Request\Users\UList;

//Подключаем автолоадер, если не используется composer
require (__DIR__.'/../src/Tools/CompleteAutoloader.php');

//Создаем инстанс API класса
$api = new Api('testapi', 'test12345678');

//Создаем объект запроса и передаем в конструктор поля, которые мы хотим видить в ответе
$request = new UList(array(UList::ROW_FIRSTNAME, UList::ROW_LASTNAME, UList::ROW_EMAIL));

//Добавляем фильтр по email адресу в запрос 
$request->addFilter(UList::FILTER_EMAIL, array('andrey_ivanov@ukr.net', 'galkina@i.ua'));

// Делаем запрос на сервер и получаем ответ в виде массива
$response = $api->request($request);
var_dump($response);
/*
array(2) {
  [0] =>
  array(3) {
    'firstname' =>
    string(18) "Александр"
    'lastname' =>
    string(12) "Галкин"
    'email' =>
    string(12) "galkina@i.ua"
  }
  [1] =>
  array(3) {
    'firstname' =>
    string(12) "Михаил"
    'lastname' =>
    string(14) "Сидоров"
    'email' =>
    string(21) "andrey_ivanov@ukr.net"
  }
}
*/
```
[Другие примеры](https://github.com/snicksnk/maitavr-api/blob/master/examples/Request.php)

