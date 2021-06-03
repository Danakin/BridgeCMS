@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">{{ ucwords($page->title) }}</h1>

    <section>
        {{ $page->content }}
    </section>

    <section class="mt-4 divide-y">
    @foreach($posts as $post)
        <article class="my-2">
            <a href="{{ route('pages.posts.show', [$page, $post]) }}">{{ $post->title }}</a>
        </article>
    @endforeach
    {{ $posts->links() }}

    </section>
@endsection
