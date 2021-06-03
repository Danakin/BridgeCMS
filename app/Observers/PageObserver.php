<?php

namespace App\Observers;

use App\Models\Page;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function created(Page $page)
    {
        $title = Str::slug($page->title);
        Permission::create(['title' => 'create-page-' . $title]);
        Permission::create(['title' => 'update-page-' . $title]);
        Permission::create(['title' => 'delete-page-' . $title]);
    }

    public function updating(Page $page)
    {
        $oldTitle = $page->getOriginal('title');
        echo DB::transaction(
            function () use ($page, $oldTitle) {
                try {
                    $permissions = Permission::where('title', 'like', '%-page-' . $oldTitle)->get();
                    foreach ($permissions as $permission) {
                         $permission->title = str_replace($oldTitle, Str::slug($page->title), $permission->title);
                         $permission->save();
                    }
                } catch(\Exception $e) {
                    Log::error($e->getMessage());
                }
            });
    }

    /**
     * Handle the Page "updated" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function updated(Page $page)
    {
        //
    }

    /**
     * Handle the Page "deleted" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function deleted(Page $page)
    {
        echo DB::transaction(
            function () use ($page) {
                try {
                    $permissions = Permission::where('title', 'like', '%-page-' . $page->title)->get();
                    foreach ($permissions as $permission) {
                        $permission->delete();
                    }
                } catch(\Exception $e) {
                    Log::error($e->getMessage());
                }
            });
    }

    /**
     * Handle the Page "restored" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function restored(Page $page)
    {
        //
    }

    /**
     * Handle the Page "force deleted" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        //
    }
}
