<?php
namespace snicksnk\MaitavrApi;
use snicksnk\MaitavrApi\Transport\TransportInterface;
use snicksnk\MaitavrApi\Transport\Curl;
use snicksnk\MaitavrApi\Rows\RowsSet;
/**
 * Class Api
 * @package snicksnk\MaitavrApi
 */
class Api {
    /**
     * @var string
     */
    protected $login;
    /**
     * @var string
     */
    protected $secretKey;
    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @param string $login
     * @param string $secretKey
     */
    public function __construct($login=null, $secretKey=null){
        if ($login !== null && $secretKey !== null){
            $this->setAuthData($login, $secretKey);
        }
        $this->transport = new Curl();
    }

    /**
    * @param string $login
    * @param string $secretKey
    */
    public function setAuthData($login, $secretKey){
        //TODO wrong authDataException
        $this->login = $login;
        $this->secretKey = $secretKey;
    }

    /**
     * @param TransportInterface $transport
     */
    public function setTransport(TransportInterface $transport){
        $this->transport = $transport;
    }

    public function request(RowsSet $rowsSet=null){
        $request = array('login'=>$this->login,'secretKey'=>$this->secretKey);
        if ($rowsSet !== null){
           $request['rows'] = $rowsSet->getRows();
        }

        $requestJson = json_encode($request);
        return $this->transport->performRequest($requestJson);
    }

}