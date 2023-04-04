<?php declare(strict_types=1);

namespace App\Libraries\Core;

use App\Routes\RouteInterface;
use App\Libraries\Core\RequestParser;

final class Router {

    private string $class;
    private string $method;
    private array $params = [];

    public function __construct(
        private RouteInterface $route, 
        private RequestParser $requestParser
    ){
        $requestPath = $this->requestParser->getPath();
        [$this->class, $this->method, $this->params] = 
            $this->route->getRoute($requestPath);
        //var_dump($this->class); die();
        $this->class = $this->route->getNamespace() . $this->class;
        $this->callRoute();
    }

    private function callRoute(): void
    {
        call_user_func_array([new $this->class, $this->method], $this->params);
    }
}