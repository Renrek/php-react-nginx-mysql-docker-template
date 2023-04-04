<?php declare(strict_types=1);
    require_once 'app/libraries/core/Bootstrap.php';
    $init = new App\Libraries\Core\Bootstrap();
    $init->loadSite();
    $requestParser = new App\Libraries\Core\RequestParser();
    $route = App\Routes\PageRoute::class;
    $router = new App\Libraries\Core\Router(new $route, $requestParser);
    