<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1, 5),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => (string)rand(1, 3),
            'email' => $this->faker->unique()->safeEmail,
            'phone1' => $this->faker->numberBetween(100, 999),
            'phone2' => $this->faker->numberBetween(100, 999),
            'phone3' => $this->faker->numberBetween(1000, 9999),
            'address' => $this->faker->address,
            'building' => $this->faker->optional()->secondaryAddress,
            'inquiry_type' => (string)rand(1, 5),
            'detail' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
