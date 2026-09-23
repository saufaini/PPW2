@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Blog Posts</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('posts.create') }}">Create New Post</a>

        @if(count($posts)>0)
        @foreach ($posts as $post)
        <div class="well">
            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
            <small>Tanggal: {{$post->created_at}}</small>
            <p>{{$post->description}}</p>
        </div>
        @endforeach
        @else
        <h3>Tidak ada data.</h3>

        @endif
    </div>
</div>
@endsection