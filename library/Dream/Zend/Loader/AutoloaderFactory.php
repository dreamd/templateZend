<?php

namespace Dream\Zend\Loader;

require 'library/Zend/Loader/AutoloaderFactory.php';

use Zend\Loader\AutoloaderFactory as ZendAutoloaderFactory;

class AutoloaderFactory extends ZendAutoloaderFactory {
    const STANDARD_AUTOLOADER = 'Dream\Zend\Loader\StandardAutoloader';
    protected static function getStandardAutoloader()
    {
        if (null !== static::$standardAutoloader) {
            return static::$standardAutoloader;
        }


        if (!class_exists(static::STANDARD_AUTOLOADER)) {
            // Extract the filename from the classname
            $stdAutoloader = substr(strrchr(static::STANDARD_AUTOLOADER, '\\'), 1);
            require_once __DIR__ . "/$stdAutoloader.php";
        }
        $loader = new StandardAutoloader();
        static::$standardAutoloader = $loader;
        return static::$standardAutoloader;
    }
}
