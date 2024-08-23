<?php

namespace App\Http\Controllers;
use App\Models\Comments;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function index($id)
    {
        //$comments = Comments:: // Retrieve all comments
        // return view('comments.index', compact('comments')); // Pass comments to the view
    }


    public function create($id)
    {
        return 'Done'; // Show the form to create a new comment
    }


    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'post_id' => 'required|integer',
        ]);

        // Store the comment
        Comments::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['success' => true]);
    }



    public function show($id)
    {
        $comments = Comments::where('post_id', $id)->with('user')->get();
        return response()->json(['comments' => $comments]);
    }


    public function edit(Comments $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comments $comment)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->update($validatedData);
        return redirect()->route('comments.index')->with('success', 'Comment updated successfully.'); // Redirect with success message
    }


    public function destroy(Comments $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.'); // Redirect with success message
    }
}
