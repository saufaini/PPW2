@extends('layouts.app')
@section('title', $post->title)

@section('content')
    <div class="card">
        <div class="flex items-start justify-between gap-3">
            <h1 class="page-title">{{ $post->title }}</h1>
            @include('posts._badge', ['status' => $post->status])
        </div>
        <p class="mt-1 text-xs text-slate-400">Tanggal: {{ $post->created_at->format('d M Y, H:i') }}</p>
        <p class="mt-3 whitespace-pre-line text-slate-600">{{ $post->description }}</p>

        @if ($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}"
                alt="{{ $post->title }}" class="mb-4 max-h-72 rounded">
        @endif

        @if ($post->images->isNotEmpty())
            <h2 class="mb-3 text-lg font-semibold">Gallery</h2>
            <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
                @foreach ($post->images as $img)
                    <img src="{{ asset('storage/' . $img->image) }}"
                        alt="{{ $img->caption ?? $post->title }}" class="h-32 w-full rounded object-cover">
                @endforeach
            </div>
        @endif

        <div class="mt-4 flex flex-wrap items-center gap-2 text-sm">
            <a href="{{ route('posts.edit', $post->id) }}" class="link">Edit</a>
            <span class="text-slate-300">|</span>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline"
                  onsubmit="return confirm('Post akan dipindahkan ke Trash. Lanjutkan?')">
                @csrf @method('DELETE')
                <button type="submit" class="link-danger">Delete</button>
            </form>
            <span class="text-slate-300">|</span>
            <a href="{{ route('posts.index') }}" class="link">Back to List</a>
        </div>
    </div>
@endsection