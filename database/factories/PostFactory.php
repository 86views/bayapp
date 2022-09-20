<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->title(),
            'author' => $this->faker->name(),
            'body' => $this->faker->text(),
            'cover_image'  => $this->faker->image('public/images/', 400, 300, null, false),

           
        ];
    }
}