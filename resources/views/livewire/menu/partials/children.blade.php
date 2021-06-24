<ul class="list-disc list-inside ml-4">
    <li>{{ $id }} - {{ $item['title'] }} - {{ $item['route'] }}</li>
    @if(isset($item['children']) && count($item['children']) > 0)
        @foreach($item['children'] as $childId => $childItem)
            @include('livewire.menu.partials.children', ['id' => $childId, 'item' => $childItem])
        @endforeach
    @endif
</ul>
