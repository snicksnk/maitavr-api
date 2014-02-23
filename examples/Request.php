<?php
use snicksnk\MaitavrApi\Api;
use snicksnk\MaitavrApi\Request\Users\Count;
use snicksnk\MaitavrApi\Request\Users\UList;

//Подключаем автолоадер, если не используется composer
spl_autoload_register(require_once (__DIR__.'/../src/Tools/SplAutoloader.php'));

//Создаем инстанс API класса
$api = new Api('testapi', 'test12345678');

//Запрос на количество пользователей
$responseWithCount = $api->request(new Count());
var_dump($responseWithCount);
/**

 array(1) {
    'count' =>
    int(4)
 }

*/

//Запрос всех пользователей со всеми данными
$responseWithFullUsersData = $api->request(new UList());
var_dump($responseWithFullUsersData);
/**
 array(2) {
    [0] =>
    array(15) {
        'firstname' =>
        string(18) "Александр"
        'fathername' =>
        string(16) "Иванович"
        'lastname' =>
        string(12) "Галкин"
        'bday' =>
        string(9) "564958800"
        'country' =>
        string(14) "Украина"
        'text' =>
        string(42) "Тестовый пользователь."
        'skype' =>
        string(13) "qweqwasdasd22"
        'icq' =>
        string(8) "46346346"
        'email' =>
        string(12) "galkina@i.ua"
        'phones' =>
        string(12) "380445428854"
        'profileUrl' =>
        array(2) {
            [0] =>
            string(18) "http://test.com.ru"
            [1] =>
            string(24) "http://test.com.ru/sasha"
        }
        'maitavrProfile' =>
        string(30) "https://maitavr.org/user/sasha"
        'photoUrl' =>
        string(34) "https://maitavr.org/uploads/_4.jpg"
        'site' =>
        string(19) "http://test3.com.ru"
        'seo' =>
        string(5) "sasha"
    }

    [1] =>
    array(15) {
        'firstname' =>
        string(12) "Михаил"
        'fathername' =>
        string(18) "Сергеевич"
        'lastname' =>
        string(14) "Сидоров"
        'bday' =>
        string(9) "106261200"
        'country' =>
        string(14) "Украина"
        'text' =>
        string(130) "Тестовый пользователь.
        Тестовый пользователь.
        Тестовый пользователь."
        'skype' =>
        string(7) "qwertyu"
        'icq' =>
        string(9) "354235325"
        'email' =>
        string(21) "andrey_ivanov@ukr.net"
        'phones' =>
        string(13) "+380501234567"
        'profileUrl' =>
        array(1) {
        [0] =>
        string(26) "http://test.com.ru/sidorov"
        }
        'maitavrProfile' =>
            string(32) "https://maitavr.org/user/sidorov"
            'photoUrl' =>
            string(35) "https://maitavr.org/uploads/_42.jpg"
            'site' =>
            string(10) "google.com"
            'seo' =>
            string(7) "sidorov"
        }
    }

 */

//Запрос нескольких пользователей с фильтром по email адресу
$usersRequestWithFilter = new UList();
$usersRequestWithFilter->addFilter('emails', array('andrey_ivanov@ukr.net', 'galkina@i.ua'));
$responseWithEmailFilter = $api->request($usersRequestWithFilter);
var_dump($responseWithEmailFilter);
/**
    array(2) {
      [0] =>
      array(15) {
        'firstname' =>
        string(18) "Александр"
        'fathername' =>
        string(16) "Иванович"
        'lastname' =>
        string(12) "Галкин"
        'bday' =>
        string(9) "564958800"
        'country' =>
        string(14) "Украина"
        'text' =>
        string(42) "Тестовый пользователь."
        'skype' =>
        string(13) "qweqwasdasd22"
        'icq' =>
        string(8) "46346346"
        'email' =>
        string(12) "galkina@i.ua"
        'phones' =>
        string(12) "380445428854"
        'profileUrl' =>
        array(2) {
          [0] =>
          string(18) "http://test.com.ru"
          [1] =>
          string(24) "http://test.com.ru/sasha"
        }
        'maitavrProfile' =>
        string(30) "https://maitavr.org/user/sasha"
        'photoUrl' =>
        string(34) "https://maitavr.org/uploads/_4.jpg"
        'site' =>
        string(19) "http://test3.com.ru"
        'seo' =>
        string(5) "sasha"
      }
      [1] =>
      array(15) {
        'firstname' =>
        string(12) "Михаил"
        'fathername' =>
        string(18) "Сергеевич"
        'lastname' =>
        string(14) "Сидоров"
        'bday' =>
        string(9) "106261200"
        'country' =>
        string(14) "Украина"
        'text' =>
        string(130) "Тестовый пользователь.
    Тестовый пользователь.
    Тестовый пользователь."
        'skype' =>
        string(7) "qwertyu"
        'icq' =>
        string(9) "354235325"
        'email' =>
        string(21) "andrey_ivanov@ukr.net"
        'phones' =>
        string(13) "+380501234567"
        'profileUrl' =>
        array(1) {
          [0] =>
          string(26) "http://test.com.ru/sidorov"
        }
        'maitavrProfile' =>
        string(32) "https://maitavr.org/user/sidorov"
        'photoUrl' =>
        string(35) "https://maitavr.org/uploads/_42.jpg"
        'site' =>
        string(10) "google.com"
        'seo' =>
        string(7) "sidorov"
      }
    }
*/

//Запрос только имени, фамилии и email адреса полей
$responseWithNotAllRows = $api->request(new UList(array(UList::ROW_FIRSTNAME, UList::ROW_LASTNAME, UList::ROW_EMAIL)));
var_dump($responseWithNotAllRows);
/**
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
        [3] =>
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















