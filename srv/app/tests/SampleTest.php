<?php declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

final class SampleTest extends TestCase
{
    public function testMethod(): void
    {
        $this->assertSame('test', 'test');
    }

}