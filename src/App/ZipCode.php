<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\App;

use Elidas1008\Experiments\Lib\Entity\EntityTranslation;
use Elidas1008\Experiments\Lib\Entity\Entity;

class ZipCode extends Entity
{
    #[EntityTranslation(fieldName: 'post code')]
    public string $postCode;
    public string $country;
    #[EntityTranslation(fieldName: 'country abbreviation')]
    public string $countryAbbreviation;
    /**
     * @var Location[]
     */
    #[EntityTranslation(arrayEntityName: Location::class)]
    public array $places;
}