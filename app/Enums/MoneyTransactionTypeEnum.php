<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;

enum MoneyTransactionTypeEnum: int
{
    use Values, Names, Options;

    case TAKE_MONEY               = 1;
    case PUT_MONEY                = 2;
}