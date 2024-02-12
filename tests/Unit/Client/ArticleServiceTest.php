<?php

namespace Tests\Unit\Client;

use App\Enums\PublicationStatus;
use App\Models\Article;
use App\Models\Client;
use App\Service\Client\ArticleService;
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
     * @group ClientArticleService
     * @return void
     */
    public function clientCanGetAllOwnedArticles()
    {
        $client = Client::factory()->create();

        // Create articles for client
        $publishedArticle = Article::factory()->create(['author_id' => $client->id, 'publication_status' => PublicationStatus::PUBLISHED->value]);
        $unpublishedArticle = Article::factory()->create(['author_id' => $client->id, 'publication_status' => PublicationStatus::DRAFT->value]);

        $articles = $this->articleService->getArticlesByCurrentClient($client->id);

        $this->assertCount(2, $articles);
        $this->assertTrue($articles->contains($publishedArticle));
        $this->assertTrue($articles->contains($unpublishedArticle));
    }

    /**
     * @test
     * @group ClientArticleService
     * @return void
     */
    public function clientCanGetAllPublishedArticles()
    {
        $client1 = Client::factory()->create();
        $client2 = Client::factory()->create();

        // Create articles for client
        $owned_publishedArticle = Article::factory()->create(['author_id' => $client1->id, 'publication_status' => PublicationStatus::PUBLISHED->value]);
        // create articles for another client
        $publishedArticle = Article::factory()->create(['author_id' => $client2->id, 'publication_status' => PublicationStatus::PUBLISHED->value]);

        $articles = $this->articleService->getArticlesByCurrentClient($client1);
        $this->assertCount(2, $articles);
        $this->assertTrue($articles->contains($publishedArticle));
        $this->assertTrue($articles->contains($owned_publishedArticle));
    }

    /**
     * @test
     * @group ClientArticleService
     * @return void
     */
    public function clientCanNotSeeOtherClientsDraftArticles()
    {
        $client1 = Client::factory()->create();
        $client2 = Client::factory()->create();

        // create articles for another client
        Article::factory()->create(['author_id' => $client2->id, 'publication_status' => PublicationStatus::DRAFT->value]);

        $articles = $this->articleService->getArticlesByCurrentClient($client1);
        $this->assertCount(0, $articles);
    }

    /**
     * @test
     * @group ClientArticleService
     * @return void
     */
    public function StoreArticle()
    {
        $client = Client::factory()->create();
        $articleData = ['title'   => 'Test Article', 'content' => 'Lorem ipsum ...'];
        $article = $this->articleService->store($articleData, $client->id);

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals($client->id, $article->author_id);
        $this->assertEquals($articleData['title'], $article->title);
        $this->assertEquals($articleData['content'], $article->content);
        $this->assertEquals(PublicationStatus::DRAFT->value, $article->publication_status);
        $this->assertNull($article->published_at);
    }

    /**
     * @test
     * @group ClientArticleService
     * @return void
     */
    public function UpdateArticle()
    {
        $client = Client::factory()->create();
        $article = Article::factory()->create(['title'     => 'Old Title', 'content'   => 'Old Content', 'author_id' => $client->id]);
        $newArticleData = ['title'   => 'New Title', 'content' => 'New Content'];
        $updatedArticle = $this->articleService->update($article, $newArticleData);

        $this->assertSame($article, $updatedArticle);
        $article->refresh();
        $this->assertEquals($newArticleData['title'], $article->title);
        $this->assertEquals($newArticleData['content'], $article->content);
    }

    /**
     * @test
     * @group ClientArticleService
     * @return void
     */
    public function UserCanEditArticleWhenAuthorIsClient()
    {
        $article = new Article();
        $article->author_id = '123';
        $canEdit = $this->articleService->userCanEditArticle($article, '123');
        $this->assertTrue($canEdit);
    }

    /**
     * @test
     * @group ClientArticleService
     * @return void
     */
    public function UserCannotEditArticleWhenAuthorIsNotClient()
    {
        $article = new Article();
        $article->author_id = '456';
        $canEdit = $this->articleService->userCanEditArticle($article, '123');
        $this->assertFalse($canEdit);
    }

}
