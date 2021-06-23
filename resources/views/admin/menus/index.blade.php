@extends('layouts.admin')

@section('content')

    @if(Session::has('success'))
        <div class="border-gray-600 bg-green-700 text-white rounded m-4 p-4">
            {{ Session::get('success') }}
        </div>
    @endif

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
                        <a href="{{ route('admin.menus.create') }}" class="w-full flex items-center justify-center text-xs px-4 py-2 rounded text-white text-center bg-blue-500">New Menu</a>
                    </div>
                </article>
            </section>
        </section>
    </div>

    <div class="border-gray-600 bg-white rounded m-4 p-4">
        <section id="header" class="flex w-full divide-x-2 font-bold">
            <article class="w-2/12 px-2 py-1">Title</article>
            <article class="w-8/12 px-2 py-1">Description</article>
            <article class="w-2/12 px-2 py-1">Options</article>
        </section>
    @forelse($menus as $menu)
        <section x-data="{ title: '{{ $menu->title }}' }" class="flex w-full divide-x-2 my-2">
            <article class="w-2/12 px-2 py-1">{{ $menu->title }}</article>
            <article class="w-8/12 px-2 py-1">{{ $menu->short_description }}</article>
            <article class="w-2/12 px-2 py-1 flex">
                <div class="mx-2 w-1/3">
                    <a href="{{ route('admin.menus.show', $menu) }}" class="w-full flex items-center justify-center text-xs py-2 rounded text-white text-center bg-blue-500">Details</a>
                </div>
                <div class="mx-2 w-1/3">
                    <a href="{{ route('admin.menus.edit', $menu) }}" class="w-full flex items-center justify-center text-xs py-2 rounded text-white text-center bg-green-500">Edit</a>
                </div>
                <div class="mx-2 w-1/3">
                    <a
                        x-on:click="
                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'Delete item? ' + title,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            })
                            .then(async (result) => {
                                if (result.isConfirmed) {
                                    return await axios.delete('{{ route('admin.menus.destroy', $menu) }}');
                                }
                                return {};
                            })
                            .then(result => {
                                if(result.status === 200 && result.data.success === true) {
                                    window.location.reload()
                                }
                            })
                            .catch((error) => {
                                console.log(error);
                                Swal.fire({
                                    title: 'Uhoh!?',
                                    text: 'Something went wrong! We could not delete {{ $menu->title }}',
                                    icon: 'error'
                                })
                            })
                        "
                        class="w-full flex items-center justify-center text-xs py-2 rounded text-white text-center bg-red-500">Delete</a>
                </div>
            </article>
        </section>
    @empty
        <div>No menus created yet</div>
    @endforelse
    </div>
@endsection
