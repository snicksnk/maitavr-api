<?php
namespace tests\Rows;
use snicksnk\MaitavrApi\Rows\RowsSet;
class RowsSetTest extends \PHPUnit_Framework_TestCase {
    public function testRowsSet(){
        $rowsSet = new RowsSet();
        $rows = array(RowsSet::ROW_BDAY, RowsSet::ROW_COUNTRY, RowsSet::ROW_FATHERNAME);
        $rowsSet->setRows($rows);
        $this->assertEquals($rows, $rowsSet->getRows());
    }

    public function testEmptyRowsSet(){
        $rowsSet = new RowsSet();
        $this->assertEquals(array(), $rowsSet->getRows());
        $rowsSet->setRows(array(RowsSet::ROW_EMAIL));
        $rowsSet->setRows(array());
        $this->assertEquals(array(), $rowsSet->getRows());
    }

    public function testFilter(){
        $rowsSet = new RowsSet();
        $filterValue = array('snicksnk@gmail.com, "some@mail.ru');
        $rowsSet->addFilter(RowsSet::ROW_EMAIL, $filterValue);
        $this->assertEquals(array(RowsSet::ROW_EMAIL => $filterValue), $rowsSet->getFilters());
    }
}
 