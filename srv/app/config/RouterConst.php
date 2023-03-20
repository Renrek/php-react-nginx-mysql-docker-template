<?php declare(strict_types=1);

namespace App\Config;

final class RouterConst
{
    const DEFAULT_CONTROLLER = 'Pages';
    const DEFAULT_CONTROLLER_METHOD = 'index';
    const DEFAULT_PAGE_NOT_FOUND_METHOD = 'notFound';
    const CONTROLLERS_PATH = '/srv/app/controllers/';
    const CONTROLLER_NAMESPACE = 'App\\Controllers\\';
}
 