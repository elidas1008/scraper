<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\Tests;

use Elidas1008\Experiments\ApiClient;
use Elidas1008\Experiments\JsonSerializer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\CurlHttpClient;
use Throwable;

class ApiClientLiveTest extends TestCase
{
    private ApiClient $client;

    protected function setUp(): void
    {
        $this->client = new ApiClient(new CurlHttpClient(), new JsonSerializer());
    }

    /**
     * @throws Throwable
     */
    public function test(): void
    {
        $response = $this->client->fetch('http://api.zippopotam.us/be/9000');

        $expected = [
            "post code" => "9000", "country" => "Belgium", "country abbreviation" => "BE", "places" => [
                ["place name" => "Gent", "longitude" => "3.7167", "state" => "Vlaanderen", "state abbreviation" => "VLG", "latitude" => "51.05"]
            ]
        ];
        static::assertSame($expected, $response);
    }
}