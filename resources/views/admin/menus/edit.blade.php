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
                <article class="w-10/12 px-2 py-1"><h2 class="text-2xl font-bold">Manage Menus</h2></article>
                <article class="w-2/12 px-2 py-1 flex">
                    <div class="mx-2">
                        <a href="{{ route('admin.menus.index') }}" class="w-full flex items-center justify-center text-xs py-2 px-3 rounded text-white text-center bg-gray-500">Back to Menu Overview</a>
                    </div>
                </article>
            </section>
        </section>
    </div>

    <div class="border-gray-600 bg-white rounded m-4 p-4">
        <section id="header" class="flex w-full divide-x-2 font-bold">
            <form action="{{ route('admin.menus.update', $menu) }}" method="POST" class="w-full">
                @csrf
                @method('PUT')
                <div class="flex my-4">
                    <label for="title" class="w-1/3">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $menu->title) }}" class="border-gray-400 rounded px-4 py-2 flex-1">
                </div>
                <div class="flex my-4">
                    <label for="description" class="w-1/3">Description</label>
                    <textarea name="description" id="description" class="border-gray-400 rounded px-4 py-2 flex-1">{{ old('description', $menu->description) }}</textarea>
                </div>
                <div class="flex justify-end">
                    <button class="rounded bg-blue-500 px-4 py-2 text-white">Update MENU</button>
                </div>
            </form>
        </section>
    </div>

    <livewire:menu.menu :menuItems="$menuItems"></livewire:menu.menu>

@endsection
