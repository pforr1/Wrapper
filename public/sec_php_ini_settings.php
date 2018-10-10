<?php
// @todo test für ini_set, alles muss string, das muss man bei Wrapperklasse beachten 
// $res = ini_set('max_execution_time', '30');
// if ($res === false) throw new \Exception( 'Unable to set.' );

// phpinfo();
// ??? woher kommen die unterschiedlichen spalten master und ...

// get ini aus file (master) welches file (apache, htaccess, phpini, , oder aus laufzeit konfig?

// !!! im index.php lade eine php_request_init, wo file upload path und cache path und soap path gesetzt werden

// use constants for array keys???
// mal testweise gemacht, dann kann man sich nicht so leicht verschreiben
// TODO in die RICHTLINIE

// DONE handle booleans values
// TODO handle php ini memory sizes values
// define on/off values?
// on/off als Bezeichnung gibt es nur bei wenigen Parametern, die sind nicht dokumentiert oder nur per File zu konfigurieren
// "1"/"0" sind häufig und können je nach Kontext on off oder einen absoluten Wert bedeuten!
// in der Doku ini core stehen die Datentypen einiger INI- Parameter (boolean etc.)

// Quellen: http://de2.php.net/manual/de/function.ini-get.php
// http://de2.php.net/manual/de/function.get-cfg-var.php
// http://de2.php.net/manual/de/function.phpinfo.php
// php.ini file comments

//

// TODO Gebiete:
// default value, development value, production value
define('INI_VALUE_TYPE', 'ini value type');
define('BOOLEAN_INI_VALUE', 'boolean ini value');
define('MEMORY_SIZE_VALUE', 'memory size value');
define('LITERAL_STRING', 'literal string');
define('INTEGER', 'integer');
define('SECURE_VALUE', 'secure value');
define('SECURE_VALUE_MIN', 'secure value');
define('SECURE_VALUE_MAX', 'secure value');
define('SECURE_VALUE_INEQUALITY_TYPE', 'secure value inequality type');
define('EQUAL_TO', 'equal to');
// define('LESS_THAN_OR_EQUAL_TO', 'less than or equal to');
// define('GREATER_THAN_OR_EQUAL_TO', 'greater than or equal to');
define('BETWEEN_INCLUSIVE', 'between inclusive');

// @todo gibt es das exakte typgleiche <== und >==???

$ini = array(
    // 'keyNotThere' => array(),
    // // beispiel für no value
    // 'iconv.input_encoding' => array(),
//     'allow_url_fopen' => array(
//         INI_VALUE_TYPE => BOOLEAN_INI_VALUE,
//         SECURE_VALUE_INEQUALITY_TYPE => EQUAL_TO,
//         SECURE_VALUE => 0
//     ),
//     'allow_url_include' => array(
//         INI_VALUE_TYPE => BOOLEAN_INI_VALUE,
//         SECURE_VALUE_INEQUALITY_TYPE => EQUAL_TO,
//         SECURE_VALUE => 0
//     ),

//     'max_input_time' => array(
//         INI_VALUE_TYPE => INTEGER,
//         SECURE_VALUE_INEQUALITY_TYPE => BETWEEN_INCLUSIVE,
//         SECURE_VALUE_MIN => 1,
//         SECURE_VALUE_MAX => 30
//     ),
    'max_execution_time' => array(
        INI_VALUE_TYPE => INTEGER,
        SECURE_VALUE_INEQUALITY_TYPE => BETWEEN_INCLUSIVE,
        SECURE_VALUE_MIN => 1,
        SECURE_VALUE_MAX => 30
    )
);

// @todo QUELLE? Dieses Mapping funktioniert nicht wenn ein '' Leerstring auch off bedeutet
$boolValues = array(
    'true' => array(
        'On',
        'True',
        'Yes'
    ),
    'false' => array(
        'Off',
        'False',
        'No'
    ),
    'null' => array(
        '',
        'None'
    )
);

foreach ($ini as $key => $value) {
    // reset
    $igValue = null;
    $igDisplay = null;
    $bDisplay = null;
    $result = null;

    $igValue = ini_get($key);

    

    if ($igValue === false) {
        $igDisplay = '<not found>';
    } elseif ($igValue === '') {
        $igDisplay = '<null>';
    } else {
        // casting against unpredicted behaveour!
        if ($value[INI_VALUE_TYPE] === INTEGER) {
            $igValue = (int) $igValue;
        }
        // @todo cast other
        // 
        if ($value[INI_VALUE_TYPE] === BOOLEAN_INI_VALUE) {
            if ($igValue === '0' || $igValue === '') {
                $bDisplay = 'off';
            } elseif ($igValue === '1')
                $bDisplay = 'on';
        } else {
            $bDisplay = '<not boolean ini value>';
        }
    }

    if ($value[SECURE_VALUE_INEQUALITY_TYPE] === EQUAL_TO) {
        if ($igValue === $value[SECURE_VALUE]) {
            $result = 'equal to';
        } else {
            $result = '!!! NOT SECURE !!!';
        }
    } elseif ($value[SECURE_VALUE_INEQUALITY_TYPE] === BETWEEN_INCLUSIVE) {
        if (
            (
            ($igValue > $value[SECURE_VALUE_MIN]) 
            && ($igValue < $value[SECURE_VALUE_MAX])
                ) 
            || ($igValue === $value[SECURE_VALUE_MIN]) 
            || ($igValue === $value[SECURE_VALUE_MAX])
            )
        {
            $result = 'between inclusive';
        } else {
            $result = '!!! NOT SECURE !!!';
        }
    }

    $resultline[$key] = array(
        'found ini value: ' . $igValue,
        $igValue,
        'value means: ' . $igDisplay,
        'boolean means: ' . $bDisplay,
        'inequality result: ' . $result
    );
}

var_dump($resultline);

echo 'cfg_file_path: ';
var_dump(get_cfg_var('cfg_file_path'));
$date = new DateTime();
$fp = fopen('file1_' . $date->getTimestamp() . '.csv', 'w');
$fields = array('key', 'iga_global_value', 'iga_local_value', 'iga_access', 'gcv', 'gcv_returntype', 'ig');
fputcsv($fp, $fields, ';', '"');
foreach (ini_get_all(null, true) as $key => $value) {
    
    $gcv = get_cfg_var($key); //gets global (set in php.ini) in mixed
    $gcvType = gettype($gcv);
    $ig = ini_get($key);  // gets local (perhaps set with ini_set or htaccess) in string
    
    $fields = array ($key, $value['global_value'], $value['local_value'], $value['access'], $gcv, $gcvType, $ig);
    fputcsv($fp, $fields, ';', '"');
    // @todo get changed master -> local values
}

echo 'for other information see output of phpinfo:';
phpinfo();

// ----------------------------------------------------------------------
/**
 * http://de2.php.net/manual/de/function.ini-get.php
 *
 * @param unknown $val
 * @return number|string
 */
function return_bytes($val)
{
    $val = trim($val);
    $last = strtolower($val[strlen($val) - 1]);
    switch ($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}
//--------------------------------------------------------------------------
//http://php.net/manual/de/function.ini-get-all.php
// I guess the third entry is the required access level (to change this variable at runtime):

// Constant           Value      Meaning
// PHP_INI_USER      1          Entry can be set in user scripts
// PHP_INI_PERDIR    2          Entry can be set in php.ini, .htaccess or httpd.conf
// PHP_INI_SYSTEM    4          Entry can be set in php.ini or httpd.conf
// PHP_INI_ALL       7          Entry can be set anywhere

// See also the docs for ini_set()

// Hugo.