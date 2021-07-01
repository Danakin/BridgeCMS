<div x-data="{}" x-ref="top" class="border-gray-600 bg-white rounded m-4 p-4 flex flex-col flex-1">
    <section class="flex-1">
        @foreach($posts as $post)
            <article class="my-4 p-2 shadow rounded flex flex-wrap">
                <div class="w-8/12 font-bold">
                    {{ $post->title }}
                </div>
                <div class="w-2/12 px-2">by {{ $post->user->name }}</div>
                <div class="w-2/12 px-2">on {{ $post->created_at->format('Y-m-d') }}</div>
                <div class="w-full">{{ $post->description }}</div>
            </article>
        @endforeach
    </section>

    <section @click="$refs.top.scrollIntoView({ behavior: 'smooth'})">
        {{ $posts->links() }}
    </section>
</div>
