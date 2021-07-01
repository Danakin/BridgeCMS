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
    <x-admin.form.input name="title">Title</x-admin.form.input>
    <x-admin.form.input name="slug">Slug</x-admin.form.input>
    <x-admin.form.input name="canHavePosts" type="checkbox">{{ $canHavePosts }}Page can have Posts</x-admin.form.input>

    <x-admin.form.textarea name="description">Description</x-admin.form.textarea>
    <x-admin.form.textarea name="content" class="flex-1">Content</x-admin.form.textarea>

</section>
