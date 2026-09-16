<?php 

namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use App\Models\Post;

class PostController extends Controller
{
    public function create() { return view('posts.create'); }

    public function store(Request $request) { 
        // $post = new Post; 
        // $post->title = $request->input('title'); 
        // $post->description = $request->input('description'); 
        // $post->save(); return redirect()->route('posts.index'); 
        // }

        //dipersingkat jadi
        // Post::create([ 'title' => $request->input('title'), 'description' => $request->input('description'), ]); 
        // return redirect()->route('posts.index'); }

    $request->validate([ 'title' => 'required|max:200', 'description' => 'required', ]); 
    Post::create($request->only(['title', 'description'])); 
    return redirect()->route('posts.index'); }
    
        

    public function show($id) { 
        $data = array( 'id' => "posts", 'posts' => Post::find($id) ); 
        return view('posts.show')->with($data); 
        }

    public function index() { 
        $data = array( 'id' => "posts", 'posts' => Post::all() ); 
        return view('posts.index')->with($data); 
        }
}
