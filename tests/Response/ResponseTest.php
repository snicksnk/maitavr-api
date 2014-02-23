<?php
namespace tests\Response;
use snicksnk\MaitavrApi\Response\Response;
use snicksnk\MaitavrApi\Response\Exceptions\AuthException;
use snicksnk\MaitavrApi\Exceptions\ApiException;

class ResponseTest extends \PHPUnit_Framework_TestCase {


    public function testAuthException(){
        $this->setExpectedException(get_class(new AuthException()));
        $jsonResponse = json_encode(array('error'=>'true', 'errorText'=>'access denied'));
        $response = new Response();
        $response->setJSONResponse($jsonResponse);
    }

    public function testSomeOtherError(){
        $this->setExpectedException(get_class(new ApiException()));
        $jsonResponse = json_encode(array('error'=>'true', 'errorText'=>'other error'));
        $response = new Response();
        $response->setJSONResponse($jsonResponse);
    }

    public function testParseResponse(){
        $json = '[
        {
            "firstname": "Александр",
            "lastname": "Галкин",
            "bday": "564958800",
            "country": "Украина"
        }, {
            "firstname": "Дмитрий",
            "lastname": "Образцов",
            "bday": "327186000",
            "country": "Россия"
        }]';

        $response = new Response();
        $response->setJSONResponse($json);
        $this->assertEquals(json_decode($json, true), $response->toArray());
    }

}
 