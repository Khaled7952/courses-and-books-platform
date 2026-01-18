<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        $verified = $this->faker->boolean(70);

        return [

            'name' => $this->faker->name(),

            'mobile' => $this->faker->unique()
                ->numerify('05########'),

            'password' => Hash::make('12345678'),

            'is_mobile_verified' => $verified,

            'mobile_verified_at' => $verified ? now() : null,

            'is_active' => $this->faker->boolean(90),
        ];
    }
}
