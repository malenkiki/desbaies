<?php
namespace Malenki\DesBaies\Field;

class Name
{
    protected $str_field;
    protected $str_table = null;

    protected function __construct($str_field, $str_table = null)
    {
        $this->str_field = trim($str_field);

        if (is_string($str_table)) {
            $this->str_table = trim($str_table);
        }
    }

    public static function create($str_field, $str_table = null)
    {
        if (!is_string($str_field)) {
            throw new \InvalidArgumentException('Field name must be a string value.');
        } elseif (strlen(trim($str_field)) == 0) {
            throw new \LengthException('Field name must be a not null string value.');
        } else {
            if(
                is_string($str_table) && strlen(trim($str_table)) == 0
                ||
                (!is_string($str_table) && !is_null($str_table))
            )
            {
                throw new \InvalidArgumentException('Reference to table must be a not null string.');
            }

            $fn = new self($str_field, $str_table);

            return $fn->render();
        }

    }

    protected function render()
    {
        if (is_null($this->str_table)) {
            return sprintf('`%s`', $this->str_field);
        } else {
            return sprintf('`%s`.`%s`', $this->str_table, $this->str_field);
        }
    }
}
