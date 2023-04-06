<?php declare(strict_types=1);

namespace App\Tests\Routes;

use PHPUnit\Framework\TestCase;
use App\Routes\PageRoute;

final class PageRouteTest extends TestCase {

    private PageRoute $route;

    public function setUp() : void {
        $this->route = new PageRoute();
    }

    public function testDefaults(): void {
        $results = $this->route->generate('', 'GET');
        $this->assertSame($results, ['HomeController', 'index', []]);
    }

    public function testNotFound(): void {
        $serverRequestUri = '/not-found';
        $results = $this->route->generate($serverRequestUri, 'GET');
        $this->assertSame($results, ['NotFoundController', 'index', []]);
    }
}