<?php declare(strict_types=1);

namespace App\Libraries\Routing;

use App\Exceptions\RouteNotFoundException;
use App\Libraries\Injection\Container;
use App\Controllers\HomeController;
use App\Controllers\NotFoundController;
use App\Attributes\Routing\RequestMethod;
use App\Attributes\Routing\Route;
use App\Libraries\Routing\RouteFormatter;

final class Router {
  
        private array $tempRoutes = [];
        private array $routes = [];
    
        public function __construct(private Container $container)
        {
            $this->registerRoutesFromCache();
        }
    
        public function registerRoutesFromCache()
        {
            $routeFormatter = $this->container->get(RouteFormatter::class);
            
            $controllers = [
                HomeController::class,
                NotFoundController::class, 
            ];

            foreach($controllers as $controller) { 
                $reflectionController = new \ReflectionClass($controller); 
                
                $classAttribute = $reflectionController->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF)[0];
                
                $basePath = $classAttribute->newInstance();
                    
                foreach($reflectionController->getMethods() as $method) {
                    $attributes = $method->getAttributes(RequestMethod::class, \ReflectionAttribute::IS_INSTANCEOF);
    
                    foreach($attributes as $attribute) {
                        $route = $attribute->newInstance();
                        
                        $this->routes[] = $routeFormatter->getRoute(
                            requestPath: $basePath->path. $route->path,
                            requestMethod: $route->method,
                            controller: $controller,
                            controllerMethod:  $method->getName(),
                        );
                        
                    }
                }
            }
        }

        
        public function resolve(string $requestUri, string $requestMethod)
        { 
            // Potential consideration
            // if (is_callable($action)) {
            //     return call_user_func($action);
            // }
            $requestedRoute = explode('?', $requestUri)[0];
            foreach ($this->routes as $k => $route) {
                
                if (preg_match($route->uriPattern, $requestedRoute) && $requestMethod === $route->requestMethod){
                    $params = $this->extractParameters($requestedRoute, $route);
                    $class = $this->container->get($route->controller);
                    return call_user_func_array([$class, $route->controllerMethod], $params);
                }
            }

            throw new RouteNotFoundException();
        }

        private function extractParameters(string $requestedRoute, $route): array 
        {
            $parameterList = [];
            $routeParts = explode('/', rtrim(ltrim($requestedRoute, '/')));
            foreach ($route->parameters as $parameter) {
                $parameterList[] = $routeParts[$parameter->index];
            }
            return $parameterList;
        }
    }