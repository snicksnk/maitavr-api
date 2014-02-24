<?php
namespace tests\Transport;
use Snicksnk\MaitavrApi\Transport\Curl;
use Snicksnk\MaitavrApi\Transport\Exceptions\TransportLevelException;
class CurlTest extends \PHPUnit_Framework_TestCase {

    public function testSetOptSsl(){
        $curl = new Curl();
        $curl->setCurlOptSSLVerifypeer(true);
        $curl->setCurlOptSSLVerifypeer(false);
    }

    public  function  testTransportLevelException(){
        $this->setExpectedException(get_class(new TransportLevelException()));
        $curl = new Curl();
        $curl->performRequest('','');
    }
}
 