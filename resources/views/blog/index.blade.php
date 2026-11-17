@extends('layouts.app')
@section('title', 'Blog')

@section('content')
    <h1 class="page-title mb-6">Blog</h1>

    <form method="GET" action="{{ route('blog.index') }}" class="card mb-6 flex flex-wrap items-end gap-3 p-4">
        <div class="min-w-48 flex-1">
            <label for="search" class="label">Cari</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" class="input">
        </div>
        <div>
            <label for="category" class="label">Kategori</label>
            <select id="category" name="category" class="input">
                <option value="">Semua kategori</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->slug }}" @selected(request('category') === $c->slug)>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div>
            <label for="technology" class="label">Technology</label>
            <select id="technology" name="technology" class="input">
                <option value="">Semua technology</option>
                @foreach ($technologies as $t)
                    <option value="{{ $t->slug }}" @selected(request('technology') === $t->slug)>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
        </div>



        <div>
            <label for="sort" class="label">Urutkan</label>
            <select id="sort" name="sort" class="input">
                <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
                <option value="terlama" @selected(request('sort') === 'terlama')>Terlama</option>
                <option value="az" @selected(request('sort') === 'az')>Judul A-Z</option>

                <option value="tanggal_baru" @selected(request('sort') === 'tanggal_baru')>Tanggal post terbaru</option>
                <option value="tanggal_lama" @selected(request('sort') === 'tanggal_lama')>Tanggal post terlama</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
        <a href="{{ route('blog.index') }}" class="link self-center text-sm">Reset</a>
    </form>

    <p class="mb-3 text-sm text-slate-500">
        {{ $posts->total() }} hasil ditemukan
    </p>

    <div class="grid gap-4 md:grid-cols-3">
        @forelse ($posts as $post)
            <div class="card">
                @if ($post->thumbnail)
                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                         alt="{{ $post->title }}" class="mb-3 h-36 w-full rounded object-cover">
                @endif

                <h2 class="text-lg font-semibold">
                    <a href="{{ route('blog.show', $post) }}" class="link">{{ $post->title }}</a>
                </h2>                
                
                <p class="text-xs text-slate-400">
                    {{ $post->category?->name ?? 'Tanpa kategori' }}
                </p>
                <p class="mt-2 text-sm text-slate-600">{{ $post->short_description }}</p>
                <div class="mt-3 flex flex-wrap gap-1">
                    @foreach ($post->technologies as $t)
                        <span class="badge badge-draft">{{ $t->name }}</span>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="card col-span-full text-center text-slate-500">
                Tidak ada post yang cocok.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
@endsection