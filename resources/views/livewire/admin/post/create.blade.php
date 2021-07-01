<div class="border-gray-600 bg-white rounded m-4 p-4">
    <section class="flex flex-col w-full">
        @if(session()->has('success'))
            <div x-data="{open: true}"
                 x-ref="el"
                 x-show="open"
                 x-transition
                 @click="open=false"
                 {{--             @click="$el.remove()"--}}
                 class="absolute top-14 left-16 right-16 p-2 border-l-4 border-green-700 bg-green-300">
                {{ session('success') }}
            </div>
        @endif
        <article class="flex justify-end">
            <button wire:click="resetPage" class="py-2 px-4 rounded bg-red-700 text-white mr-4">Reset</button>
            <button wire:click="submit" class="py-2 px-4 rounded bg-green-700 text-white">Save</button>
        </article>
        <article class="flex flex-wrap">
            <div class="flex my-1 items-center w-1/5">Title</div>
            <div class="flex my-1 items-center w-4/5">
                <input wire:model="title"
                       type="text"
                       id="title"
                       name="title"
                       class="w-full rounded shadow-sm border-gray-200">
            </div>
            @error('title')
            <div class="w-full m-4 p-2 border-l-4 border-red-700 bg-red-300">{{ $message }}</div>
            @enderror
        </article>
        <article class="flex">
            <div class="flex my-1 items-center w-1/5">Slug</div>
            <div class="flex my-1 items-center w-4/5">
                <input wire:model="slug"
                       type="text"
                       id="slug"
                       name="slug"
                       class="w-full rounded shadow-sm border-gray-200">
            </div>
        </article>
        <article class="flex">
            <div class="flex my-1 items-center w-1/5">Page can have posts</div>
            <div class="flex my-1 items-center w-4/5">
                <input wire:model="canHavePosts"
                       type="checkbox"
                       id="canHavePosts"
                       name="canHavePosts">
            </div>
        </article>
        <article class="flex">
            <div class="flex my-1 items-center w-1/5">Description</div>
            <div class="flex my-1 items-center w-4/5">
            <textarea wire:model="description"
                      type="text"
                      id="description"
                      name="description"
                      class="w-full rounded shadow-sm border-gray-200 resize-none"></textarea>
            </div>
        </article>
        <article class="flex flex-1">
            <div class="flex my-1 items-center w-1/5">Content</div>
            <div class="flex my-1 items-center w-4/5">
            <textarea wire:model="content"
                      type="text"
                      id="content"
                      name="content"
                      class="w-full rounded shadow-sm border-gray-200 h-full"
                      rows="10"></textarea>
            </div>
        </article>
    </section>
</div>
