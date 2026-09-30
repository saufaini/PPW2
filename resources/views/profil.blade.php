@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="card">
    <h1>Profil Saya</h1>
    <p>Nama: {{ $nama }}</p>
    <p>Umur: {{ $umur }} tahun</p>
    <p>Kota: {{ $kota }}</p>
</div>
@endsection