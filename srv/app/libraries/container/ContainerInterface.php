<?php declare(strict_types=1);

namespace App\Libraries\Container;

interface ContainerInterface {

    public function get(string $id);

    public function has(string $id): bool;

}