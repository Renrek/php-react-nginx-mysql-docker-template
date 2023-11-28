<?php declare(strict_types = 1);

namespace App\Attributes\Routing\Methods;

use App\Attributes\Routing\RequestMethod;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD|Attribute::IS_REPEATABLE)]
class Put extends RequestMethod
{
    public function __construct(string $path)
    {
        parent::__construct($path, 'post');
    }
}