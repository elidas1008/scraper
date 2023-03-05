<?php

declare(strict_types=1);

namespace Elidas1008\Scraper\Tests;

use Elidas1008\Scraper\Scraper;
use PHPUnit\Framework\TestCase;

/**
 * @covers Scraper
 */
class ScraperTest extends TestCase
{
    private Scraper $scraper;

    protected function setUp(): void
    {
        $this->scraper = new Scraper();
    }

    public function test(): void
    {
        $this->scraper->go('https://www.immoweb.be/nl');
    }
}