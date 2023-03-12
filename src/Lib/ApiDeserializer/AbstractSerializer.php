<?php

namespace Elidas1008\Experiments\Lib\ApiDeserializer;

use Elidas1008\Experiments\Lib\ApiDeserializer\Entity\Entity;
use Elidas1008\Experiments\Lib\ApiDeserializer\Entity\EntityTranslation;
use ReflectionClass;
use RuntimeException;

abstract class AbstractSerializer
{
    /**
     * @param AbstractSerializerOptions[] $options
     */
    final public function __construct(protected array $options = [])
    {
    }

    abstract public function deserialize(string $encoded, string $entityName): Entity;

    protected function createEntity(string $entityName): Entity
    {
        if (false === is_subclass_of($entityName, Entity::class)) {
            throw new RuntimeException('Argument \'entity\' must extend Serializable');
        }

        return new $entityName();
    }

    protected function hydrate(array $data, Entity $entity): void
    {
        $reflection = new ReflectionClass($entity);
        foreach ($reflection->getProperties() as $property) {
            $arguments = $property->getAttributes(EntityTranslation::class)[0]?->getArguments() ?? null;
            $dataKey = $arguments[EntityTranslation::FIELD_NAME] ?? $property->getName();
            $entityKey = $property->getName();
            $arrayFieldName = $arguments[EntityTranslation::ARRAY_ENTITY_NAME] ?? null;

            if (false === isset($data[$dataKey])) {
                continue; // ignore setting entity where data was not provided
            }
            $write = null;

            if (isset($arrayFieldName)) {
                $subArray = [];
                foreach ($data[$dataKey] as $subData) {
                    $subEntity = $this->createEntity($arrayFieldName);
                    $this->hydrate($subData, $subEntity);
                    $subArray[] = $subEntity;
                }
                $write = $subArray;
            } else {
                $write = $data[$dataKey];
            }

            $entity->$entityKey = $write;
        }
    }
}