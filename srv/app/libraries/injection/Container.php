<?php declare(strict_types=1);

namespace App\Libraries\Injection;

use App\Exceptions\ContainerException;
use App\Libraries\Injection\ContainerInterface;

class Container implements ContainerInterface {

    private array $entries = [];

    public function get(string $id) : mixed {

        if ($this->has($id)) {
            $entry = $this->entries[$id];

            if (is_callable($entry)) {
                return $entry($this);
            }

            $id = $entry;
        }

        return $this->resolve($id);
    }

    public function has(string $id): bool {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete): void {
        $this->entries[$id] = $concrete;
    }   

    public function resolve(string $id) {
        if (!class_exists($id)){
            throw new ContainerException('Unable to find class'. $id);
        }

        $reflection = new \ReflectionClass($id);

        if(! $reflection->isInstantiable()) {
            throw new ContainerException('Unable to instantiate class'. $id);
        }

        $reflectionConstructor = $reflection->getConstructor();
        if (! $reflectionConstructor) {
            return new $id;
        }
        
        $reflectionParameters = $reflectionConstructor->getParameters();
        if (! $reflectionParameters) { 
            return new $id;
        }
        
        $dependencies = array_map(
            function (\ReflectionParameter $param) use ($id): mixed {
                $name = $param->getName();
                $type = $param->getType();
                
                if(! $type) {
                    throw new ContainerException('No type provided');
                }

                if ($type instanceof \ReflectionUnionType) {
                    throw new ContainerException(
                        'Union type for prams not accepted'
                    );
                }

                if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) { 
                    return $this->get($type->getName());
                }

                throw new ContainerException('Failed to resolve class.');
            },
            $reflectionParameters
        );

        return $reflection->newInstanceArgs($dependencies);
    }
}