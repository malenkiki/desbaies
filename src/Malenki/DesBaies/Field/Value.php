<?php
namespace Malenki\DesBaies\Field;

class Value
{
    protected $mixed;



    protected function __construct($mixed = null)
    {
        $this->mixed = $mixed;
    }



    public static function create($mixed = null)
    {
        if(is_array($mixed) && count($mixed) == 0)
        {
            throw new \InvalidArgumentException('Array must contain at least one value');
        }

        $fv = new self($mixed);
        return $fv->render();
    }



    protected function render()
    {
        if(is_numeric($this->mixed))
        {
            return $this->mixed;
        }
        elseif(is_null($this->mixed))
        {
            return 'NULL';
        }
        elseif(is_array($this->mixed))
        {
            $arr_prov = array();

            foreach($this->mixed as $mixed_value)
            {
                $arr_prov[] = self::create($mixed_value);
            }

            return sprintf('(%s)', implode(',', $arr_prov));
        }
        else
        {
            return sprintf('"%s"', $this->mixed);
        }
    }
}

