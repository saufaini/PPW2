@extends('layouts.app')
@section('title', 'Posts')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="page-title">Blog Posts</h1>
        <div class="flex gap-2">
            <a href="{{ route('posts.trash') }}" class="btn btn-outline">Trash ({{ $stats['trashed'] }})</a>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Create New Post</a>
        </div>
    </div>

    <div class="mb-6 grid grid-cols-2 gap-4 md:grid-cols-4">
        <div class="card p-4"><p class="text-xs text-slate-400">Total Post</p>
            <p class="text-2xl font-bold text-indigo-600">{{ $stats['total'] }}</p></div>
        <div class="card p-4"><p class="text-xs text-slate-400">Published / Draft</p>
            <p class="text-2xl font-bold text-indigo-600">{{ $stats['published'] }} / {{ $stats['draft'] }}</p></div>
        <div class="card p-4"><p class="text-xs text-slate-400">ID Terkecil / Terbesar</p>
            <p class="text-2xl font-bold text-indigo-600">{{ $stats['minId'] ?? '-' }} / {{ $stats['maxId'] ?? '-' }}</p></div>
        <div class="card p-4"><p class="text-xs text-slate-400">Post Terbaru</p>
            <p class="truncate text-sm font-semibold">{{ $stats['latest']?->title ?? '-' }}</p></div>
    </div>

    <form method="GET" action="{{ route('posts.index') }}" class="card mb-6 flex flex-wrap items-end gap-3 p-4">
        <div class="min-w-48 flex-1">
            <label for="search" class="label">Cari judul</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" class="input">
        </div>
        <div>
            <label for="status" class="label">Status</label>
            <select id="status" name="status" class="input">
                <option value="">Semua</option>
                <option value="published" @selected(request('status') === 'published')>Published</option>
                <option value="draft" @selected(request('status') === 'draft')>Draft</option>
            </select>
        </div>



        <div>
            <label for="per_page" class="label">Per halaman</label>
            <select id="per_page" name="per_page" class="input">
                @foreach ([5, 10, 25] as $n)
                    <option value="{{ $n }}" @selected((int) request('per_page', 10)) === $n)>{{ $n }}</option>
                @endforeach
            </select>
        </div>





        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('posts.index') }}" class="link self-center text-sm">Reset</a>
    </form>

    @forelse ($posts as $post)
        <div class="card mb-4">
            <div class="flex items-start justify-between gap-3">
                <h3 class="text-lg font-semibold">
                    {{ $posts->firstItem() + $loop->index }}.
                    <a href="{{ route('posts.show', $post->id) }}" class="link">{{ $post->title }}</a>
                </h3>
                @include('posts._badge', ['status' => $post->status])
            </div>
            <p class="mt-1 text-xs text-slate-400">Tanggal: {{ $post->created_at->format('d M Y, H:i') }}</p>
            <p class="mt-2 text-slate-600">{{ \Illuminate\Support\Str::limit($post->description, 160) }}</p>

            <div class="mt-3 flex items-center gap-2 text-sm">
                <a href="{{ route('posts.edit', $post->id) }}" class="link">Edit</a>
                <span class="text-slate-300">|</span>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline"
                      onsubmit="return confirm('Post akan dipindahkan ke Trash. Lanjutkan?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="link-danger">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="card text-center text-slate-500">Tidak ada data.</div>
    @endforelse

    <div class="mt-4 text-sm text-slate-500">
        Halaman : {{ $posts->currentPage() }} <br>
        Jumlah Data : {{ $posts->total() }} <br>
        Data Per Halaman : {{ $posts->perPage() }}
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
@endsection