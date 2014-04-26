<?php

namespace Malenki\DesBaies\Stack;

use Malenki\DesBaies\Select as SelectClause;

class Select extends \SplQueue
{

    public function add($str_field, $str_table = null)
    {
        $this->push(new SelectClause($str_field, $str_table));

        return $this;
    }

    public function select($str_field, $str_table = null)
    {
        return $this->add($str_field, $str_table);
    }

    // TODO
    public function __call($str, $arr)
    {
        if(
            in_array(
                $str,
                array('alias')
            )
        )
        {
            if (in_array($str, array('subString'))) {
                $this->top()->$str($arr[0], $arr[1]);
            } else {
                $this->top()->$str(array_pop($arr));
            }

            return $this;
        }
    }

    // TODO
    public function render()
    {
        $this->rewind();

        $arr = array();

        while ($this->valid()) {
            $arr[] = $this->current()->render();
            $this->next();
        }

        return implode(', ', $arr);
    }
}
