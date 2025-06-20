<?php

namespace App\Http\Middleware;

use App\Models\Post;
use App\Services\PostViewService;
use Closure;
use Illuminate\Http\Request;

class TrackPostView
{
    protected $postViewService;

    public function __construct(PostViewService $postViewService)
    {
        $this->postViewService = $postViewService;
    }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Track view hanya untuk GET request yang sukses
        if ($request->isMethod('GET') && $response->getStatusCode() === 200) {
            $post = $request->route('post');

            if ($post instanceof Post) {
                // Track view secara asynchronous untuk tidak mengganggu response
                dispatch(function () use ($post, $request) {
                    $this->postViewService->trackView($post, $request);
                })->afterResponse();
            }
        }

        return $response;
    }
}
