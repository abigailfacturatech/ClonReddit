<?php

namespace Database\Factories;
use App\Models\Post;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Post::class;


    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'email' => $this->faker->paragraph,
            'url' => $this->faker->url,
            'user_id' => function ()
            {
                factory(User::class)->create()->id;
            }
        ];
    }
}
