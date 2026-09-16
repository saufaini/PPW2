@extends('layouts.app') 
@section('content') 
<div class="jumbotron jumbotron-fluid"> 
    <div class="container"> 
        <h1>{{$project->title}}</h1> 
        <small>Tanggal: {{$project->created_at}}</small> 
        <p>{{$project->description}}</p> 
    </div> 
</div> 
@endsection
