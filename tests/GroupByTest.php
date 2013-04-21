<?php
include_once('OrderBy.php');
include_once('GroupBy.php');

class GroupByTest extends PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $ob = new Malenki\DesBaies\GroupBy('field_name');
        $this->assertEquals('`field_name`', $ob->render());
    }

    public function testSimpleAsc()
    {
        $ob = new Malenki\DesBaies\GroupBy('field_name');
        $ob->asc();
        $this->assertEquals('`field_name` ASC', $ob->render());
    }

    public function testSimpleDesc()
    {
        $ob = new Malenki\DesBaies\GroupBy('field_name');
        $this->assertEquals('`field_name` DESC', $ob->desc()->render());
    }

}

