<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permissions\Role;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:role list', ['only' => ['index', 'show']]);
        $this->middleware('can:role create', ['only' => ['create', 'store']]);
        $this->middleware('can:role edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:role delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = (new Role)->newQuery();
        $roles = $roles->latest();
        $roles = $roles->paginate(100)->appends(request()->query());

        return Inertia::render('Admin/Role/Index', [
            'roles' => $roles,
            'can' => [
                'create' => Gate::allows('role create'),
                'edit' => Gate::allows('role edit'),
                'delete' => Gate::allows('role delete'),
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SelectRoles()
    {
        $roles = Role::all();
        return response()->json($roles);
    }
}
