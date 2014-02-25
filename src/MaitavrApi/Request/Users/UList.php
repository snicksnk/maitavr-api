<?php
namespace MaitavrApi\Request\Users;
use MaitavrApi\Request\RequestInterface;
use MaitavrApi\Request\RequestWithResponseRowsInterface;
use MaitavrApi\Request\RequestWithFilterInterface;

/**
 * Запрос списка пользователей
 * Class UList
 * @package MaitavrApi\Request
 */
class UList implements  RequestInterface, RequestWithResponseRowsInterface, RequestWithFilterInterface {
    /**
     * Имя
     */
    const ROW_FIRSTNAME = "firstname";
    /*
     * Отчество
     */
    const ROW_FATHERNAME = "fathername";
    /**
     * Фамилия
     */
    const ROW_LASTNAME = "lastname";
    /**
     * Дата рождения
     */
    const ROW_BDAY = "bday";
    /**
     * Страна
     */
    const ROW_COUNTRY = "country";
    /**
     * О себе
     */
    const ROW_TEXT = "text";
    /**
     * Логин в skype
     */
    const ROW_SKYPE = "skype";
    /*
     * Номер ICQ
     */
    const ROW_ICQ = "icq";
    /**
     * e-mail адрес
     */
    const ROW_EMAIL = "email";
    /**
     * Номер телефона
     */
    const ROW_PHONES = "phones";
    /**
     * url сайта
     */
    const ROW_SITE = "site";
    /**
     * Человеко-читаемая ссылка на профиль maitavr.org
     */
    const ROW_SEO = "seo";
    /**
     * Адрес аватары пользователя
     */
    const ROW_PHOTOURL = "photoUrl";
    /**
     * URL профиля на сайте партнера
     */
    const ROW_PROFILEURL = "profileUrl";
    /**
     * URL профиля на сайте maitavr.org
     */
    const ROW_MAITAVRPROFILE = "maitavrProfile";

    /**
     * Фильтрация по e-mail адресу
     */
    const FILTER_EMAIL = 'emails';


    protected $rows = array();
    protected $filters = array();

    /**
     * @param string $rows json-ответ от сервера
     */
    public function __construct($rows = null){
        if ($rows !== null){
            $this->setRows($rows);
        }
    }

    /**
     * Добавить ожидаемые поля в запрос
     * @param array/null $rows одномерный массив со списком полей, ожидаемых в ответе (см. const ROW_*)
     */
    public function setRows(array $rows=null){
        $this->rows = array();
        foreach((array)$rows as $rowName){
            $this->addRow((string)$rowName);
        }
    }

    /**
     * @param string $rowName Добавить ожидаемое в ответе поле (см. const ROW_*)
     */
    public function addRow($rowName){
        array_push($this->rows, (string)$rowName);
    }

    /**
     * Добавить поле фильтрации результата на стороне сервера
     * @param string $rowName Имя поля для фильтрации результата на стороне сервера
     * @param mixed $value Значение фильтра
     */
    public function addFilter ($rowName, $value){
        $this->filters[$rowName] = $value;
    }

    /**
     * Получить список ожидаемых в ответе полей
     * @return array
     */
    public function getRows(){
        return $this->rows;
    }

    /**
     * Получить фильтры, которые будут применены к ответу на стороне сервера
     * @return array
     */
    public function getFilters(){
        return $this->filters;
    }

    /**
     * Получить относительный url для этого запроса
     * @return string
     */
    public function getRequestRelativeURL(){
        return 'usersList';
    }

} 