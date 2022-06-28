<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        return [
          'identifier' => $this->faker->unique()->userName,
          'first_name' => $this->faker->firstName,
          'last_name' => $this->faker->lastName,
          'email' => $this->faker->unique()->safeEmail,
          'password' => bcrypt('password'),
          'role_id' => Role::LEARNER,
          'contact' => '0102030405',
          'gender' => 'M',
          'badge' => 'badge.jpeg',
          'country_id' => \App\Models\Country::all()->random()->id
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
}
