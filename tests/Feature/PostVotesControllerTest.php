<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Post;
use App\Models\PostVote;
use App\Models\User;


class PostVotesControllerTest extends TestCase
{

    use DatabaseMigraions;

    use HasFactory;
    use Factory;
    public function it_doesnt_allow_a_vote_without_veing_authenticated()
    {
        $post=factory(Post::class)->create();

        $response = $this->json('POST',"/posts/vote/{$post->id}",['vote' => 1]);

        $response->assertStatus(401);
    }


    public function is_allaws_a_user_to_vote()
    {
        $user=factory(User::class)->create();

        $post=factory(Post::class)->create();

        $response = $this->actingAs($user)

            ->json('POST', "/posts/vote/{$post->id}",['vote'=>1]);


        $response->assertStatus(200);

        $this->assertDatabaseHas('post_votes',[
            'post_id' =>$post->id,
            'user_id' =>$user->id,
            'vote'=>1

        ]);
    }

    public function it_returns_vote_total()
    {
        $users=factory(User::class)->create();

        $post=factory(Post::class)->create();

        $response = $this->actingAs($users)

            ->json('POST', "/posts/{$post->id}/vote",['vote'=>1]);


        $response->assertStatus(200);
        $response->assertJson([
            'vote_total'=> 1
        ]);

    }

    public function it_update_vote_id_voted_twice($user)
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


public function it_calculates_total_votes($user)
    {
        $user1 = User::factory()->create();

        $user2=User::factory()->create();

        $user3 = User::factory()->create();

        $post=Post::factory()->create();


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
