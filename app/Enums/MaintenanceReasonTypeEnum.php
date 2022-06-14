<?php

namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;

enum MaintenanceReasonTypeEnum: int
{
    use Values, Names, Options;
    case INTERNET_SLOW                = 1;
    case INTERNET_CUT_OFF             = 2;
    case INTERNET_CONNECT_AND_SEPARATES               = 3;
    case CHANGE_PASSWORD_FOR_ROUTER                  = 4;
    case TRANSFER                     = 5;
    // case TRANSFER                     = 6;
    // case TRANSFER                     = 7;
    // case TRANSFER                     = 8;
    // case TRANSFER                     = 9;
    // <option value="1">انترنت ضعيف</option>
    // <option value="2">انترنت مقطوع</option>
    // <option value="3">فصل ووصل في الانترنت</option>
    // <option value="4">تغيير كلمة المرور للراوتر</option>
    // <option value="5">نقل اللايت من مكان لآخر</option>
    // <option value="6">تغيير مكان الراوتر</option>
    // <option value="7">تبديل راوتر </option>
    // <option value="8">تبديل لايت</option>
    // <option value="9">تبديل كبل</option>
}