<?php
namespace tests;
use Snicksnk\MaitavrApi\Api;
use Snicksnk\MaitavrApi\Transport\TransportInterface;
use Snicksnk\MaitavrApi\Response\ResponseInterface;
use Snicksnk\MaitavrApi\Request\Users\UList;
use Snicksnk\MaitavrApi\Request\Users\Count;

class ApiTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){

    }

    public function testRequestWithoutAuthData(){
        $requestData = json_encode(array('login'=>'login','secretKey'=>'key'));
        $transportMock = $this->getMockBuilder('Snicksnk\MaitavrApi\Transport\TransportInterface')
            ->setMethods(array('performRequest'))
            ->getMock();
        $transportMock->expects($this->once())->method('performRequest')
            ->with($this->equalTo('https://maitavr.org/subsystem/partners/api/usersList'), $this->equalTo($requestData));

        $api = new Api('login', 'key');
        $api->setTransport($transportMock);
        $api->requestAndGetObject(new UList());
    }


    public function testMakeRequestWithRows(){

        $requestData = json_decode('{
        "login": "login",
        "secretKey": "key",
        "rows": [
            "firstname",
            "lastname",
            "bday",
            "country"
        ]
        }',true);

        $responseData = json_decode('[
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

        $transportMock = $this->getMockBuilder('Snicksnk\MaitavrApi\Transport\TransportInterface')
            ->setMethods(array('performRequest'))
            ->getMock();
        $transportMock->expects($this->once())
            ->method('performRequest')
            ->with($this->equalTo('https://maitavr.org/subsystem/partners/api/usersList'), $this->equalTo(json_encode($requestData)))
            ->will($this->returnValue(json_encode($responseData)));

        $api = new Api('login', 'key');
        $api->setTransport($transportMock);

        $rowsSet = new UList(array(UList::ROW_FIRSTNAME, UList::ROW_LASTNAME, UList::ROW_BDAY, UList::ROW_COUNTRY));

        $response = $api->requestAndGetObject($rowsSet)->toArray();
        $this->assertEquals($responseData, $response);
    }

    public function testRequestWithFilter(){

        $requestData = json_decode('{
        "login": "login",
        "secretKey": "key",
        "rows": [
            "firstname",
            "lastname",
            "bday",
            "country"
        ],
        "emails": [
            "Snicksnk@gmail.com",
            "somemail@gmail.com"
        ]
        }',true);

        $responseData = json_decode('[
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

        $transportMock = $this->getMockBuilder('Snicksnk\MaitavrApi\Transport\TransportInterface')
            ->setMethods(array('performRequest'))
            ->getMock();
        $transportMock->expects($this->once())
            ->method('performRequest')
            ->with($this->equalTo('https://maitavr.org/subsystem/partners/api/usersList'), $this->equalTo(json_encode($requestData)))
            ->will($this->returnValue(json_encode($responseData)));

        $api = new Api('login', 'key');
        $api->setTransport($transportMock);

        $rowsSet = new UList(array(UList::ROW_FIRSTNAME, UList::ROW_LASTNAME, UList::ROW_BDAY, UList::ROW_COUNTRY));
        $rowsSet->addFilter('emails',array("Snicksnk@gmail.com", "somemail@gmail.com"));
        $response = $api->request($rowsSet);
        $this->assertEquals($responseData, $response);

    }

    public function testRealRequest(){
        $api = new Api('testapi', 'test12345678');
        $response = $api->requestAndGetObject(new UList());
        $this->assertTrue(is_array($response->toArray()));
    }

    public  function testRealRequestWithRowsSet(){
        $api = new Api('testapi', 'test12345678');
        $request = new UList(array(UList::ROW_BDAY, UList::ROW_EMAIL, UList::ROW_ICQ));
        $response = $api->requestAndGetObject($request);
        $this->assertTrue(is_array($response->toArray()));
    }

    public function testGetUsersCount(){
        $api = new Api('testapi', 'test12345678');
        $response = $api->request(new Count());
        $this->assertTrue(isset($response['count']));
    }

}
 