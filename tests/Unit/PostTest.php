<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_posts_can_be_seen()
    {
//        $this->withoutExceptionHandling();
        Post::create();

        $posts = Post::all();
        $this->assertDatabaseHas('posts', ['id' => 1]);
    }

    public function test_posts_can_have_a_title()
    {
        $testTitle = 'testtitle';
        Post::factory()->create(
            [
                'title' => $testTitle,
            ]
        );

        $this->assertDatabaseHas(
            'posts',
            [
                'title' => $testTitle,
            ]
        );
    }

    public function test_posts_can_have_a_description()
    {
        $testDescription = 'testdescription';
        Post::factory()->create(
            [
                'description' => $testDescription,
            ]
        );

        $this->assertDatabaseHas(
            'posts',
            [
                'description' => $testDescription,
            ]
        );
    }

    public function test_posts_can_have_a_slug()
    {
        $testSlug = 'testslug';
        Post::factory()->create(
            [
                'slug' => $testSlug,
            ]
        );

        $this->assertDatabaseHas(
            'posts',
            [
                'slug' => $testSlug,
            ]
        );
    }

    public function test_a_title_can_not_be_null()
    {
        try {
            Post::factory()->create(['title' => null]);
        } catch (\Exception $e) {

        } finally {
            $this->assertDatabaseMissing('posts', ['id' => 1]);
        }
    }

    public function test_a_description_can_not_be_null()
    {
        try {
            Post::factory()->create(['description' => null]);
        } catch (\Exception $e) {

        } finally {
            $this->assertDatabaseMissing('posts', ['id' => 1]);
        }
    }

    public function test_a_slug_must_be_unique()
    {
        try {
            Post::factory()->create(['slug' => 'slug']);
            Post::factory()->create(['slug' => 'slug']);
        } catch (\Exception $e) {

        } finally {
            $this->assertDatabaseMissing('posts', ['id' => 2]);
        }
    }


}
