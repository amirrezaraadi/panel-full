<?php

namespace Database\Factories\Manager;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->name() ,
            'slug' => $this->faker->name() ,
            'icon' => $this->faker->imageUrl(),
            'status' => 'success',
            'parent_id' => null,
            'user_id' => $this->faker->numberBetween(1, 15),
        ];
    }
}
