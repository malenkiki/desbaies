<?php
include_once('Where.php');
include_once('Having.php');

class HavingTest extends PHPUnit_Framework_TestCase
{
    public function testIsAnd()
    {
        $h = new Malenki\DesBaies\Having('field_name');
        $this->assertTrue($h->isAnd());
    }

}
