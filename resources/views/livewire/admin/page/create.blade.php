<section class="flex flex-col w-full">
    <article class="flex justify-end">
        <button wire:click="submit" class="py-2 px-4 rounded bg-green-700 text-white">Save</button>
        <button wire:click="resetPage" class="py-2 px-4 rounded bg-red-700 text-white">Save</button>
    </article>
    <x-admin.form.input name="title">Title</x-admin.form.input>
    <x-admin.form.input name="slug">Slug</x-admin.form.input>
    {{ $canHavePosts }}
    <x-admin.form.input name="canHavePosts" type="checkbox">Page can have Posts</x-admin.form.input>


    <x-admin.form.textarea name="description">Description</x-admin.form.textarea>
    <x-admin.form.textarea name="content" class="flex-1">Content</x-admin.form.textarea>

</section>
