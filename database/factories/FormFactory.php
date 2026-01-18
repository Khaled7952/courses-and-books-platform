<?php

namespace Database\Factories;

use App\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Form::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'city' =>  $this->faker->city,
            'phone' =>  $this->faker->phoneNumber,
            'email' =>  $this->faker->email,
            'message' =>  $this->faker->text,
            'device_fingerprint' => json_encode(['device' => $this->faker->word]),
            'ip' =>  $this->faker->ipv4,
        ];
    }
}
