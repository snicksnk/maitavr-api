<?php
namespace tests\Transport;
use Snicksnk\MaitavrApi\Transport\StreamContext;
use Snicksnk\MaitavrApi\Transport\Exceptions\TransportLevelException;

class StreamContextTest extends \PHPUnit_Framework_TestCase {
    public function testTransportEcxeption(){
        $this->setExpectedException(get_class(new TransportLevelException()));
        $sc = new StreamContext();
        $sc->performRequest('','');
    }

    public function testTransportNotFoundEcxeption(){
        $this->setExpectedException(get_class(new TransportLevelException()));
        $sc = new StreamContext();
        $sc->performRequest('http:/someurlthatcannotexists.ruddd/123','');
    }
}
 