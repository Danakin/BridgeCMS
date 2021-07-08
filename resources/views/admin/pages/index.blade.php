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

    @if (session()->has('success'))
        <div class="border-gray-600 bg-green-700 text-white rounded m-4 p-4">
            <ul>
                {{ session()->get('success') }}
            </ul>
        </div>
    @endif

    <div class="border-gray-600 bg-white rounded m-4 p-4 flex items-center">
        <article class="w-10/12 px-2 py-1">
            <h2 class="text-2xl font-bold">Manage {{ ucwords(__('Pages')) }}</h2>
        </article>

        <article class="w-2/12 px-2 py-1 text-right">
            <a href="{{ route('admin.pages.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded font-bold">New Page</a>
        </article>
    </div>

    <div class="border-gray-600 bg-white rounded m-4 p-4 flex flex-1 flex-col divide-y-2">
        <article class="flex flex-wrap w-full p-4 font-bold">
            <div class="w-1/12 px-2">Title</div>
            <div class="w-10/12 px-2">Description</div>
            <div class="w-1/12 px-2">Links</div>
        </article>
        @foreach($pages as $page)
            <article class="flex flex-wrap w-full mt-2 p-4">
                <div class="w-1/12 px-2">
                    {{ $page->title }}
                </div>
                <div class="w-10/12 px-2">
                    {{ $page->description }}
                </div>
                <div class="w-1/12 px-2">
                    <a href="{{ route('admin.pages.show', $page) }}"
                       class="px-4 py-2 bg-green-500 text-white text-xs rounded flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <a
                        x-data="{}"
                        @click="
                        Swal.fire({
                          title: 'Are you sure?',
                          text: 'You won\'t be able to revert this!',
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Yes, delete it!'
                        })
                        .then(async (result) => {
                          if (result.isConfirmed) {
                            const result = await axios.delete('{{ route('admin.pages.destroy', $page) }}')
                            if(result.data.success === true) {
                              window.location = '{{ route('admin.pages.index') }}'
                            } else {
                              Swal.fire(
                              'Error!',
                                'Something went wrong.',
                                'error'
                              )
                            }
                          }
                        })
                        "
                        class="px-4 py-2 bg-red-500 text-white text-xs rounded flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </a>
                </div>
            </article>
        @endforeach
    </div>
@endsection
