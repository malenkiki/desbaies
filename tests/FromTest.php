<?php
include_once('src/Malenki/DesBaies/From.php');

class FromTest extends PHPUnit_Framework_TestCase
{
    public function testTable()
    {
        $f = new Malenki\DesBaies\From('table_name');
        $this->assertEquals('`table_name`', $f->render());
    }
    
    public function testTableAlias()
    {
        $f = new Malenki\DesBaies\From('table_name', 'alias_name');
        $this->assertEquals('`table_name` AS `alias_name`', $f->render());
    }
}

