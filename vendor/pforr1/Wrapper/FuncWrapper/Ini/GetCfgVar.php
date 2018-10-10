<?php
namespace Wrapper\FuncWrapper\Ini;

/**
 * FINDINGS: return false if option is not found (see tests)
 * AND
 * returns false if an error occurs (see docs).
 *
 * @author ingmar
 *
 */
class GetCfgVar
{

    public $option;

    /**
     *
     * @var mixed
     */
    public $return;

    /**
     *
     * @param string $option
     */
    public function __construct($option)
    {
        $this->option = $option;
        $this->run();
    }

    public function run()
    {
        $this->return = get_cfg_var($this->option);

        // always_populate_raw_post_data return false
        // if ($this->return === false) {
        // throw new \Exception('get_cfg_var error');
        // }
        return $this->return;
    }
}

