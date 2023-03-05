<?php

declare(strict_types=1);

namespace Elidas1008\Experiments;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class ApiClient
{
    public function __construct(private HttpClientInterface $client, private SerializerInterface $serializer)
    {
    }

    /**
     * @throws Throwable
     */
    public function fetch(string $url, array $options = []): array
    {
        $response = $this->client->request('GET', $url, $options);
        return $this->serializer->deserialize($response->getContent());
    }
}