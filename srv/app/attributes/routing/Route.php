<?php declare(strict_types=1);

namespace App\Attributes\Routing;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Route implements RequestRouteInterface
{
    public function __construct(
        public string $path,
    ){}
}