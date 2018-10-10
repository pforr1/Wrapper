<?php
namespace Wrapper\FuncWrapper\Extension;

use Wrapper\FuncWrapper\Ini\Ini;
use Wrapper\FuncWrapper\Ini\IniTool;

/**
 * handle n extensions
 *
 * @author ingmar
 * @todo get loaded extension with zend = false gets also zend extensions (xdebug and PHP OpCache)
 *
 */
class ExtensionTool
{

    /**
     * array of Extensions
     *
     * @var array
     */
    public $es = array();

    /**
     */
    public function __construct()
    {}

    private function loadExtensions()
    {
        $gle1 = new GetLoadedExtensions(true);
        $gle2 = new GetLoadedExtensions(false);

        foreach ($gle1->return as $key => $value) {
            $e = new Extension();
            $e->gleExtensionName = $value;
            $e->gleExtensionZendBoolean = true;
            $e->re = new \ReflectionExtension($value);
            $this->es[] = $e;
        }
        foreach ($gle2->return as $key => $value) {
            $e = new Extension();
            $e->gleExtensionName = $value;
            $e->gleExtensionZendBoolean = false;
            $e->re = new \ReflectionExtension($value);
            $this->es[] = $e;
        }
        return $this->es;
    }

    public function getExtentions()
    {
        if ($this->es === array()) {
            $this->loadExtensions();
        }
        return $this->es;
    }

    /**
     * get ini objects by all known methods
     */
    public function getAllInis()
    {
        $it = new IniTool();
        $igaInis = $it->getIgaInis();
        $igaByExtentionInis = $it->getIgaByExtensionInis();

        $reInis = array();
        $es = $this->getExtentions();
        // var_dump($es);
        foreach ($es as $key1 => $value1) {
            $re = $value1->re;

            $inis = $re->getINIEntries();
            foreach ($inis as $key2 => $value2) {

                // relate from ReflectionExtention to ini object
                $in = new Ini();
                $in->iniReName = $key2;
                $in->iniReValue = $value2;

                $in->gleExtension = $value1;
                $reInis[] = $in;
            }
        }

        // var_dump($igaInis);
        // var_dump($igaByExtentionInis);
        // var_dump($reInis);
        print_r($igaInis);
        print_r($igaByExtentionInis);
    }

    /**
     * except ini info
     */
    public function getAllExtensionInfo()
    {}
}