<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Service\Admin\ArticleService;
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
        $articles = $this->articleService->getAllArticles();
        return view('admin.article.index', compact('articles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.article.show', compact(['article']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $this->articleService->delete($article);
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully!');
    }

    public function publish(Article $article): RedirectResponse
    {
        $this->articleService->publish($article);
        return redirect()->route('admin.articles.index')->with('success', 'Article published successfully!');
    }

    public function trash_list(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $articles = $this->articleService->getTrashedArticles();
        return view('admin.article.trash_list', compact('articles'));
    }

    public function restore(Article $article): RedirectResponse
    {
        $this->articleService->restore($article);
        return redirect()->route('admin.articles.index')->with('success', 'Article restored successfully!');
    }
}
