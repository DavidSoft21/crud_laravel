<?php

namespace App\Models\Permissions;

use Spatie\Permission\Models\Permission as OriginalPermission;

class Permission extends OriginalPermission
{
    protected $fillable = [
        'name',
        'guard_name',
        'updated_at',
        'created_at',
    ];
}