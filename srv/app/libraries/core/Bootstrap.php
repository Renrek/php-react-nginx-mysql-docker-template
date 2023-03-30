<?php declare(strict_types=1);

namespace App\Libraries\Core;

use App\Config\AppConst;
use App\Libraries\Core\Router;

class Bootstrap {

    public function __construct(){
        $this->classAutoLoaders();
        $this->loadGlobals();
    }

    public function loadSite(): void {
        session_start();
        //$this->checkAddress(); 
        $router = new Router; 
    }

    private function classAutoLoaders(): void {

        // Composer Dependencies
        require_once '/srv/app/libraries/vendors/autoload.php';

        // Application Classes
        spl_autoload_register(function($className){
            $baseDirectory = '/srv/app';
            $prefix = 'App\\';
            $prefixLength = strlen($prefix);
            if (strncmp($prefix, $className, $prefixLength) !== 0) {
                return;
            }
            $suffix = substr($className, $prefixLength);
            $suffix = strtolower($suffix);
            $fullFilePath = $baseDirectory . '/' 
                . str_replace('\\', '/', $suffix) . '.php';
            if (file_exists($fullFilePath)) {
                require_once $fullFilePath;
            }
        });
    }

    // For the places that I don't want to instantiate a class to get a variable
    private function loadGlobals(): void {
        define('APP_ROOT', AppConst::APP_ROOT);
        define('URL_ROOT', AppConst::URL_ROOT);
        define('SITE_NAME', AppConst::SITE_NAME);
    }

    // private function checkAddress(){
    //     if(array_key_exists('ipAddress',$_SESSION)){
    //         if ($_SERVER['REMOTE_ADDR'] !== $_SESSION['ipAddress']){
    //             session_unset();
    //             session_destroy();
    //         }
    //     } else {
    //         $_SESSION['ipAddress'] = $_SERVER['REMOTE_ADDR'];
    //     }
    // }
}