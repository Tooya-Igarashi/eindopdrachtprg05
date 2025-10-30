<x-app-layout>
<x-slot name="header">
Hello
</x-slot>
    <x-slot name="header_text">
        Admin Page</x-slot>
<table class="mx-auto">
    <thead>
    <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Name</th>
        <th class="px-4 py-2">Genre</th>
        <th class="px-4 py-2">Description</th>
        <th class="px-4 py-2">Time</th>
        <th class="px-4 py-2">Difficulty</th>
        <th class="px-4 py-2">Created At</th>
        <th class="px-4 py-2">Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($games as $game)
        <tr class="border-t">
            <td class="px-4 py-2">{{ $game->id }}</td>
            <td class="px-4 py-2">{{ $game->name }}</td>
            <td class="px-4 py-2">{{ $game->genre->name }}</td>
            <td class="px-4 py-2">{{ Str::limit($game->description, 50)}}</td>
            <td class="px-4 py-2">{{ $game->time}}</td>
            <td class="px-4 py-2">{{ $game->difficulty}}</td>
            <td class="px-4 py-2">{{ $game->created_at}}</td>
            <td class="px-4 py-2">{{ $game->updated_at}}</td>
            <td>
                <form method="POST" action="{{ route('games.authenticate', $game) }}" class="mt-4">
                    @csrf
                    @method('PATCH')
                    @if($game->validation_check === 0)
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                        Authenticate {{$game->validation_check}}
                    </button>
                    @elseif($game->validation_check === 1)
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                            Reverse Authentication {{$game->validation_check}}
                        </button>
                    @endif
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</x-app-layout>
