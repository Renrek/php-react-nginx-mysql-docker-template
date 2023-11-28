<?php declare(strict_types=1);

    require_once 'app/libraries/core/Bootstrap.php';
    
    (new App\Libraries\Core\Bootstrap())->run();
    
    (new App\Libraries\Core\App(
        new App\Libraries\Routing\Router(
            new App\Libraries\Injection\Container()
        ),
        new App\Libraries\Routing\RequestParser(),
    ))->run();
    