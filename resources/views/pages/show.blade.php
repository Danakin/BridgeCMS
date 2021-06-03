@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">{{ ucwords($page->title) }}</h1>

    <section>
        {{ $page->content }}
    </section>

    <section class="mt-4">
    @foreach($posts as $post)
        <x-post.block :page="$page" :post="$post">
        </x-post.block>
    @endforeach
    {{ $posts->links() }}

    </section>
@endsection
