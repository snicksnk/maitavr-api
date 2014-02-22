<?php
namespace snicksnk\MaitavrApi\Rows;
class RowsSet {

    const ROW_FIRSTNAME = "firstname";
    const ROW_FATHERNAME = "fathername";
    const ROW_LASTNAME = "lastname";
    const ROW_BDAY = "bday";
    const ROW_COUNTRY = "country";
    const ROW_TEXT = "text";
    const ROW_SKYPE = "skype";
    const ROW_ICQ = "icq";
    const ROW_EMAIL = "email";
    const ROW_PHONES = "phones";
    const ROW_SITE = "site";
    const ROW_SEO = "seo";
    const ROW_PHOTOURL = "photoUrl";
    const ROW_PROFILEURL = "profileUrl";
    const ROW_MAITAVRPROFILE = "maitavrProfile";

    protected $rows = array();
    protected $filters = array();

    public function __construct($rows){
        $this->setRows($rows);
    }

    public function setRows(array $rows=null){
        $this->rows = array();
        foreach((array)$rows as $rowName){
            $this->addRow((string)$rowName);
        }
    }

    public function addRow($rowName){
        array_push($this->rows, (string)$rowName);
    }

    public function addFilter ($rowName, $value){
        $this->filters[$rowName] = $value;
    }

    public function getRows(){
        return $this->rows;
    }

    public function getFilters(){
        return $this->filters;
    }

} 