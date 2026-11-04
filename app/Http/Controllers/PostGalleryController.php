<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostGalleryController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'images'   => 'required|array|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);




        $sisa = 10 - $post->images()->count();

        if (count($request->file('images')) > $sisa) {
            return back()->withErrors([
                'images' => "Gallery maksimal 10 gambar. Sisa slot: {$sisa}.",
            ]);
        }



        
        foreach ($request->file('images') as $file) {
            $post->images()->create([
                'image' => $file->store('posts/gallery', 'public'),
            ]);
        }

        return back()->with('success', 'Gambar berhasil diunggah.');
    }

    public function destroy(Post $post, PostImage $image)
    {
        abort_if($image->post_id !== $post->id, 404);

        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar dihapus.');
    }
}