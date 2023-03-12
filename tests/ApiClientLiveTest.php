<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\Tests;

use Elidas1008\Experiments\App\ApiDeserializerExample\Location;
use Elidas1008\Experiments\App\ApiDeserializerExample\ZipCode;
use Elidas1008\Experiments\Lib\ApiDeserializer\ApiClient;
use Elidas1008\Experiments\Lib\ApiDeserializer\Entity\Entity;
use Elidas1008\Experiments\Lib\ApiDeserializer\JsonSerializer;
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
        $response = $this->client->get('http://api.zippopotam.us/be/9000', ZipCode::class);

        $location = new Location();
        $location->placeName = 'Gent';
        $location->longitude = '3.7167';
        $location->latitude = '51.05';
        $location->stateAbbreviation = 'VLG';
        $location->state = 'Vlaanderen';

        $zipCode = new ZipCode();
        $zipCode->postCode = '9000';
        $zipCode->country = 'Belgium';
        $zipCode->countryAbbreviation = 'BE';
        $zipCode->places = [$location];


        $this->compareZipCode($zipCode, $response);
    }

    private function compareZipCode(ZipCode $expected, Entity $actual)
    {
        static::assertInstanceOf(ZipCode::class, $actual);
        static::assertSame($expected->postCode, $actual->postCode);
        static::assertSame($expected->country, $actual->country);
        static::assertSame($expected->countryAbbreviation, $actual->countryAbbreviation);
        for ($i = 0; $i<count($expected->places); $i++) {
            $this->compareLocation( $expected->places[$i], $actual->places[$i]);
        }
    }

    private function compareLocation(Location $expected, Entity $actual)
    {
        static::assertInstanceOf(Location::class, $actual);
        static::assertSame($expected->state, $actual->state);
        static::assertSame($expected->latitude, $actual->latitude);
        static::assertSame($expected->longitude, $actual->longitude);
        static::assertSame($expected->stateAbbreviation, $actual->stateAbbreviation);
        static::assertSame($expected->placeName, $actual->placeName);
    }
}