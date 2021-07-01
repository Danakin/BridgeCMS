<li x-data="{ edit: false, title: @entangle('title'), }" x-on:saved="edit=false">

    <div class="flex justify-between">
        <div>
            <p x-show="!edit">
                {{ $itemId }}: {{ $order }} - {{ $title }} - {{ $route }}
            </p>
            <input x-show="edit" type="text" x-model="title">
            @error('title') <span class="error">{{ $message }}</span> @enderror
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div>
            <button x-show="!edit" @click="edit=true" class="px-4 py-2 w-32 bg-green-600 text-white">EDIT</button>
            <button x-show="edit" wire:click="save({{ $itemId }})" style="display: none" class="px-4 py-2 w-32 bg-green-600 text-white">SAVE</button>
            <button x-show="edit" @click="edit=false" style="display: none" class="px-4 py-2 w-32 bg-green-600 text-white">Cancel</button>
        </div>
    </div>
    <div x-html="title"></div>
    <div>{{ $title }}</div>
</li>
