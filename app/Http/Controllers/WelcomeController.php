<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Category;
use App\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => Post::all()
        ]);
    }
}
