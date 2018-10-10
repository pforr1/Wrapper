<?php
use Wrapper\FuncWrapper\Ini\GetLoadedExtensions;
use Wrapper\FuncWrapper\Ini\IniGetAll;
use Wrapper\FuncWrapper\Ini\IniSet;

require_once __DIR__ . '/Autoloader.php';

// echo 'hallo';
// phpinfo();

$e = new GetLoadedExtensions(true);
var_dump($e);
$e2 = new GetLoadedExtensions(false);
var_dump($e2);

// @todo returns extension names case sensitive
var_dump($e2->return);

// @todo is sort of case insensitive Core == core != coRE
$re = new ReflectionExtension('coRE');
var_dump($re);

// @todo must be lowercase core
// $aaa = new IniGetAll('core', true);
// var_dump($aaa);

foreach ($e->return as $index => $ext) {
    var_dump($index);
    var_dump($ext);

    $re1 = new ReflectionExtension($ext);
    var_dump($re1);
    print_r($re1->getName());
    print_r($re1->getVersion());
    print_r($re1->getFunctions());
    print_r($re1->getClassNames());
    print_r($re1->getDependencies());
    print_r($re1->getINIEntries());
}
foreach ($e2->return as $index => $ext) {
    var_dump($index);
    var_dump($ext);

    $re1 = new ReflectionExtension($ext);
    var_dump($re1);
    print_r($re1->getName());
    print_r($re1->getVersion());
    print_r($re1->getFunctions());
    print_r($re1->getClassNames());
    print_r($re1->getDependencies());
    print_r($re1->getINIEntries());
}
echo 'ini get all----------------------------------------------------';
$all3 = new IniGetAll(null, true);
var_dump($all3);

/**
 * Teste ini set mit verschiedenen bool werten und ini get
 */

/**
 * Teste mit nicht veränderbaren werten
 */
// $is1 = new IniSet('disable_classes', 'ErrorException');
$is1 = new IniSet('post_max_size', '4000000');

// $re2 = new ReflectionExtension('standard');

// print_r($re2->getName());
// print_r($re2->getVersion());
// print_r($re2->getFunctions());
// print_r($re2->getClassNames());
// print_r($re2->getDependencies());
// print_r($re2->getINIEntries());

// $b = new IniSet('sessionname', 'andersder');

// $c = new IniSet('max_execution_time', 'andersder');
// $d = new IniSet('max_execution_time', '40');
// @TODO test:
// test if upload_max_filesize is really settable
// and if yes, then test the access level
// should be PHP_INI_PERDIR and not settable
// same goes for register_globals, magic_quotes_gpc
