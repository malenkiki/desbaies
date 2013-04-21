<?php
namespace Malenki\DesBaies;

use \SplStack as SplStack;
use Malenki\DesBaies\Field\Name as FieldName;
use Malenki\DesBaies\Field\Value as FieldValue;


class Where
{
    protected static $arr_operators = array(
        'EQ' => ' = ',
        'NE' => ' <> ',
        'GT' => ' > ',
        'GE' => ' >= ',
        'LT' => ' < ',
        'LE' => ' <= ',
        'REGEXP' => ' REGEX ',
        'LIKE' => ' LIKE ',
        'NOTLIKE' => ' NOT LIKE ',
        'IN' => ' IN',
        'NOTIN' => ' NOT IN',
        'IS' => ' IS ',
        'ISNOT' => ' IS NOT '
    );

    protected $str_field = null;
    protected $str_operator = null;
    protected $str_value = null;
    protected $str_condition = 'AND';



    public function __construct($str_field = null, $str_table = null)
    {
        if($str_field)
        {
            $this->setField($str_field, $str_table);
        }

    }

    public function setField($str_field, $str_table = null)
    {
        $this->str_field = FieldName::create($str_field, $str_table);
    }

    public static function create()
    {
        return new self();
    }


    public function asOr()
    {
        $this->str_condition = 'OR';
        return $this;
    }



    public function isAnd()
    {
        return $this->str_condition == 'AND';
    } 



    public function isOr()
    {
        return $this->str_condition == 'OR';
    } 






    protected function valuePart($str_operator, $mixed_value)
    {
        $this->str_operator = $str_operator;
        $this->str_value = FieldValue::create($mixed_value);

        return $this;
    }

    protected function valuePartAsField($str_operator, $str_field, $str_table = null)
    {
        $this->str_operator = $str_operator;
        $this->str_value = FieldName::create($str_field, $str_table);

        return $this;
    }

    
    public function in(array $arr)
    {
        return $this->valuePart('IN', $arr);
    }

    public function notIn(array $arr)
    {
        return $this->valuePart('NOTIN', $arr);
    }


    public function isNull()
    {
        return $this->valuePart('IS', null);
    }
    
    public function isNotNull()
    {
        return $this->valuePart('ISNOT', null);
    }


    public function eq($mixed)
    {
        return $this->valuePart('EQ', $mixed);
    }

    public function ne($mixed)
    {
        return $this->valuePart('NE', $mixed);
    }

    public function gt($mixed)
    {
        return $this->valuePart('GT', $mixed);
    }
    public function ge($mixed)
    {
        return $this->valuePart('GE', $mixed);
    }


    public function lt($mixed)
    {
        return $this->valuePart('LT', $mixed);
    }

    public function le($mixed)
    {
        return $this->valuePart('LE', $mixed);
    }



    public function eqf($str_field, $str_table = null)
    {
        return $this->valuePartAsField('EQ', $str_field, $str_table);
    }

    public function nef($str_field, $str_table = null)
    {
        return $this->valuePartAsField('NE', $str_field, $str_table);
    }

    public function gtf($str_field, $str_table = null)
    {
        return $this->valuePartAsField('GT', $str_field, $str_table);
    }
    public function gef($str_field, $str_table = null)
    {
        return $this->valuePartAsField('GE', $str_field, $str_table);
    }


    public function ltf($str_field, $str_table = null)
    {
        return $this->valuePartAsField('LT', $str_field, $str_table);
    }

    public function lef($str_field, $str_table = null)
    {
        return $this->valuePartAsField('LE', $str_field, $str_table);
    }

    public function render()
    {
        return sprintf(
            '%s%s%s',
            $this->str_field,
            self::$arr_operators[$this->str_operator],
            $this->str_value
        );
    }

    public function __toString()
    {
        return $this->render();
    }
}
