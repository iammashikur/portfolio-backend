<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'designation' => $this->faker->text(255),
            'status' => $this->faker->numberBetween(0, 127),
        ];
    }
}
