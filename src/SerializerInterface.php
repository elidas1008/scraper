<?php

namespace Elidas1008\Experiments;

interface SerializerInterface
{
    public function deserialize(string $data): array;
}