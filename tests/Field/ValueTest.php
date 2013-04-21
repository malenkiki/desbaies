<?php

include_once('Field/Value.php');

class ValueTest extends PHPUnit_Framework_TestCase
{
    public function testValueEmpty()
    {
        $this->assertEquals(
            'NULL',
            Malenki\DesBaies\Field\Value::create()
        );
    }

    public function testValueNull()
    {
        $this->assertEquals(
            'NULL',
            Malenki\DesBaies\Field\Value::create(null)
        );
    }

    public function testValueString()
    {
        $this->assertEquals(
            '"field_value"',
            Malenki\DesBaies\Field\Value::create('field_value')
        );
    }

    public function testValueNumber()
    {
        $this->assertEquals(
            '23',
            Malenki\DesBaies\Field\Value::create(23)
        );
    }
    
    public function testValueArrayNumbers()
    {
        $this->assertEquals(
            '(1,2,3)',
            Malenki\DesBaies\Field\Value::create(array(1, 2, 3))
        );
    }
    
    public function testValueArrayStrings()
    {
        $this->assertEquals(
            '("one","two","three")',
            Malenki\DesBaies\Field\Value::create(array('one', 'two', 'three'))
        );
    }
    
    public function testValueArrayNulls()
    {
        $this->assertEquals(
            '(NULL,NULL,NULL)',
            Malenki\DesBaies\Field\Value::create(array(null, null, null))
        );
    }
    
    public function testValueArrayMixed()
    {
        $this->assertEquals(
            '(1,"two",NULL)',
            Malenki\DesBaies\Field\Value::create(array(1, 'two', null))
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testValueVoidArray()
    {
        Malenki\DesBaies\Field\Value::create(array());
    }
}
