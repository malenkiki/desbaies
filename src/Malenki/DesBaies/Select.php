<?php
namespace Malenki\DesBaies;

//use \SplStack as SplStack;
use Malenki\DesBaies\Field\Name as FieldName;

class Select
{
    protected $str_field = null;
    protected $str_alias = null;

    public function __construct($str_field = null, $str_table = null)
    {
        if ($str_field) {
            $this->setField($str_field, $str_table);
        }

    }

    public function setField($str_field, $str_table = null)
    {
        $this->str_field = FieldName::create($str_field, $str_table);
    }

    public static function create()
    {
        return new self();
    }

    public function alias($str)
    {
        if (is_string($str) && strlen($str)) {
            $this->str_alias = $str;
        } else {
            throw new \InvalidArgumentException(
                _('Alias value must be a not null string.')
            );
        }

        return $this;
    }

    public function subString($int_offset, $int_length = null)
    {
        if ($int_offset <= 0 || !is_numeric($int_offset)) {
            throw new \InvalidArgumentException(_('Offset must be greater than 0'));
        }

        if (is_numeric($int_length) && $int_length <= 0) {
            throw new \InvalidArgumentException(_('If given, length must be greater than 1'));
        }

        if ($int_length) {
            $this->str_field = sprintf(
                'SUBSTRING(%s,%d,%d)',
                $this->str_field,
                $int_offset,
                $int_length
            );
        } else {
            $this->str_field = sprintf(
                'SUBSTRING(%s,%d)',
                $this->str_field,
                $int_offset
            );
        }

        return $this;
    }

    public function render()
    {
        if ($this->str_alias) {
            return sprintf('%s AS `%s`', $this->str_field, $this->str_alias);
        } else {
            return $this->str_field;
        }
    }

    public function __toString()
    {
        return $this->render();
    }
}
