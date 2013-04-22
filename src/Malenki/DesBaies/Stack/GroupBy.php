<?php

namespace Malenki\DesBaies\Stack;

use Malenki\DesBaies\GroupBy as GroupByClause;



class GroupBy extends OrderBy
{
    public function by($str_field, $str_table = null)
    {
        $this->push(new GroupByClause($str_field, $str_table));

        return $this;
    }
    
    public function asc()
    {
        $this->top()->asc();

        return $this;
    }
}
