<?php declare(strict_types=1);

namespace App\Libraries\Routing;

use App\Libraries\Routing\RouteItem;

class RouteFormatter {


    public function getRoute(
        string $path,
        string $method,
        array $action,
    ): RouteItem {

        return new RouteItem(
            pattern: $this->createPattern($path),
            path: $path,
            method: $method,
            action: $action,
        );
    }

    private function createPattern($path): string
    {
        if ($path === ''){
            return '/^$/';
        }

        $pattern = '/';
        $uriParts = explode('/', rtrim(ltrim($path, '/')));

        foreach ($uriParts as $key => $part) {
            if(str_starts_with($part,'{') && str_ends_with($part,'}')){
                $pattern .= '\/(.*)';
            }else {
                $pattern .= '\/('.$part.')';
            }
            
        }
        $pattern .= '$/';

        return $pattern;
    }
}