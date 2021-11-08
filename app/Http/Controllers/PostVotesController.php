<?php

namespace App\Http\Controllers;

use App\Models\PostVote;
use Illuminate\Http\Request;


class PostVotesController extends Controller
{


    public function store(Request $request, $postId)
    {

        $vote = (int) $request->get('vote');

        $userId = \Auth::user()->id;

        //revisar si ya existe un voto para este post por este usuario

        $postVote = PostVote::firstOrNew(['user_id' => $userId, 'post_id' => $postId]);

        //sino existe, creamos el voto
        if (!$postVote->exists) {
            $postVote->vote = $vote;
            $postVote->save();
        } else {

            //si existe, actualizar el voto anterior

            PostVote::where(['user_id' => $userId, 'post_id' => $postId])->update(['vote' => $vote]);
        }

        $post = $postVote->post;

        return response()->json([

            'vote_total' => $post->totalVotes()

        ]);

        // $postVote = new PostVote;
        // $postVote->post_id = $postId;
        // $postVote->user_id=$userId;
        // $postVote->vote = $vote;
        // $postVote->updated_at =now();
        // $postVote->created_at = now();

        // $postVote->save();





    }

}
