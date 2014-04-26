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
