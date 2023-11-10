<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Qualification;
use Illuminate\Database\Eloquent\Factories\Factory;

class QualificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Qualification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'School' => $this->faker->text(255),
            'from_date' => $this->faker->date(),
            'to_date' => $this->faker->date(),
            'degree' => $this->faker->text(255),
            'status' => $this->faker->numberBetween(0, 127),
        ];
    }
}
