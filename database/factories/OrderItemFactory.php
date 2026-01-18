<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Book;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $model = fake()->randomElement([Book::class, Course::class]);
        $item  = $model::inRandomOrder()->first();

        if (! $item) {
            $item = $model::factory()->create();
        }

        return [
            'item_id'   => $item->id,
            'item_type' => $model,
            'item_name' => $item->title,
            'price'     => $item->price,
            'status'    => fake()->randomElement(['completed','refunded']),
        ];
    }
}
