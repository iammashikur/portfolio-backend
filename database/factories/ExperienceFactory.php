<?php

namespace Database\Factories;

use App\Models\Experience;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company' => $this->faker->text(255),
            'designation' => $this->faker->text(255),
            'from_date' => $this->faker->date(),
            'to_date' => $this->faker->date(),
            'status' => $this->faker->numberBetween(0, 127),
        ];
    }
}
