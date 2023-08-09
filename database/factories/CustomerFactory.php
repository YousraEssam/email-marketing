<?php

namespace Database\Factories;

use App\Enums\GenderType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement([
            GenderType::MALE->value,
            GenderType::FEMALE->value
        ]);

        return [
            'first_name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $gender,
            'birth_date' => $this->faker->date('Y-m-d', 'now')
        ];
    }
}
