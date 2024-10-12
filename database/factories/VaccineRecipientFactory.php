<?php

namespace Database\Factories;

use App\Models\VaccineRecipient;
use Illuminate\Database\Eloquent\Factories\Factory;

class VaccineRecipientFactory extends Factory
{
    protected $model = VaccineRecipient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'nid' => $this->faker->unique()->numerify('##########'),
            'contact_no' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'vaccine_center_id' => null,
        ];
    }
}
