@extends('layouts.app')
@section('title', 'Pesan dari ' . $contact->name)

@section('content')
    <div class="card">
        <h1 class="page-title">{{ $contact->subject ?: '(Tanpa subjek)' }}</h1>
        <p class="mt-1 text-sm text-slate-600">{{ $contact->name }} &middot; {{ $contact->email }}</p>
        <p class="text-xs text-slate-400">{{ $contact->created_at->format('d M Y, H:i') }}</p>

        <p class="mt-4 whitespace-pre-line text-slate-700">{{ $contact->message }}</p>

        <div class="mt-6">
            <a href="{{ route('contacts.index') }}" class="link">&larr; Kembali ke Messages</a>
        </div>
    </div>
@endsection