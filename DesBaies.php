<?php

namespace Malenki\DesBaies;

use Malenki\DesBaies\Stack\Select as StackSelect;
use Malenki\DesBaies\Stack\From as StackFrom;
use Malenki\DesBaies\Stack\Where as StackWhere;
use Malenki\DesBaies\Stack\Having as StackHaving;
use Malenki\DesBaies\Stack\OrderBy as StackOrderBy;
use Malenki\DesBaies\Stack\GroupBy as StackGroupBy;

class DesBaies
{
    protected $select;
    protected $from;
    protected $where;
    protected $having;

    protected $order;
    protected $group;
        
    protected $limit = null;
    protected $skip = 0;

    protected $update;


    public function __get($name)
    {
        if(in_array($name, array('select', 'from', 'where', 'having', 'order', 'group')))
        {
            return $this->$name;
        }
    }

    public function __construct(){
        $this->select = new StackSelect();
        $this->from = new StackFrom();
        $this->where = new StackWhere();
        $this->having = new StackHaving();
        $this->order = new StackOrderBy();
        $this->group = new StackGroupBy();
    }



    public static function create(){
        return new self();
    }

    public function limit($int)
    {
        if(is_numeric($int) && $int >= 0)
        {
            $this->limit = $int;
            return $this;
        }
        else
        {
            throw new \InvalidArgumentException(_('Limit must be zero or positive integer.'));
        }
    }

    public function skip($int)
    {
        if(is_numeric($int) && $int >= 0)
        {
            $this->skip = $int;
            return $this;
        }
        else
        {
            throw new \InvalidArgumentException(_('Offset must be zero or positive integer.'));
        }
    }



    public function render()
    {
        $arr = array();

        // SELECT
        if($this->select->count())
        {
            $arr[] = sprintf('SELECT %s', $this->select->render());

            if($this->from->count())
            {
                $arr[] = sprintf('FROM %s', $this->from->render());

                if($this->where->count())
                {
                    $arr[] = sprintf('WHERE %s', $this->where->render());
                }

                if($this->having->count())
                {
                    $arr[] = sprintf('HAVING %s', $this->having->render());
                }

                if($this->order->count())
                {
                    $arr[] = sprintf('ORDER BY %s', $this->order->render());
                }

                if($this->group->count())
                {
                    $arr[] = sprintf('GROUP BY %s', $this->group->render());
                }

                if($this->skip || $this->limit)
                {
                    if($this->skip)
                    {
                        $arr[] = sprintf('LIMIT %d,%d', $this->skip, $this->limit);
                    }
                    else
                    {
                        $arr[] = sprintf('LIMIT %d', $this->limit);
                    }
                }
            }
        }

        // UPDATE
        if($this->update)
        {
            //TODO
        }

        return implode("\n", $arr). ';';
    }



    public function __toString()
    {
        return $this->render();
    }
}
