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


class DesBaiesTest extends PHPUnit_Framework_TestCase
{
    public function testSimpleQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`;",
            $db->render()
        );
    }

    public function testSimpleLimitQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->limit(10);

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`\nLIMIT 10;",
            $db->render()
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSimpleBadLimitQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->limit(-10);
        $db->render();
    }

    public function testSimpleLimitOffsetQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->limit(10)->skip(2);

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`\nLIMIT 2,10;",
            $db->render()
        );
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testSimpleBadLimitOffsetQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->limit(10)->skip(-2);
        $db->render();
    }

    public function testSimpleWhereQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->where->add('id')->eq(1);

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`\nWHERE `id` = 1;",
            $db->render()
        );
    }
    
    public function testSimpleHavingQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->having->add('id')->gt(1);

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`\nHAVING `id` > 1;",
            $db->render()
        );
    }
    
    
    public function testSimpleOrderByQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->order->by('foo');

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`\nORDER BY `foo` ASC;",
            $db->render()
        );
    }
    
    public function testSimpleOrderByDescQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->order->by('foo')->desc;

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`\nORDER BY `foo` DESC;",
            $db->render()
        );
    }
    
    public function testMultipleOrderByQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo')->add('foo2');
        $db->from->add('bar');
        $db->order->by('foo')->desc->by('foo2');

        $this->assertEquals(
            "SELECT `foo`, `foo2`\nFROM `bar`\nORDER BY `foo` DESC, `foo2` ASC;",
            $db->render()
        );
    }
    
    public function testMultipleOrderByWithTableQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo', 'b')->add('foo2', 'b2');
        $db->from->add('bar', 'b');
        $db->from->add('bar2', 'b2');
        $db->order->by('foo', 'b')->desc->by('foo2', 'b2');

        $this->assertEquals(
            "SELECT `b`.`foo`, `b2`.`foo2`\nFROM `bar` AS `b`, `bar2` AS `b2`\nORDER BY `b`.`foo` DESC, `b2`.`foo2` ASC;",
            $db->render()
        );
    }




    public function testSimpleGroupByQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->group->by('foo');

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`\nGROUP BY `foo`;",
            $db->render()
        );
    }
    
    public function testSimpleGroupByAscQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->group->by('foo')->asc();

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`\nGROUP BY `foo` ASC;",
            $db->render()
        );
    }
    
    public function testSimpleGroupByDescQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo');
        $db->from->add('bar');
        $db->group->by('foo')->desc;

        $this->assertEquals(
            "SELECT `foo`\nFROM `bar`\nGROUP BY `foo` DESC;",
            $db->render()
        );
    }
    
    public function testMultipleGroupByQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo')->add('foo2');
        $db->from->add('bar');
        $db->group->by('foo')->desc->by('foo2');

        $this->assertEquals(
            "SELECT `foo`, `foo2`\nFROM `bar`\nGROUP BY `foo` DESC, `foo2`;",
            $db->render()
        );
    }
    
    public function testMultipleGroupByWithTableQuery()
    {
        $db = new Malenki\DesBaies\DesBaies();
        $db->select->add('foo', 'b')->add('foo2', 'b2');
        $db->from->add('bar', 'b');
        $db->from->add('bar2', 'b2');
        $db->group->by('foo', 'b')->desc->by('foo2', 'b2')->asc();

        $this->assertEquals(
            "SELECT `b`.`foo`, `b2`.`foo2`\nFROM `bar` AS `b`, `bar2` AS `b2`\nGROUP BY `b`.`foo` DESC, `b2`.`foo2` ASC;",
            $db->render()
        );
    }

}
