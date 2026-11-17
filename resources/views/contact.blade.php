@extends('layouts.app')
@section('title', 'Kontak')

@section('content')
    <div class="card mx-auto max-w-xl">
        <h1 class="page-title mb-4">Hubungi Saya</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="label">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="input">
                @error('name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="input">
                @error('email')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="subject" class="label">Subjek</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="input">
                @error('subject')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="message" class="label">Pesan</label>
                <textarea name="message" id="message" rows="5" class="input">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
        </form>
    </div>
@endsection