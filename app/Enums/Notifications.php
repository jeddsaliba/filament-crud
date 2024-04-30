<?php

namespace App\Enums;

enum Notifications: string
{
    const DEFAULT_SUCCESS_TITLE = 'Success';
    const DEFAULT_FAILED_TITLE = 'Failed';

    const MODULE_DELETE_FAILED_BODY = 'Module is being used by permission(s).';
    const PERMISSION_DELETE_FAILED_BODY = 'Permission is enabled in role(s).';
    const PROJECT_DELETE_FAILED_BODY = 'Project already has task(s) in it.';
    const ROLE_DELETE_FAILED_BODY = 'Role is being used by user(s).';
    const STATUS_DELETE_FAILED_BODY = 'Status is being used by task(s).';
    const USER_PROJECT_CREATED_DELETE_FAILED_BODY = 'Project(s) were created using this user.';
    const USER_TASK_CREATED_DELETE_FAILED_BODY = 'Task(s) were created using this user.';
    const USER_TASK_ASSIGNED_DELETE_FAILED_BODY = 'User is assigned to a task.';
}
