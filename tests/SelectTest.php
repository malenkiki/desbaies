<?php
include_once('Select.php');

class SelectTest extends PHPUnit_Framework_TestCase
{
    public function testField()
    {
        $s = new Malenki\DesBaies\Select('field_name');
        $this->assertEquals('`field_name`', $s->render());
    }
    
    public function testFieldAlias()
    {
        $s = new Malenki\DesBaies\Select('field_name');
        $s->alias('alias_name');
        $this->assertEquals('`field_name` AS `alias_name`', $s->render());
    }
}
