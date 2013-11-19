<?php
include_once('src/Malenki/DesBaies/GroupBy.php');
include_once('src/Malenki/DesBaies/Stack/OrderBy.php');

class Stack_GroupByTest extends PHPUnit_Framework_TestCase
{
    public function testBy()
    {
        $gb = new Malenki\DesBaies\Stack\GroupBy();
        $gb->by('field_name');
        $this->assertEquals('`field_name`', $gb->render());
    }

}
