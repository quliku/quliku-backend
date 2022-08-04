<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $roles = ['contractor', 'foreman'];
        return [
            'name' => fake()->name(),
            'username' => fake()->userName(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => $roles[array_rand($roles)],
            'profile_url' => null,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's role should be contractor.
     *
     * @return static
     */
    public function contractorRole()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'contractor',
            ];
        });
    }

    /**
     * Indicate that the model's role should be foreman.
     *
     * @return static
     */
    public function foremanRole()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'foreman',
            ];
        });
    }

    /**
     * Configure the model factory
     *
     * @return $this
     */

    public function configure(): static
    {
        return $this->afterMaking(function ($user) {
            $user->profile_url = $user->username . '.jpg';
        });
    }
}
