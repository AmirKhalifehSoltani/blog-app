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
        $article_data = [
            'title'              => fake()->realText(50),
            'content'            => fake()->realText(1000),
            'publication_status' => fake()->randomElement(['draft', 'published']),
        ];

        if ($article_data['publication_status'] === 'published') {
            $article_data['published_at'] = fake()->dateTimeBetween('-1 year');
        }

        return $article_data;
    }
}
