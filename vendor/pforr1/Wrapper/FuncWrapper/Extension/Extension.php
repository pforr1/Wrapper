<?php
namespace Wrapper\FuncWrapper\Extension;

/**
 * one extension
 *
 * @author ingmar
 *
 */
class Extension
{

    /**
     *
     * @var \ReflectionExtension
     */
    public $re;

    /**
     * returned name from get_loaded_extensions
     *
     * @var string
     */
    public $gleExtensionName;

    public $gleExtensionZendBoolean;

    /**
     */
    public function __construct()
    {}
}

