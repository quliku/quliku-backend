<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ForemanDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $classification = ['water', 'infra', 'engineer', 'craft'];
        $bank_type = ['BRI', 'BNI', 'BCA', 'Mandiri'];
        return [
            'user_id' => User::factory()->create()->id,
            'city' => fake()->city,
            'wa_number' => fake()->phoneNumber,
            'classification' => $classification[array_rand($classification)],
            'description' => fake()->text(50),
            'experience' => fake()->numberBetween(1, 10),
            'min_people' => fake()->numberBetween(10, 20),
            'max_people' => fake()->numberBetween(50, 100),
            'price' => fake()->numberBetween(100, 1000),
            'bank_type' => $bank_type[array_rand($bank_type)],
            'account_name' => fake()->name,
            'account_number' => fake()->randomNumber(10),
        ];
    }
}
