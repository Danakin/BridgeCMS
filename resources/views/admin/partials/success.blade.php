@if (session()->has('success'))
    <div class="border-gray-600 bg-green-700 text-white rounded m-4 p-4">
        <ul>
            {{ session()->get('success') }}
        </ul>
    </div>
@endif
