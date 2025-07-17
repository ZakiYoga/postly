<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'MyPosts';
        $posts = Post::with(['category', 'author'])
            ->withCount('likes')
            ->where('author_id', Auth::id())
            ->latest()
            ->paginate(6);

        return view('user.dashboard.posts', compact('title', 'posts'));
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
    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['generate_unsplash'] = $request->has('generate_unsplash');

        // if cover image or unsplash image is not provided
        if (!$request->file('cover_image') && !$validatedData['generate_unsplash']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please upload a featured image or enable auto-generate image from Unsplash.');
        }

        if ($request->file('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        } else {
            if ($validatedData['generate_unsplash']) {
                $category = Category::find($request->category_id);

                $response = Http::withHeaders([
                    'Authorization' => 'Client-ID ' . config('services.unsplash.access_key')
                ])
                    ->get('https://api.unsplash.com/photos/random', [
                        'query' => $category->name,
                        'orientation' => 'landscape',
                    ]);

                if ($response->successful()) {
                    $validatedData['cover_image'] = $response->json('urls.small');
                } else {
                    $errorMessage = $response->json('errors.0') ?? 'Unknown error';
                    return back()->with('error', 'Failed to fetch image from Unsplash. ' . $errorMessage);
                }
            }
        }




        $cleanBody = Purifier::clean($request->body);
        $validatedData['body'] = $cleanBody;

        $validatedData['author_id'] = Auth::user()->id;

        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New Post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        $post = Post::with([
            'category',
            'author',
            'comments' => function ($query) {
                $query->whereNull('parent_id')
                    ->approved()
                    ->orderBy('created_at', 'desc')
                    ->with([
                        'user',
                        'replies' => function ($q) {
                            $q->approved()
                                ->orderBy('created_at', 'asc')
                                ->with('user');
                        }
                    ]);
            }
        ])
            ->withCount(['likes', 'comments', 'views'])
            ->findOrFail($post->id);

        return view('user.dashboard.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('user.dashboard.edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validatedData = $request->validatedForDatabase();

        // Handle cover image logic
        if ($request->hasFile('cover_image')) {
            // New image uploaded - replace existing image

            if ($post->cover_image) {
                Storage::delete($post->cover_image);
            }

            $validatedData['cover_image'] = $request->file('cover_image')->store('cover_images');
        } elseif ($request->has('remove_image') && $request->remove_image == '1') {

            // Delete old cover image if exists
            if ($post->cover_image) {
                Storage::delete($post->cover_image);
            }

            $validatedData['cover_image'] = null;
        } else {
            // No new image uploaded and not removed - keep existing values
            unset($validatedData['cover_image']);
        }

        $validatedData['author_id'] = Auth::user()->id;
        Post::where('id', $post->id)->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
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
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function updateVisibility(Post $post, Request $request)
    {
        $visibility = $request->boolean('visibility') ? 'public' : 'private';

        $post->update([
            'visibility' => $visibility,
        ]);

        $message = $visibility === 'public'
            ? 'The post is now visible to the public.'
            : 'The post is now private and hidden from the public.';

        return back()->with('success', $message);
    }
}
