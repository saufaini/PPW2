@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>{{ $posts->title }}</h1>
        <small>Tanggal: {{ $posts->created_at }}</small>
        <p>{{ $posts->description }}</p>

        <a href="{{ route('posts.edit', $posts->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('posts.destroy', $posts->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus post ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{ route('posts.index') }}">Back to List</a>
    </div>
</div>
@endsection