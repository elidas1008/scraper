<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\Tests;

use Elidas1008\Experiments\ApiClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\CurlHttpClient;
use Throwable;

class ApiClientTest extends TestCase
{
    private ApiClient $client;

    protected function setUp(): void
    {
        $this->client = new ApiClient(new CurlHttpClient());
    }

    /**
     * @throws Throwable
     */
    public function test(): void
    {
        $response = $this->client->fetch('http://api.zippopotam.us/be/9000');
        static::assertSame(
            '	
post code	"9000"
country	"Belgium"
country abbreviation	"BE"
places	
0	
place name	"Gent"
longitude	"3.7167"
state	"Vlaanderen"
state abbreviation	"VLG"
latitude	"51.05"',
            $response
        );
    }
}