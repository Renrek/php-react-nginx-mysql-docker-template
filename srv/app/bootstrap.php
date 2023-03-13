<?php
// Load configuration
require_once __DIR__ . '/libraries/vendors/autoload.php';
require_once 'config.php';

// Load libraries
spl_autoload_register(function($className){
    $baseDirectory = __DIR__;
    $prefix = 'App\\';
    $prefixLength = strlen($prefix);
    if (strncmp($prefix, $className, $prefixLength) !== 0) {
        return;
    }
    $suffix = substr($className, $prefixLength);
    $suffix = strtolower($suffix);
    $fullFilePath = $baseDirectory . '/' . str_replace('\\', '/', $suffix) . '.php';
    if (file_exists($fullFilePath)) {
        require_once $fullFilePath;
    }
});