<?php

namespace App\Enums;

enum Notifications: string
{
    const DEFAULT_SUCCESS_TITLE = 'Success';
    const DEFAULT_FAILED_TITLE = 'Failed';

    const MODULE_DELETE_FAILED_BODY = 'Module is being used by permission(s).';
    const PERMISSION_DELETE_FAILED_BODY = 'Permission is enabled in role(s).';
    const USER_DELETE_FAILED_BODY = 'User is being used by task(s).';
}
