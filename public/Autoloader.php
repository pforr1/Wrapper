<?php

/**
 * from php.net
 * This is my autoloader for my PSR-4 clases. I prefer to use composer's autoloader, but this works for legacy projects that can't use composer.
 * Simple autoloader, so we don't need Composer just for this.
 */
class Autoloader
{

    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            // mod
            $file = __DIR__ . '/../vendor/pforr1/' . $file;
            // echo $file . 'asdf';
            if (file_exists($file)) {
                // original
                // if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}
Autoloader::register();