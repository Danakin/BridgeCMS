@extends('layouts.admin')

@section('content')
    <div class="border-gray-600 bg-white rounded m-4 p-4">
        <article class="w-10/12 px-2 py-1">
            <h2 class="text-2xl font-bold">{{ __('Add Page') }}</h2>
        </article>
        <article class="w-2/12 px-2 py-1 flex items-center">
            <a href="{{ route('admin.pages.index') }}"
               class="w-full flex items-center justify-center text-xs py-2 px-3 rounded text-white text-center bg-gray-500">Back
                to Page Overview</a>
        </article>
    </div>

    <div class="border-gray-600 bg-white rounded m-4 p-4 flex flex-1">
        <livewire:admin.page.create></livewire:admin.page.create>
    </div>
@endsection
