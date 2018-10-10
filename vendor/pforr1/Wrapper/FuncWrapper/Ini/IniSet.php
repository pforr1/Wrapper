<?php
namespace Wrapper\FuncWrapper\Ini;

/**
 *
 * @author ingmar
 *
 */
class IniSet
{

    public $varname;

    public $newvalue;

    public $return;

    /**
     *
     * @var array
     */
    public $beforeRuntimeSettings = array(
        'register_globals',
        'magic_quotes_gpc',
        'post_max_size'
    );

    /**
     * * @TODO CHECK THIS OUTWhen a setting can not be changed in a user script, the return value of ini_set is "empty", not "false" as you may expect.
     * If you check in your script for return value is "false" the script will continue processing, although the setting has not been set.
     * The boolean return value is used for settings that can be changed in a script. Otherwise the empty value is returned.
     *
     * @param unknown $varname
     * @param unknown $newvalue
     */
    public function __construct($varname, $newvalue)
    {
        $this->varname = $varname;
        $this->newvalue = $newvalue;
        $this->run();
    }

    public function run()
    {
        // no ini set when old value = new value
        $oldValue = new IniGet($this->varname);
        if ($oldValue === $this->newvalue) {
            $this->return = $oldValue;
            return $this->return;
        }

        $this->return = ini_set($this->varname, $this->newvalue);
        if ($this->return === false) {
            throw new \Exception('ini_set failed; setting new value is not allowed');
        }
        return $this->return;
    }
}