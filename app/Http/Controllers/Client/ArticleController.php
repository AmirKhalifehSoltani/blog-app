<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreArticleRequest;
use App\Models\Article;
use App\Service\Client\ArticleService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct(protected ArticleService $articleService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $articles = $this->articleService->getArticlesByCurrentUser();
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
        $article = $this->articleService->store($articleData);
        return redirect()->route('articles.show', compact('article'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $article = $this->articleService->show($article);
        if ($article instanceof RedirectResponse) {
            return $article;
        }
        return view('client.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): \Illuminate\Contracts\Foundation\Application|Factory|View|Application|RedirectResponse
    {
        $article = $this->articleService->edit($article);
        if ($article instanceof RedirectResponse) {
            return $article;
        }
        return view('client.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $this->articleService->update($article, $request->only(['title', 'content']));
        return redirect()->route('articles.show', compact('article'));
    }
}
