<?php
namespace Malenki\DesBaies;

class GroupBy extends OrderBy
{
    protected $str_dir = null;
    
    public function __get($name)
    {
        if(in_array($name, array( 'desc', 'asc')))
        {
            $method = '_'.$name;
            return $this->$method();
        }
    }
    
    protected function _desc()
    {
        $this->str_dir = 'DESC';

        return $this;
    }

    
    protected function _asc()
    {
        $this->str_dir = 'ASC';

        return $this;
    }

    public function render()
    {
        if($this->str_dir)
        {
            return parent::render();
        }
        else
        {
            return $this->str_field;
        }
    }
}
