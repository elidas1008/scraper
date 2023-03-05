<?php

declare(strict_types=1);

namespace Elidas1008\Experiments;

use Throwable;

class JsonSerializer implements SerializerInterface
{
    /**
     * @throws Throwable
     */
    public function deserialize(string $data): array
    {
        return json_decode($data, true, JSON_THROW_ON_ERROR);
    }
}