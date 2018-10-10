<?php
namespace Wrapper\FuncWrapper\Extension;

/**
 *
 * @author ingmar
 *
 */
class GetLoadedExtensions
{

    public $zend_extensions;

    public $return;

    /**
     *
     * @param unknown $zend_extensions
     *            FINDINGS:
     *            zend_extensions = true contains all zend extension (here 2)
     *            zend_extensions = false contains all extensions inclusive zend! (here 56)
     *            the name Xdebug, xdebug is written different depending on this option?!
     *
     */
    public function __construct($zend_extensions)
    {
        $this->zend_extensions = $zend_extensions;
        $this->run();
    }

    public function run()
    {
        $this->return = get_loaded_extensions($this->zend_extensions);
        return $this->return;
    }

    public function __toString()
    {
        return $this->return;
    }
}

