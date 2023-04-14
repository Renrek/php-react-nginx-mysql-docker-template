<?php declare(strict_types=1);

namespace App\Libraries\Container;

use App\Exceptions\ContainerException;

class Container { //implements ContainerInterface {

    private array $entries = [];

    public function get(string $id) {
        if ($this->has($id)) {
            $class = $this->entries[$id];
            return $class($this);
        }
        //return new $id;
        //$this->resolve($id);
        // if (\class_exists(new $id)){ // Psalm is being a PITA
        //     throw new ContainerException('Unable to find class'. $id);
        // }
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
            function (\ReflectionParameter $param) use ($id) {
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

                if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) { //var_dump($type->getName()); die();
                    return $this->get($type->getName());
                }

                throw new ContainerException('Failed to resolve class.');
            },
            $reflectionParameters
        );

        return $reflection->newInstanceArgs($dependencies);
    }

    public function has(string $id): bool {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $hmm): void {
        $this->entries[$id] = $hmm;
    }   

    public function resolve(string $id) {

        
    }
}