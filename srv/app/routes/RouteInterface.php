<?php declare(strict_types=1);

namespace App\Routes;

interface RouteInterface {

    public function getClassPath(): string;

    public static function getUriPrefix(): string;

    public function getNamespace(): string;

    public function getClassSuffix(): string;

    public function getRoute(string $requestPath): array;

}