<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\Lib\Entity;

use Attribute;

#[Attribute]
final class FieldName
{
    public function __construct(public string $fieldName)
    {
    }
}