<?php

namespace Tests\Unit;

use App\Models\Page;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_page_can_be_created()
    {
//        $this->withoutExceptionHandling();
        $page = Page::factory()->create();

        $this->assertDatabaseHas(
            'pages',
            [
                'id' => $page->id,
                'title' => $page->title,
                'slug' => $page->slug,
                'description' => $page->description,
            ]
        );
    }

    public function test_a_page_can_have_a_title()
    {
        $title = "testtitle";
        $page = Page::factory()->create(["title" => $title]);

        $this->assertDatabaseHas('pages', ["title" => $title]);
    }

    public function test_a_page_can_have_a_description()
    {
        $description = "testdescription";
        $page = Page::factory()->create(["description" => $description]);

        $this->assertDatabaseHas('pages', ["description" => $description]);
    }

    public function test_a_page_can_have_a_slug()
    {
        $slug = "testslug";
        $page = Page::factory()->create(["slug" => $slug]);

        $this->assertDatabaseHas('pages', ["slug" => $slug]);
    }

    public function test_a_title_cannot_be_null()
    {
        $page = null;
        try {
            $page = Page::factory()->create(["title" => null]);
        } catch (\Exception $e) {
        } finally {
            $this->assertNull($page);
            $this->assertDatabaseMissing('pages', ["title" => null]);
        }
    }

    public function test_a_description_cannot_be_null()
    {
        $page = null;

        try {
            $page = Page::factory()->create(["description" => null]);
        } catch (\Exception $e) {
        } finally {
            $this->assertNull($page);
        }
    }

    public function test_a_slug_cannot_be_null()
    {
        $page = null;

        try {
            $page = Page::factory()->create(["slug" => null]);
        } catch (\Exception $e) {
        } finally {
            $this->assertNull($page);
            $this->assertDatabaseMissing('pages', ["slug" => null]);
        }
    }

    public function test_a_title_must_be_unique()
    {
        $page1 = Page::factory()->create();
        $page2 = null;
        try {
            $page2 = Page::factory()->create(["title" => $page1->title]);
        } catch (\Exception $e) {
        } finally {
            $this->assertDatabaseHas('pages', ["title" => $page1->title]);
            $this->assertDatabaseHas('pages', ["id" => $page1->id]);
            $this->assertCount(1, Page::where("title", $page1->title)->get());
            $this->assertNull($page2);
        }
    }

    public function test_a_slug_must_be_unique()
    {
        $page1 = Page::factory()->create();
        $page2 = null;
        try {
            $page2 = Page::factory()->create(["slug" => $page1->slug]);
        } catch (\Exception $e) {
        } finally {
            $this->assertDatabaseHas('pages', ["slug" => $page1->slug]);
            $this->assertDatabaseHas('pages', ["id" => $page1->id]);
            $this->assertCount(1, Page::where("slug", $page1->slug)->get());
            $this->assertNull($page2);
        }
    }

    public function test_a_page_can_belong_to_a_user()
    {
        $user = User::factory()->create();
        $page = $user->pages()->create(Page::factory()->make()->toArray());

        $this->assertDatabaseHas('pages', ['user_id' => $user->id]);
        $this->assertDatabaseHas('pages', ['id' => $page->id]);
        $this->assertNotNull($user->pages);
        $this->assertNotNull($page->user);
        $this->assertCount(1, $user->pages);
    }

    public function test_a_user_can_have_many_pages()
    {
        $user = User::factory()->create();
        $page1 = $user->pages()->create(Page::factory()->make()->toArray());
        $page2 = $user->pages()->create(Page::factory()->make()->toArray());

        $this->assertDatabaseHas('pages', ['id' => $page1->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('pages', ['id' => $page2->id, 'user_id' => $user->id]);
        $this->assertNotNull($page1->user);
        $this->assertNotNull($page2->user);
        $this->assertNotNull($user->pages);
        $this->assertCount(2, $user->pages);
    }

    public function test_a_user_id_can_be_null()
    {
        $page = Page::factory()->create(["user_id" => null]);
        $this->assertNotNull($page);
        $this->assertDatabaseHas('pages', ["id" => $page->id]);
        $this->assertNull($page->user_id);
    }

    public function test_creating_a_page_creates_permissions()
    {
        $pageTitle = 'permission';
        $page = Page::factory()->create(['title' => $pageTitle]);
        $role = Role::factory()->create(['title' => 'PageEditor']);
        $page->roles()->sync($role->id);
        $this->assertDatabaseHas('page_role', ['page_id' => $page->id, 'role_id' => $role->id]);
        $this->assertCount(1, $page->roles);

        $random_permission = Permission::factory()->create(['title' => 'rnd']);
        $permissions = Permission::where('title', 'like', '%' . $page->title)->pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        $role->permissions()->attach($random_permission->id);
        $this->assertCount(4, $role->permissions);
        $this->assertDatabaseHas('permissions', ['title' => 'create-page-' . $pageTitle]);
        $this->assertDatabaseHas('permissions', ['title' => 'update-page-' . $pageTitle]);
        $this->assertDatabaseHas('permissions', ['title' => 'delete-page-' . $pageTitle]);

        $this->assertCount(3, $page->permissions);
    }

    public function test_renaming_a_page_renames_permissions()
    {
        $pageName = 'rename';
        $page = Page::factory()->create(['title' => $pageName]);
        $role = Role::factory()->create(['title' => 'PageEditor']);
        $page->roles()->sync($role->id);
        $permissions = Permission::where('title', 'like', '%' . $page->title)->pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        $this->assertDatabaseHas('permissions', ['title' => 'create-page-' . $pageName]);
        $this->assertDatabaseHas('permissions', ['title' => 'update-page-' . $pageName]);
        $this->assertDatabaseHas('permissions', ['title' => 'delete-page-' . $pageName]);
        $this->assertCount(3, $page->permissions);

        $newPageName = 'newTitle';
        $page->title = $newPageName;
        $page->save();
        $this->assertDatabaseHas('pages', ['title' => $newPageName]);
        $this->assertDatabaseHas('permissions', ['title' => 'create-page-' . $newPageName]);
        $this->assertDatabaseHas('permissions', ['title' => 'update-page-' . $newPageName]);
        $this->assertDatabaseHas('permissions', ['title' => 'delete-page-' . $newPageName]);
    }

    public function test_deleting_a_page_also_deletes_permissions()
    {
        $pageName = 'destroy';
        $page = Page::factory()->create(['title' => $pageName]);
        $role = Role::factory()->create(['title' => 'PageEditor']);
        $page->roles()->sync($role->id);
        $permissions = Permission::where('title', 'like', '%' . $page->title)->pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        $this->assertDatabaseHas('permissions', ['title' => 'create-page-' . $pageName]);
        $this->assertDatabaseHas('permissions', ['title' => 'update-page-' . $pageName]);
        $this->assertDatabaseHas('permissions', ['title' => 'delete-page-' . $pageName]);
        $this->assertCount(3, $page->permissions);

        $page->delete();
        $this->assertDatabaseMissing('pages', ['title' => $pageName]);
        $this->assertDatabaseMissing('permissions', ['title' => 'create-page-' . $pageName]);
        $this->assertDatabaseMissing('permissions', ['title' => 'update-page-' . $pageName]);
        $this->assertDatabaseMissing('permissions', ['title' => 'delete-page-' . $pageName]);
    }

    public function test_can_have_post_field_can_be_set()
    {
        $page1 = Page::factory()->create(["can_have_posts" => false]);
        $page2 = Page::factory()->create(["can_have_posts" => true]);

        $this->assertDatabaseHas('pages', ["id" => $page1->id, "can_have_posts" => false]);
        $this->assertDatabaseHas('pages', ["id" => $page2->id, "can_have_posts" => true]);
    }

    public function test_the_content_field_can_be_null()
    {
        $page = Page::factory()->create(["content" => null]);
        $this->assertDatabaseHas('pages', ["id" => $page->id, "content" => null]);
    }

    public function test_the_content_field_can_be_set()
    {
        $page = Page::factory()->create(["content" => "fixed content"]);
        $this->assertDatabaseHas('pages', ["id" => $page->id, "content" => "fixed content"]);
    }
}
