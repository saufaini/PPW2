<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Technology;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category', 'technologies')
            ->where('status', 'published')
            ->when($request->search, fn ($q, $s) =>
                $q->where(fn ($w) => $w
                    ->where('title', 'like', "%{$s}%")
                    ->orWhere('short_description', 'like', "%{$s}%")
                    ->orWhere('description', 'like', "%{$s}%")))
            ->when($request->category, fn ($q, $c) =>
                $q->whereHas('category', fn ($w) => $w->where('slug', $c)))
            ->when($request->technology, fn ($q, $t) =>
                $q->whereHas('technologies', fn ($w) => $w->where('slug', $t)));    

        switch ($request->query('sort')) {
            case 'terlama':
                $query->oldest();
                break;
            case 'az':
                $query->orderBy('title');
                break;
            case 'tanggal_baru':
                $query->orderByDesc('post_date')->latest();
                break;
            case 'tanggal_lama':
                $query->orderBy('post_date')->oldest();
                break;
            default:
                $query->latest();
        }

        $posts = $query->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        return view('blog.index', compact('posts', 'categories', 'technologies'));
    }

    public function show(Post $post)
    {
        abort_if($post->status !== 'published', 404);

        $post->load('category', 'technologies', 'images');

        return view('blog.show', compact('post'));
    }
}