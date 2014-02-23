<?php
namespace snicksnk\MaitavrApi;
use snicksnk\MaitavrApi\Request\RequestWithFilterInterface;
use snicksnk\MaitavrApi\Response\Response;
use snicksnk\MaitavrApi\Transport\TransportInterface;
use snicksnk\MaitavrApi\Transport\StreamContext;
use snicksnk\MaitavrApi\Request\RequestInterface;
use snicksnk\MaitavrApi\Request\RequestWithResponseRowsInterface;

/**
 * Class Api
 * @package snicksnk\MaitavrApi
 */
class Api {
    /**
     * @var string Логин
     */
    protected $login;
    /**
     * @var string Secret Key
     */
    protected $secretKey;
    /**
     * @var TransportInterface Объект-транспорт для доставки запросов на сервер maitavr.org
     */
    protected $transport;

    /**
     * URL запросов
     */
    const API_URL = 'https://maitavr.org/subsystem/partners/api/';

    /**
     * Создать инстанс класса API
     * @param string $login Логин
     * @param string $secretKey Secret key
     */
    public function __construct($login=null, $secretKey=null){
        if ($login !== null && $secretKey !== null){
            $this->setAuthData($login, $secretKey);
        }
        $this->setTransport(new StreamContext());
    }

    /**
    * Указать данные для аутефикации
    * @param string $login Логин
    * @param string $secretKey Пароль
    */
    public function setAuthData($login, $secretKey){
        //TODO wrong authDataException
        $this->login = $login;
        $this->secretKey = $secretKey;
    }

    /**
     * Указать транспорт для доставки запроса на сервер
     * @param TransportInterface $transport Класс-транспорт
     */
    public function setTransport(TransportInterface $transport){
        $this->transport = $transport;
    }

    /**
     * Сделать запрос
     * @param RequestInterface $request
     * @return Response
     */
    public function requestAndGetObject(RequestInterface $request){
        $requestData = array('login'=>$this->login,'secretKey'=>$this->secretKey);

        if ($request instanceof RequestWithResponseRowsInterface){
            $requestRows = $request->getRows();
            if (count($requestRows)>0){
                $requestData['rows'] = $requestRows;
            }
        }

        if ($request instanceof RequestWithFilterInterface){
            //TODO Вынести обработку фильтров в отдельный класс
            if ($filters = $request->getFilters()){
                foreach ($filters as $filterName=>$filterValue){
                    if ($filterName=='emails'){
                        $requestData['emails'] = $filterValue;
                    }
                }
            }
        }

        $requestJSON = json_encode($requestData);
        $requestURL = self::API_URL.$request->getRequestRelativeURL();
        $responseJSON = $this->transport->performRequest($requestURL, $requestJSON);

        $response = new Response();
        $response->setJSONResponse($responseJSON);
        return $response;
    }

    /**
     * Сделать запрос и получить ответ в виде массива
     * @param RequestInterface $request Инстанс класса-запроса
     * @return array Ответ от сервера
     */
    public function request(RequestInterface $request){
        return $this->requestAndGetObject($request)->toArray();
    }

}