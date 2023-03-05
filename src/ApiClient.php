<?php

declare(strict_types=1);

namespace Elidas1008\Experiments;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class ApiClient
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    /**
     * @throws Throwable
     */
    public function fetch(string $url, array $options = []): string
    {
        $response = $this->client->request('GET', $url, $options);
        return $response->getContent();
    }
}