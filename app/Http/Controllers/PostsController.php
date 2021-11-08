<?php

namespace App\Http\Controllers;
use App\Models\Post;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function index()
    {
                //te muestra todos los datos del mas reciente al más antiguo
        $posts = Post::with('user', 'votes')->orderBy('id','desc')->paginate(10);

            return view('posts.index')->with(['posts'=> $posts]);
    }

    public function show(Post $id)
    {
         $id->load(['comments' => function($query){

                $query->orderBy('id','desc');

         },'comments.user']);


            return view('posts.show')->with(['post'=>$id]);
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

            return redirect()->route('posts_index_path');
    }

    public function edit(Post $post)
    {
             if($post->user_id != Auth::user()->id)
            {
                    return redirect()->route('posts_index_path');
            }

            return view('posts.edit')->with(['post'=> $post]);
    }

    public function update(Post $post, UpdatePostRequest $request)
    {


            $post->update(

                $request->only('title','description','url')
            );

             session()->flash('message', 'Post Updated');

            return redirect()->route('posts_index_path',['post'=> $post->id]);
    }

    public function delete(Post $post)
    {

            if($post->user_id != Auth::user()->id)
            {
                    return redirect()->route('posts_index_path');
            }

            //se utliza el metodo delete y se redirecciona en la pagina principal
           $post->delete();
           //mensaje de eliminar
            session()->flash('message', 'Post Created');

           return redirect()->route('posts_index_path');
    }

}
