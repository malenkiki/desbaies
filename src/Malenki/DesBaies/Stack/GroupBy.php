<?php

namespace Malenki\DesBaies\Stack;

use Malenki\DesBaies\GroupBy as GroupByClause;

class GroupBy extends OrderBy
{

    public function __get($name)
    {
        if (in_array($name, array( 'desc', 'asc'))) {
            $method = '_'.$name;

            return $this->$method();
        }
    }

    public function by($str_field, $str_table = null)
    {
        $this->push(new GroupByClause($str_field, $str_table));

        return $this;
    }

    protected function _desc()
    {
        $this->top()->desc;

        return $this;
    }

    protected function _asc()
    {
        $this->top()->asc;

        return $this;
    }
}
