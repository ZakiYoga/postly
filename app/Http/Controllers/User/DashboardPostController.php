<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.dashboard.posts', [
            'posts' => Post::where('author_id', Auth::user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Store the previous URL in session for the cancel button
        session(['previous_url' => url()->previous()]);

        return view('user.dashboard.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|unique:posts,slug',
            'body' => 'required',
            'status' => 'required|in:published,private,draft',
            'cover_image' => 'image|file|max:1024',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->file('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('cover_images');
        }

        $validatedData['author_id'] = Auth::user()->id;

        Post::create($validatedData);

        return redirect('/dashboard')->with('success', 'New Post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('user.dashboard.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('user.dashboard.edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'required|in:published,private,draft',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'image|file|max:1024',
        ];

        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts,slug';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('cover_image')) {
            if ($request->oldCover_Image) {
                Storage::delete($request->oldCover_Image);
            }
            $validatedData['cover_image'] = $request->file('cover_image')->store('cover_images');
        } elseif ($request->cover_image == "") {
            if ($request->oldCover_Image) {
                Storage::delete($request->oldCover_Image);
            }
            $validatedData['cover_image'] = null;
        }

        $validatedData['author_id'] = Auth::user()->id;
        Post::where('id', $post->id)->update($validatedData);
        return redirect('/dashboard')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->cover_image) {
            Storage::delete($post->cover_image);
        }

        Post::destroy($post->id);
        return redirect('/dashboard')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
