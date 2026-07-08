<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post; 
use App\Models\Category; 
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth', 'isAdmin']);
    }

    public function index()
    {

        $posts = Post::latest()->paginate(6);
        

        $categories = Category::all();
        

        return view('posts.index', compact('posts', 'categories'));
    }
}