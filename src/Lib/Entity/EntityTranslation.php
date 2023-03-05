<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\Lib\Entity;

use Attribute;

#[Attribute]
final class EntityTranslation
{
    public const FIELD_NAME = 'fieldName';
    public const ARRAY_ENTITY_NAME = 'arrayEntityName';
    public function __construct(public ?string $fieldName = null, public ?string $arrayEntityName = null)
    {
    }
}