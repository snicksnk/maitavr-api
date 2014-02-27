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
* Запрос списка пользователей [MaitavrApi\Request\Users\UList](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/UList.php)
* Запрос количества пользоватлей 
[MaitavrApi\Request\Users\Count](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/Count.php) 
* Stream context transport [MaitavrApi\Transport\StreamContext](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Transport/StreamContext.php) - средство доставки запросов по умолчанию


Параметры, которые позволяют изменить поля, приходящие от сервера 
------------

Если не используется не один из этих параметров в ответ приходят все поля 


* [Список полей, которые можно получить в ответе](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/UList.php#L13)


* [MaitavrApi\Request\Users\UList::__construct(array $rows)](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/UList.php#L86) - передать список полей в виде массива в конструктор (ранее заданные поля будут заменены переданными в этот метод)  

* [MaitavrApi\Request\Users\UList::setRows(array $rows=null)](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/UList.php#L96) - задать список полей в виде массива

* [MaitavrApi\Request\Users\UList::addRow($rowName)](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/UList.php#L106) - добавить одно новое поле в ответ
 

Фильтрация: 

* [Фильтр, который можно применить к ответу](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/UList.php#L74)

* [MaitavrApi\Request\Users\UList::addFilter($rowName, $value)](https://github.com/snicksnk/maitavr-api/blob/master/src/MaitavrApi/Request/Users/UList.php#L115) - Добавить фильтр


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

