<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\PostVote;
use App\Models\User;


class PostVotesControllerTest extends TestCase
{

    use DatabaseMigraions;


    public function it_doesnt_allow_a_vote_without_veing_authenticated()
    {
        $post=factory(Post::class)->create();

        $response = $this->json('POST',"/posts/{$post->id}/vote",['vote'=>1]);

        $response->assertStatus(401);
    }


    public function is_allaws_a_user_to_vote()
    {
        $user = factory(User::class)->create();
        
        $post=factory(Post::class)->create();

        $response = $this->actingAs($user)
        
            ->json('POST', "/posts/{$post->id}/vote",['vote'=>1]);


        $response->assertStatus(200); 
        
        $this->assertDatabaseHas('post_votes',[
            'post_id' =>$post->id,
            'user_id' =>$user->id,
            'vote'=>1

        ]);
    }

    public function it_returns_vote_total()
    {
        $user = factory(User::class)->create();
        
        $post=factory(Post::class)->create();

        $response = $this->actingAs($user)
        
            ->json('POST', "/posts/{$post->id}/vote",['vote'=>1]);


        $response->assertStatus(200); 
        $response->assertJson([
            'vote_total'=> 1
        ]); 
       
    }

    public function it_update_vote_id_voted_twice()
    {
        $user = factory(User::class)->create();
        
        $post=factory(Post::class)->create();

        $response = $this->actingAs($user)
        
            ->json('POST', "/posts/{$post->id}/vote",['vote'=>1]);


        $response->assertStatus($user)

            ->json('POST', "/posts/{$post->id}/vote",['vote'=> -1]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('post_votes',[
            'post_id' =>$post->id,
            'user_id' =>$user->id,
            'vote'=>-1

        ]);

        $this->assertEquals(3,PostVote::count());

    }

    
public function it_calculates_total_votes()
    {
        $user1 = factory(User::class)->create();
        
        $user2=factory(User::class)->create();

        $user3 = factory(User::class)->create();
        
        $post=factory(Post::class)->create();


        $response = $this->actingAs($user)
        
            ->json('POST', "/posts/{$post->id}/vote",['vote'=>1]);


        $response->assertStatus(200); 
        $response->assertJson([
            'vote_total'=> 1
        ]); 
       
    }
    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
}
