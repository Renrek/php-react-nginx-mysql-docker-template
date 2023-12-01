<?php declare(strict_types=1);

namespace App\Attributes\Routing;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD|Attribute::IS_REPEATABLE)]
class RequestMethod implements RequestMethodInterface
{
    public function __construct(
        public string $path,
        public string $method = 'get',
    ){}
}