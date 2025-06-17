<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|min:1|string|max:500',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // User login required
        if (!Auth::check()) {
            return back()->route('login')->with('error', 'You must be logged in to comment.');
        }


        if ($request->parent_id) {
            $parentComment = Comment::find($request->parent_id);
            if (!$parentComment || $parentComment->post_id != $post->id) {
                return back()->with('error', 'Invalid parent comment.');
            }
        }

        // create comment
        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'is_approved' => true,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    /**
     * Delete a comment
     */

    public function destroy(Comment $comment)
    {

        // check permision to delete comment
        if (Auth::id() !== $comment->user_id && !Auth::user()->role == 'admin') {
            return back()->with('error', 'You do not have permission to delete this comment.');
        }

        $comment->delete();
        return back()->with('success', 'Comment deleted successfully.');
    }
}
