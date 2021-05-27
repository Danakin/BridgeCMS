<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
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

    public function test_a_title_can_not_be_null()
    {
        $post = null;
        try {
            $post = Post::factory()->create(['title' => null]);
        } catch (\Exception $e) {
        } finally {
            $this->assertNull($post);
        }
    }

    public function test_a_description_can_not_be_null()
    {
        $post = null;
        try {
            $post = Post::factory()->create(['description' => null]);
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
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

        $this->assertDatabaseHas('posts', ['id' => $post->id, 'user_id' => 1]);
        $this->assertNotNull($post->user);
        $this->assertNotNull($user->posts);
    }


}
