<?php
namespace Wrapper\FuncWrapper\Ini;

/**
 *
 * @author ingmar
 *
 */
class IniGetAll
{

    public $extension;

    public $detail;

    /**
     * extension name is coming in case sensitive from get_loaded_extensions
     * BUT ini_get_all is expecting name lowercase
     * will be handled strtolower
     *
     * FINDINGS:
     * core in regard to ini values is the same as <null> (get all) (here 306 keys)
     * core in regard to functions is NOT the same as all functions
     *
     * ReflectionExtension works for lowercase 'core'
     * $re = new ReflectionExtension('core');
     * $re->getINIEntries();
     * (all ini entries summed up = 306 keys)
     *
     * @param unknown $extension
     * @param unknown $detail
     */
    public function __construct($extension, $detail)
    {
        if ($extension === null) {
            $this->extension = $extension;
        } else {
            $this->extension = strtolower($extension);
            // $this->extension = $extension;
        }
        $this->detail = $detail;
        $this->run();
    }

    public function run()
    {
        $this->return = ini_get_all($this->extension, $this->detail);
        if ($this->return === false) {
            throw new \Exception('ini_get_all extension not found');
        }
        return $this->return;
    }

    public function __toString()
    {
        return $this->return;
    }
}