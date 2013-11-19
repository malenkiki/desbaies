<?php
include_once('src/Malenki/DesBaies/OrderBy.php');
include_once('src/Malenki/DesBaies/GroupBy.php');

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

