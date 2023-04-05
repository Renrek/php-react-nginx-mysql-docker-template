<?php declare(strict_types=1);

namespace App\Libraries\Routing;

class RequestParser {

    public function getPath(): string {
        if (\array_key_exists('REQUEST_URI', $_SERVER)) {
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }
        die(); // TODO - do something else here
    }

    public function getMethod(): string {
        if (\array_key_exists('REQUEST_METHOD', $_SERVER)) {
            return $_SERVER['REQUEST_METHOD'];
        }
        die(); // TODO - do something else here
    }

}