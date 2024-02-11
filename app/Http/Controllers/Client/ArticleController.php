<?php

namespace App\Http\Controllers\Client;

use App\Enums\PublicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $articles = Article::query()
            ->where(function ($query) {
                $query->where('author_id', auth()->id())
                    ->orWhere('publication_status', PublicationStatus::PUBLISHED->value);
            })
            ->with('author')
            ->get();
        return view('client.article.index', compact(['articles']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('client.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $article_data = $request->only(['title', 'content']);
        $article_data['author_id'] = auth()->id();
        $article = Article::query()->create($article_data);
        return redirect()->route('articles.show', compact(['article']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        if ($article->author_id !== auth()->id() && $article->publication_status !== PublicationStatus::PUBLISHED->value) {
            return back()->withErrors(['error' => 'Access Forbidden']);
        }
        return view('client.article.show', compact(['article']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): \Illuminate\Contracts\Foundation\Application|Factory|View|Application|RedirectResponse
    {
        if ($article->author_id !== auth()->id()) {
            return back()->withErrors(['error' => 'Access Forbidden']);
        }
        return view('client.article.edit', compact(['article']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        if ($article->author_id !== auth()->id()) {
            return back()->withErrors(['error' => 'Access Forbidden']);
        }

        $article->update($request->only(['title', 'content']));
        return redirect()->route('articles.show', compact(['article']));
    }
}
