<?php declare(strict_types=1);

namespace App\Config;

final class RouterConst
{
    const DEFAULT_CONTROLLER_PREFIX = 'Home';
    const DEFAULT_CONTROLLER_METHOD = 'index';

    const DEFAULT_PAGE_NOT_FOUND_CONTROLLER = 'NotFound';

    const CONTROLLERS_PATH = '/srv/app/controllers/';
    const CONTROLLER_NAMESPACE = 'App\\Controllers\\';
    const CONTROLLER_SUFFIX = 'Controller';
    
    const STANDARD_API_PATH = '/srv/app/api/standard/';
    const CUSTOM_API_PATH = '/srv/app/api/custom/';
    const STANDARD_API_NAMESPACE = 'App\\Api\\Standard\\';
    const CUSTOM_API_NAMESPACE = 'App\\Api\\Custom\\';
    const API_SUFFIX = 'Api';
}
 