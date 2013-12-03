<?php
/*
Copyright (c) 2013 Michel Petit <petit.michel@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';



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
