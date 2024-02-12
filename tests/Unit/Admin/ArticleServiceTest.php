<?php

namespace Tests\Unit\Admin;

use App\Enums\PublicationStatus;
use App\Models\Article;
use App\Models\Client;
use App\Service\Admin\ArticleService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ArticleServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected ArticleService $articleService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->articleService = new ArticleService();
        Article::truncate();
    }

    /**
     * @test
     * @group AdminArticleService
     * @return void
     */
    public function getAllArticles(): void
    {
        $client = Client::factory()->create();
        $client2 = Client::factory()->create();
        $article1 = Article::factory()->create(['author_id' => $client->id, 'publication_status' => PublicationStatus::PUBLISHED->value]);
        $article2 = Article::factory()->create(['author_id' => $client->id, 'publication_status' => PublicationStatus::DRAFT->value]);
        $article3 = Article::factory()->create(['author_id' => $client2->id, 'publication_status' => PublicationStatus::DRAFT->value]);

        $articles = $this->articleService->getAllArticles();

        $this->assertCount(3, $articles);
        $this->assertTrue($articles->contains($article1));
        $this->assertTrue($articles->contains($article2));
        $this->assertTrue($articles->contains($article3));
    }

    /**
     * @test
     * @group AdminArticleService
     * @return void
     */
    public function deleteArticle(): void
    {
        $client = Client::factory()->create();
        $article = Article::factory()->create(['author_id' => $client->id]);
        $this->articleService->delete($article);
        $articles = Article::get();
        $this->assertCount(0, $articles);
        // assert soft deleted
        $articles_with_trashed = Article::onlyTrashed()->get();
        $this->assertCount(1, $articles_with_trashed);
    }

    /**
     * @test
     * @group AdminArticleService
     * @return void
     */
    public function PublishArticle()
    {
        $client = Client::factory()->create();
        $article = Article::factory()->create(['publication_status' => PublicationStatus::DRAFT->value, 'author_id' => $client->id]);
        $this->articleService->publish($article);
        $article->refresh();
        $this->assertEquals(PublicationStatus::PUBLISHED->value, $article->publication_status);
    }

    /**
     * @test
     * @group AdminArticleService
     * @return void
     */
    public function getTrashedArticles()
    {
        $client = Client::factory()->create();
        Article::factory()->create(['author_id' => $client->id, 'deleted_at' => now()->subMinute()]);
        $trashed_articles = $this->articleService->getTrashedArticles();
        $this->assertCount(1, $trashed_articles);
    }

    /**
     * @test
     * @group AdminArticleService
     * @return void
     */
    public function restoreArticle()
    {
        $client = Client::factory()->create();
        $article =Article::factory()->create(['author_id' => $client->id, 'deleted_at' => now()->subMinute()]);
        $this->articleService->restore($article);

        $articles = Article::get();
        $this->assertCount(1, $articles);
        $trashed_articles = Article::onlyTrashed()->get();
        $this->assertCount(0, $trashed_articles);
    }
}
