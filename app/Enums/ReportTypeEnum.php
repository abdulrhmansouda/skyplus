<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
// App\Enums\ReportTypeEnum::CHARGE_SUBSCRIBER->value
enum ReportTypeEnum: int
{
    use Values, Names, Options;
    case CHARGE_SUBSCRIBER      = 1;
    case CHARGE_POINT           = 2;
    case COMMISSION             = 3;
    case SUPPORT                = 4;
}