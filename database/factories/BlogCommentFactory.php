<?php

namespace Database\Factories;

use App\Models\BlogComment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogComment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(),
            'email' => $this->faker->email(),
            'comment' => $this->faker->text(),
            'parent_id' => $this->faker->randomNumber(),
            'blog_id' => \App\Models\Blog::factory(),
        ];
    }
}
