<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;

enum SupportRequestTypeEnum: int
{
    use Values, Names, Options;
    case NEW_SUBSCRIBER               = 1;
    case SWITCH_COMPANY               = 2;
    case SWITCH_PACKAGE               = 3;
    case MAINTENANCE                  = 4;
    case TRANSFER                     = 5;
}