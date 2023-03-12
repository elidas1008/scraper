<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\Lib\ApiDeserializer;

use Elidas1008\Experiments\Lib\ApiDeserializer\Entity\Entity;
use Throwable;

class JsonSerializer extends AbstractSerializer
{
    /**
     * @throws Throwable
     */
    public function deserialize(string $encoded, string $entityName): Entity
    {
        $entity = $this->createEntity($entityName);

        $data = json_decode($encoded, true, JSON_THROW_ON_ERROR);

        $this->hydrate($data, $entity);

        return $entity;
    }
}