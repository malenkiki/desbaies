<?php
include_once('src/Malenki/DesBaies/Where.php');
include_once('src/Malenki/DesBaies/Having.php');

class HavingTest extends PHPUnit_Framework_TestCase
{
    public function testIsAnd()
    {
        $h = new Malenki\DesBaies\Having('field_name');
        $this->assertTrue($h->isAnd());
    }

}
