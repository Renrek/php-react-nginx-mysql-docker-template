<?php declare(strict_types=1);

namespace App\Helpers;

use App\Config\RouterConst;

final class RedirectHelper
{
    
    static function sendToHome() : void 
    {
        header('location: '. URL_ROOT);
    }

    static function sendToNotFound() : void
    {
        header('location: '. URL_ROOT. '/not-found');
    }

    static function sendToController(string $class, ?string $method): void
    {
        // TODO consider including params ***REDO THIS **
        // TO Think on, would call_user_func_array be better?
        $suffix = $method ? '/' . $method : '';
        header('location: '. URL_ROOT . '/'. $class . $suffix);
    }

}