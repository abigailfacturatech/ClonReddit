<?php

namespace App\Http\Controllers;
use App\Models\PostVote;
use Illuminate\Http\Request;

class PostsVotesController extends Controller
{
    public function store($request,$postId)
    {
       $vote =(int) $request -> get('vote');

       $userId = \Auth::user()->id;

       //revisar si ya existe un voto para este post por este usuario

       $postVote = PostVote::firstOrNew(['user_id'=> $userId, 'post_id' => $postId]);

       //sino existe, creamos el voto
        if(!$postVote->exixts){
            $postVote->vote=$vote;
            $postVote->save();
        }else{
            
            //si existe, actualizar el voto anterior

            PostVote::where(['user_id'=>$userId, 'post_id'=>$postId])->update(['vote' => $vote]);
       
        }

            $post = $postVote->post;

       return response()->json([

        'vote_total'=> $post->totalVotes()

    ]);
    }

    
}
