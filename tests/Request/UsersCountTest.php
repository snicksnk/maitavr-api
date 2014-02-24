<?php
namespace tests\Request;
use MaitavrApi\Request\Users\Count;

class UsersCountTest extends \PHPUnit_Framework_TestCase {
    public function testGetRelativeUrl(){
        $api = new Count();
        $this->assertEquals('usersCount', $api->getRequestRelativeURL());
    }
}
 