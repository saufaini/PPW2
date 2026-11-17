@extends('layouts.app')
@section('title', 'Messages')

@section('content')
    <h1 class="page-title mb-6">Messages</h1>

    @forelse ($contacts as $contact)
        <div class="card mb-3">
            <div class="flex items-start justify-between gap-3">
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('contacts.show', $contact->id) }}" class="link">
                        {{ $contact->subject ?: '(Tanpa subjek)' }}
                    </a>
                </h2>
                @if ($contact->is_read)
                    <span class="badge badge-published">Sudah dibaca</span>
                @else
                    <span class="badge badge-draft">Belum dibaca</span>
                @endif
            </div>
            <p class="text-sm text-slate-600">{{ $contact->name }} &middot; {{ $contact->email }}</p>
            <p class="text-xs text-slate-400">{{ $contact->created_at->format('d M Y, H:i') }}</p>
        </div>
    @empty
        <div class="card text-center text-slate-500">Belum ada pesan.</div>
    @endforelse

    <div class="mt-4">
        {{ $contacts->links() }}
    </div>
@endsection