<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;

enum UserRole: STRING
{
    use Values, Names, Options;

    case SUPER_ADMIN         = 'super_admin';
    case ADMIN               = 'admin';
    case ACCOUNTANT          = 'accountant';
    case POINT               = 'point';
}