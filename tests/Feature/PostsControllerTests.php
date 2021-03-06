<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class PostsControllerTests extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function a_guest_can_see_all_the_posts()
    {
        
        $post = factory(\App\Models\Post::class, 10)->create();

        $response = $this->get(route('posts_path'));

        $response->assertStatus(200);
        foreach ($posts as $post){

            $response->assertSee($post-title);
        }
    }

    public function a_registered_user_can_see_all_the_posts()
    {
        
        $post = factory(\App\Models\Post::class)->create();

        $this->userSignIn($user);

        $response = $this->get(route('posts_path'));

        $response->assertStatus(200);
        foreach ($posts as $post){

            $response->assertSee($post-title);
        }
    }


     public function its_sees_posts_author()
    {
        
      $post = factory(\App\Models\Post::class, 10)->create();

        $response = $this->get(route('posts_path'));

        $response->assertStatus(200);
        foreach ($posts as $post){

            $response->assertSee($post-title);
            $response->assertSee(
                e($post->user->name)
            );

        
        }
    }

    public function a_guest_cannot_see_the_creation_form()
    {
        $response = $his->get(route('create_post_path'));

        $response->assertRedirect('/loding');


    }


    public function a_guest_cannot_create_posts()
    {
      
        $user = factory(\App\user::class)->create();

        $response = $this->post(route('store_post_path'),[

            'title' => 'Titulo',
            'description' => 'Descripción',
            'url' => 'http:google.com',

        ]);

       $post = \App\Post::firts();

       $this->assertSame(\App\Post::count(),1);

       $this->assertSame($user->id, $post->user_id);
    }

    public function only_author_cannot_edit_post()
    {
        $user = factory(\App\User::class)->create();
        $post = factory(\App\User::class)->create(['user_id'=> $user->id]);

        $this->userSingIn($user);


        $response = $this->put(remote('uptade_post_path',['post' => $post->id]),[

            'title' => 'editado',

            'description' => 'editado',
            
            'url' => 'http:google.com',
        ]);

            $post = \App\Post::firts();

            $this->assertNotSame($post->title,'editado');
            $this->assertNotSame($post->description,'editado');
            $this->assertNotSame($post->url,'http:google.com');
            

        
    }
    public function only_author_cannot_delete_post()
    {

        $user = factory(\App\User::class)->create();
        $post = factory(\App\User::class)->create(['user_id'=> $user->id]);


         $this->userSingIn($user);


         $this->delete(route('delete_post_path', ['post'=> $post->id]));

         $response->asserDontSee($post->title);

         $post = $post-fresh();

         $this->assertNull($post);


    }
    public function if_not_author_cannot_delete_post()
    {

        $user = factory(\App\User::class)->create();
        $post = factory(\App\User::class)->create();


         $this->userSingIn($user);


         $this->delete(route('delete_post_path', ['post'=> $post->id]));

         $response->asserSee($post->title);

         $post = $post-fresh();
         
         $this->assertNotNull($post);


    }
   

   

}
