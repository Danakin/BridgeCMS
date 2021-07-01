@extends('layouts.admin')

@section('content')
    @if ($errors->any())
        <div class="border-gray-600 bg-red-700 text-white rounded m-4 p-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="border-gray-600 bg-white rounded m-4 p-4">
        <section class="flex w-full">
            <section id="header" class="flex w-full font-bold">
                <article class="w-10/12 px-2 py-1"><h2 class="text-2xl font-bold">{{ __('Add Page') }}</h2></article>
                <article class="w-2/12 px-2 py-1 flex">
                    <div class="mx-2">
                        <a href="{{ route('admin.menus.index') }}" class="w-full flex items-center justify-center text-xs py-2 px-3 rounded text-white text-center bg-gray-500">Back to Menu Overview</a>
                    </div>
                </article>
            </section>
        </section>
    </div>

    <div class="border-gray-600 bg-white rounded m-4 p-4 flex flex-1">
        <livewire:admin.page.create></livewire:admin.page.create>
    </div>
@endsection
