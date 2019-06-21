<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_valid_post_is_being_saved()
    {
        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();
        $category = factory(\App\PostCategory::class)->create();
        $this->actingAs($user);

        $data = [
            'title' => 'lorem',
            'body' => 'ipsum',
            'category_id' => $category->id,
            'attachment' => UploadedFile::fake()->image('random.jpg'),
        ];

        $response = $this->json('post', route('posts.store'), $data);

        $response->assertStatus(201);

        $response->assertJson(\App\Post::first()->toArray());

        $data['user_id'] = $user->id;

        unset($data['attachment']);

        $this->assertDatabaseHas('posts', $data);
    }

    /** @test */
    public function a_post_attachment_is_being_storaged()
    {
        $this->withoutExceptionHandling();

        \Storage::fake('attachments');

        $user = factory(\App\User::class)->create();
        $category = factory(\App\PostCategory::class)->create();

        $this->actingAs($user);

        $file = UploadedFile::fake()->image('random.jpg');

        $data = [
            'title' => 'lorem',
            'body' => 'ipsum',
            'category_id' => $category->id,
            'attachment' => $file,
        ];

        $response = $this->json('post', route('posts.store'), $data);

        $filename = \App\Post::first()->id . '-' . $file->getClientOriginalName();

        \Storage::disk('attachments')->assertExists($filename);
    }

    /** @test */
    public function a_post_without_title_is_not_being_saved()
    {
        \Storage::fake('attachments');

        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $file = UploadedFile::fake()->image('random.jpg');

        $data = [
            'title' => '',
            'body' => 'ipsum',
            'category_id' => 2,
            'attachment' => $file,
        ];

        $response = $this->json('post', route('posts.store'), $data);

        $response->assertStatus(422)->assertSee('title field is required');

    }

    /** @test */
    public function a_post_without_body_is_not_being_saved()
    {
        \Storage::fake('attachments');

        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $file = UploadedFile::fake()->image('random.jpg');

        $data = [
            'title' => 'lorem',
            'body' => '',
            'category_id' => 2,
            'attachment' => $file,
        ];

        $response = $this->json('post', route('posts.store'), $data);

        $response->assertStatus(422)->assertSee('body field is required');

    }

    /** @test */
    public function a_post_without_category_is_not_being_saved()
    {
        \Storage::fake('attachments');

        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $file = UploadedFile::fake()->image('random.jpg');

        $data = [
            'title' => 'lorem',
            'body' => 'ipsum',
            'category_id' => '',
            'attachment' => $file,
        ];

        $response = $this->json('post', route('posts.store'), $data);

        $response->assertStatus(422)->assertSee('category id field is required');

    }

    /** @test */
    public function a_post_without_attachment_is_not_being_saved()
    {
        \Storage::fake('attachments');

        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $file = UploadedFile::fake()->image('random.jpg');

        $data = [
            'title' => 'lorem',
            'body' => 'ipsum',
            'category_id' => 1,
            'attachment' => '',
        ];

        $response = $this->json('post', route('posts.store'), $data);

        $response->assertStatus(422)->assertSee('attachment field is required');

    }
}
