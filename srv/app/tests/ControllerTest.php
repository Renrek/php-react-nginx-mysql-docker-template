<?php declare(strict_types=1);

namespace App\Libraries\Tests;

use PHPUnit\Framework\TestCase;
use App\Libraries\Helpers\Practice;

final class ControllerTest extends TestCase
{
    public function testView(): void
    {
        $practice = new Practice;
        $number = $practice->someTinker(1);
        $this->assertEquals($number, 2);
        $this->assertSame('test', 'test');
    }

}