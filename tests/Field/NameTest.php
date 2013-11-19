<?php

include_once('src/Malenki/DesBaies/Field/Name.php');

class NameTest extends PHPUnit_Framework_TestCase
{


    public function testFieldNameAlone()
    {
        $this->assertEquals(
            '`field_name`',
            Malenki\DesBaies\Field\Name::create('field_name')
        );
    }



    public function testFieldNameFull()
    {
        $this->assertEquals(
            '`table_name`.`field_name`',
            Malenki\DesBaies\Field\Name::create('field_name', 'table_name')
        );
    }



    /**
     * @expectedException InvalidArgumentException
     */
    public function testBadFieldNameType()
    {
        Malenki\DesBaies\Field\Name::create(23);
    }



    /**
     * @expectedException LengthException
     */
    public function testBadFieldNameLength()
    {
        Malenki\DesBaies\Field\Name::create('');

    }



    /**
     * @expectedException InvalidArgumentException
     */
    public function testBadTableNameType()
    {
        Malenki\DesBaies\Field\Name::create('field_name', 23);
    }

    
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testBadTableNameLength()
    {
        Malenki\DesBaies\Field\Name::create('field_name', '');
    }
}
