<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;

enum PaymentTypeEnum: int
{
    use Values, Names, Options;

    case CASH                = 1;
    case BANK                = 2;
}