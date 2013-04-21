<?php
include_once('Where.php');

class WhereTest extends PHPUnit_Framework_TestCase
{
    public function testIsAnd()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $this->assertTrue($w->isAnd());
    }

    public function testIsOr()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->asOr();
        $this->assertTrue($w->isOr());
    }

    public function testIn()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->in(array(1, 2, 3));
        $this->assertEquals('`field_name` IN(1,2,3)',$w->render());
    }
    
    public function testNotIn()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->notIn(array(1, 2, 3));
        $this->assertEquals('`field_name` NOT IN(1,2,3)',$w->render());
    }
    
    public function testIsNull()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->isNull();
        $this->assertEquals('`field_name` IS NULL',$w->render());
    }
    
    public function testIsNotNull()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->isNotNull();
        $this->assertEquals('`field_name` IS NOT NULL',$w->render());
    }

    public function testEqNumber()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->eq(23);
        $this->assertEquals('`field_name` = 23',$w->render());
    }
    
    public function testEqString()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->eq('foo');
        $this->assertEquals('`field_name` = "foo"',$w->render());
    }
    
    public function testNeNumber()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->ne(23);
        $this->assertEquals('`field_name` <> 23',$w->render());
    }
    
    public function testNeString()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->ne('foo');
        $this->assertEquals('`field_name` <> "foo"',$w->render());
    }
    public function testGtNumber()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->gt(23);
        $this->assertEquals('`field_name` > 23',$w->render());
    }
    
    public function testGtString()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->gt('foo');
        $this->assertEquals('`field_name` > "foo"',$w->render());
    }
    public function testGeNumber()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->ge(23);
        $this->assertEquals('`field_name` >= 23',$w->render());
    }
    
    public function testGeString()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->ge('foo');
        $this->assertEquals('`field_name` >= "foo"',$w->render());
    }
    public function testLtNumber()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->lt(23);
        $this->assertEquals('`field_name` < 23',$w->render());
    }
    
    public function testLtString()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->lt('foo');
        $this->assertEquals('`field_name` < "foo"',$w->render());
    }
    
    public function testLeNumber()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->le(23);
        $this->assertEquals('`field_name` <= 23',$w->render());
    }
    
    public function testLeString()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->le('foo');
        $this->assertEquals('`field_name` <= "foo"',$w->render());
    }
    
    public function testEqNumberTable()
    {
        $w = new Malenki\DesBaies\Where('field_name', 'table_name');
        $w->eq(23);
        $this->assertEquals('`table_name`.`field_name` = 23',$w->render());
    }
    
    
    
    public function testEqf()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->eqf('other_field_name');
        $this->assertEquals('`field_name` = `other_field_name`',$w->render());
    }
    
    
    public function testNef()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->nef('other_field_name');
        $this->assertEquals('`field_name` <> `other_field_name`',$w->render());
    }
    
    public function testGtf()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->gtf('other_field_name');
        $this->assertEquals('`field_name` > `other_field_name`',$w->render());
    }
    
    public function testGef()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->gef('other_field_name');
        $this->assertEquals('`field_name` >= `other_field_name`',$w->render());
    }
    
    public function testLtf()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->ltf('other_field_name');
        $this->assertEquals('`field_name` < `other_field_name`',$w->render());
    }
    
    
    public function testLef()
    {
        $w = new Malenki\DesBaies\Where('field_name');
        $w->lef('other_field_name');
        $this->assertEquals('`field_name` <= `other_field_name`',$w->render());
    }
    
    public function testEqfTable()
    {
        $w = new Malenki\DesBaies\Where('field_name','bar');
        $w->eqf('other_field_name', 'foo');
        $this->assertEquals('`bar`.`field_name` = `foo`.`other_field_name`',$w->render());
    }
    
    
    public function testNefTable()
    {
        $w = new Malenki\DesBaies\Where('field_name','bar');
        $w->nef('other_field_name', 'foo');
        $this->assertEquals('`bar`.`field_name` <> `foo`.`other_field_name`',$w->render());
    }
    
    public function testGtfTable()
    {
        $w = new Malenki\DesBaies\Where('field_name','bar');
        $w->gtf('other_field_name', 'foo');
        $this->assertEquals('`bar`.`field_name` > `foo`.`other_field_name`',$w->render());
    }
    
    public function testGefTable()
    {
        $w = new Malenki\DesBaies\Where('field_name','bar');
        $w->gef('other_field_name', 'foo');
        $this->assertEquals('`bar`.`field_name` >= `foo`.`other_field_name`',$w->render());
    }
    
    public function testLtfTable()
    {
        $w = new Malenki\DesBaies\Where('field_name','bar');
        $w->ltf('other_field_name', 'foo');
        $this->assertEquals('`bar`.`field_name` < `foo`.`other_field_name`',$w->render());
    }
    
    
    public function testLefTable()
    {
        $w = new Malenki\DesBaies\Where('field_name','bar');
        $w->lef('other_field_name', 'foo');
        $this->assertEquals('`bar`.`field_name` <= `foo`.`other_field_name`',$w->render());
    }
}
