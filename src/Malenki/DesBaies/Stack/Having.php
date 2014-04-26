<?php

namespace Malenki\DesBaies\Stack;

use Malenki\DesBaies\Having as HavingClause;

class Having extends Where
{

    public function add($str_field, $str_table = null)
    {
        $this->push(new HavingClause($str_field, $str_table));

        return $this;
    }

    public function addOr($str_field, $str_table = null)
    {
        $or = new HavingClause($str_field, $str_table);
        $or->asOr();

        $this->push($or);

        return $this;
    }

    public function addSub(Having $stack_sub_having)
    {
        $stack = new \stdClass();
        $stack->isSubHaving = true;
        $stack->condition = 'AND';
        $stack->havings = $stack_sub_having;
        $this->push($stack);

        return $this;
    }

    public function addOrSub(Having $stack_sub_having)
    {
        $stack = new \stdClass();
        $stack->isSubHaving = true;
        $stack->condition = 'OR';
        $stack->havings = $stack_sub_having;
        $this->push($stack);

        return $this;
    }

    public function render()
    {
        $this->rewind();

        $arr_out = array();

        while ($this->valid()) {
            if ($this->key() == 0) {
                $arr_out[] = $this->current()->render();
            } else {
                $str_condition = 'AND';
                $str_printf = '%s %s';
                $str_render = '';

                if (isset($this->current()->isSubHaving)) {
                    $str_condition = $this->current()->condition;
                    $str_printf = '%s (%s)';
                    $str_render = $this->current()->havings->render();
                } else {
                    if ($this->current()->isOr()) {
                        $str_condition = 'OR';
                    }
                    $str_render = $this->current()->render();
                }

                $arr_out[] = sprintf($str_printf, $str_condition, $str_render);
            }
            $this->next();
        }

        return implode(' ', $arr_out);
    }
}
