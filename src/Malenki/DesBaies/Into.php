<?php
namespace Malenki\DesBaies;

// idée : $db->into->file('/tmp/truc.txt')->lineStart('')->lineEnd("\n")->fieldEnd("\t")->fieldEnclosedBy('"')->fieldEscapedBy('\\')

class Into
{
    protected $str_file = null;
    protected $arr_fields = array('TERMINATED BY' => '\t', 'ENCLOSED BY' => '', 'ESCAPED BY' => '\\');
    protected $arr_lines = array('STARTING BY' => '', 'TERMINATED BY' => '\n');
    protected $bool_out = true;

    public function __construct()
    {
    }

    public function file($str)
    {
        if (is_string($str) && strlen($str) && !file_exists($str)) {
            $this->str_file = $str;

            return $this;
        } else {
            throw new \InvalidArgumentException(_('The file must not already exist.'));
        }
    }

    public function fieldEnd($str = '\t')
    {
        if (is_string($str)) {
            $this->arr_fields['TERMINATED BY'] = $str;

            return $this;
        } else {
            // TODO: text!!
            throw new \InvalidArgumentException(_(''));
        }
    }

    public function fieldEnclosedBy($str = '')
    {
        if (is_string($str)) {
            $this->arr_fields['ENCLOSED BY'] = $str;

            return $this;
        } else {
            // TODO: text!!
            throw new \InvalidArgumentException(_(''));
        }
    }

    public function fieldEscapedBy($str = '\\')
    {
        if (is_string($str)) {
            $this->arr_fields['TERMINATED BY'] = $str;

            return $this;
        } else {
            // TODO: text!!
            throw new \InvalidArgumentException(_(''));
        }
    }

    public function lineStart($str = '')
    {
        if (is_string($str)) {
            $this->arr_lines['STARTING BY'] = $str;

            return $this;
        } else {
            // TODO: text!!
            throw new \InvalidArgumentException(_(''));
        }
    }

    public function lineEnd($str = '\n')
    {
        if (is_string($str)) {
            $this->arr_lines['TERMINATED BY'] = $str;

            return $this;
        } else {
            // TODO: text!!
            throw new \InvalidArgumentException(_(''));
        }
    }

    public function asDump()
    {
        $this->bool_out = false;

        return $this;
    }

    public function render()
    {
        $arr_out = array();

        if ($this->bool_out) {
            // TODO: echapper la chaîne…
            $arr_out[] = sprintf('OUTFILE "%s"', $this->str_file);

            $arr = array();

            foreach ($this->arr_fields as $k => $v) {
                $arr[] = sprintf('%s "%s"', $k, $v);
            }

            $arr_out[]  = sprintf('FIELDS %', implode(' ', $arr));

            $arr = array();

            foreach ($this->arr_lines as $k => $v) {
                $arr[] = sprintf('%s "%s"', $k, $v);
            }

            $arr_out[] = sprintf('LINES %', implode(' ', $arr));
        } else {
            $arr_out[] = sprintf('DUMPFILE "%s"', $this->str_file);
        }

        return implode(' ', $arr_out);
    }

    public function __toString()
    {
        return $this->render();
    }
}
