<?php
namespace snicksnk\MaitavrApi\Response;
use snicksnk\MaitavrApi\Exceptions\ApiException;
use snicksnk\MaitavrApi\Response\ResponseInterface;
use snicksnk\MaitavrApi\Response\Exceptions\AuthException;

class Response implements ResponseInterface {

    protected $response;

    public function setJSONResponse($jsonResponse){
        $response = json_decode($jsonResponse, true);
        if (isset($response['error']) && $response['error'] === 'true'){
            if ($response['errorText'] === 'access denied'){
                throw new AuthException("Your auth data is wrong");
            } else {
                throw new ApiException($response['errorText']);
            }
        }

        $this->response = $response;
    }

    public function toArray(){
        return $this->response;
    }
} 