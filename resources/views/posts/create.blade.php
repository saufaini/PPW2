@extends('layouts.app')

@section('title', 'Add Post')
@section('content')
    <div class="card">
        <h1 class="page-title mb-5">Add Blog Post</h1>
        @include('posts._form')
    </div>
@endsection