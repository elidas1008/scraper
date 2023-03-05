<?php

namespace Elidas1008\Experiments\Lib;

use Elidas1008\Experiments\Lib\Entity\FieldName;
use Elidas1008\Experiments\Lib\Entity\Serializable;
use ReflectionClass;
use ReflectionType;
use RuntimeException;

abstract class AbstractSerializer
{
    /**
     * @param AbstractSerializerOptions[] $options
     */
    final public function __construct(protected array $options = [])
    {
    }

    abstract public function deserialize(string $encoded, string $entityName): Serializable;

    protected function createEntity(string $entityName): Serializable
    {
        if (false === is_subclass_of($entityName, Serializable::class)) {
            throw new RuntimeException('Argument \'entity\' must extend Serializable');
        }

        return new $entityName();
    }

    protected function hydrate(array $data, Serializable $entity): void
    {
        $reflection = new ReflectionClass($entity);
        foreach ($reflection->getProperties() as $property) {
            $arguments = $property->getAttributes(FieldName::class)[0]?->getArguments() ?? null;
            $dataKey = $arguments['fieldName'] ?? $property->getName();
            $entityKey = $property->getName();

            $entity->$entityKey = $this->getValue($data, $dataKey, $property->getType());
        }
    }

    private function getValue(array $data, string $dataKey, ReflectionType $type): mixed
    {
            return $data[$dataKey] ?? '';
    }
}