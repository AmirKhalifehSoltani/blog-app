<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $articles = Article::with('author')->get();
        return view('admin.article.index', compact(['articles']));
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
        $article->delete();
        return redirect()->route('admin.articles.index');
    }

    public function publish(Article $article): RedirectResponse
    {
        $article->update(['publication_status'=> 'published', 'published_at' => now()]);
        return redirect()->route('admin.articles.index');
    }

    public function trash_list(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $articles = Article::query()->with('author')->onlyTrashed()->get();
        return view('admin.article.trash_list', compact(['articles']));
    }

    public function restore(Article $article): RedirectResponse
    {
        $article->restore();
        return redirect()->route('admin.articles.index');
    }
}
