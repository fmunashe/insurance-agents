<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::query()->pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($users),
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'gender' => fake()->randomLetter(),
            'id_number' => fake()->randomNumber(),
            'mobile' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'address' => fake()->address()
        ];
    }
}
