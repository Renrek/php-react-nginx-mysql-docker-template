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
                            path: $basePath->path. $route->path,
                            method: $route->method,
                            action: [$controller, $method->getName()]
                        );
                        
                    }
                }
            }
        }

        // public function register(string $requestMethod, string $route, callable|array $action): self
        // {
        //     $this->tempRoutes[$requestMethod][$route] = $action;
        //     return $this;
        // }
    
        
    
        public function resolve(string $requestUri, string $requestMethod)
        { 
            // if (is_callable($action)) {
            //     return call_user_func($action);
            // }
            $requestedRoute = explode('?', $requestUri)[0];
            foreach ($this->routes as $k => $route) {
                
                if (preg_match($route->pattern, $requestedRoute) && $requestMethod === $route->method){
                    $class = $this->container->get($route->action[0]);
                    return call_user_func_array([$class, $route->action[1]], []);
                }
            }

            throw new RouteNotFoundException();
        }
    }