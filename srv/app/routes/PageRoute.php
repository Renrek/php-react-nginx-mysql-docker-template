<?php declare(strict_types=1);

namespace App\Routes;

use App\Routes\RouteInterface;
use App\Routes\RouteAbstract;

class PageRoute extends RouteAbstract{

    private const DEFAULT_CONTROLLER = 'home';
    private const DEFAULT_METHOD = 'index';

    public function getClassPath(): string {
        return '/srv/app/controllers/';
    }

    public static function getUriPrefix(): string {
        return '';
    }

    public function getNamespace(): string {
        return 'App\\Controllers\\';
    }

    public function getClassSuffix(): string {
        return 'Controller';
    }


    public function getRoute(string $requestPath): array {
        //$requestPath = $this->stripUrlPrefix($requestPath);
        $requestPath = rtrim(ltrim($requestPath, '/'));
        $requestPath = filter_var($requestPath, FILTER_SANITIZE_URL);
        $uri = explode('/', $requestPath);
        //var_dump($uri); die();
        $rawClass = !empty($uri[0]) ? $uri[0] : self::DEFAULT_CONTROLLER;
        $class = $this->formatRequestElement($rawClass);
        
        array_shift($uri);
        $method = !empty($uri[0]) ? $uri[0] : self::DEFAULT_METHOD;
        array_shift($uri);

        $this->validateRequest($class, $method);
        $params = $uri;

        $class .= $this->getClassSuffix();
        
        return [$class, $method, $params];
    }

    protected function handleNotFound () : void {
        var_dump('shit! - not found'); die(); // TODO - change to proper handling
    }
}