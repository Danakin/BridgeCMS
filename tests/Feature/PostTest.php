<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function test_a_post_page_can_be_accessed()
    {
        $this->withoutExceptionHandling();

        $page = Page::factory()->create();
        $post = Post::factory()->create(['page_id' => $page->id]);

        $response = $this->get(route('pages.posts.show', [$page, $post]));

        $response->assertStatus(200);
        $response->assertSee(ucwords($post->title));
        $response->assertSee("Back to " . ucwords($page->title));
        $response->assertViewHas("page");
        $response->assertViewHas("post");
    }
}
