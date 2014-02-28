<?php

//Кодировка utf-8

//Конструкция use должна быть в самом начале (но после namespace)
use MaitavrApi\Api;
use MaitavrApi\Request\Users\Count;
use MaitavrApi\Request\Users\UList;

//Подключаем автолоадер, если не используется composer (нужно поправить путь к этому файлу на вашем сайте)
require_once (__DIR__.'/maitavr-api/src/Tools/CompleteAutoloader.php');

//Создаем инстанс API класса (логин, Секретный ключ)
$api = new Api('testapi', 'test12345678');

//Создаем объект запроса списка пользователей
$request = new UList(array(UList::ROW_FIRSTNAME, UList::ROW_LASTNAME, UList::ROW_COUNTRY));
$request->addFilter('emails', array('galkina@i.ua', 'mail@perviy.kiev.ua'));

//Выполняем запрос, получаем ответ в виде массива
$response = $api->request($request);
        
//Выводим массив с ответом
var_dump($response);

