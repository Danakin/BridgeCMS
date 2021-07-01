<nav class="fixed top-0 left-0 bottom-0 w-64 bg-gray-900 text-white flex flex-col justify-between">
    <ul>
        <li class="text-2xl font-bold text-center border-b-2 border-white mt-4">Admin Panel</li>
        <x-menu.admin.item route="{{ route('welcome') }}" title="Back To Homepage" class="mt-4 border-t-2 border-b-2 border-gray-700"></x-menu.admin.item>
        <x-menu.admin.item route="{{ route('admin.menus.index') }}" title="{{ __('Menus') }}"></x-menu.admin.item>
        @foreach($pages as $page)
        <x-menu.admin.item route="{{ route('admin.pages.show', $page) }}" title="{{ ucwords(__($page->title)) }}"></x-menu.admin.item>
        @endforeach
    </ul>

    <section class="d-flex flex-col border-t-2 border-white">
        <article class="text-center py-2">{{ auth()->user()->email }}</article>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="py-2 w-full hover:bg-gray-700">{{__('Logout')}}</button>
        </form>
    </section>
</nav>
