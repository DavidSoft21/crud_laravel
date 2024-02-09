<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permissions\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use App\Http\Requests\Users\UserCreateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user list', ['only' => ['index', 'show']]);
        $this->middleware('can:user create', ['only' => ['create', 'store']]);
        $this->middleware('can:user edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:user delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new User)->newQuery();
        $users = $users->latest();
        $users = $users->paginate(100)->appends(request()->query());

        return Inertia::render('Admin/User/Index', [
            'users' => $users,
            'can' => [
                'create' => Gate::allows('user create'),
                'edit' => Gate::allows('user edit'),
                'delete' => Gate::allows('user delete'),
            ],
            'flash' => [
                'success' => Session::get('success'),
            ],
            'errors' => Session::get('errors') ? Session::get('errors')->getBag('default')->getMessages() : (object)[],
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function store(UserCreateRequest $request): RedirectResponse
    {
        $users = User::create($request->validated());
        $role = Role::find($request->role);
        $users->assignRole($role);
        return Redirect::route('users.index')->with('success', 'User created.');
    }
}
