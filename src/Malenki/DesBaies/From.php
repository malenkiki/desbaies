<?php
namespace Malenki\DesBaies;

use Malenki\DesBaies\Field\Name as FieldName;

class From
{
    protected $str_table = null;
    protected $str_alias = null;

    public function __construct($str_table = null, $str_alias = null)
    {
        if ($str_table) {
            $this->setTable($str_table, $str_alias);
        }

    }

    public function setTable($str_table, $str_alias = null)
    {
        $this->str_table = FieldName::create($str_table);

        if ($str_alias) {
            $this->str_alias = FieldName::create($str_alias);
        }
    }

    public static function create()
    {
        return new self();
    }

    public function render()
    {
        if ($this->str_alias) {
            return sprintf('%s AS %s', $this->str_table, $this->str_alias);
        } else {
            return $this->str_table;
        }
    }

    public function __toString()
    {
        return $this->render();
    }
}
