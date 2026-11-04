<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->status === 'published') {
            $query->published();
        } elseif ($request->status === 'draft') {
            $query->draft();
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();;

        $perPage = in_array((int) $request->per_page, [5, 10, 25])
            ? (int) $request->per_page
            : 5;

        $posts = $query->orderBy('created_at', 'desc')
                    ->paginate($perPage)
                    ->withQueryString();

        $stats = [
            'total'     => Post::count(),
            'published' => Post::published()->count(),
            'draft'     => Post::draft()->count(),
            'maxId'     => Post::max('id'),
            'minId'     => Post::min('id'),
            'latest'    => Post::latest()->first(),
            'trashed'   => Post::onlyTrashed()->count(),
        ];

        return view('posts.index', compact('posts', 'stats'));
    }
    


    public function create()
    {
        return view('posts.create');
    }

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:200',
        'description' => 'required|min:10',
        'status' => 'required|in:draft,published',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
    ]);

    $data = $request->only(['title', 'description', 'status']);

    if ($request->hasFile('thumbnail')) {
        $data['thumbnail'] = $request->file('thumbnail')
            ->store('posts/thumbnails', 'public');
    }

    Post::create($data);

    return redirect()->route('posts.index')
        ->with('success', 'Post berhasil ditambahkan.');
}




    

    public function show($id)
    {
        // $data = [
        //     'id' => "posts",
        //     'posts' => Post::findOrFail($id),
        // ];
          
        // return view('posts.show')->with($data);
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }



    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $data = [
            'post' => $post,
        ];
        return view('posts.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required|min:10',
            'status' => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
        ]);

        $post = Post::findOrFail($id);
        $oldThumbnail = $post->thumbnail;

        $post->fill($request->only(['title', 'description', 'status']));

        if ($request->hasFile('thumbnail')) {
            $post->thumbnail = $request->file('thumbnail')
                ->store('posts/thumbnails', 'public');
        }

        if (! $post->isDirty()) {
            return redirect()->route('posts.index')->with('info', 'Tidak ada perubahan data.');
        }

        $post->save();

        if ($request->hasFile('thumbnail') && $oldThumbnail) {
            Storage::disk('public')->delete($oldThumbnail);
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post dipindahkan ke Trash!');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('posts.trash')->with('success', 'Post berhasil dikembalikan.');
    }

    // public function forceDelete($id)
    // {
    //     $post = Post::onlyTrashed()->findOrFail($id);

    //     if ($post->thumbnail) {
    //         Storage::disk('public')->delete($post->thumbnail);
    //     }

    //     $post->forceDelete();

    //     return redirect()->route('posts.trash')->with('success', 'Post dihapus permanen.');
    // }


    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        foreach ($post->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $post->forceDelete();

        return redirect()->route('posts.trash')->with('success', 'Post dihapus permanen.');
    }
}