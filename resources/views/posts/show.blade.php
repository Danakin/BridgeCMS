@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">{{ ucwords($post->title) }}</h1>

    <section class="mt-4 p-4">
        {!! nl2br($post->description) !!}
    </section>

    <section class="mt-4">
        <a href="{{ route('pages.show', $page) }}">&lAarr; Back to {{ ucwords($page->title) }}</a>
    </section>
@endsection
