<?php

namespace Malenki\DesBaies\Stack;

use Malenki\DesBaies\OrderBy as OrderByClause;



class OrderBy extends \SplQueue
{
    public function by($str_field, $str_table = null)
    {
        $this->push(new OrderByClause($str_field, $str_table));

        return $this;
    }



    public function desc()
    {
        $this->top()->desc();

        return $this;
    }


    
    public function render()
    {
        $this->rewind();
        $arr_out = array();
        
        while($this->valid())
        {
            $arr_out[] = $this->current()->render();

            $this->next();
        }

        return implode(', ', $arr_out);
    }



    public function __toString()
    {
        return $this->render();
    }

}
