<?php declare(strict_types=1);

namespace App\Config;

final class RouterConst
{
    const DEFAULT_CONTROLLER_PREFIX = 'Home';
    const DEFAULT_CONTROLLER_METHOD = 'index';

    const PAGE_NOT_FOUND_CONTROLLER = 'NotFound';
    const PAGE_NOT_FOUND_METHOD = 'index';

    const CONTROLLERS_PATH = '/srv/app/controllers/';
    const CONTROLLER_NAMESPACE = 'App\\Controllers\\';
    const CONTROLLER_SUFFIX = 'Controller';
    
    const API_SUFFIX = 'Api';

    const STANDARD_API_URI_PREFIX = '/api/v1/rest';
    const STANDARD_API_PATH = '/srv/app/api/standard/';
    const STANDARD_API_NAMESPACE = 'App\\Api\\Standard\\';
    const STANDARD_API_CLASS_SUFFIX = 'Api';

    const CUSTOM_API_URI_PREFIX = '/api/v1/custom';
    const CUSTOM_API_PATH = '/srv/app/api/custom/';
    const CUSTOM_API_NAMESPACE = 'App\\Api\\Custom\\';
    const CUSTOM_API_SUFFIX = 'Api';
    
}
 