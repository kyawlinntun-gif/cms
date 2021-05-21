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
        
        $search = request()->query('search');

        if ($search) {
            $posts = Post::where('title', 'like', "%{$search}%")->simplePaginate(3);
        } else {
            $posts = Post::simplePaginate(3);
        }

        return view('welcome', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => $posts
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
        $search = request()->query('search');

        if ($search) {
            $posts = $category->posts()->where('title', 'like', "%{$search}%")->simplePaginate(3);
        } else {
            $posts = $category->posts()->simplePaginate(3);
        }

        return view('blog.category', [
            'category' => $category,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => $posts
        ]);
    }

    public function tag(Tag $tag)
    {
        $search = request()->query('search');

        if ($search) {
            $posts = $tag->posts()->where('title', 'like', "%{$search}%")->simplePaginate(3);
        } else {
            $posts = $tag->posts()->simplePaginate(3);
        }

        return view('blog.tag', [
            'tag' => $tag,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'posts' => $posts
        ]);
    }
}
