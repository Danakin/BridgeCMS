<nav class="fixed top-0 left-0 bottom-0 w-64 bg-green-900 text-white flex flex-col justify-between">
    <ul>
        <li class="text-2xl font-bold text-center border-b-2 border-white mt-4">{{ config('app.name', 'Laravel') }}</li>
        @can('access-admin')
            <x-menu.item route="{{ route('admin.dashboard') }}" title="Admin Panel" class="mt-4 border-t-2 border-b-2 border-green-700"></x-menu.item>
        @endcan
        <x-menu.item route="{{ route('pages.show', 'home') }}" title="Home" class="mt-4"></x-menu.item>
        <x-menu.item route="{{ route('pages.show', 'about-us') }}" title="About Us"></x-menu.item>
        <x-menu.item route="{{ route('pages.show', 'contact') }}" title="Contact"></x-menu.item>
        <x-menu.item route="{{ route('pages.show', 'blog') }}" title="Blog"></x-menu.item>
        <x-menu.item route="{{ route('pages.show', 'tutorials') }}" title="Tutorials"></x-menu.item>
    </ul>
    @auth
    <section class="d-flex flex-col border-t-2 border-white">
        <article class="text-center py-2">{{ auth()->user()->email }}</article>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="py-2 w-full hover:bg-green-700">{{__('Logout')}}</button>
        </form>
    </section>
    @else
        <ul>
            <x-menu.item route="{{ route('login') }}" title="{{ __('Login') }}"></x-menu.item>
            <x-menu.item route="{{ route('register') }}" title="{{ __('Register') }}"></x-menu.item>
        </ul>
    @endauth
</nav>
