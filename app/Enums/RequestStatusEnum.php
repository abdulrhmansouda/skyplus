<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
// App\Enums\RequestStatusEnum::WAINTING->value
enum RequestStatusEnum: int
{
    use Values, Names, Options;

    case WAINTING               = 1;
    case ACCEPTED               = 2;
    case REJECTED               = 3;
}