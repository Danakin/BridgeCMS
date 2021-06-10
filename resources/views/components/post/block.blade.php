<article class="my-2 p-4 border shadow-sm">
    <h2 class="text-xl font-bold mb-4">
        <a href="{{ route('pages.posts.show', [$page, $post]) }}">{{ $post->title }}</a>
    </h2>
    <p>
        {!! nl2br($post->short_description) !!}
    </p>
    {{ $slot }}
</article>
