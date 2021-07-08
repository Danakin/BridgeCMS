@if ($errors->any())
    <div class="border-gray-600 bg-red-700 text-white rounded m-4 p-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
