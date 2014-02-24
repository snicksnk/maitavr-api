<?php
namespace tests\Request;
use MaitavrApi\Request\Users\UList;
class UsersListTest extends \PHPUnit_Framework_TestCase {

    public function testRowsSet(){
        $usersRequest = new UList();
        $rows = array(UList::ROW_BDAY, UList::ROW_COUNTRY, UList::ROW_FATHERNAME);
        $usersRequest->setRows($rows);
        $this->assertEquals($rows, $usersRequest->getRows());
    }

    public function testEmptyRowsSet(){
        $usersRequest = new UList();
        $this->assertEquals(array(), $usersRequest->getRows());
        $usersRequest->setRows(array(UList::ROW_EMAIL));
        $usersRequest->setRows(array());
        $this->assertEquals(array(), $usersRequest->getRows());
    }

    public function testFilter(){
        $usersRequest = new UList();
        $filterValue = array('Snicksnk@gmail.com, "some@mail.ru');
        $usersRequest->addFilter(UList::ROW_EMAIL, $filterValue);
        $this->assertEquals(array(UList::ROW_EMAIL => $filterValue), $usersRequest->getFilters());
    }
}
 