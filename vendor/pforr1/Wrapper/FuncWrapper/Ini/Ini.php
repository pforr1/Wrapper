<?php
namespace Wrapper\FuncWrapper\Ini;

/**
 * One Ini Var
 *
 * @author ingmar
 *
 */
class Ini
{

    /**
     * name of ini var from ini_get_all
     *
     * @var unknown
     */
    public $iniIgaName;

    /**
     * from getloadedextension
     *
     * @var Wrapper\FuncWrapper\Extension\
     */
    public $gleExtension;

    /**
     * value of ini var from ini get
     *
     * @var unknown
     */
    public $iniIgValue;

    /**
     * value of ini var in ini file
     *
     * @var unknown
     */
    public $iniCfgVarValue;

    /**
     * value of ini var from php preconfigured(standard), php.ini, conf, htaccess
     *
     * @var unknown
     */
    public $iniGlobalIgaValue;

    /**
     * value of ini var in the script
     *
     * @var unknown
     */
    public $iniLocalIgaValue;

    /**
     * access level of ini var
     *
     * @var unknown
     */
    public $accessLevelIgaValue;

    /**
     * name of ini var from ReflectionExtention->getINIVar()
     *
     * @var unknown
     */
    public $iniReName;

    /**
     * value of ini var in ReflectionExtention
     *
     * @var unknown
     */
    public $iniReValue;

    /**
     */
    public function __construct()
    {}
}

