<?php declare(strict_types=1);

namespace App\Libraries\Helpers;

use App\Config\RouterConst;

final class Redirect
{
    
    static function toHome() : void 
    {
        header('location: '. URL_ROOT);
    }

    static function toNotFound() : void
    {
        header('location: '. URL_ROOT. '/not-found');
    }

    static function toController(string $class, ?string $method): void
    {
        // TODO consider including params
        // TO Think on, would call_user_func_array be better?
        $suffix = $method ? '/' . $method : '';
        header('location: '. URL_ROOT . '/'. $class . $suffix);
    }

}