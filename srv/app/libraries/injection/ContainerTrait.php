<?php declare(strict_types=1);

namespace App\Libraries\Injection;

trait ContainerTrait {

    protected function resource() {
        return new Container();
    }
    
}