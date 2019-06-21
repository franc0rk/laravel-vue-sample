<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsListTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function posts_list_is_being_returned_as_json()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $categories = factory(\App\PostCategory::class, 2)->create();

        $posts = factory(\App\Post::class, 2)->create([
            'category_id' => $categories->first()->id,
            'user_id' => $user->id,
        ]);

        $response = $this->json('get', route('posts.index'));

        $response->assertJson($posts->toArray());
    }
}
