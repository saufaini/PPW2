@extends('layouts.app')
@section('title', 'Trash')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="page-title">Trash</h1>
        <a href="{{ route('posts.index') }}" class="btn btn-outline">&larr; Back to Posts</a>
    </div>

    @forelse ($posts as $post)
        <div class="card mb-4">
            <div class="flex items-start justify-between gap-3">
                <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                @include('posts._badge', ['status' => $post->status])
            </div>
            <p class="mt-1 text-xs text-slate-400">
                Dibuat: {{ $post->created_at->format('d M Y, H:i') }}
                &bull; Dihapus: {{ $post->deleted_at->format('d M Y, H:i') }}
            </p>
            <p class="mt-2 text-slate-600">{{ \Illuminate\Support\Str::limit($post->description, 160) }}</p>

            <div class="mt-3 flex items-center gap-2">
                <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-success">Restore</button>
                </form>
                <form action="{{ route('posts.force-delete', $post->id) }}" method="POST"
                      onsubmit="return confirm('Hapus PERMANEN? Data tidak bisa dikembalikan.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Permanently</button>
                </form>
            </div>
        </div>
    @empty
        <div class="card text-center text-slate-500">Trash kosong.</div>
    @endforelse
@endsection