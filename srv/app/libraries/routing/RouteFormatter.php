<?php declare(strict_types=1);

namespace App\Libraries\Routing;

use App\Libraries\Routing\Route;
use App\Libraries\Routing\Parameter;

class RouteFormatter {


    public function getRoute(
        string $requestPath,
        string $requestMethod,
        string $controller,
        string $controllerMethod,
    ): Route {

        $parameters = [];
        $pattern = '/';
        $uriParts = explode('/', rtrim(ltrim($requestPath, '/')));

        foreach ($uriParts as $key => $part) {
            if(str_starts_with($part,'{') && str_ends_with($part,'}')){
                $pattern .= '\/(.*)';
                $parameters[$key] = $this->getParameter($key, $part);
            }else {
                $pattern .= '\/('.$part.')';
            }
            
        }
        $pattern .= '$/';
        
        return new Route(
            uriPattern: $pattern,
            requestPath: $requestPath,
            requestMethod: $requestMethod,
            controller: $controller,
            controllerMethod: $controllerMethod,
            parameters: $parameters,
        );
    }

    private function getParameter($key, $part): Parameter
    {
        $part = rtrim($part, '}');
        $part = ltrim($part, '{');
        if (strpos($part, ':')) {
            [$name, $type] = explode(':', $part);
        } else {
            $name = $part;
            $type = 'mixed';
        }
        
        return new Parameter(
            index: $key,
            name: $name,
            type: $type,
        );
    }


}