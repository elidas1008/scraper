<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\Lib\ApiDeserializer;

use Elidas1008\Experiments\Lib\ApiDeserializer\Entity\Entity;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class ApiClient
{
    public function __construct(private HttpClientInterface $client, private AbstractSerializer $serializer)
    {
    }

    /**
     * @throws Throwable
     */
    public function get(string $url, string $entity, array $options = []): Entity
    {
        $response = $this->client->request('GET', $url, $options);
        return $this->serializer->deserialize($response->getContent(), $entity);
    }
}