<?php
include_once('From.php');
include_once('Stack/From.php');

class Stack_FromTest extends PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $f = new Malenki\DesBaies\Stack\From();
        $f->add('table_name');
        $this->assertEquals('`table_name`', $f->render());
    }

    public function testMultipleAdds()
    {
        $f = new Malenki\DesBaies\Stack\From();
        $f->add('tbl_1');
        $f->add('tbl_2');
        $f->add('tbl_3');
        $this->assertEquals('`tbl_1`, `tbl_2`, `tbl_3`', $f->render());
    }
    
    public function testAddAlias()
    {
        $f = new Malenki\DesBaies\Stack\From();
        $f->add('table_name', 'alias_name');
        $this->assertEquals('`table_name` AS `alias_name`', $f->render());
    }

    public function testMulitpleAddAliases()
    {
        $f = new Malenki\DesBaies\Stack\From();
        $f->add('tbl_1', 'An alias');
        $f->add('tbl_2', 'Another alias');
        $f->add('tbl_3', 'Last but not the least');
        $this->assertEquals(
            '`tbl_1` AS `An alias`, `tbl_2` AS `Another alias`, `tbl_3` AS `Last but not the least`',
            $f->render()
        );
    }

    public function testMulitpleMixes()
    {
        $f = new Malenki\DesBaies\Stack\From();
        $f->add('tbl_1', 'An alias');
        $f->add('table two', 'simple_alias');
        $f->add('last one', 'last two :)');
        $this->assertEquals(
            '`tbl_1` AS `An alias`, `table two` AS `simple_alias`, `last one` AS `last two :)`',
            $f->render()
        );
    }


}
