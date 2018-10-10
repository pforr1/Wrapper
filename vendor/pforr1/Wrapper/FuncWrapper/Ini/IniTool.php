<?php
namespace Wrapper\FuncWrapper\Ini;

use Wrapper\FuncWrapper\Extension\ExtensionTool;

/**
 *
 * @author ingmar
 *
 */
class IniTool
{

    /**
     * array of Inis
     *
     * @var array
     */
    public $igaInis = array();

    public $igaByExtentionInis = array();

    /**
     */
    public function __construct()
    {}

    /**
     * load all inis via ini_get_all in member var
     */
    private function loadIgaInis()
    {
        $iga = new IniGetAll(null, true);
        foreach ($iga->return as $key => $value) {

            $in = $this->getIniFromIga(null, $key, $value);

            // fill member var
            $this->igaInis[] = $in;
        }
    }

    public function getIgaInis()
    {
        if ($this->igaInis === array()) {
            $this->loadIgaInis();
        }
        return $this->igaInis;
    }

    private function loadIgaByExtensionInis()
    {
        $et = new ExtensionTool();
        $es = $et->getExtentions();
        foreach ($es as $key1 => $value1) {
            $en = $value1->gleExtensionName;
            $iga = new IniGetAll($en, true);
            foreach ($iga->return as $key2 => $value2) {

                $in = $this->getIniFromIga($value1, $key2, $value2);
                // fill member var
                $this->igaByExtentionInis[] = $in;
            }
        }
    }

    /**
     *
     * @param \Exception $extension
     * @param string $igaKey
     * @param array $igaValue
     * @return \Wrapper\FuncWrapper\Ini\Ini
     */
    public function getIniFromIga($extension, $igaKey, $igaValue)
    {
        // mapping from return value to object
        $in = new Ini();
        $in->gleExtension = $extension;
        $in->iniIgaName = $igaKey;
        $in->iniGlobalIgaValue = $igaValue['global_value'];
        $in->iniLocalIgaValue = $igaValue['local_value'];
        $in->accessLevelIgaValue = $igaValue['access'];

        $ig = new IniGet($igaKey);
        $in->iniIgValue = $ig->return;

        $gcv = new GetCfgVar($igaKey);
        $in->iniCfgVarValue = $gcv->return;
        return $in;
    }

    public function getIgaByExtensionInis()
    {
        if ($this->igaByExtentionInis === array()) {
            $this->loadIgaByExtensionInis();
        }
        return $this->igaByExtentionInis;
    }
}