<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Tag;

class PostsController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['verify.categories'])->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // Store the image
        $image = $request->file('image')->store('posts');

        // Store the data
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category_id
        ]);

        // Store tags
        if ($post && $request->tag_id) {
            $post->tags()->attach($request->tag_id);
        }

        session()->flash('success', 'Post created successfully!');

        return redirect(url('/posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //Check the image
        if ($request->hasFile('image')) {
            // Store old image
            $image_old = $post->image;

            // Store the image
            $image = $request->file('image')->store('posts');
    
            // Store the data
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'image' => $image,
                'published_at' => $request->published_at,
                'category_id' => $request->category_id
            ]);

            // Store tags
            if ($post) {
                $post->tags()->sync($request->tag_id);
            }

            // Delete old image
            if ($post) {
                $post->deleteImage($image_old);
            }
        } else {
            // Store the data
            $post = $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'published_at' => $request->published_at,
                'category_id' => $request->category_id
            ]);
        }

        session()->flash('success', 'Post updated successfully!');

        return redirect(url('/posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
            $post->deleteImage($post->image);
            $post->forceDelete();
            session()->flash('success', 'Post deleted successfully!');
        } else {
            $post->delete();
            session()->flash('success', 'Post trashed successfully!');
        }

        return redirect(url('/posts'));
    }

    /**
     * Display a list of all trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully!');

        return redirect(url('/posts'));
    }
}
