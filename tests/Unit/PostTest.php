<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function post_determines_its_author()
    {
      $user = factory(\App\Models\User::class)->create();
      
      $post = factory(\App\Models\User::class)->create([

            'user_id' => $user->id

      ]);

      $postByAnotherUser = factory(\App\Models\Post::class)-create();

      $postByAuthor = $post->wasCreateBy($user);

      $postByAnotherAuthor = $postByAnotherUser->wasCreatedBy($user);


      

      $this->asserTrue($postByAuthor);

      $this->assertFalse($postByAnotherAuthor);
    }

    public function post_determines_its_author_if_null_return_false()
    {
      $user = factory(\App\Models\User::class)->create();
      
      $postByAuthor = $post->wasCreateBy(null);

    
      $this->assertFalse($postByAuthor);
    }

}
