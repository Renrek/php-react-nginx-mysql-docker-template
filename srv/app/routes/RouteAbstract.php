<?php declare(strict_types=1);

namespace App\Routes;

use App\Routes\RouteInterface;

abstract class RouteAbstract implements RouteInterface {

    abstract protected function handleNotFound () : void ;

    protected function formatRequestElement (string $rawElement) : string {
        $classElements = explode('-', $rawElement);
        foreach ($classElements as $key => $value) {
            $classElements[$key] = \ucfirst($value);
        }
        return implode($classElements);
    }

    protected function validateRequest(string $class, string $method): void {
        $file = $this->getClassPath().$class.$this->getClassSuffix().'.php';
        if(!realpath($file)){
            $this->handleNotFound();
        }
        $fullClassName = $this->getNamespace().$class.$this->getClassSuffix();
        if(!method_exists(new $fullClassName, $method)){
            $this->handleNotFound();
        }
    }

    protected function stripUrlPrefix(string $requestPath): string {
        $prefix = $this->getUriPrefix();
        if (substr($requestPath, 0, strlen($prefix)) === $prefix){
            return substr($requestPath, strlen($prefix));
        }
        return $requestPath;
    }
}