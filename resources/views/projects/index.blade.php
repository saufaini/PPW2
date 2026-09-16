 @extends('layouts.app') 

 @section('content') 
 <div class="jumbotron jumbotron-fluid"> 
    <div class="container"> 
        <h1>My Projects</h1> 
        <a href="{{ route('projects.create') }}">Tambah Project</a>
         @if(count($projects)>0) 
         @foreach ($projects as $project) 
         <div class="well"> 
            <h3><a href="/projects/{{$project->id}}">{{$project->title}}</a></h3> 
            <small>Tanggal: {{$project->created_at}}</small> 
        </div> @endforeach @else 
        <h3>Belum ada project.</h3> 
        @endif 
    </div> 
</div> 
@endsection