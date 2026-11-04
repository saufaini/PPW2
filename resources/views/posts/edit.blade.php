@extends('layouts.app')


@section('title', 'Edit Post')
@section('content')
    <div class="card">
        <h1 class="page-title mb-5">Edit Blog Post</h1>
        @include('posts._form', ['post' => $post])

        <div class="card mt-6">
            <h2 class="mb-3 text-lg font-semibold">Gallery</h2>

            <form action="{{ route('posts.gallery.store', $post->id) }}" method="POST"
                enctype="multipart/form-data" class="mb-4">
                @csrf
                <input type="file" name="images[]" multiple accept="image/*" class="input">
                @error('images')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn btn-primary mt-2">Upload</button>
            </form>

            <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
                @foreach ($post->images as $img)
                    <div>
                        <img src="{{ asset('storage/' . $img->image) }}"
                            alt="{{ $img->caption ?? $post->title }}" class="h-28 w-full rounded object-cover">
                        <form action="{{ route('posts.gallery.destroy', [$post->id, $img->id]) }}" method="POST"
                            onsubmit="return confirm('Hapus gambar ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="link-danger text-sm">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection