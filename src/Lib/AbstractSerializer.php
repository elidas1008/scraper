<?php

namespace Elidas1008\Experiments\Lib;

abstract class AbstractSerializer
{
    /**
     * @param AbstractSerializerOptions[] $options
     */
    final public function __construct(protected array $options = [])
    {
    }

    abstract public function deserialize(string $encoded, string $entity): Serializable;
}