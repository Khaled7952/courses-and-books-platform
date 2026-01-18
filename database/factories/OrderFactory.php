<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $user = Customer::inRandomOrder()->first() ?? Customer::factory()->create();

        return [
            'user_id'     => $user->id,
            'order_code'  => Str::uuid(),
            'order_type'  => fake()->randomElement(['book','course']),
            'total_price' => fake()->randomFloat(2, 50, 500),
            'status'      => fake()->randomElement(['pending','paid','failed']),
            'name'        => $user->name,
            'phone'       => $user->mobile,
        ];
    }
}
