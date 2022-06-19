<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
// App\Enums\UserStatusEnum::ACTIVE->value
enum UserStatusEnum: int
{
    use Values, Names, Options;

    case ACTIVE          = 1;
    case INACTIVE        = 2;
    case CLOSED          = 3;
}
