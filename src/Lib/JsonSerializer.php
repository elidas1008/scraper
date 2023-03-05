<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\Lib;

use RuntimeException;
use Throwable;

class JsonSerializer extends AbstractSerializer
{
    /**
     * @throws Throwable
     */
    public function deserialize(string $encoded, string $entity): Serializable
    {
        if (false === is_subclass_of($entity, Serializable::class)) {
            throw new RuntimeException('Argument \'entity\' must extend Serializable');
        }
        $object = new $entity();

        $data = json_decode($encoded, true, JSON_THROW_ON_ERROR);

        foreach ($data as $key => $value) {
            if (in_array(AbstractSerializerOptions::THROW_ON_MISSING_PROPERTY, $this->options)
                && false === property_exists($object, $key)) {
                throw new RuntimeException("Object '" . $object::class . "' does not have property '" . $key . "'");
            }

            if (false === property_exists($object, $key)) {
                continue;
            }

            $object->$key = $value;
        }

        return $object;
    }
}