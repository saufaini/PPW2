<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $data = [
            'id' => "posts",
            'posts' => Post::all(),
        ];
        return view('posts.index')->with($data);
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
        ]);

        Post::create($request->only(['title', 'description']));

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'id' => "posts",
            'posts' => Post::find($id),
        ];
        return view('posts.show')->with($data);
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
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'description']));

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }
}