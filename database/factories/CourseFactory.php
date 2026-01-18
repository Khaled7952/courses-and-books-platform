<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug'  => fake()->unique()->slug(),
            'description' => fake()->paragraph(3),
            'price' => fake()->randomFloat(2, 50, 500),

            'image' => 'courses/default.png',
            'benefits' => [
                ['benefit' => 'ميزة رقم 1'],
                ['benefit' => 'ميزة رقم 2'],
            ],

            'rating_avg'   => 0,
            'rating_count' => 0,

            'file_pdf' => null,

            'is_featured' => fake()->boolean(),

            'meta_title'       => fake()->sentence(),
            'meta_description' => fake()->text(120),
            'meta_keywords'    => fake()->words(5, true),
        ];
    }
}
