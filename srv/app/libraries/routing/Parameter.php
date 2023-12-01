<?php declare(strict_types=1);

namespace App\Libraries\Routing;


class Parameter {
    public function __construct(
        public int $index,
        public string $name = '',
        public string $type = 'mixed',
    ){}
}