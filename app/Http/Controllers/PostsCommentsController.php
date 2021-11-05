<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostsCommentsController extends Controller
{
    public function create(Request $request, $postId)
    {
        //validar la data enviada
        $this->validate($request, [
            'comment' => 'required'
        ]);

        
        //persistir el ario
        $comment = new Comment;

        $comment->text= $request->get('comment');

        $comment->post_id = $postId;

        $comment->user_id = \Auth::user()->id;

        $comment->save();

        // //redireccionar a la publicacion    

        return redirect()->route('post_show_path', ['id'=>$postId]);
        

    }

}