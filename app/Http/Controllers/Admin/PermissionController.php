<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permissions\Permission;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:permission list', ['only' => ['index', 'show']]);
        $this->middleware('can:permission create', ['only' => ['create', 'store']]);
        $this->middleware('can:permission edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:permission delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = (new Permission)->newQuery();
        $permissions = $permissions->latest();
        $permissions = $permissions->paginate(100)->appends(request()->query());

        return Inertia::render('Admin/Permission/Index', [
            'permissions' => $permissions,
            'can' => [
                'create' => Gate::allows('permission create'),
                'edit' => Gate::allows('permission edit'),
                'delete' => Gate::allows('permission delete'),
            ]
        ]);
    }
}
