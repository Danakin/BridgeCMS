<article {{ $attributes->merge(['class' => 'flex flex-wrap']) }}>
    <div class="flex my-1 items-center w-1/5">{{ $slot }}</div>
    <div class="flex my-1 items-center w-4/5">
        <input wire:model="{{ $name }}"
               type="{{ $type }}"
               id="{{ $name }}"
               name="{{ $name }}"
               class="w-full rounded shadow-sm border-gray-200">
    </div>
    @error($name)
    <div class="w-full m-4 p-2 border-l-4 border-red-700 bg-red-300">{{ $message }}</div>
    @enderror
</article>
