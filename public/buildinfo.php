<?php
use Wrapper\FuncWrapper\Extension\ExtensionTool;

require_once __DIR__ . '/Autoloader.php';

$et = new ExtensionTool();
// var_dump($et->getExtensions());
$et->getAllInis();