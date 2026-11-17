<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['category', 'technologies'])
            ->where('status', 'published')
            ->when($request->search, fn ($q, $s) =>
                $q->where(fn ($w) => $w
                    ->where('title', 'like', "%{$s}%")
                    ->orWhere('short_description', 'like', "%{$s}%")))
            ->when($request->category, fn ($q, $c) =>
                $q->whereHas('category', fn ($w) => $w->where('slug', $c)))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        abort_if($post->status !== 'published', 404);

        return new PostResource($post->load(['category', 'technologies']));
    }
}







