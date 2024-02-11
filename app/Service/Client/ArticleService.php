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
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function getArticlesByCurrentUser(): Collection|array
    {
        return Article::query()
            ->where(function ($query) {
                $query->where('author_id', Auth::id())
                    ->orWhere('publication_status', PublicationStatus::PUBLISHED->value);
            })
            ->with('author')
            ->get();
    }

    public function store(array $articleData): Article
    {
        $articleData['author_id'] = Auth::id();
        return Article::create($articleData);
    }

    public function show(Article $article): Article|RedirectResponse
    {
        if ($article->author_id !== Auth::id() && $article->publication_status !== PublicationStatus::PUBLISHED->value) {
            return redirect()->back()->withErrors(['error' => 'Access Forbidden']);
        }
        return $article;
    }

    public function edit(Article $article): Article|RedirectResponse
    {
        if ($article->author_id !== Auth::id()) {
            return redirect()->back()->withErrors(['error' => 'Access Forbidden']);
        }
        return $article;
    }

    public function update(Article $article, array $articleData): Article|RedirectResponse
    {
        if ($article->author_id !== Auth::id()) {
            return back()->withErrors(['error' => 'Access Forbidden']);
        }
        $article->update($articleData);
        return $article;
    }
}