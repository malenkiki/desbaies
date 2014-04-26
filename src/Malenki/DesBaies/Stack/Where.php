<?php

namespace Malenki\DesBaies\Stack;

use Malenki\DesBaies\Where as WhereClause;

class Where extends \SplQueue
{
    public function add($str_field, $str_table = null)
    {
        $this->push(new WhereClause($str_field, $str_table));

        return $this;
    }

    public function where($str_field, $str_table = null)
    {
        return $this->add($str_field, $str_table);
    }

    public function addOr($str_field, $str_table = null)
    {
        $or = new WhereClause($str_field, $str_table);
        $or->asOr();

        $this->push($or);

        return $this;
    }

    public static function createSubWhere()
    {
        return new self();
    }

    public function addSub(Where $stack_sub_where)
    {
        $stack = new \stdClass();
        $stack->isSubWhere = true;
        $stack->condition = 'AND';
        $stack->wheres = $stack_sub_where;
        $this->push($stack);

        return $this;
    }

    public function addOrSub(Where $stack_sub_where)
    {
        $stack = new \stdClass();
        $stack->isSubWhere = true;
        $stack->condition = 'OR';
        $stack->wheres = $stack_sub_where;
        $this->push($stack);

        return $this;
    }

    public function __call($str, $arr)
    {
        if(
            in_array(
                $str,
                array('in', 'notIn', 'isNull', 'isNotNull', 'eq', 'ne', 'gt', 'ge', 'lt', 'le')
            )
        )
        {
            if (in_array($str, array('isNull', 'isNotNull'))) {
                $this->top()->$str();
            } else {
                $this->top()->$str(array_pop($arr));
            }

            return $this;
        }
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

                if (isset($this->current()->isSubWhere)) {
                    $str_condition = $this->current()->condition;
                    $str_printf = '%s (%s)';
                    $str_render = $this->current()->wheres->render();
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

    public function __toString()
    {
        return $this->render();
    }
}
