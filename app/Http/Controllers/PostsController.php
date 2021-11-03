<?php

namespace App\Http\Controllers;
use App\Models\Post;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    
    public function index()
    {               
                //te muestra todos los datos del mas reciente al más antiguo
        $posts = Post::orderBy('id','desc')->paginate(10); 
            
            return view('posts.index')->with(['posts'=> $posts]);
    }
    
    public function show(Post $post)
    {

            return view('posts.show')->with(['post'=>$post]);
    }

    public function create()
    {
            $post = new Post;
  
            return view('posts.create')->with(['post' =>$post]);    
            
    }

    public function store(CreatePostRequest $request)
    {
      
        $post = new Post;
        
        $post->fill(

                $request->only('title','description','url')
        );
        
                $post->user_id = $request->user()->id;

                $post->save();

                session()->flash('message', 'Post Created');

            return redirect()->route('posts_path');
    }

    public function edit(Post $post)
    {
            return view('posts.edit')->with(['post'=> $post]);
    }

    public function update(Post $post, UpdatePostRequest $request)
    {   
           

            $post->update(

                $request->only('title','description','url')
            );

             session()->flash('message', 'Post Updated');
            
            return redirect()->route('post_path',['post'=> $post->id]);
    }

    public function delete(Post $post)
    {
            //se utliza el metodo delete y se redirecciona en la pagina principal
           $post->delete();
                //mensaje de eliminar
            session()->flash('message', 'Post Created');

           return redirect()->route('posts_path');
    }

}