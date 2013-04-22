<?php
namespace Malenki\DesBaies;

class GroupBy extends OrderBy
{
    protected $str_dir = null;
    
    public function asc()
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
