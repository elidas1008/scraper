<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\Lib;

use Elidas1008\Experiments\Lib\Entity\FieldName;
use Elidas1008\Experiments\Lib\Entity\Serializable;
use ReflectionClass;
use RuntimeException;
use Throwable;

class JsonSerializer extends AbstractSerializer
{
    /**
     * @throws Throwable
     */
    public function deserialize(string $encoded, string $entityName): Serializable
    {
        if (false === is_subclass_of($entityName, Serializable::class)) {
            throw new RuntimeException('Argument \'entity\' must extend Serializable');
        }
        $entity = new $entityName();

        $data = json_decode($encoded, true, JSON_THROW_ON_ERROR);

        $r = new ReflectionClass($entity);
        foreach ($r->getProperties() as $property) {
            $arguments = $property->getAttributes(FieldName::class)[0]?->getArguments() ?? null;

            $dataKey = $arguments['fieldName'] ?? $property->getName();
            $entityKey = $property->getName();

            $entity->$entityKey = $data[$dataKey] ?? '';
        }
//
//        foreach ($data as $key => $value) {
//            if (in_array(AbstractSerializerOptions::THROW_ON_MISSING_PROPERTY, $this->options)
//                && false === property_exists($entity, $key)) {
//                throw new RuntimeException("Object '" . $entity::class . "' does not have property '" . $key . "'");
//            }
//
//            if (false === property_exists($entity, $key)) {
//                continue;
//            }
//
//            $entity->$key = $value;
//        }

        return $entity;
    }
}