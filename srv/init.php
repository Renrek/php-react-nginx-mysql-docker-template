<?php declare(strict_types=1);

    require_once 'app/libraries/core/Bootstrap.php';
    $init = new App\Libraries\Core\Bootstrap();
    $init->loadSite();

    $requestParser = new App\Libraries\Routing\RequestParser();
    $requestPath = $requestParser->getPath();

    $routeManager = new App\Routes\RouteManager();
    $route = $routeManager->getRoute($requestPath);
    
    $router = new App\Libraries\Routing\Router($route, $requestParser);
    