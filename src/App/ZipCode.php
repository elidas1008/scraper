<?php

declare(strict_types=1);

namespace Elidas1008\Experiments\App;

use Elidas1008\Experiments\Lib\Serializable;

class ZipCode extends Serializable
{
    public string $postCode;
    public string $country;
}