<?php
/**
 * Author: Seyed Amir Khalifeh Soltani
 * Contact-Author: https://www.linkedin.com/in/amir-khalifehsoltani/
 * Time: 2/10/24 - 9:53 PM
 */

namespace App\Service\Client;

use App\Enums\PublicationStatus;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class ArticleService
{
    public function getArticlesByCurrentClient(string $client_id): Collection|array
    {
        return Article::query()
            ->where(function ($query) use ($client_id) {
                $query->where('author_id', $client_id)
                    ->orWhere('publication_status', PublicationStatus::PUBLISHED->value);
            })
            ->with('author')
            ->get();
    }

    public function store(array $articleData, string $client_id): Article
    {
        $articleData['author_id'] = $client_id;
        $articleData['publication_status'] = PublicationStatus::DRAFT->value;
        return Article::create($articleData);
    }

    public function update(Article $article, array $articleData): Article
    {
        $article->update($articleData);
        return $article;
    }

    public function userCanEditArticle(Article $article, string $client_id): bool
    {
        return ($article->author_id === $client_id);
    }

    public function userCanSeeArticle(Article $article, string $client_id): bool
    {
        return ($article->author_id === $client_id || $article->publication_status === PublicationStatus::PUBLISHED->value);
    }
}