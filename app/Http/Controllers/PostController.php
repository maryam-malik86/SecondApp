<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostCreateRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    { $posts = Post::with('user')->paginate(5);

        // return view('/posts/index', compact('posts'));
        return view('posts.index', compact('posts'));


    }
    public function create()
    {
        // return view('/posts/create');
        return view('posts.create');
    }


    public function store(PostCreateRequest $request)
    {
        // $validatedData = $request->validate([
        //     'title' => ['required', 'string', 'max:255'],
        //     'content' => ['required', 'string'],
        // ]);

        // // Create a new post using the validated data
        // Post::create([
        //     'name' => $request->title,
        //     'content' => $request->content,
        //     'user_id' => Auth::id(),
        // ]);

        // Create a new post using the validated data
       Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post has been created successfully');

    }


    public function show()
    {
        $posts = Post::with('user')->paginate(5);
        return view('posts.show', compact('posts'));
    }



    public function edit(Post $post)
    {
        // $post = Post::find($id);
        return view('posts.edit', compact('post')); // Return a view with a single post
    }


    public function update(PostCreateRequest $request, Post $post)
    {

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post has been updated successfully');
    }



    public function destroy(Post $post)
    {
        // $post = Post::find($id);

        // if ($post) {
        $post->delete();
        // }
        return redirect()->back()->with('success', 'Post has been deleted successfully');

    }


}
