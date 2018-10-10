<?php
namespace Wrapper\FuncWrapper\Ini;

/**
 *
 * @author ingmar
 *
 */
class IniGet
{

    /**
     *
     * @var string
     */
    public $return;

    /**
     */
    public function __construct($varname)
    {
        $this->varname = $varname;
        $this->run();
    }

    public function run()
    {
        $this->return = ini_get($this->varname);
        if ($this->return === false) {
            throw new \Exception('ini_get varname not found');
        }
        return $this->return;
    }
}

