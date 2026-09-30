@extends('layouts.app')


@section('title', 'Edit Post')
@section('content')
    <div class="card">
        <h1 class="page-title mb-5">Edit Blog Post</h1>
        @include('posts._form', ['post' => $post])
    </div>
@endsection