<?php

namespace Tests\Unit;

use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_can_be_created()
    {
//        $this->withoutExceptionHandling();
        $post = Post::factory()->create();

        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }

    public function test_posts_can_have_a_title()
    {
        $testTitle = 'testtitle';
        $post = Post::factory()->create(
            [
                'title' => $testTitle,
            ]
        );

        $this->assertDatabaseHas(
            'posts',
            [
                'title' => $post->title,
            ]
        );
    }

    public function test_posts_can_have_a_description()
    {
        $testDescription = 'testdescription';
        $post = Post::factory()->create(
            [
                'description' => $testDescription,
            ]
        );

        $this->assertDatabaseHas(
            'posts',
            [
                'description' => $post->description,
            ]
        );
    }

    public function test_posts_can_have_a_slug()
    {
        $testSlug = 'testslug';
        $post = Post::factory()->create(
            [
                'slug' => $testSlug,
            ]
        );

        $this->assertDatabaseHas(
            'posts',
            [
                'slug' => $post->slug,
            ]
        );
    }

    public function test_a_title_cannot_be_null()
    {
        $post = null;
        try {
            $post = Post::factory()->create(['title' => null]);
        } catch (Exception $e) {
        } finally {
            $this->assertNull($post);
        }
    }

    public function test_a_description_cannot_be_null()
    {
        $post = null;
        try {
            $post = Post::factory()->create(['description' => null]);
        } catch (Exception $e) {
        } finally {
            $this->assertNull($post);
        }
    }

    public function test_a_slug_must_be_unique()
    {
        $post1 = null;
        $post2 = null;
        try {
            $post1 = Post::factory()->create(['slug' => 'slug']);
            $post2 = Post::factory()->create(['slug' => 'slug']);
        } catch (Exception $e) {
        } finally {
            $this->assertNotNull($post1);
            $this->assertNull($post2);
            $this->assertDatabaseHas('posts', ['id' => $post1->id]);
        }
    }

    public function test_a_post_can_belong_to_a_user()
    {
        $user = User::factory()->create();
        $post = $user->posts()->create(Post::factory()->make()->toArray());

        $this->assertDatabaseHas('posts', ['id' => $post->id, 'user_id' => $user->id]);
        $this->assertNotNull($post->user);
        $this->assertNotNull($user->posts);
        $this->assertCount(1, $user->posts);
    }

    public function test_a_user_can_have_many_posts()
    {
        $user = User::factory()->create();
        $post1 = $user->posts()->create(Post::factory()->make()->toArray());
        $post2 = $user->posts()->create(Post::factory()->make()->toArray());

        $this->assertDatabaseHas('posts', ['id' => $post1->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('posts', ['id' => $post2->id, 'user_id' => $user->id]);
        $this->assertNotNull($post1->user);
        $this->assertNotNull($post2->user);
        $this->assertNotNull($user->posts);
        $this->assertCount(2, $user->posts);
    }

    public function test_a_user_id_can_be_null()
    {
        $post = Post::factory()->create(["user_id" => null]);
        $this->assertNotNull($post);
        $this->assertDatabaseHas('posts', ["id" => $post->id]);
        $this->assertNull($post->user_id);
    }

    public function test_a_post_can_belong_to_a_page()
    {
        $page = Page::factory()->create();
        $post = $page->posts()->create(Post::factory()->make()->toArray());

        $this->assertDatabaseHas('posts', ['id' => $post->id]);
        $this->assertDatabaseHas('pages', ['id' => $page->id]);
        $this->assertDatabaseHas('posts', ['page_id' => $post->page_id]);
        $this->assertNotNull($post->page);
        $this->assertNotNull($page->posts);
        $this->assertCount(1, $page->posts);
    }

    public function test_a_page_can_have_multiple_posts()
    {
        $page = Page::factory()->create();
        $post1 = $page->posts()->create(Post::factory()->make()->toArray());
        $post2 = $page->posts()->create(Post::factory()->make()->toArray());

        $this->assertDatabaseHas('posts', ['id' => $post1->id]);
        $this->assertDatabaseHas('posts', ['id' => $post2->id]);
        $this->assertDatabaseHas('pages', ['id' => $page->id]);
        $this->assertDatabaseHas('posts', ['page_id' => $post1->page_id]);
        $this->assertDatabaseHas('posts', ['page_id' => $post2->page_id]);
        $this->assertNotNull($post1->page);
        $this->assertNotNull($page->posts);
        $this->assertCount(2, $page->posts);
    }

    public function test_a_page_id_can_be_null()
    {
        $post = Post::factory()->create(["page_id" => null]);
        $this->assertNotNull($post);
        $this->assertDatabaseHas('posts', ["id" => $post->id]);
        $this->assertNull($post->page_id);
    }
}
