<?php

namespace Malenki\DesBaies\Stack;

use Malenki\DesBaies\From as FromClause;



class From extends \SplQueue
{
    public function add($str_table, $str_alias = null)
    {
        $this->push(new FromClause($str_table, $str_alias));

        return $this;
    }



    public function from($str_table, $str_alias = null)
    {
        return $this->add($str_table, $str_alias);
    }





    // TODO
    public function render()
    {
        $this->rewind();

        $arr = array();

        while($this->valid())
        {
            $arr[] = $this->current()->render();
            $this->next();
        }

        return implode(', ', $arr);
    }
}


