<?php declare(strict_types=1);

namespace App\Libraries\Routing;

class Route {
    public function __construct(
        public string $uriPattern,
        public string $requestPath,
        public string $requestMethod,
        public string $controller,
        public string $controllerMethod,
        public ?array $parameters // Array<App\Libraries\Parameter>
    ){}
}