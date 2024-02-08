<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'              => fake()->title(),
            'content'            => fake()->text(),
            'publication_status' => fake()->randomElement(['draft', 'published']),
            'published_at'       => fake()->dateTimeBetween('-1 year'),
        ];
    }
}
