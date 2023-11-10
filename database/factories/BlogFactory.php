<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->text(),
            'keywords' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'status' => $this->faker->numberBetween(0, 127),
            'blog_category_id' => \App\Models\BlogCategory::factory(),
        ];
    }
}
