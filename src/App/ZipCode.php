<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\App;

use Elidas1008\Experiments\Lib\Entity\FieldName;
use Elidas1008\Experiments\Lib\Entity\Serializable;

class ZipCode extends Serializable
{
    #[FieldName(fieldName: 'post code')]
    public string $postCode;
    public string $country;
    #[FieldName(fieldName: 'country abbreviation')]
    public string $countryAbbreviation;
//    public array $places;
}