<?php
include_once('Having.php');
include_once('Stack/Having.php');

class Stack_HavingTest extends PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $h = new Malenki\DesBaies\Stack\Having();
        $h->add('field_name')->gt(1);
        $this->assertEquals('`field_name` > 1', $h->render());
    }

}

