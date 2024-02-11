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
    public function getArticlesByCurrentUser(): Collection|array
    {
        return Article::query()
            ->where(function ($query) {
                $query->where('author_id', auth()->id())
                    ->orWhere('publication_status', PublicationStatus::PUBLISHED->value);
            })
            ->with('author')
            ->get();
    }

    public function store(array $articleData): Article
    {
        $articleData['author_id'] = auth()->id();
        return Article::create($articleData);
    }

    public function update(Article $article, array $articleData): Article
    {
        $article->update($articleData);
        return $article;
    }

    public function userCanEditArticle(Article $article): bool
    {
        return ($article->author_id === auth()->id());
    }

    public function userCanSeeArticle(Article $article): bool
    {
        return ($article->author_id === auth()->id() || $article->publication_status === PublicationStatus::PUBLISHED->value);
    }
}