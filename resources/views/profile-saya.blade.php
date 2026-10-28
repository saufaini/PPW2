@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')
    <h1 class="page-title">Profil Saya</h1>

    <div class="card">
        <p>Nama : {{ Auth::user()->name }}</p>
        <p>Email : {{ Auth::user()->email }}</p>
    </div>
@endsection