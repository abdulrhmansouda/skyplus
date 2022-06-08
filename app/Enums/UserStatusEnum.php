<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;

enum UserStatusEnum: int
{
    use Values, Names, Options;

    case ACTIVE          = 1;
    case INACTIVE        = 2;
    case CLOSED          = 3;
}
