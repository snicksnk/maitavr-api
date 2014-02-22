<?php
namespace tests;
use snicksnk\MaitavrApi\Api;
use snicksnk\MaitavrApi\Transport\TransportInterface;
use snicksnk\MaitavrApi\Response\ResponseInterface;
use snicksnk\MaitavrApi\Rows\RowsSet;

class ApiTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){

    }

    public function testRequestWithoutAuthData(){
        $requestData = json_encode(array('login'=>'login','secretKey'=>'key'));
        $transportMock = $this->getMockBuilder('snicksnk\MaitavrApi\Transport\TransportInterface')
            ->setMethods(array('performRequest'))
            ->getMock();
        $transportMock->expects($this->once())->method('performRequest')->with($this->equalTo($requestData));

        $api = new Api('login', 'key');
        $api->setTransport($transportMock);
        $api->request();
    }


    public function testMakeRequestWithRows(){

        $jsonRequest = json_decode('{
        "login": "login",
        "secretKey": "key",
        "rows": [
            "firstname",
            "lastname",
            "bday",
            "country"
        ]
        }',true);

        $jsonResponse = json_decode('[
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
        }]',true);

        $transportMock = $this->getMockBuilder('snicksnk\MaitavrApi\Transport\TransportInterface')
            ->setMethods(array('performRequest'))
            ->getMock();
        $transportMock->expects($this->once())
            ->method('performRequest')
            ->with($this->equalTo($jsonRequest))
            ->will($this->returnValue(json_encode($jsonResponse)));

        $api = new Api('login', 'key');
        $api->setTransport($transportMock);
        $rowsSet = new RowsSet(array(RowsSet::ROW_FIRSTNAME, RowsSet::ROW_LASTNAME, RowsSet::ROW_BDAY, RowsSet::ROW_COUNTRY));

        $response = $api->request($rowsSet)->asArray();

        $this->assertEquals($jsonResponse, $response);

    }





}
 