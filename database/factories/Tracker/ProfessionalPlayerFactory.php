<?php

namespace Database\Factories\Tracker;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tracker\ProfessionalPlayer>
 */
class ProfessionalPlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'biography' => $this->faker->paragraphs(2, true),
            'enabled' => true,
        ];
    }
}
