<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_page_can_be_displayed()
    {
        $page = Page::factory()->has(Post::factory()->count(10))->create();

        $response = $this->get(route('pages.show', $page));
        $response->assertStatus(200);
        $response->assertSee(ucwords($page->title));
        foreach ($page->posts as $post) {
            $response->assertSee($post->title);
        }
        $response->assertViewHas('page');
        $response->assertViewHas('posts');
    }
}
