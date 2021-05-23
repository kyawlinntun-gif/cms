<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Category;
use App\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Give all data
     *
     * @return void
     */
    public function index()
    {
        // return request()->get('search');

        return view('welcome', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => Post::searched()->simplePaginate(3)
        ]);
    }

    public function show(Post $post)
    {
        return view('blog.show', [
            'post' => $post
        ]);
    }

    /**
     * Give all posts with category
     *
     * @return void
     */
    public function category(Category $category)
    {
        return view('blog.category', [
            'category' => $category,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => $category->posts()->searched()->simplePaginate(3)
        ]);
    }

    public function tag(Tag $tag)
    {
        return view('blog.tag', [
            'tag' => $tag,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => $tag->posts()->searched()->simplePaginate(3)
        ]);
    }
}
