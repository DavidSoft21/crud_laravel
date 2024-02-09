<?php

namespace App\Models\Permissions;

use Spatie\Permission\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    protected $fillable = [
        'name',
        'guard_name',
        'updated_at',
        'created_at',
    ];
}
