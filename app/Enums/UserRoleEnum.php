<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;

enum UserRoleEnum: int
{
    use Values, Names, Options;

    case SUPER_ADMIN         = 1;
    case ADMIN               = 2;
    case ACCOUNTANT          = 3;
    case POINT               = 4;
}
