<?php
namespace tests\Request;
use snicksnk\MaitavrApi\Request\Users\Count;

class UsersCountTest extends \PHPUnit_Framework_TestCase {
    public function testGetRelativeUrl(){
        $api = new Count();
        $this->assertEquals('usersCount', $api->getRequestRelativeURL());
    }
}
 