<?php declare(strict_types=1);

namespace App\Libraries\Core;

use App\Libraries\Injection\Container;
use App\Libraries\Routing\Router;
use App\Exceptions\RouteNotFoundException;
use App\Libraries\Routing\RequestParser;

class App
{
    public function __construct(
        protected Router $router,
        protected RequestParser $requestParser,
    ) {

    }

    public function run()
    {
        try {
            return $this->router->resolve($this->requestParser->getPath(), strtolower($this->requestParser->getMethod()));
        } catch (RouteNotFoundException $e) {
            http_response_code(404);
            echo $e.'- not found - App Catch';
            //echo View::make('error/404');
        }
    }
}