@extends('layouts.app')
@section('title', $post->title)

@section('content')
    <div class="card">
        <h1 class="page-title">{{ $post->title }}</h1>
        <p class="mt-1 text-xs text-slate-400">
            {{ $post->category?->name ?? 'Tanpa kategori' }}
            @if ($post->post_date)
                &middot; {{ \Carbon\Carbon::parse($post->post_date)->format('d M Y') }}
            @endif
        </p>

        @if ($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}"
                 alt="{{ $post->title }}" class="mt-4 max-h-72 rounded">
        @endif

        <p class="mt-4 whitespace-pre-line text-slate-600">{{ $post->description }}</p>

        <div class="mt-4 flex flex-wrap gap-1">
            @foreach ($post->technologies as $t)
                <span class="badge badge-draft">{{ $t->name }}</span>
            @endforeach
        </div>

        @if ($post->images->isNotEmpty())
            <h2 class="mb-3 mt-6 text-lg font-semibold">Gallery</h2>
            <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
                @foreach ($post->images as $img)
                    <img src="{{ asset('storage/' . $img->image) }}"
                         alt="{{ $img->caption ?? $post->title }}"
                         class="h-32 w-full rounded object-cover">
                @endforeach
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('blog.index') }}" class="link">&larr; Kembali ke Blog</a>
        </div>
    </div>
@endsection