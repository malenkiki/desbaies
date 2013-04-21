<?php
namespace Malenki\DesBaies;

use Malenki\DesBaies\Field\Name as FieldName;


class OrderBy
{
    protected $str_field = null;
    protected $str_dir = 'ASC';
    
    
    public function __construct($str_field = null, $str_table = null)
    {
        if($str_field)
        {
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

    public function desc()
    {
        $this->str_dir = 'DESC';

        return $this;
    }

    public function render()
    {
        return sprintf('%s %s', $this->str_field, $this->str_dir);
    }

    public function __toString()
    {
        return $this->render();
    }
}
