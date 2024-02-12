<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Article\StoreArticleRequest;
use App\Http\Requests\Client\Article\UpdateArticleRequest;
use App\Models\Article;
use App\Service\Client\ArticleService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{

    public function __construct(protected ArticleService $articleService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $articles = $this->articleService->getArticlesByCurrentClient(auth()->id());
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
        $articleData = $request->only(['title', 'content']);
        $article = $this->articleService->store($articleData, auth()->id());
        return redirect()->route('articles.show', compact('article'))->with('success', 'Article saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        if (!$this->articleService->userCanSeeArticle($article, auth()->id())) {
            return back()->withErrors(['error' => 'Access Forbidden!']);
        }
        return view('client.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): \Illuminate\Contracts\Foundation\Application|Factory|View|Application|RedirectResponse
    {
        if (!$this->articleService->userCanEditArticle($article, auth()->id())) {
            return back()->withErrors(['error' => 'Access Forbidden!']);
        }
        return view('client.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        if (!$this->articleService->userCanEditArticle($article, auth()->id())) {
            return back()->withErrors(['error' => 'Access Forbidden!']);
        }
        $article = $this->articleService->update($article, $request->only(['title', 'content']));
        return redirect()->route('articles.show', compact('article'))->with('success', 'Article updated successfully!');
    }
}
