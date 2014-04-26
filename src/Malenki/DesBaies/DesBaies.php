<?php
/*
Copyright (c) 2013 Michel Petit <petit.michel@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Malenki\DesBaies;

use Malenki\DesBaies\Stack\Select as StackSelect;
use Malenki\DesBaies\Stack\From as StackFrom;
use Malenki\DesBaies\Stack\Where as StackWhere;
use Malenki\DesBaies\Stack\Having as StackHaving;
use Malenki\DesBaies\Stack\OrderBy as StackOrderBy;
use Malenki\DesBaies\Stack\GroupBy as StackGroupBy;

/**
 * DesBaies writes for you SQL requests.
 *
 * With **DesBaies**, you can create SQL requests without SQL code, in PHP
 * only. This is great into complex request creation.
 *
 * @property-read \Malenki\DesBaies\Stack\Select $select Select part
 * @property-read \Malenki\DesBaies\Stack\From $from From part
 * @property-read \Malenki\DesBaies\Stack\Where $where Where part
 * @property-read \Malenki\DesBaies\Stack\Having $having Having part
 * @property-read \Malenki\DesBaies\Stack\Order $order Order part
 * @property-read \Malenki\DesBaies\Stack\Group $group Group part
 *
 * @author Michel Petit <petit.michel@gmail.com>
 * @license MIT
 */
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
        if (in_array($name, array('select', 'from', 'where', 'having', 'order', 'group'))) {
            return $this->$name;
        }
    }

    public function __construct()
    {
        $this->select = new StackSelect();
        $this->from = new StackFrom();
        $this->where = new StackWhere();
        $this->having = new StackHaving();
        $this->order = new StackOrderBy();
        $this->group = new StackGroupBy();
    }

    public static function create()
    {
        return new self();
    }

    public function limit($int)
    {
        if (is_numeric($int) && $int >= 0) {
            $this->limit = $int;

            return $this;
        } else {
            throw new \InvalidArgumentException('Limit must be zero or positive integer.');
        }
    }

    public function skip($int)
    {
        if (is_numeric($int) && $int >= 0) {
            $this->skip = $int;

            return $this;
        } else {
            throw new \InvalidArgumentException('Offset must be zero or positive integer.');
        }
    }

    public function render()
    {
        $arr = array();

        // SELECT
        if ($this->select->count()) {
            $arr[] = sprintf('SELECT %s', $this->select->render());

            if ($this->from->count()) {
                $arr[] = sprintf('FROM %s', $this->from->render());

                if ($this->where->count()) {
                    $arr[] = sprintf('WHERE %s', $this->where->render());
                }

                if ($this->having->count()) {
                    $arr[] = sprintf('HAVING %s', $this->having->render());
                }

                if ($this->order->count()) {
                    $arr[] = sprintf('ORDER BY %s', $this->order->render());
                }

                if ($this->group->count()) {
                    $arr[] = sprintf('GROUP BY %s', $this->group->render());
                }

                if ($this->skip || $this->limit) {
                    if ($this->skip) {
                        $arr[] = sprintf('LIMIT %d,%d', $this->skip, $this->limit);
                    } else {
                        $arr[] = sprintf('LIMIT %d', $this->limit);
                    }
                }
            }
        }

        // UPDATE
        if ($this->update) {
            //TODO
        }

        return implode("\n", $arr). ';';
    }

    public function __toString()
    {
        return $this->render();
    }
}
