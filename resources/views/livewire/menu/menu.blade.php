<div class="border-gray-600 bg-white rounded m-4 p-4">
    <section class="text-xl font-bold">
        Edit Menu-Items
    </section>
    <section>
        @foreach($menuItems as $itemId => $item)
            @include('livewire.menu.partials.children', ['itemId' => $itemId, 'item' => $item])
        @endforeach
    </section>
</div>
