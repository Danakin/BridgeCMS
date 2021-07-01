<ul class="list-disc list-inside ml-4 px-4 py-2 my-2 border border-gray-300 rounded">
    <livewire:menu.menu-item :itemId="$itemId" :item="$item"></livewire:menu.menu-item>
    @if(isset($item['children']) && count($item['children']) > 0)
        @foreach($item['children'] as $childId => $childItem)
            @include('livewire.menu.partials.children', ['itemId' => $childId, 'item' => $childItem])
        @endforeach
    @endif
</ul>
