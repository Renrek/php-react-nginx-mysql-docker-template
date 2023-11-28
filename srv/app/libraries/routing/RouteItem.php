<?php declare(strict_types=1);

namespace App\Libraries\Routing;


class RouteItem {
    public function __construct(
        public string $pattern,
        public string $path,
        public string $method,
        public array $action,
    ){}
}