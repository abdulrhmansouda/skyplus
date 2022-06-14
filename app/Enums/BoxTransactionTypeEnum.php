<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;

enum BoxTransactionTypeEnum: int
{
    use Values, Names, Options;

    case CHARGE_POINT        = 1;
    case SELL                = 2;
    case PAY                 = 3;
}