<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\App;

use Elidas1008\Experiments\Lib\Entity\Entity;
use Elidas1008\Experiments\Lib\Entity\EntityTranslation;

class Location extends Entity
{
    #[EntityTranslation(fieldName: 'place name')]
    public string $placeName;
    public string $longitude;
    public string $state;
    #[EntityTranslation(fieldName: 'state abbreviation')]
    public string $stateAbbreviation;
    public string $latitude;
}