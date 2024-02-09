<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:post list', ['only' => ['index', 'show']]);
        $this->middleware('can:post create', ['only' => ['create', 'store']]);
        $this->middleware('can:post edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:post delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = (new Post)->newQuery();
        $posts = $posts->latest();
        $posts = $posts->paginate(100)->appends(request()->query());

        return Inertia::render('Post/Index', [
            'posts' => $posts,
            'can' => [
                'create' => Gate::allows('post create'),
                'edit' =>  Gate::allows('post edit'),
                'delete' =>  Gate::allows('post delete'),
            ]
        ]);
    }
}
