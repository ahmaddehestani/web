<?php

namespace App\Enums;

enum PermissionEnum: string
{
    use EnumToArray;

    case ADMIN = "admin";

    case USER_ALL     = "user.all";
    case USER_INDEX   = "user.index";
    case USER_SHOW    = "user.show";
    case USER_STORE   = "user.store";
    case USER_UPDATE  = "user.update";
    case USER_TOGGLE  = "user.toggle";
    case USER_DELETE  = "user.delete";
    case USER_RESTORE = "user.restore";
}
