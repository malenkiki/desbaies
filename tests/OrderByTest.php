<?php
include_once('OrderBy.php');

class OrderByTest extends PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $ob = new Malenki\DesBaies\OrderBy('field_name');
        $this->assertEquals('`field_name` ASC', $ob->render());
    }

    public function testSimpleDesc()
    {
        $ob = new Malenki\DesBaies\OrderBy('field_name');
        $this->assertEquals('`field_name` DESC', $ob->desc()->render());
    }

}
