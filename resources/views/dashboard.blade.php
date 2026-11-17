@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <h1 class="page-title mb-6">Dashboard</h1>

    <div class="mb-6 grid grid-cols-2 gap-4 md:grid-cols-3">
        <x-stat-card label="Total Post" :value="$totalPosts" />
        <x-stat-card label="Published" :value="$totalPublished" color="text-green-600" />
        <x-stat-card label="Draft" :value="$totalDraft" color="text-orange-600" />
        <x-stat-card label="Trash" :value="$totalTrashed" color="text-purple-600" />

        <x-stat-card label="Messages" :value="$totalMessages" color="text-sky-600" />
        <x-stat-card label="Belum Dibaca" :value="$unreadMessages" color="text-rose-600" />
    </div>
    
    <h2 class="mb-3 text-lg font-semibold">Post per Bulan</h2>
    <div class="card mb-6">
        @forelse ($perBulan as $bulan => $jumlah)
            <div class="flex justify-between border-b border-slate-100 py-2 text-sm last:border-0">
                <span>{{ \Carbon\Carbon::createFromFormat('!Y-m', $bulan)->format('M Y') }}</span>
                <span class="font-semibold text-indigo-600">{{ $jumlah }}</span>
            </div>
        @empty
            <p class="text-center text-slate-500">Belum ada data.</p>
        @endforelse
    </div>

    <h2 class="mb-3 text-lg font-semibold">5 Post Terbaru</h2>
    @forelse ($latestPosts as $post)
        <div class="card mb-3">
            <a href="{{ route('posts.show', $post->id) }}" class="link">{{ $post->title }}</a>
            <p class="text-xs text-slate-400">{{ $post->created_at->format('d M Y, H:i') }}</p>
        </div>
    @empty
        <div class="card text-center text-slate-500">Belum ada post.</div>
    @endforelse
@endsection

<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->
