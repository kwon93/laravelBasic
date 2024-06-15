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

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;   

    public function test_댓글을_작성_할_수_있다(): void
    {
        $user = User::factory()->create();

        $article = Article::factory()->create();

        $this->actingAs($user)
        ->post(route('comments.store'), ['article_id' => $article->id, 'body => hello'])
        ->assertStatus(302);
    }

}
