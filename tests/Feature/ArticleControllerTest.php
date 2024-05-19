<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use function PHPSTORM_META\map;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;   

    public function test_createViewReturn200StatusCode(): void
    {
        $response = $this->get(route('articles.create'));
        $response->assertStatus(200)
        ->assertSee('글을 써봅시다.');
    }

    public function test_글_작성에_성공해야한다(): void
    {
        $testData = [
            'body' => 'test aritlce'
        ];

        $user = User::factory()->create();

        $this->actingAs($user)
        ->post(route('articles.store'), $testData)
        ->assertRedirect(route('articles.index'));

        $this->assertDatabaseHas('articles', $testData);
    }

    public function test_글목록이_최신일자로_정렬되어야한다(): void
    {
        $articles = collect(range(1,3))->map(function(){
            return Article::factory()->create();
        })->all();

        $this->get(route('articles.index'))
        ->assertSeeInOrder([
            $articles[0]->body,
            $articles[1]->body
        ]);
    }

    public function test_개별_글을_조회_할_수_있다(): void
    {
        $article = Article::factory()->create();
        
        $this->get(route('articles.show', [
            'article' => $article->id
        ]))
        ->assertSuccessful()
        ->assertSee($article->body);
    }

    public function test_글_수정_화면을_볼_수_있다(): void
    {
        $article = Article::factory()->create();
        $response = $this->get(route('articles.edit', [
            'article' => $article->id
        ]));
        $response->assertStatus(200)
        ->assertSee('글을 수정해봅시다.');
    }

    public function test_글_수정에_성공해야한다(): void
    {
        $payload = ['body' => '수정된 글'];
        $article = Article::factory()->create();

        $this->put(route('articles.update', ['article' => $article->id]), $payload)
        ->assertRedirect(route('articles.show', ['article' => $article->id]));

        $this->assertDatabaseHas('articles', $payload);
    }

    public function test_글을_삭제_할_수_있다(): void
    {
        $article = Article::factory()->create();

        $this->delete(route('articles.delete', ['article' => $article->id]))
        ->assertRedirect(route('articles.index'));
        $this->assertDatabaseMissing('articles', ['id'=>$article->id]);
    }
}
