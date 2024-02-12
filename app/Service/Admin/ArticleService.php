<?php
/**
 * Author: Seyed Amir Khalifeh Soltani
 * Contact-Author: https://www.linkedin.com/in/amir-khalifehsoltani/
 * Time: 2/10/24 - 9:53 PM
 */

namespace App\Service\Admin;

use App\Enums\PublicationStatus;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class ArticleService
{
    public function getAllArticles(): Collection|array
    {
        return Article::with('author')->get();
    }

    public function delete(Article $article): void
    {
        $article->delete();
    }

    public function publish(Article $article): void
    {
        $article->update(['publication_status' => PublicationStatus::PUBLISHED->value, 'published_at' => now()]);
    }

    public function getTrashedArticles()
    {
        return Article::with('author')->onlyTrashed()->get();
    }

    public function restore(Article $article): void
    {
        $article->restore();
    }
}